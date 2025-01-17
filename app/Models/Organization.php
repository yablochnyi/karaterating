<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;
    protected $guarded = false;
    protected $table = 'users';

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected static function booted()
    {
        static::addGlobalScope('role', function ($builder) {
            $builder->where('role_id', 2);
        });
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
