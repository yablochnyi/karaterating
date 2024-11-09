<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TournamentStudentList extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function listTournament()
    {
        return $this->belongsTo(ListTournament::class, 'list_tournament_id');
    }

}
