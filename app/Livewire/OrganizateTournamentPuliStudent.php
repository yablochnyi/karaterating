<?php

namespace App\Livewire;

use App\Models\ManageTournament;
use App\Models\MatchPool;
use App\Models\Pool;
use App\Models\TournamentStudentList;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrganizateTournamentPuliStudent extends Component
{
    public $pool;
    public $selectedListId;
    public $students;
    public $selectedStudent = null;

    public function mount($id)
    {
        // Загрузка данных с Eloquent
        $this->pool = \App\Models\TournamentStudentList::where('tournament_id', $id)
            ->with([
                'match_pools' => function ($query) {
                    $query->with(['student1', 'student2']);
                }
            ])
            ->get();

//        dd($this->pool);

//        if ($this->tournament->organization_id != Auth::id()) {
//            abort(403);
//        }
    }
    public function loadStudents($listId)
    {
        $this->selectedListId = $listId;
        $this->students = MatchPool::where('list_id', $listId)
            ->with(['student1', 'student2'])
            ->get();
//        dd($this->students);
    }
    public function selectStudent($index, $role, $id)
    {
        $this->selectedStudent = ['matchId' => $index, 'role' => $role, 'id' => $id];
    }

    public function markAsWinner()
    {
        if (!$this->selectedStudent) {
            return;
        }

        $winnerId = $this->selectedStudent['id'];
        $matchPool = MatchPool::where('student1_id', $winnerId)->orWhere('student2_id', $winnerId)->first();

        if ($matchPool) {
            $matchPool->winner_id = $winnerId;
            $matchPool->save();

            // Определение следующего раунда
            $nextRound = $matchPool->round + 1;

            // Проверка существующего матча в следующем раунде
            $nextMatchPool = MatchPool::where('tournament_id', $matchPool->tournament_id)
                ->where('list_id', $matchPool->list_id)
                ->where('round', $nextRound)
                ->where(function ($query) use ($winnerId) {
                    $query->where('student1_id', $winnerId)
                        ->orWhere('student2_id', null);
                })
                ->first();

            if ($nextMatchPool) {
                // Обновление существующего матча
                if ($nextMatchPool->student1_id === $winnerId || $nextMatchPool->student2_id === null) {
                    $nextMatchPool->student2_id = $winnerId;
                } else {
                    $nextMatchPool->student1_id = $winnerId;
                }
                $nextMatchPool->save();
            } else {
                // Создание новой записи для следующего раунда
                MatchPool::create([
                    'tournament_id' => $matchPool->tournament_id,
                    'list_id' => $matchPool->list_id,
                    'student1_id' => $winnerId,
                    'round' => $nextRound,
                    // Другие необходимые поля
                ]);
            }

            // Увеличение побед для победителя
            Pool::where('student_id', $winnerId)->increment('wins');

            $loserId = $matchPool->student1_id == $winnerId ? $matchPool->student2_id : $matchPool->student1_id;

            // Увеличение поражений для проигравшего
            Pool::where('student_id', $loserId)->increment('losses');
        }
    }


    public function render()
    {
        return view('livewire.organizate-tournament-puli-student');
    }
}
