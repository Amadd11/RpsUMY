<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\RpsRepository;

class RpsService
{
    protected RpsRepository $rpsRepository;

    public function __construct(RpsRepository $rpsRepository)
    {
        $this->rpsRepository = $rpsRepository;
    }

    public function getFakultasData()
    {
        return $this->rpsRepository->getAllFakultas();
    }

    public function getProdiDataByFakultas(string $slug)
    {
        $fakultas = $this->rpsRepository->findFakultasBySlug($slug);
        $prodis   = $this->rpsRepository->getProdiByFakultasId($fakultas->id);

        return compact('fakultas', 'prodis');
    }

    public function getProdiDetails(string $slug)
    {
        return $this->rpsRepository->findProdiWithCoursesBySlug($slug);
    }

    public function getProdiDetailsPaginated(string $slug, Request $request)
    {
        $prodi   = $this->rpsRepository->findProdiBySlug($slug);
        $courses = $this->rpsRepository->getCoursesByProdi($prodi->id, $request);

        return compact('prodi', 'courses');
    }

    public function getRpsDetails(string $slug)
    {
        $course = $this->rpsRepository->findCourseBySlug($slug);
        $rps    = $this->rpsRepository->getRpsWithRelations($course->id);

        $groupedCpmks = $rps?->cpls
            ?->mapWithKeys(function ($cpl) {
                return [
                    $cpl->id => [
                        'cpl'   => $cpl,
                        'cpmks' => $cpl->cpmk,
                    ],
                ];
            }) ?? collect();

        $rencanas = $rps?->rencanas
            ->sortBy('week')
            ->values() ?? collect();

        $groupedEvaluasi = $rps?->evaluasis
            ?->groupBy('cpmk_id')
            ->map(function ($items) {
                $cpmk = $items->first()->cpmk;
                return [
                    'cpl'              => $cpmk?->cpl,
                    'cpmk'             => $cpmk,
                    'items'            => $items,
                    'total_bobot_cpmk' => $items->sum('bobot_sub_cpmk'),
                    'week_counts'      => $items->countBy('week'),
                ];
            }) ?? collect();

        return [
            'course'             => $course,
            'rps'                => $rps,
            'rencanas'           => $rencanas,
            'allCpls'            => $this->rpsRepository->getAllCplsByProdiId($course->prodi_id),
            'selectedCplIds'     => $rps?->cpls?->pluck('id')->toArray() ?? [],
            'totalBobotCpl'      => $rps?->cpls?->sum('pivot.bobot') ?? 0,
            'groupedCpmks'       => $groupedCpmks,
            'daftarTugas'        => $rps?->tugas ?? collect(),
            'groupedEvaluasi'    => $groupedEvaluasi,
            'totalBobotRencana'  => $rps?->rencanas->sum('bobot'),
            'totalBobotEvaluasi' => $groupedEvaluasi->pluck('items')->flatten()->sum('bobot_sub_cpmk'),
            'referensi'          => $rps?->referensi ?? collect(),
        ];
    }

    // ──────────────────────────────────────────
    // Chatbot Context Methods
    // ──────────────────────────────────────────

