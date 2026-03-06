<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RpsChatbotService;
use Illuminate\Support\Facades\Log;

class RpsChatbotController extends Controller
{
    public function ask(Request $request, RpsChatbotService $chatbotService)
    {
        try {
            $validated = $request->validate([
                'message' => ['required', 'string', 'max:1000'],
                'rps_id'  => ['nullable', 'integer'],
            ]);

            $answer = $chatbotService->ask(
                $validated['rps_id'] ?? null,
                $validated['message']
            );

            return response()->json([
                'success' => true,
                'reply'   => $answer,
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => collect($e->errors())->flatten()->first(),
            ], 422);
        } catch (\Throwable $e) {
            Log::error($e);
            return response()->json([
                'success' => false,
                'message' => 'AI sedang sibuk, coba lagi beberapa saat.',
            ], 500);
        }
    }

    public function stream(Request $request, RpsChatbotService $chatbotService)
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:1000'],
            'rps_id'  => ['nullable', 'integer'],
        ]);

        return response()->stream(function () use ($validated, $chatbotService) {
            try {
                foreach ($chatbotService->stream($validated['rps_id'] ?? null, $validated['message']) as $chunk) {
                    echo "data: " . json_encode(['text' => $chunk]) . "\n\n";
                    ob_flush();
                    flush();
                }
            } catch (\Throwable $e) {
                Log::error('Chatbot Stream Error: ' . $e->getMessage());
                echo "data: " . json_encode(['error' => 'AI sedang sibuk, coba lagi beberapa saat.']) . "\n\n";
                ob_flush();
                flush();
            }

            echo "data: [DONE]\n\n";
            ob_flush();
            flush();
        }, 200, [
            'Content-Type'      => 'text/event-stream',
            'Cache-Control'     => 'no-cache',
            'X-Accel-Buffering' => 'no', // Penting untuk Nginx
        ]);
    }
}
