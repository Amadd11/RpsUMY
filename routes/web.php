<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\RpsController;

Route::get('/', [FrontController::class, 'index'])->name('index');

Route::get('/about', [FrontController::class, 'about'])->name('about');

Route::prefix('rps')->group(function () {

    Route::get('/fakultas', [RpsController::class, 'fakultas'])
        ->name('rps.fakultas');

    Route::get('/fakultas/{slug}', [RpsController::class, 'prodiByFakultas'])
        ->name('rps.prodi');

    Route::get('/prodi/{slug}', [RpsController::class, 'showProdi'])
        ->name('rps.prodi.show');

    Route::get('/prodi/course/{slug}', [RpsController::class, 'showRps'])
        ->name('rps.course.show');
});
