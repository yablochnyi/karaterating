<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageTournament extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function scale()
    {
        return $this->belongsTo(Scale::class);
    }

    public function coaches()
    {
        return $this->belongsToMany(User::class, 'manage_tournament_coaches', 'tournament_id', 'coach_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'tournament_students', 'tournament_id', 'student_id');
    }
}
