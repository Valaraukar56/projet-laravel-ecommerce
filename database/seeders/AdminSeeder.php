<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // créer le rôle si pas existant
        $role = Role::firstOrCreate(['name' => 'admin']);

        // créer un user admin
        $user = User::firstOrCreate(
            ['email' => 'admin@admin.fr'],
            [
                'name' => 'Admin',
                'password' => bcrypt('admin123'),
            ]
        );

        // donner le rôle
        $user->assignRole($role);
    }
}
