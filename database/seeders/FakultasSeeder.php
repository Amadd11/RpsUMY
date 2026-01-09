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
            [
                'name' => 'Fakultas Teknik',
                'deskripsi' => 'Menyelenggarakan pendidikan teknik yang inovatif, aplikatif, dan berorientasi pada pengembangan teknologi berkelanjutan.',
                'logo' => 'fakultas-logo/logo-3.jpg',
            ],
            [
                'name' => 'Fakultas Ekonomi',
                'deskripsi' => 'Mengembangkan ilmu ekonomi dan bisnis yang berdaya saing global serta berlandaskan nilai etika dan profesionalisme.',
                'logo' => 'fakultas-logo/logo-5.png',
            ],
            [
                'name' => 'Fakultas Ilmu Komputer',
                'deskripsi' => 'Fokus pada pengembangan teknologi informasi, sistem cerdas, dan inovasi digital untuk kebutuhan industri dan masyarakat.',
                'logo' => 'fakultas-logo/logo-7.jpg',
            ],
            [
                'name' => 'Fakultas Kesehatan',
                'deskripsi' => 'Mencetak tenaga kesehatan profesional yang unggul dalam pelayanan, penelitian, dan pengabdian kepada masyarakat.',
                'logo' => 'fakultas-logo/logo-3.jpg',
            ],
        ];

        foreach ($fakultas as $item) {
            Fakultas::updateOrCreate(
                ['slug' => Str::slug($item['name'])],
                [
                    'name' => $item['name'],
                    'deskripsi' => $item['deskripsi'],
                    'logo' => $item['logo'],
                ]
            );
        }
    }
}
