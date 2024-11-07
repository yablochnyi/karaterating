<?php

namespace App\Http\Controllers;

use Xoco70\LaravelTournaments\Models\Tournament;

class GeneratePuliController extends Controller
{
    public function generate($tournamentId)
    {
        // Загружаем ваш локальный турнир с его списками и студентами
        $localTournament = \App\Models\Tournament::with(['lists.listTournaments.students.trener'])->findOrFail($tournamentId);

        foreach ($localTournament->lists as $list) {
            foreach ($list->listTournaments as $listTournament) {
                $students = $listTournament->students;
                $count = $students->count();


            }
        }

        return response()->json(['message' => 'Турнирные сетки успешно созданы']);
    }

    protected function getTournamentType($count)
    {

        if ($count == 2) {
            return 'single_elimination'; // Для двух участников - один матч
        } elseif ($count == 3) {
            return 'round_robin'; // Каждый с каждым
        } elseif ($count >= 4) {
            return 'single_elimination'; // Для четырех и более участников - турнир на выбывание
        }
    }

    protected function applyCustomRules(Tournament $tournament)
    {
        // Здесь можно задать правила для изменения сетки, чтобы ученики одного тренера
        // не встречались в первом бою. Пакет xoco70 не поддерживает это по умолчанию,
        // поэтому потребуется дополнительная логика.

        $matches = $tournament->matches()->where('round', 1)->get();
        $participantsByTrainer = $tournament->participants->groupBy(function ($participant) {
            return $participant->external->trener_id; // Используем ID тренера для группировки
        });

        foreach ($matches as $match) {
            // Проверяем участников и перемещаем их по сетке, если они тренируются у одного тренера
            $participant1 = $match->participant1;
            $participant2 = $match->participant2;

            if ($participant1 && $participant2 && $participant1->external->trener_id == $participant2->external->trener_id) {
                // Если оба бойца от одного тренера, переназначаем бой
                $this->reassignMatch($tournament, $match);
            }
        }
    }

    protected function reassignMatch(Tournament $tournament, $match)
    {
        // Здесь можно добавить логику для переназначения матчей,
        // чтобы бойцы от одного тренера не встречались в первом бою.
        // Например, можно поменять участника в текущем бою на другого.

        // Логика переназначения, если необходимо
    }


}
