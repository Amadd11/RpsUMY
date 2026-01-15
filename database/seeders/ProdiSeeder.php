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
                    'akreditasi' => 'Unggul',
                    'jenjang' => 'S1',
                    'total_sks' => 144,
                    'total_semester' => 8,
                ],
                [
                    'name' => 'Teknik Industri',
                    'deskripsi' => 'Mempelajari sistem industri terpadu yang melibatkan manusia, mesin, material, dan manajemen.',
                    'logo' => 'prodi-logo/logo-4.png',
                    'akreditasi' => 'A',
                    'jenjang' => 'S1',
                    'total_sks' => 144,
                    'total_semester' => 8,
                ],
                [
                    'name' => 'Teknik Sipil',
                    'deskripsi' => 'Mengembangkan keahlian dalam perencanaan, pembangunan, dan pemeliharaan infrastruktur.',
                    'logo' => 'prodi-logo/logo-4.png',
                    'akreditasi' => 'Unggul',
                    'jenjang' => 'S1',
                    'total_sks' => 144,
                    'total_semester' => 8,
                ],
            ],

            'Fakultas Ekonomi' => [
                [
                    'name' => 'Manajemen',
                    'deskripsi' => 'Menghasilkan lulusan yang kompeten di bidang manajemen bisnis dan kewirausahaan.',
                    'logo' => 'prodi-logo/logo-2.jpg',
                    'akreditasi' => 'Unggul',
                    'jenjang' => 'S1',
                    'total_sks' => 144,
                    'total_semester' => 8,
                ],
                [
                    'name' => 'Akuntansi',
                    'deskripsi' => 'Fokus pada pencatatan, pelaporan, dan analisis keuangan berbasis standar akuntansi.',
                    'logo' => 'prodi-logo/logo-2.jpg',
                    'akreditasi' => 'A',
                    'jenjang' => 'S1',
                    'total_sks' => 144,
                    'total_semester' => 8,
                ],
            ],

            'Fakultas Ilmu Komputer' => [
                [
                    'name' => 'Sistem Informasi',
                    'deskripsi' => 'Mengintegrasikan teknologi informasi dan proses bisnis untuk mendukung pengambilan keputusan.',
                    'logo' => 'prodi-logo/logo-7.jpg',
                    'akreditasi' => 'Unggul',
                    'jenjang' => 'S1',
                    'total_sks' => 144,
                    'total_semester' => 8,
                ],
                [
                    'name' => 'Ilmu Komputer',
                    'deskripsi' => 'Mempelajari komputasi, algoritma, dan pengembangan teknologi cerdas.',
                    'logo' => 'prodi-logo/logo-7.jpg',
                    'akreditasi' => 'A',
                    'jenjang' => 'S1',
                    'total_sks' => 144,
                    'total_semester' => 8,
                ],
            ],

            'Fakultas Kesehatan' => [
                [
                    'name' => 'Keperawatan',
                    'deskripsi' => 'Mencetak tenaga perawat profesional yang berorientasi pada pelayanan kesehatan.',
                    'logo' => 'prodi-logo/logo-6.png',
                    'akreditasi' => 'Unggul',
                    'jenjang' => 'S1',
                    'total_sks' => 144,
                    'total_semester' => 8,
                ],
                [
                    'name' => 'Kesehatan Masyarakat',
                    'deskripsi' => 'Berfokus pada upaya promotif dan preventif untuk meningkatkan derajat kesehatan masyarakat.',
                    'logo' => 'prodi-logo/logo-6.png',
                    'akreditasi' => 'A',
                    'jenjang' => 'S1',
                    'total_sks' => 144,
                    'total_semester' => 8,
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
                        'akreditasi' => $prodi['akreditasi'],
                        'jenjang' => $prodi['jenjang'],
                        'total_sks' => $prodi['total_sks'],
                        'total_semester' => $prodi['total_semester'],
                        'fakultas_id' => $fakultas->id,
                    ]
                );
            }
        }
    }
}
