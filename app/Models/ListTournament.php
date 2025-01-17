<?php

namespace App\Models;

use App\Traits\SortOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListTournament extends Model
{
    use HasFactory;
    use SortOrder;

    protected $guarded = false;

    public function templateStudentList()
    {
        return $this->belongsTo(TemplateStudentList::class, 'template_student_list_id');
    }

    public function tournamentStudentLists()
    {
        return $this->hasMany(TournamentStudentList::class, 'list_tournament_id');
    }
    public function students()
    {
        return $this->hasManyThrough(
            User::class,
            TournamentStudentList::class,
            'list_tournament_id', // Foreign key on TournamentStudentList table
            'id', // Foreign key on User table
            'id', // Local key on ListTournament table
            'student_id' // Local key on TournamentStudentList table
        );
    }

    public function pools()
    {
        return $this->hasMany(Pool::class, 'list_id');
    }

    public function getFirstTatamiAttribute()
    {
        return $this->pools()->first()->tatami ?? null;
    }

}