    public function getRpsContextForChat(int $rpsId): ?string
    {
        $rps = $this->rpsRepository->getRpsWithRelationsByRpsId($rpsId);

        if (!$rps) return null;

        $text = [];

        $text[] = "=== INFORMASI MATA KULIAH ===";
        $text[] = "Mata Kuliah  : {$rps->course->name}";
        $text[] = "Program Studi: {$rps->course->prodi->name}";
        $text[] = "Semester     : {$rps->course->semester}";
        $text[] = "SKS          : {$rps->course->sks}";

        if ($rps->deskripsi) {
            $text[] = "Deskripsi    : " . strip_tags($rps->deskripsi);
        }

        if ($rps->cpls && $rps->cpls->isNotEmpty()) {
            $text[] = "\n=== CPL (CAPAIAN PEMBELAJARAN LULUSAN) ===";
            foreach ($rps->cpls as $cpl) {
                $bobot    = $cpl->pivot->bobot ?? null;
                $bobotStr = $bobot !== null ? " (Bobot: {$bobot}%)" : '';
                $text[]   = "CPL {$cpl->code}{$bobotStr}: " . strip_tags($cpl->description);
            }
        }

        if ($rps->cpmks && $rps->cpmks->isNotEmpty()) {
            $text[] = "\n=== CPMK & SUB CPMK ===";
            foreach ($rps->cpmks as $cpmk) {
                $text[] = "CPMK {$cpmk->code}: " . strip_tags($cpmk->description);
                foreach ($cpmk->subCpmks as $sub) {
                    $text[] = "  - Sub CPMK {$sub->code}: " . strip_tags($sub->description);
                }
            }
        }

        if ($rps->referensi && $rps->referensi->isNotEmpty()) {
            $text[] = "\n=== REFERENSI ===";
            foreach ($rps->referensi as $ref) {
                $jenis   = $ref->jenis ?? 'Umum';
                $penulis = $ref->penulis ? " — {$ref->penulis}" : '';
                $text[]  = "[{$jenis}] {$ref->judul}{$penulis}";
            }
        }

        if ($rps->tugas && $rps->tugas->isNotEmpty()) {
            $text[] = "\n=== TUGAS ===";
            foreach ($rps->tugas as $tugas) {
                $deskripsi = $tugas->deskripsi ? ": " . strip_tags($tugas->deskripsi) : '';
                $text[]    = "- {$tugas->judul}{$deskripsi}";
            }
        }

        return implode("\n", $text);
    }

    // ✅ Method ini sebelumnya tidak ada — wajib ditambahkan
    public function getAllFakultasContext(): ?string
    {
        $fakultasList = $this->rpsRepository->getAllFakultas();

        if ($fakultasList->isEmpty()) return null;

        $text   = ["=== DATA FAKULTAS & PROGRAM STUDI ==="];
        $text[] = "Jumlah Fakultas: " . $fakultasList->count();

        foreach ($fakultasList as $index => $fakultas) {
            $text[] = "\n" . ($index + 1) . ". Fakultas: {$fakultas->name}";
            if ($fakultas->prodis && $fakultas->prodis->isNotEmpty()) {
                $text[] = "   Jumlah Prodi: " . $fakultas->prodis->count();
                foreach ($fakultas->prodis as $prodi) {
                    $text[] = "   - {$prodi->name}";
                }
            }
        }

        return implode("\n", $text);
    }

    public function getAllCoursesContext(): ?string
    {
        $fakultasList = $this->rpsRepository->getAllFakultas();

        if ($fakultasList->isEmpty()) return null;

        $text = ["=== DAFTAR MATA KULIAH ==="];

        foreach ($fakultasList as $fakultas) {
            foreach ($fakultas->prodis ?? [] as $prodi) {
                $text[] = "\nProgram Studi: {$prodi->name}";
                foreach ($prodi->courses ?? [] as $course) {
                    $text[] = "  - {$course->name} | Semester {$course->semester} | {$course->sks} SKS";
                }
            }
        }

        return implode("\n", $text);
    }

    public function findRpsByCourseName(string $keyword): ?string
    {
        $fakultasList = $this->rpsRepository->getAllFakultas();

        foreach ($fakultasList as $fakultas) {
            foreach ($fakultas->prodis ?? [] as $prodi) {
                foreach ($prodi->courses ?? [] as $course) {
                    if (stripos($course->name, $keyword) !== false) {
                        $rps = $this->rpsRepository->getRpsWithRelations($course->id);
                        if ($rps) {
                            return $this->getRpsContextForChat($rps->id);
                        }
                        return "Mata kuliah {$course->name} ditemukan tetapi RPS belum tersedia.";
                    }
                }
            }
        }

        return null;
    }
}
