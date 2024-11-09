<?php

namespace App\Http\Controllers;

use App\Models\ListTournament;
use App\Models\Tournament;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class GeneratePDFPuliController extends Controller
{
    public $tournament;
    public function generatePDFPuli($id): \Illuminate\Http\Response
    {
        $this->tournament = Tournament::with([
            'pools' => function ($query) use ($id) {
                $query->where('tournament_id', $id);
            },
            'pools.student',
            'pools.opponent',
            'pools.listTournament.templateStudentList' // Подгружаем TemplateStudentList через ListTournament
        ])->findOrFail($id);

        // Получаем title из TemplateStudentList и сохраняем в свойство
//        $this->titleList = $this->tournament->pools->first()->listTournament->templateStudentList->name ?? 'Default Title';


        $pdf = Pdf::loadView('pdf.puli-pdf', [
            'tournament' => $this->tournament,
        ])->setPaper('a4')->setOptions([
            'defaultFont' => 'DejaVu Sans'
        ]);
        // Возврат PDF потока в браузер
        return $pdf->stream('puli.pdf');

    }
}
