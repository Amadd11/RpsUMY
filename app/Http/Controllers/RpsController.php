<?php

namespace App\Http\Controllers;

use App\Services\RpsService;
use Illuminate\Http\Request;

class RpsController extends Controller
{
    /**
     * Dependency Injection RpsService.
     * Dengan cara ini, Controller tidak perlu tahu detail kueri database.
     */
    protected $rpsService;

    public function __construct(RpsService $rpsService)
    {
        $this->rpsService = $rpsService;
    }

    public function fakultas()
    {
        $fakultas = $this->rpsService->getFakultasData();

        return view('rps.fakultas', compact('fakultas'));
    }

    /**
     * Menampilkan daftar prodi berdasarkan fakultas.
     */
    public function prodiByFakultas(string $slug)
    {
        $data = $this->rpsService->getProdiDataByFakultas($slug);

        return view('rps.prodi', $data);
    }

    /**
     * Menampilkan detail prodi dan daftar mata kuliahnya.
     */
    public function showProdi(string $slug, Request $request)
    {
        $data = $this->rpsService->getProdiDetailsPaginated($slug, $request);

        return view('rps.details-prodi', $data);
    }



    /**
     * Menampilkan detail RPS secara dinamis.
     * Semua logika grouping CPL/CPMK sudah ditangani di dalam Service.
     */
    public function showRps(string $slug)
    {

        $data = $this->rpsService->getRpsDetails($slug);

        return view('rps.index', $data);
    }
}
