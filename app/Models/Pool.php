<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pool extends Model
{
    use HasFactory;
    protected $guarded = false;

    protected static function booted()
    {
        static::created(function ($pool) {
            // Получаем связанный ListTournament
            $listTournament = $pool->listTournament;

            if ($listTournament && !$listTournament->sort_order) {
                // Устанавливаем sort_order равным ID записи
                $listTournament->sort_order = $listTournament->id;
                $listTournament->save();
            }
        });
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function opponent()
    {
        return $this->belongsTo(Student::class);
    }

    public function templateStudentList()
    {
        return $this->hasOneThrough(
            TemplateStudentList::class,   // Модель, к которой хотим добраться
            ListTournament::class,        // Промежуточная модель
            'id',                         // Foreign key в ListTournament
            'id',                         // Foreign key в TemplateStudentList
            'list_id',                    // Local key в Pool (поле, связывающее с ListTournament)
            'template_student_list_id'    // Foreign key в ListTournament, связывающее с TemplateStudentList
        );
    }

    public function listTournament()
    {
        return $this->belongsTo(ListTournament::class, 'list_id');
    }

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

}
