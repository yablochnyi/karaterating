<?php

namespace App\Livewire;

use App\Models\ManageTournament;
use App\Models\MatchPool;
use App\Models\Pool;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class OrganizateTournamentPuli extends Component
{
    public $tournament;

    public function mount($id)
    {
        $this->tournament = ManageTournament::with(['coaches', 'lists.students.student'])->find($id);
        if ($this->tournament->organization_id != Auth::id()) {
            abort(403);
        }
    }

    public function generatePools()
    {

        foreach ($this->tournament->lists as $list) {
            $participants = $list->students;
            if (count($participants) == 3) {
                $this->createPoolForThree($participants, $list->id);
            }
            if (count($participants) == 2 || count($participants) == 4) {
                $this->createPoolForFourOrTwo($participants, $list->id);
            }
            if (count($participants) >= 5 && count($participants) <= 8) {
                $this->createPoolForEight($participants, $list->id);
            }
            if (count($participants) >= 16) {
                $this->createPoolForSixteen($participants, $list->id);
            }
        }
    }

    private function createPoolForThree(Collection $participants, $listId)
    {
        $participants = $participants->shuffle(); // Перемешиваем участников
        $this->createPool($participants, $listId); // Создаем пул

        // Загрузка данных о тренерах для каждого участника
        $participants->load('student.coach');

        // Определение, кто должен встретиться в последнем матче
        $coaches = $participants->pluck('student.coach_id', 'student_id');
        $coachMatchup = [];

        foreach ($coaches as $studentId => $coachId) {
            if (isset($coachMatchup[$coachId])) {
                $coachMatchup[$coachId][] = $studentId;
                if (count($coachMatchup[$coachId]) == 2) {
                    // У нас есть два участника от одного тренера
                    $lastMatchParticipants = $coachMatchup[$coachId];
                    break;
                }
            } else {
                $coachMatchup[$coachId] = [$studentId];
            }
        }

        // Оставшийся участник для первого матча
        $remainingParticipant = $participants->reject(function ($participant) use ($lastMatchParticipants) {
            return in_array($participant->student_id, $lastMatchParticipants);
        })->first();

        // Генерация первых двух матчей с оставшимся участником
        if (!empty($remainingParticipant)) {
            foreach ($lastMatchParticipants as $participantId) {
                $this->generateMatch($listId, $remainingParticipant->student_id, $participantId);
            }
        }

        // Последний матч между двумя участниками от одного тренера
        if (!empty($lastMatchParticipants) && count($lastMatchParticipants) == 2) {
            $this->generateMatch($listId, $lastMatchParticipants[0], $lastMatchParticipants[1], 'tree');
        }
    }

    private function createPoolForFourOrTwo(Collection $participants, $listId)
    {
        $participants = $participants->shuffle(); // Перемешиваем участников
        $this->createPool($participants, $listId); // Создаем пул

        // Загрузка данных о тренерах для каждого участника
        $participants->load('student.coach');

        // Собираем информацию о клубах участников через поле club тренера
        $clubs = $participants->mapWithKeys(function ($participant) {
            return [$participant->student_id => $participant->student->coach->club];
        });

        // Подсчет количества участников в каждом клубе
        $clubCounts = $clubs->countBy();

        // Группировка участников по клубам
        $groupedByClub = $participants->groupBy(function ($item) {
            return $item->student->coach->club;
        });

        $matches = [];
        if (count($participants) == 4) {
            // Расставляем участников так, чтобы минимизировать клубные столкновения в первом бою
            $this->arrangeFourParticipants($groupedByClub, $matches);
        } elseif (count($participants) == 2) {
            // Просто создаем один матч
            $matches[] = [$participants[0]->student_id, $participants[1]->student_id];
        }

        // Генерация матчей
        foreach ($matches as $match) {
            $this->generateMatch($listId, $match[0], $match[1]);
        }
    }

    private function arrangeFourParticipants($groupedByClub, &$matches)
    {
        // Список всех участников
        $allParticipants = $groupedByClub->collapse();

        // Если только два клуба и в каждом по два участника
        if ($groupedByClub->count() == 2 && $groupedByClub->every(function ($group) { return count($group) == 2; })) {
            $clubs = $groupedByClub->keys()->all();
            $matches[] = [$groupedByClub[$clubs[0]][0]->student_id, $groupedByClub[$clubs[1]][0]->student_id];
            $matches[] = [$groupedByClub[$clubs[0]][1]->student_id, $groupedByClub[$clubs[1]][1]->student_id];
        } else {
            // Ищем клубы с более чем одним участником и разделяем их
            $singleParticipants = collect([]);
            foreach ($groupedByClub as $club => $participants) {
                if (count($participants) > 1) {
                    // Перемешиваем участников в каждом клубе, чтобы разделить одноклубников
                    $participants = $participants->shuffle();
                    // Добавляем первого участника в список одиночных участников
                    $singleParticipants->push($participants->shift());
                    // Оставшихся участников добавляем обратно в список
                    foreach ($participants as $participant) {
                        $singleParticipants->push($participant);
                    }
                } else {
                    $singleParticipants = $singleParticipants->merge($participants);
                }
            }

            // Теперь у нас есть список, где одноклубники разделены
            // Формируем матчи из списка одиночных участников
            $matches[] = [$singleParticipants[0]->student_id, $singleParticipants[2]->student_id];
            $matches[] = [$singleParticipants[1]->student_id, $singleParticipants[3]->student_id];
        }
    }

    private function createPoolForEight(Collection $participants, $listId)
    {
        $participants = $participants->shuffle(); // Перемешиваем участников для случайности
        $this->createPool($participants, $listId); // Создаем пул

        // Группировка участников по тренерам
        $groupedByCoach = $participants->groupBy(function ($participant) {
            return $participant->student->coach_id;
        });

        $pairs = [];
        $usedParticipants = collect();

        // Функция для поиска пары от другого тренера
        $findOpponent = function($participant, $remainingParticipants) use ($groupedByCoach, $usedParticipants) {
            foreach ($remainingParticipants as $potentialOpponent) {
                if ($participant->student->coach_id !== $potentialOpponent->student->coach_id &&
                    !$usedParticipants->contains($potentialOpponent)) {
                    return $potentialOpponent;
                }
            }
            return null;
        };

        $remainingParticipants = $participants->filter(function ($participant) use ($usedParticipants) {
            return !$usedParticipants->contains($participant);
        });

        // Создаем пары, избегая боев между участниками одного тренера
        foreach ($groupedByCoach as $coachId => $members) {
            foreach ($members as $member) {
                if ($usedParticipants->contains($member)) {
                    continue;
                }
                $opponent = $findOpponent($member, $remainingParticipants);
                if ($opponent !== null) {
                    $pairs[] = [$member, $opponent];
                    $usedParticipants->push($member);
                    $usedParticipants->push($opponent);
                } else {
                    // Если подходящего противника нет, добавляем в оставшиеся
                    $remainingParticipants->push($member);
                }
            }
        }

        // Создаем матчи для всех пар
        foreach ($pairs as $pair) {
            $this->generateMatch($listId, $pair[0]->student_id, $pair[1]->student_id, 'eight', 1);
        }

        // Обработка оставшихся участников, если они есть
        if ($remainingParticipants->count() > 1) {
            foreach ($remainingParticipants->chunk(2) as $pair) {
                if ($pair->count() == 2) {
                    $this->generateMatch($listId, $pair[0]->student_id, $pair[1]->student_id, 'eight', 1);
                }
            }
        }

        // Логирование для отладки
        Log::info('Pairs created for first round', ['pairs' => $pairs, 'remainingParticipants' => $remainingParticipants]);
    }


    private function createPoolForSixteen(Collection $participants, $listId)
    {
        $participants = $participants->shuffle(); // Перемешиваем участников для случайности
        $this->createPool($participants, $listId); // Создаем пул

        // Группировка участников по клубам
        $groupedByClub = $participants->groupBy(function ($participant) {
            return $participant->student->coach->club;
        });

        // Выбор клубов с наибольшим количеством участников
        $sortedClubs = $groupedByClub->sortByDesc(function ($participants) {
            return count($participants);
        });

        $inDrive = max(16 - $participants->count(), 0); // Количество участников в приводе
        $participantsInDrive = collect();

        foreach ($sortedClubs as $club => $members) {
            if ($participantsInDrive->count() < $inDrive) {
                $participantsInDrive = $participantsInDrive->merge($members->take($inDrive - $participantsInDrive->count()));
            }
        }

        // Установка участников в приводе во второй раунд
        foreach ($participantsInDrive as $participant) {
            $this->generateMatch($listId, $participant->student_id, null, 2);
        }

        // Участники для первого раунда
        $participantsForMatches = $participants->diff($participantsInDrive);
        $matches = $this->arrangeMatchesAvoidingSameCoach($participantsForMatches);

        // Генерация матчей
        foreach ($matches as $match) {
            $this->generateMatch($listId, $match[0], $match[1], 1);
        }
    }

    private function arrangeMatchesAvoidingSameCoach(Collection $participants)
    {
        $matches = [];
        $totalParticipants = $participants->count();

        for ($i = 0; $i < $totalParticipants - 1; $i += 2) {
            if (isset($participants[$i], $participants[$i + 1])) {
                if ($participants[$i]->student->coach_id !== $participants[$i + 1]->student->coach_id) {
                    $matches[] = [$participants[$i]->student_id, $participants[$i + 1]->student_id];
                } else {
                    for ($j = $i + 2; $j < $totalParticipants; $j++) {
                        if ($participants[$i]->student->coach_id !== $participants[$j]->student->coach_id) {
                            $matches[] = [$participants[$i]->student_id, $participants[$j]->student_id];
                            $temp = $participants[$i + 1];
                            $participants[$i + 1] = $participants[$j];
                            $participants[$j] = $temp;
                            break;
                        }
                    }
                }
            }
        }

        return $matches;
    }

    private function createPool(Collection $participants, $listId)
    {

        foreach ($participants as $participant) {
            Pool::create([
                'tournament_id' => $this->tournament->id,
                'list_id' => $listId,
                'student_id' => $participant->student_id
            ]);
        }

    }

    private function generateMatch($listId, $student1Id, $student2Id, $type, $round = 1)
    {
        MatchPool::create([
            'tournament_id' => $this->tournament->id,
            'list_id' => $listId,
            'student1_id' => $student1Id,
            'student2_id' => $student2Id,
            'type' => $type,
            'round' => $round // указываем раунд для матча
        ]);

        $this->dispatch('notify', title: 'Пули сгенерированы');
    }

    public function render()
    {
        $matches = MatchPool::with(['student1', 'student2', 'winner'])
            ->where('tournament_id', $this->tournament->id)
            ->get()
            ->groupBy('round');

        return view('livewire.organizate-tournament-puli', ['matches' => $matches]);
    }
}
