<?php

namespace App\Http\Controllers;

use App\Models\Pool;
use App\Models\Tournament;

class GeneratePuliController extends Controller
{
    public function generate($tournamentId)
    {
        $tournament = Tournament::with(['lists.listTournaments.students.trener'])->findOrFail($tournamentId);

        foreach ($tournament->lists as $list) {
            foreach ($list->listTournaments as $listTournament) {
                $students = $listTournament->students;

                if ($students->count() == 3) {
                    // Логика распределения для 3 участников, как в вашем оригинальном коде
                    $this->generateForThreeStudents($students, $tournamentId, $listTournament->id);
                } elseif ($students->count() == 4) {
                    // Логика распределения для 4 участников
                    $this->generateForFourStudents($students, $tournamentId, $listTournament->id);
                }
            }
        }

        return response()->json(['message' => 'Пули успешно созданы']);
    }

    protected function generateForThreeStudents($students, $tournamentId, $listTournamentId)
    {
        // Сортировка студентов по тренерам
        $groupedByTreners = $students->groupBy('trener_id');

        if (count($groupedByTreners) == 2) {
            // Если 2 студента от одного тренера, то они бьются последними
            $lastFightGroup = $groupedByTreners->filter(function($group) {
                return count($group) == 2;
            })->first();
            $firstFightGroup = $groupedByTreners->filter(function($group) {
                return count($group) == 1;
            })->first();

            // Расписание первых боев
            $this->scheduleFight($firstFightGroup[0], $lastFightGroup[0], $tournamentId, $listTournamentId);
            $this->scheduleFight($firstFightGroup[0], $lastFightGroup[1], $tournamentId, $listTournamentId);

            // Расписание последнего боя
            $this->scheduleFight($lastFightGroup[0], $lastFightGroup[1], $tournamentId, $listTournamentId);
        } else {
            // Стандартный порядок боев для всех трех участников
            for ($i = 0; $i < $students->count(); $i++) {
                for ($j = $i + 1; $j < $students->count(); $j++) {
                    $this->scheduleFight($students[$i], $students[$j], $tournamentId, $listTournamentId);
                }
            }
        }
    }

    protected function generateForFourStudents($students, $tournamentId, $listTournamentId)
    {
        $this->scheduleFight($students[0], $students[1], $tournamentId, $listTournamentId); // Бой 1: Участник 1 против Участника 2
        $this->scheduleFight($students[2], $students[3], $tournamentId, $listTournamentId); // Бой 2: Участник 3 против Участника 4
        Pool::create([
            'tournament_id' => $tournamentId,
            'list_id' => $listTournamentId,
            'student_id' => null,
            'opponent_id' => null,
            'round' => 'final',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    protected function scheduleFight($student1, $student2, $tournamentId, $listTournamentId)
    {
        Pool::create([
            'tournament_id' => $tournamentId,
            'list_id' => $listTournamentId,
            'student_id' => $student1->id,
            'opponent_id' => $student2->id,
            'round' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
