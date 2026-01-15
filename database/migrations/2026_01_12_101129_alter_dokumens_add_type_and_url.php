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
        Schema::table('dokumens', function (Blueprint $table) {
            //
            $table->enum('tipe', ['upload', 'url'])
                ->default('upload')
                ->after('judul');

            $table->string('file_path')->nullable()->after('tipe');
            $table->string('file_url')->nullable()->after('file_path');
            $table->dropColumn('file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dokumens', function (Blueprint $table) {
            //
            $table->dropColumn(['tipe', 'file_path', 'file_url']);
        });
    }
};
