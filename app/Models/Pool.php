<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pool extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function student()
    {
        return $this->belongsTo(User::class);
    }

    public function tournament()
    {
        return $this->belongsTo(ManageTournament::class);
    }

    public function list()
    {
        return $this->belongsTo(TournamentStudentList::class);
    }
}
