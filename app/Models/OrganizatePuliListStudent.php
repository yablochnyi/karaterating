<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizatePuliListStudent extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function list()
    {
        return $this->belongsTo(TournamentStudentList::class, 'list_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
