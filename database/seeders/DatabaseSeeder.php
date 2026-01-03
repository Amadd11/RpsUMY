<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\ProdiSeeder;
use Database\Seeders\CourseSeeder;
use Database\Seeders\FakultasSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            FakultasSeeder::class,
            ProdiSeeder::class,
            CourseSeeder::class,
        ]);
    }
}
