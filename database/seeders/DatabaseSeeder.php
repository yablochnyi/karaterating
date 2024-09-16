<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'Admin',
        ]);
        Role::create([
            'name' => 'Organization',
        ]);
        Role::create([
            'name' => 'Coach',
        ]);
        Role::create([
            'name' => 'Student',
        ]);
//        User::create([
//            'name' => 'admin',
//            'email' => 'admin@admin.com',
//            'password' => bcrypt('admin'),
//            'role_id' => 1
//        ]);
    }
}
