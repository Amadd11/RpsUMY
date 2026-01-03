<?php

namespace App\Services;

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

    /**
     * Menyiapkan data kompleks untuk halaman RPS.
     * Termasuk logika grouping data agar Controller tetap bersih.
     */
    public function getRpsDetails(string $slug)
    {
        $course = $this->rpsRepository->findCourseBySlug($slug);
        $rps = $this->rpsRepository->getRpsWithRelations($course->id);

        if (!$rps) {
            return null;
        }

        // Olah data: Grouping & Transformasi
        return [
            'course'          => $course,
            'rps'             => $rps,
            'allCpls'         => $this->rpsRepository->getAllCplsByProdiId($course->prodi_id),
            'selectedCplIds'  => $rps->cpls->pluck('id')->toArray(),
            'totalBobot'      => $rps->cpls->sum('pivot.bobot'),
            'groupedCpmks'    => $rps->cpmks->groupBy('cpl_id'),
            'groupedEvaluasi' => $rps->evaluasis->groupBy('cpmk_id'),
        ];
    }
}
