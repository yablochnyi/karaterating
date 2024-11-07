<?php

namespace Database\Seeders;

use App\Models\ListTournament;
use App\Models\Region;
use App\Models\Role;
use App\Models\Scale;
use App\Models\TemplateStudentList;
use App\Models\TournamentStudentList;
use App\Models\User;
use App\Models\Tournament;
use App\Models\StudentTournament; // Подключаем модель StudentTournament
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Создаем роли
        $adminRole = Role::create(['name' => 'Admin']);
        $organizationRole = Role::create(['name' => 'Organization']);
        $coachRole = Role::create(['name' => 'Coach']);
        $studentRole = Role::create(['name' => 'Student']);

        // Создаем пользователей
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'role_id' => $adminRole->id
        ]);

        $organization = User::create([
            'name' => 'organization',
            'email' => 'organization@admin.com',
            'password' => bcrypt('admin'),
            'role_id' => $organizationRole->id
        ]);

        // Создаем тренеров
        $trainers = [];
        for ($i = 1; $i <= 10; $i++) {
            $trainers[] = User::create([
                'name' => "Trainer $i",
                'email' => "trainer$i@example.com",
                'password' => Hash::make('password'), // Пароль по умолчанию
                'role_id' => $coachRole->id
            ]);
        }

        // Создаем студентов и привязываем их к случайным тренерам
        $students = [];
        for ($j = 1; $j <= 4; $j++) {
            $students[] = User::create([
                'name' => "Student $j",
                'email' => "student$j@example.com",
                'password' => Hash::make('password'), // Пароль по умолчанию
                'role_id' => $studentRole->id,
                'coach_id' => $trainers[array_rand($trainers)]->id, // Привязываем к случайному тренеру
            ]);
        }

        // Создаем регион и масштаб турнира
        $region = Region::create(['name' => 'Ростовская обл.']);
        $scale = Scale::create(['name' => 'Закрытый турнир областной организации']);

        // Создаем турнир
        $tournament = Tournament::create([
            'name' => 'Открытый турнир по карате',
            'region_id' => $region->id,
            'scale_id' => $scale->id,
            'age_from' => 6,
            'age_to' => 14,
            'date_commission' => now()->addDays(7),
            'tatami' => 3,
            'KY_up_to_8' => true,
            'KY_from_8' => false,
            'fight_for_third_place' => true,
            'price' => 1000,
            'address' => 'ул. Спортивная, д. 10, Ростов-на-Дону',
            'date' => now()->addDays(10),
            'date_finish' => now()->addDays(11),
            'regulation_document' => 'regulation.pdf', // Пример имени файла для регламента
            'application_document' => 'application.pdf', // Пример имени файла для заявки
            'organization_id' => $organization->id,
        ]);

        // Привязываем тренеров к турниру
        $tournament->treners()->attach(array_map(fn($trainer) => $trainer->id, $trainers));

        // Создаем шаблонный список студентов
        $templateList = TemplateStudentList::create([
            'name' => "Список",
            'age_from' => rand(6, 10),
            'age_to' => rand(11, 14),
            'weight_from' => rand(20, 30),
            'weight_to' => rand(31, 50),
            'rang_from' => rand(1, 5),
            'rang_to' => rand(6, 10),
            'gender' => rand(0, 1) ? 'male' : 'female', // Случайный выбор пола
            'user_id' => $organization->id
        ]);

        // Привязываем шаблонный список студентов к турниру
        $listTournament = ListTournament::create([
            'tournament_id' => $tournament->id,
            'template_student_list_id' => $templateList->id,
        ]);

        // Привязываем студентов к турниру через таблицу student_tournaments
        foreach ($students as $student) {
            StudentTournament::create([
                'tournament_id' => $tournament->id,
                'student_id' => $student->id,
            ]);
        }
        foreach ($students as $student) {
            TournamentStudentList::create([
                'list_tournament_id' => $listTournament->id,
                'student_id' => $student->id,
            ]);
        }
    }
}
