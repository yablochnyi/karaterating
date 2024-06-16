<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Observers\UserObserver;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[ObservedBy([UserObserver::class])]
class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

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

    public function tournaments()
    {
        return $this->belongsToMany(ManageTournament::class, 'tournament_students', 'student_id', 'tournament_id')
            ->wherePivot('is_success', true);
    }

    public function coach(): BelongsTo
    {
        return $this->belongsTo(User::class, 'coach_id', 'id');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role_id === self::Admin;
    }
}
