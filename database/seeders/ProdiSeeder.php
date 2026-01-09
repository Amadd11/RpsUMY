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
                [
                    'name' => 'Teknik Informatika',
                    'deskripsi' => 'Program studi yang fokus pada pengembangan perangkat lunak, sistem cerdas, dan teknologi informasi.',
                    'logo' => 'prodi-logo/logo-4.png',
                ],
                [
                    'name' => 'Teknik Industri',
                    'deskripsi' => 'Mempelajari sistem industri terpadu yang melibatkan manusia, mesin, material, dan manajemen.',
                    'logo' => 'prodi-logo/logo-4.png',
                ],
                [
                    'name' => 'Teknik Sipil',
                    'deskripsi' => 'Mengembangkan keahlian dalam perencanaan, pembangunan, dan pemeliharaan infrastruktur.',
                    'logo' => 'prodi-logo/logo-4.png',
                ],
            ],

            'Fakultas Ekonomi' => [
                [
                    'name' => 'Manajemen',
                    'deskripsi' => 'Menghasilkan lulusan yang kompeten di bidang manajemen bisnis dan kewirausahaan.',
                    'logo' => 'prodi-logo/logo-2.jpg',
                ],
                [
                    'name' => 'Akuntansi',
                    'deskripsi' => 'Fokus pada pencatatan, pelaporan, dan analisis keuangan berbasis standar akuntansi.',
                    'logo' => 'prodi-logo/logo-2.jpg',
                ],
            ],

            'Fakultas Ilmu Komputer' => [
                [
                    'name' => 'Sistem Informasi',
                    'deskripsi' => 'Mengintegrasikan teknologi informasi dan proses bisnis untuk mendukung pengambilan keputusan.',
                    'logo' => 'prodi-logo/logo-7.jpg',
                ],
                [
                    'name' => 'Ilmu Komputer',
                    'deskripsi' => 'Mempelajari komputasi, algoritma, dan pengembangan teknologi cerdas.',
                    'logo' => 'prodi-logo/logo-7.jpg',
                ],
            ],

            'Fakultas Kesehatan' => [
                [
                    'name' => 'Keperawatan',
                    'deskripsi' => 'Mencetak tenaga perawat profesional yang berorientasi pada pelayanan kesehatan.',
                    'logo' => 'prodi-logo/logo-6.png',
                ],
                [
                    'name' => 'Kesehatan Masyarakat',
                    'deskripsi' => 'Berfokus pada upaya promotif dan preventif untuk meningkatkan derajat kesehatan masyarakat.',
                    'logo' => 'prodi-logo/logo-6.png',
                ],
            ],
        ];

        foreach ($prodis as $fakultasName => $prodiList) {
            $fakultas = Fakultas::where('name', $fakultasName)->first();

            if (! $fakultas) {
                continue;
            }

            foreach ($prodiList as $prodi) {
                Prodi::updateOrCreate(
                    ['slug' => Str::slug($prodi['name'])],
                    [
                        'name' => $prodi['name'],
                        'deskripsi' => $prodi['deskripsi'],
                        'logo' => $prodi['logo'],
                        'fakultas_id' => $fakultas->id,
                    ]
                );
            }
        }
    }
}
