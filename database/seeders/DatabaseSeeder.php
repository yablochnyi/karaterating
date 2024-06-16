<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'ref_token' => Str::uuid()->toString(),
            'role_id' => 1
        ]);
    }
}
