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
        Schema::create('rencanas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subcpmk_id')->constrained()->cascadeOnDelete();
            $table->foreignId('rps_id')->constrained()->cascadeOnDelete();
            $table->integer('week')->nullable();
            $table->text('indikator')->nullable();
            $table->text('kriteria_teknik')->nullable();
            $table->text('materi_pembelajaran')->nullable();
            $table->text('luring')->nullable();
            $table->text('daring')->nullable();
            $table->integer('bobot')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rencanas');
    }
};
