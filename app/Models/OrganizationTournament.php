<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationTournament extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function organization()
    {
        return $this->belongsTo(Organization::class , 'applicant_organizer_id');
    }

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }
}
