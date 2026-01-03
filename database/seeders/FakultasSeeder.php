<?php

namespace Database\Seeders;

use App\Models\Fakultas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FakultasSeeder extends Seeder
{
    public function run(): void
    {
        $fakultas = [
            'Fakultas Teknik',
            'Fakultas Ekonomi',
            'Fakultas Ilmu Komputer',
            'Fakultas Kesehatan',
        ];

        foreach ($fakultas as $name) {
            Fakultas::updateOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name]
            );
        }
    }
}
