<?php

namespace App\Repositories;

use App\Models\Rps;
use App\Models\Fakultas;
use App\Models\Prodi;
use App\Models\Course;
use App\Models\Cpl;

class RpsRepository
{
    /**
     * Mengambil semua data fakultas beserta jumlah prodi di dalamnya.
     */
    public function getAllFakultas()
    {
        return Fakultas::withCount('prodi')->get();
    }

    /**
     * Mencari satu fakultas berdasarkan slug.
     */
    public function findFakultasBySlug(string $slug)
    {
        return Fakultas::where('slug', $slug)->firstOrFail();
    }

    /**
     * Mengambil daftar prodi berdasarkan ID fakultas.
     */
    public function getProdiByFakultasId(int $fakultasId)
    {
        return Prodi::where('fakultas_id', $fakultasId)->with('fakultas')->get();
    }

    /**
     * Mengambil detail prodi beserta daftar mata kuliahnya.
     */
    public function findProdiWithCoursesBySlug(string $slug)
    {
        return Prodi::where('slug', $slug)
            ->with([
                'fakultas',
                'courses' => fn($q) => $q->orderBy('semester')->orderBy('name')
            ])
            ->firstOrFail();
    }

    /**
     * Mencari mata kuliah berdasarkan slug.
     */
    public function findCourseBySlug(string $slug)
    {
        return Course::whereSlug($slug)->firstOrFail();
    }

    /**
     * Mengambil data RPS lengkap dengan semua relasi yang dibutuhkan view.
     */
    public function getRpsWithRelations(int $courseId)
    {
        return Rps::with([
            'dosen',
            'cpls' => function ($query) {
                $query->withPivot('bobot')
                    ->with('cpmk');
            },
            'cpmks.subCpmks.rencanas',
            'evaluasis.cpmk',
            'evaluasis.subCpmk',
            'referensi',
            'tugas',
        ])
            ->where('course_id', $courseId)
            ->latest()
            ->first();
    }

    /**
     * Mengambil semua CPL standar dari sebuah Program Studi.
     */
    public function getAllCplsByProdiId(int $prodiId)
    {
        return Cpl::where('prodi_id', $prodiId)
            ->orderBy('code')
            ->get();
    }
}
