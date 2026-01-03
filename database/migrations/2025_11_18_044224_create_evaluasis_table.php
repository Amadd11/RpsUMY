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
        Schema::create('evaluasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subcpmk_id')->constrained()->cascadeOnDelete();
            $table->foreignId('cpl_id')->constrained()->cascadeOnDelete();
            $table->foreignId('cpmk_id')->constrained()->cascadeOnDelete();
            $table->foreignId('rps_id')->constrained()->cascadeOnDelete();
            $table->string('week')->nullable();
            $table->unsignedTinyInteger('bobot_sub_cpmk')->nullable();
            $table->text('indikator')->nullable();
            $table->text('bentuk_penilaian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluasis');
    }
};
