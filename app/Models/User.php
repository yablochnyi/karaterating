<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    const Admin = 1;
    const Organization = 2;
    const Coach = 3;
    const Student = 4;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = false;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function trener()
    {
        return $this->belongsTo(User::class, 'coach_id', 'id');
    }

    public function tournaments()
    {
        return $this->belongsToMany(Tournament::class, 'student_tournaments', 'student_id', 'tournament_id');
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
