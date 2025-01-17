<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function getAgeAttribute(): ?string
    {
        if (!$this->birthday) {
            return null;
        }

        $age = Carbon::parse($this->birthday)->age;

        $suffix = match (true) {
            $age % 10 === 1 && $age % 100 !== 11 => 'год',
            in_array($age % 10, [2, 3, 4]) && !in_array($age % 100, [12, 13, 14]) => 'года',
            default => 'лет',
        };

        return "{$age} {$suffix}";
    }
}
