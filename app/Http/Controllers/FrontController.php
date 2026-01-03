<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    //
    public function index()
    {
        $fakultas = Fakultas::withCount('prodi')->get();

        return view('index', compact('fakultas'));
    }

    public function about()
    {
        return view('about');
    }
}
