<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $adminFakultas = Role::create([
            'name' => 'Admin Fakultas'
        ]);

        $adminProdi = Role::create([
            'name' => 'Admin Prodi'
        ]);

        $dosen = Role::create([
            'name' => 'Dosen'
        ]);

        $user = User::create([
            'name' => 'superadmin',
            'email' => 'superadmin@mail.com',
            'password' => bcrypt('123123123'),
        ]);
    }
}
