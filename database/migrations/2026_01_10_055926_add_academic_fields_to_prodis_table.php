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
        Schema::table('prodis', function (Blueprint $table) {
            //
            $table->string('akreditasi')->nullable()->after('deskripsi');
            $table->string('jenjang')->nullable()->after('akreditasi');
            $table->unsignedSmallInteger('total_sks')->nullable()->after('jenjang');
            $table->unsignedTinyInteger('total_semester')->nullable()->after('total_sks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prodis', function (Blueprint $table) {
            //
            $table->dropColumn(['akreditasi', 'jenjang', 'total_sks', 'total_semester']);
        });
    }
};
