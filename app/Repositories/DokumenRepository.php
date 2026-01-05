<?php

namespace App\Repositories;

use App\Models\Dokumen;
use App\Models\Fakultas;
use App\Models\Prodi;

class DokumenRepository
{

    public function getAllFakultas()
    {
        return Fakultas::withCount('prodi')
            ->orderBy('name')
            ->get();
    }

    public function findFakultasBySlug(string $slug): Fakultas
    {
        return Fakultas::whereSlug($slug)->firstOrFail();
    }

    public function getProdiByFakultas(int $fakultasId)
    {
        return Prodi::where('fakultas_id', $fakultasId)
            ->orderBy('name')
            ->get();
    }

    public function findProdiBySlug(string $slug): Prodi
    {
        return Prodi::whereSlug($slug)
            ->with('fakultas')
            ->firstOrFail();
    }

    public function getDokumenByProdi(int $prodiId)
    {
        return Dokumen::where('prodi_id', $prodiId)
            ->orderBy('created_at', 'asc')
            ->get();
    }
}
