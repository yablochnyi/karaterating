<?php

namespace App\Livewire;

use App\Models\OrganizatePuliListStudent;
use App\Models\TournamentStudent;
use App\Models\TournamentStudentList;
use App\Models\User;
use Livewire\Component;

class CoachTournament extends Component
{
    public $tournaments;

    public function mount()
    {
        $this->tournaments = \App\Models\ManageTournament::whereHas('coaches', function ($query) {
            $query->where('manage_tournament_coaches.coach_id', auth()->id());
        })->with('coaches')->get();

    }

    public function addStudent($studentId, $tournamentId)
    {
        TournamentStudent::create([
            'tournament_id' => $tournamentId,
            'student_id' => $studentId,
        ]);

        $tournament = \App\Models\ManageTournament::with('lists')->find($tournamentId);
        $student = \App\Models\User::find($studentId);

        $addedToList = false;

        foreach ($tournament->lists as $list) {
            if (
                $student->age >= $list->age_from && $student->age <= $list->age_to
                &&
                $student->weight >= $list->weight_from && $student->weight <= $list->weight_to
                &&
                $student->ky >= $list->kyu_from
                &&
                $student->ky <= $list->kyu_to
                &&
                $student->gender == $list->gender
            ) {
                OrganizatePuliListStudent::create([
                    'list_id' => $list->id,
                    'student_id' => $student->id,
                ]);
                $addedToList = true;
                break;
            }
        }

        if (!$addedToList) {
            // Проверяем, существует ли уже дефолтный список
            $defaultList = TournamentStudentList::where('tournament_id', $tournamentId)
                ->where('name', 'Ученики которые не попали в списки')
                ->first();

            if (!$defaultList) {
                $defaultList = TournamentStudentList::create([
                    'name' => 'Ученики которые не попали в списки',
                    'age_from' => 0,
                    'age_to' => 0,
                    'weight_from' => 0,
                    'weight_to' => 0,
                    'kyu_from' => 0,
                    'kyu_to' => 0,
                    'gender' => 'all',
                    'tournament_id' => $tournamentId,
                ]);
            }

            // Добавляем студента в дефолтный список
            OrganizatePuliListStudent::create([
                'list_id' => $defaultList->id,
                'student_id' => $student->id,
            ]);
        }
    }

    public function removeStudent($studentId, $tournamentId)
    {
        // Удаление записи студента из TournamentStudent
        TournamentStudent::where('tournament_id', $tournamentId)
            ->where('student_id', $studentId)
            ->delete();

        // Получение всех списков из TournamentStudentList, где tournament_id == $tournamentId
        $tournamentStudentLists = TournamentStudentList::where('tournament_id', $tournamentId)->with('students')->get();

        // Проход по всем спискам и удаление записи студента из каждого списка
        foreach ($tournamentStudentLists as $list) {
            foreach ($list->students as $student) {
                if ($student->student_id == $studentId) {
                    // Удаление студента из списка
                    $student->delete(); // Если у вас есть отдельная таблица для связи, этот метод работает непосредственно с записями студентов
                }
            }
        }
    }



    public function isStudentInTournament($studentId, $tournamentId)
    {
        return TournamentStudent::where('tournament_id', $tournamentId)
            ->where('student_id', $studentId)
            ->exists();
    }

    public function render()
    {
        $students = User::where('coach_id', auth()->id())->get();
        return view('livewire.coach-tournament', compact('students'));
    }
}
