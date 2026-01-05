<?php

namespace App\Http\Controllers;

use App\Services\DokumenService;

class DokumenController extends Controller
{
    protected $service;

    public function __construct(DokumenService $service)
    {
        $this->service = $service;
    }

    /**
     * STEP 1: Pilih Fakultas
     */
    public function fakultas()
    {
        $data = $this->service->getFakultasData();

        return view('dokumen.fakultas', $data);
    }

    /**
     * STEP 2: Pilih Prodi
     */
    public function prodi(string $slug)
    {
        $data = $this->service->getProdiByFakultas($slug);

        return view('dokumen.prodi', $data);
    }

    /**
     * STEP 3: List Dokumen
     */
    public function list(string $slug)
    {
        $data = $this->service->getDokumenByProdi($slug);

        return view('dokumen.index', $data);
    }
}
