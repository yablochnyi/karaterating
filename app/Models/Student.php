<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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


}
