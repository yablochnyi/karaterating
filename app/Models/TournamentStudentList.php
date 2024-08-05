<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TournamentStudentList extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function tournament()
    {
        return $this->belongsTo(ManageTournament::class, 'tournament_id');
    }

    public function students()
    {
        return $this->hasMany(OrganizatePuliListStudent::class, 'list_id', 'id');
    }

    public function match_pools()
    {
        return $this->hasMany(MatchPool::class, 'list_id', 'id');
    }

}
