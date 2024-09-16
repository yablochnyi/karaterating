<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;
    protected $guarded = false;
    protected $table = 'users';

    protected static function booted()
    {
        static::addGlobalScope('role', function ($builder) {
            $builder->where('role_id', 2);
        });
    }


}
