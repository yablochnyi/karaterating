<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tournament extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = false;


    public function coaches()
    {
        return $this->belongsToMany(Trener::class);
    }

    public function treners()
    {
        return $this->belongsToMany(Trener::class, 'tournament_treners', 'tournament_id', 'trener_id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_tournaments', 'tournament_id', 'student_id')
            ->withPivot('is_success_weight'); // Указываем колонку из смежной таблицы
    }


    public function lists()
    {
        return $this->belongsToMany(TemplateStudentList::class, 'list_tournaments', 'tournament_id', 'template_student_list_id')
            ->withPivot('id');
    }

    public function listWhereExistPools()
    {
        return $this->hasMany(ListTournament::class, 'tournament_id')
            ->whereHas('pools')
            ->orderBy('list_tournaments.sort_order', 'asc');
    }


    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function scale()
    {
        return $this->belongsTo(Scale::class);
    }

    public function tournamentOrganizations()
    {
        return $this->hasMany(OrganizationTournament::class, 'tournament_id');
    }

    public function pools()
    {
        return $this->hasMany(Pool::class, 'tournament_id');
    }
}
