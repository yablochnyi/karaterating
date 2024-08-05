<?php

namespace Database\Seeders;

use App\Models\ManageTournament;
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
               Role::create([
           'name' => 'Admin',
       ]);

      Role::create([
          'name' => 'Organization',
      ]);
//
      Role::create([
          'name' => 'Coach',
      ]);
//
      Role::create([
          'name' => 'Student',
      ]);
       User::create([
           'name' => 'admin',
           'email' => 'admin@admin.com',
           'password' => bcrypt('admin'),
           'role_id' => 1
       ]);
//        $organizerId = User::where('role_id', 2)->first()->id;
//
//        // Создание тренеров
        // for ($i = 0; $i < 10; $i++) {
        //     User::create([
        //         'name' => "Trener $i",
        //         'email' => "coach$i@example.com",
        //         'password' => bcrypt('password'),
        //         'role_id' => 3,
        //         'organization_id' => $organizerId
        //     ]);
        // }
//
//
//        // Создание студентов и распределение по спискам
//        $coaches = User::where('role_id', 3)->get();
//        for ($i = 0; $i < 16; $i++) {
//            $student = User::create([
//                'name' => "Student $i",
//                'first_name' => "Student $i",
//                'last_name' => "Student $i",
//                'age' => rand(6, 18),
//                'weight' => rand(10, 50),
//                'email' => "student$i@example.com",
//                'password' => bcrypt('password'),
//                'role_id' => 4,
//                'coach_id' => $coaches->random()->id
//            ]);
//
//        }
    }
}
