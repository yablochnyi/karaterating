<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchPool extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function student1()
    {
        return $this->belongsTo(User::class, 'student1_id');
    }

    public function student2()
    {
        return $this->belongsTo(User::class, 'student2_id');
    }

    public function winner()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
