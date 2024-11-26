<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTournament extends Model
{
    use HasFactory;
    protected $table = 'student_tournaments';
    protected $guarded = false;
}
