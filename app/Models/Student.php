<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'users';
    protected $guarded = false;

    protected static function booted()
    {
        static::addGlobalScope('role', function ($builder) {
            $builder->where('role_id', User::Student);
        });
    }

    public function tournaments()
    {
        return $this->belongsToMany(Tournament::class, 'student_tournaments', 'student_id', 'tournament_id');
    }

    public function trener()
    {
        return $this->belongsTo(Trener::class, 'coach_id', 'id');
    }

    public function tournamentLists()
    {
        return $this->belongsToMany(ListTournament::class, 'tournament_student_lists');
    }

    public function getWinsAndLosses()
    {
        // Подсчет побед, когда текущий пользователь указан как `winner_id`
        $wins = Pool::where('winner_id', $this->id)->count();

        // Подсчет поражений, когда текущий пользователь участвовал, но не был победителем
        $losses = Pool::where(function ($query) {
            $query->where('student_id', $this->id)
                ->orWhere('opponent_id', $this->id);
        })->where('winner_id', '!=', $this->id)
            ->count();

        return [
            'wins' => $wins,
            'losses' => $losses,
        ];
    }

    public function getMedalsCount()
    {
        $gold = Pool::where('winner_id', $this->id)
            ->where('type', 'final')
            ->count();

        $silver = Pool::where(function ($query) {
            $query->where('student_id', $this->id)
                ->orWhere('opponent_id', $this->id);
        })
            ->where('type', 'final')
            ->whereColumn('winner_id', '!=', DB::raw($this->id))
            ->count();

        $bronze = Pool::where('winner_id', $this->id)
            ->where('type', '3rd')
            ->count();

        return [
            'gold' => $gold,
            'silver' => $silver,
            'bronze' => $bronze,
        ];
    }



}
