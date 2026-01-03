<?php

namespace Database\Seeders;

use App\Models\Prodi;
use App\Models\Fakultas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProdiSeeder extends Seeder
{
    public function run(): void
    {
        $prodis = [
            'Fakultas Teknik' => [
                'Teknik Informatika',
                'Teknik Industri',
                'Teknik Sipil',
            ],
            'Fakultas Ekonomi' => [
                'Manajemen',
                'Akuntansi',
            ],
            'Fakultas Ilmu Komputer' => [
                'Sistem Informasi',
                'Ilmu Komputer',
            ],
            'Fakultas Kesehatan' => [
                'Keperawatan',
                'Kesehatan Masyarakat',
            ],
        ];

        foreach ($prodis as $fakultasName => $prodiList) {
            $fakultas = Fakultas::where('name', $fakultasName)->first();

            foreach ($prodiList as $name) {
                Prodi::updateOrCreate(
                    ['slug' => Str::slug($name)],
                    [
                        'name' => $name,
                        'fakultas_id' => $fakultas->id,
                    ]
                );
            }
        }
    }
}
