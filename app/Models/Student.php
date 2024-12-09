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
        $wins = Pool::whereHas('tournament', function ($query) {
            $query->whereNull('deleted_at');
        })
            ->where('winner_id', $this->id)
            ->count();

        $losses = Pool::whereHas('tournament', function ($query) {
            $query->whereNull('deleted_at');
        })
            ->where(function ($query) {
                $query->where('student_id', $this->id)
                    ->orWhere('opponent_id', $this->id);
            })
            ->where('winner_id', '!=', $this->id)
            ->count();

        return [
            'wins' => $wins,
            'losses' => $losses,
        ];
    }


    public function getMedalsCount()
    {
        // Gold medals
        $gold = Pool::whereHas('tournament', function ($query) {
            $query->whereNull('deleted_at');
        })
            ->where('winner_id', $this->id)
            ->where('type', 'final')
            ->distinct('tournament_id') // Уникальные турниры
            ->count('tournament_id');

        // Silver medals
        $silver = Pool::whereHas('tournament', function ($query) {
            $query->whereNull('deleted_at');
        })
            ->where(function ($query) {
                $query->where('student_id', $this->id)
                    ->orWhere('opponent_id', $this->id);
            })
            ->where('type', 'final')
            ->whereColumn('winner_id', '!=', DB::raw($this->id))
            ->distinct('tournament_id') // Уникальные турниры
            ->count('tournament_id');

        // Bronze medals
        $bronze = Pool::whereHas('tournament', function ($query) {
            $query->whereNull('deleted_at');
        })
            ->where('winner_id', $this->id)
            ->where('type', '3rd')
            ->distinct('tournament_id') // Уникальные турниры
            ->count('tournament_id');

        // Round Robin Gold
        $roundRobinGold = Pool::whereHas('tournament', function ($query) {
            $query->whereNull('deleted_at');
        })
            ->where('winner_id_1rd_robbin', $this->id)
            ->distinct('tournament_id')
            ->count('tournament_id');

        // Round Robin Silver
        $roundRobinSilver = Pool::whereHas('tournament', function ($query) {
            $query->whereNull('deleted_at');
        })
            ->where('winner_id_2rd_robbin', $this->id)
            ->distinct('tournament_id')
            ->count('tournament_id');

        // Round Robin Bronze
        $roundRobinBronze = Pool::whereHas('tournament', function ($query) {
            $query->whereNull('deleted_at');
        })
            ->where('winner_id_3rd_robbin', $this->id)
            ->distinct('tournament_id')
            ->count('tournament_id');

        return [
            'gold' => $gold + $roundRobinGold,
            'silver' => $silver + $roundRobinSilver,
            'bronze' => $bronze + $roundRobinBronze,
        ];
    }

}
