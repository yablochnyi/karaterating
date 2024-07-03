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
}
