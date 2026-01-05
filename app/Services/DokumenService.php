<?php

namespace App\Services;

use App\Repositories\DokumenRepository;

class DokumenService
{
    protected $repository;

    public function __construct(DokumenRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getFakultasData(): array
    {
        return [
            'fakultas' => $this->repository->getAllFakultas(),
        ];
    }

    public function getProdiByFakultas(string $slug): array
    {
        $fakultas = $this->repository->findFakultasBySlug($slug);

        return [
            'fakultas' => $fakultas,
            'prodis'   => $this->repository->getProdiByFakultas($fakultas->id),
        ];
    }

    public function getDokumenByProdi(string $slug): array
    {
        $prodi = $this->repository->findProdiBySlug($slug);

        return [
            'prodi'    => $prodi,
            'dokumens' => $this->repository->getDokumenByProdi($prodi->id),
        ];
    }

    public function getSingleMatriksByProdiId(int $prodiId)
    {
        return $this->repository->getDokumenByProdi($prodiId, true);
    }
}
