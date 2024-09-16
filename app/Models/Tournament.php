<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tournament extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = false;

    public function scopeAccessibleByUser($query, $userId)
    {
        return $query->where('organization_id', $userId)
            ->orWhereHas('treners', function ($query) use ($userId) {
                $query->where('trener_id', $userId);
            })
            ->orWhereHas('students', function ($query) use ($userId) {
                $query->where('student_id', $userId);
            });
    }


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
        return $this->belongsToMany(Student::class, 'student_tournaments', 'tournament_id', 'student_id');
    }

    public function lists()
    {
        return $this->belongsToMany(TemplateStudentList::class, 'list_tournaments', 'tournament_id', 'template_student_list_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function scale()
    {
        return $this->belongsTo(Scale::class);
    }

}
