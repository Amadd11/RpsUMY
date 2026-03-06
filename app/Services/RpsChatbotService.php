<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RpsChatbotService
{
    private string $endpoint;
    private string $apiKey;
    private string $model;

    public function __construct(
        protected RpsService $rpsService
    ) {
        $this->endpoint = config('services.qwen.endpoint', 'https://dashscope-intl.aliyuncs.com/compatible-mode/v1/chat/completions');
        $this->apiKey   = config('services.qwen.api_key');
        $this->model    = config('services.qwen.model', 'qwen-turbo');
    }

    // ──────────────────────────────────────────
    // Non-streaming (fallback)
    // ──────────────────────────────────────────
    public function ask(?int $rpsId, string $question): string
    {
        [$instruction, $contextData] = $this->determineContext($rpsId, $question);
        $systemContent = $this->buildSystemContent($instruction, $contextData);

        try {
            $response = Http::withToken($this->apiKey)
                ->timeout(30)
                ->post($this->endpoint, [
                    'model'       => $this->model,
                    'messages'    => [
                        ['role' => 'system', 'content' => $systemContent],
                        ['role' => 'user',   'content' => $question],
                    ],
                    'temperature' => 0.2,
                    'max_tokens'  => 1000,
                ]);

            if ($response->failed()) {
                Log::error('Qwen API Error', [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
                return "Maaf, asisten AI sedang mengalami gangguan. Silakan coba lagi nanti.";
            }

            return $response->json('choices.0.message.content')
                ?? "Maaf, tidak ada respons dari asisten.";
        } catch (\Exception $e) {
            Log::error("Chatbot Error: " . $e->getMessage());
            return "Maaf, asisten AI sedang mengalami gangguan. Silakan coba lagi nanti.";
        }
    }

    // ──────────────────────────────────────────
    // Streaming — jawaban muncul bertahap
    // ──────────────────────────────────────────
    public function stream(?int $rpsId, string $question): \Generator
    {
        [$instruction, $contextData] = $this->determineContext($rpsId, $question);
        $systemContent = $this->buildSystemContent($instruction, $contextData);

        $response = Http::withToken($this->apiKey)
            ->timeout(60)
            ->withOptions(['stream' => true])
            ->post($this->endpoint, [
                'model'       => $this->model,
                'messages'    => [
                    ['role' => 'system', 'content' => $systemContent],
                    ['role' => 'user',   'content' => $question],
                ],
                'temperature' => 0.2,
                'max_tokens'  => 1000,
                'stream'      => true,
            ]);

        $body   = $response->getBody();
        $buffer = '';

        while (!$body->eof()) {
            $buffer .= $body->read(1024);

            while (($pos = strpos($buffer, "\n")) !== false) {
                $line   = trim(substr($buffer, 0, $pos));
                $buffer = substr($buffer, $pos + 1);

                if (!str_starts_with($line, 'data:')) continue;

                $json = trim(substr($line, 5));
                if ($json === '[DONE]') return;

                $chunk = json_decode($json, true);
                $text  = $chunk['choices'][0]['delta']['content'] ?? '';
                if ($text !== '') yield $text;
            }
        }
    }

    // ──────────────────────────────────────────
    // Helpers
    // ──────────────────────────────────────────
    private function buildSystemContent(string $instruction, ?string $contextData): string
    {
        $systemContent = $instruction;

        $systemContent .= "\n\nFORMAT JAWABAN:";
        $systemContent .= "\n- Gunakan paragraf yang rapi.";
        $systemContent .= "\n- Gunakan bullet list jika menjelaskan poin.";
        $systemContent .= "\n- Jangan memotong kata atau kalimat.";

        if ($contextData) {
            $trimmedContext = mb_substr($contextData, 0, 3000);
            if (mb_strlen($contextData) > 3000) {
                $trimmedContext .= "\n[... data dipotong karena terlalu panjang]";
            }

            $systemContent .= "\n\nKONTEKS DATA:\n" . $trimmedContext;
            $systemContent .= "\n\nPENTING: Prioritaskan data di atas saat menjawab. " .
                "Jika tidak ada dalam data, boleh jawab secara umum.";
        }

        return $systemContent;
    }

    private function determineContext(?int $rpsId, string $question): array
    {
        if ($rpsId) {
            $context = $this->rpsService->getRpsContextForChat($rpsId);
            if ($context) {
                return [
                    'Kamu adalah asisten akademik. Jawab berdasarkan data RPS yang diberikan. ' .
                        'Jika pertanyaan di luar data, jawab secara umum dengan sopan.',
                    $context,
                ];
            }
        }

        $dbContext = $this->fetchDatabaseContext($question);
        if ($dbContext) {
            return [
                'Kamu adalah asisten akademik portal RPS. ' .
                    'Prioritaskan data yang tersedia untuk menjawab. ' .
                    'Jika tidak ada dalam data, jawab secara umum.',
                $dbContext,
            ];
        }

        if ($this->isWebsiteQuestion($question)) {
            return [
                'Kamu adalah asisten website Portal Akademik RPS.',
                $this->buildWebsiteContext(),
            ];
        }

        return [
            'Kamu adalah asisten AI akademik. Jawab singkat, jelas, dan sopan. ' .
                'Jika ditanya data spesifik yang tidak tersedia, sarankan membuka halaman RPS terkait.',
            null,
        ];
    }

    private function fetchDatabaseContext(string $question): ?string
    {

        if ($this->isAskingAboutFakultas($question)) {
            return $this->rpsService->getAllFakultasContext();
        }

        if ($this->isAskingForList($question)) {
            return $this->rpsService->getAllCoursesContext();
        }

        // Cari mata kuliah spesifik
        if ($this->isRpsQuestion($question)) {
            $stopWords = [
                'apa',
                'saja',
                'yang',
                'ada',
                'pada',
                'dari',
                'untuk',
                'cpl',
                'cpmk',
                'sub',
                'rps',
                'referensi',
                'tugas',
                'mata',
                'kuliah',
                'adalah',
                'bagaimana',
                'berapa',
                'sks',
                'ini',
                'itu',
                'dan',
                'atau',
                'dengan',
                'di',
                'ke',
                'nya',
                'sebutkan',
                'jelaskan',
                'tolong',
                'mohon',
                'bisa',
            ];

            $words    = preg_split('/\s+/', strtolower($question));
            $keywords = array_diff($words, $stopWords);

            foreach ($keywords as $keyword) {
                if (strlen($keyword) < 3) continue;
                $context = $this->rpsService->findRpsByCourseName($keyword);
                if ($context) return $context;
            }
        }

        return null;
    }

    private function isAskingAboutFakultas(string $question): bool
    {
        return (bool) preg_match(
            '/fakultas|faculty|prodi|program\s*studi|jurusan/i',
            $question
        );
    }

    private function isAskingForList(string $question): bool
    {
        return (bool) preg_match(
            '/daftar|list|ada\s*apa\s*saja|apa\s*saja|semua\s*mata\s*kuliah|mata\s*kuliah\s*apa/i',
            $question
        );
    }

    private function isRpsQuestion(string $question): bool
    {
        return (bool) preg_match(
            '/rps|cpmk|cpl|sub\s*cpmk|sks|mata\s*kuliah|evaluasi|tugas/i',
            $question
        );
    }

    private function isWebsiteQuestion(string $question): bool
    {
        return (bool) preg_match(
            '/website|portal|aplikasi|fitur|menu|cara\s*pakai|login|daftar/i',
            $question
        );
    }

    private function buildWebsiteContext(): string
    {
        return <<<TEXT
Website ini adalah Portal Akademik.

Fitur utama:
- Informasi Fakultas & Program Studi
- Daftar Mata Kuliah
- RPS (Rencana Pembelajaran Semester)
- Detail CPL, CPMK, dan Sub CPMK
- Referensi dan Tugas Mata Kuliah

Website digunakan oleh mahasiswa dan dosen.
TEXT;
    }
}
