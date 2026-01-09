<?php

namespace App\Repositories;

use App\Models\Cpl;
use App\Models\Rps;
use App\Models\Prodi;
use App\Models\Course;
use App\Models\Fakultas;
use Illuminate\Http\Request;

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

    public function findProdiBySlug(string $slug): Prodi
    {
        return Prodi::with('fakultas')
            ->where('slug', $slug)
            ->firstOrFail();
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

    public function getCoursesByProdi(int $prodiId, Request $request)
    {
        return Course::where('prodi_id', $prodiId)
            ->when(
                $request->semester,
                fn($q) =>
                $q->where('semester', $request->semester)
            )
            ->when(
                $request->search,
                fn($q) =>
                $q->where(function ($qq) use ($request) {
                    $qq->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('code', 'like', '%' . $request->search . '%');
                })
            )
            ->orderBy('semester')
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();
    }


    /**
     * Mencari mata kuliah berdasarkan slug.
     */
    public function findCourseBySlug(string $slug): Course
    {
        return Course::with('prodi')->whereSlug($slug)->firstOrFail();
    }


    /**
     * Mengambil data RPS lengkap dengan semua relasi yang dibutuhkan view.
     */
    public function getRpsWithRelations(int $courseId): ?Rps
    {
        return Rps::with([
            'dosen',
            'cpls' => fn($q) => $q->withPivot('bobot')->with('cpmk'),
            'cpmks.subCpmks.rencanas',
            'evaluasis.subCpmk',
            'evaluasis.cpmk.cpl',
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
