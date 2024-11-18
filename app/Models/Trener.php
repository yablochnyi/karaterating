<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trener extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'users';
    protected $guarded = false;

    protected static function booted()
    {
        static::addGlobalScope('role', function ($builder) {
            $builder->where('role_id', User::Coach);
        });
    }

    public function tournaments()
    {
        return $this->belongsToMany(Tournament::class, 'tournament_treners', 'trener_id', 'tournament_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'coach_id');
    }
}
