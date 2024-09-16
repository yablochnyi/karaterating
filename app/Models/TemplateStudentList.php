<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateStudentList extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function tournaments()
    {
        return $this->belongsToMany(Tournament::class, 'list_tournaments', 'template_student_list_id', 'tournament_id');
    }

    public function listTournaments()
    {
        return $this->hasMany(ListTournament::class, 'template_student_list_id');
    }
}
