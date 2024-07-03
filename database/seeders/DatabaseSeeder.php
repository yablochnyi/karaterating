<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\TournamentStudentList;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      //for ($i = 1; $i <= 10; $i++) {
      //    TournamentStudentList::create([
      //        'name' => 'List ' . $i,
      //        'age_from' => rand(10, 20),
      //        'age_to' => rand(21, 30),
      //        'weight_from' => rand(50, 60),
      //        'weight_to' => rand(61, 80),
      //        'kyu_from' => rand(1, 3),
      //        'kyu_to' => rand(4, 6),
      //        'gender' => ['male', 'female'][rand(0, 1)],
      //        'tournament_id' => 3
      //    ]);
      //}
       // Role::create([
       //     'name' => 'Admin',
       // ]);
//
       // Role::create([
       //     'name' => 'Organization',
       // ]);
//
       // Role::create([
       //     'name' => 'Coach',
       // ]);
//
       // Role::create([
       //     'name' => 'Student',
       // ]);
//
       // User::factory()->create([
       //     'name' => 'Admin',
       //     'email' => 'admin@admin.com',
       //     'password' => Hash::make('admin'),
       //     'ref_token' => Str::uuid()->toString(),
       //     'role_id' => 1
       // ]);

        for ($i = 1; $i <= 50; $i++) {
            $userId = DB::table('users')->insertGetId([
                'name' => 'User' . $i,
                'first_name' => 'First' . $i,
                'last_name' => 'Last' . $i,
                'email' => 'user' . $i . '@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'gender' => ['М', 'Ж'][rand(0, 1)],
                'birthday' => now()->subYears(rand(18, 40))->format('Y-m-d'),
                'passport' => 'Passport' . Str::random(10),
                'brand' => 'Brand' . $i,
                'insurance' => 'Insurance' . $i,
                'iko_card' => 'IKO' . Str::random(10),
                'avatar' => 'avatar' . $i . '.jpg',
                'role_id' => 4,
                'coach_id' => 3,
                'ref_token' => Str::uuid(),
                'age' => rand(10, 30),
                'weight' => rand(50, 80),
                'rating' => rand(0, 100) / 10,
                'gold_medals' => rand(0, 10),
                'silver_medals' => rand(0, 10),
                'bronze_medals' => rand(0, 10),
                'wins' => rand(0, 20),
                'losses' => rand(0, 20),
                'balance' => rand(0, 10000) / 100,
                'created_at' => now(),
                'updated_at' => now(),
                'ky' => rand(1,8)
            ]);

            // Сохранение пользователя в таблице tournament_students
           //DB::table('tournament_students')->insert([
           //    'tournament_id' => 3, // или используйте случайный турнир из существующих
           //    'student_id' => $userId,
           //    'is_success' => true,
           //    'created_at' => now(),
           //    'updated_at' => now(),
           //]);
        }
    }
}
