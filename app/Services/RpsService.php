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
        $prodis = $this->rpsRepository->getProdiByFakultasId($fakultas->id);

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

    /**
     * Menyiapkan data kompleks untuk halaman RPS.
     * Termasuk logika grouping data agar Controller tetap bersih.
     */
    public function getRpsDetails(string $slug)
    {
        $course = $this->rpsRepository->findCourseBySlug($slug);
        $rps = $this->rpsRepository->getRpsWithRelations($course->id);

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
                    'cpl' => $cpmk?->cpl,
                    'cpmk' => $cpmk,
                    'items' => $items,
                    'total_bobot_cpmk' => $items->sum('bobot_sub_cpmk'),
                    'week_counts' => $items->countBy('week'),
                ];
            }) ?? collect();

        // Olah data: Grouping & Transformasi
        return [
            'course'          => $course,
            'rps'             => $rps,
            'rencanas'       => $rencanas,
            'allCpls'         => $this->rpsRepository->getAllCplsByProdiId($course->prodi_id),
            'selectedCplIds'  => $rps?->cpls?->pluck('id')->toArray() ?? [],
            'totalBobotCpl'      => $rps?->cpls?->sum('pivot.bobot') ?? 0,
            'groupedCpmks'    => $groupedCpmks,
            'daftarTugas'     => $rps?->tugas ?? collect(),
            'groupedEvaluasi' => $groupedEvaluasi,
            'totalBobotRencana' => $rps?->rencanas->sum('bobot'),
            'totalBobotEvaluasi' => $groupedEvaluasi->pluck('items')->flatten()->sum('bobot_sub_cpmk'),
            'referensi'      => $rps?->referensi ?? collect(),
        ];
    }
}
