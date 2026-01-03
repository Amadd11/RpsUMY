<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rps_id')->constrained()->cascadeOnDelete();
            $table->string('bentuk_penilaian')->nullable();
            $table->string('judul_penilaian')->nullable();
            $table->text('sub_cpmk')->nullable();
            $table->text('deskripsi_penilaian')->nullable();
            $table->text('metode_penilaian')->nullable();
            $table->text('bentuk_dan_format_luaran')->nullable();
            $table->text('indikator_kriteria_bobot')->nullable();
            $table->text('jadwal_pelaksanaan')->nullable(); 
            $table->text('pustaka')->nullable();
            $table->text('lain_lain')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};
