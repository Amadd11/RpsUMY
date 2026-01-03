<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Prodi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            'Teknik Informatika' => [
                ['Pemrograman Web', 'Web Programming', 'SI101', 3, 2],
                ['Algoritma & Struktur Data', 'Algorithms & Data Structures', 'SI102', 3, 2],
            ],
            'Sistem Informasi' => [
                ['Basis Data', 'Database Systems', 'SI201', 3, 2],
                ['Analisis Sistem', 'System Analysis', 'SI202', 3, 3],
            ],
            'Manajemen' => [
                ['Pengantar Manajemen', 'Introduction to Management', 'MN101', 3, 1],
            ],
        ];

        foreach ($courses as $prodiName => $list) {
            $prodi = Prodi::where('name', $prodiName)->first();

            foreach ($list as [$name, $nameEn, $code, $sks, $semester]) {
                Course::updateOrCreate(
                    ['slug' => Str::slug($name)],
                    [
                        'name' => $name,
                        'name_en' => $nameEn,
                        'code' => $code,
                        'sks' => $sks,
                        'semester' => $semester,
                        'prodi_id' => $prodi->id,
                    ]
                );
            }
        }
    }
}
