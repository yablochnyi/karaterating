<?php

namespace App\Http\Controllers;

use App\Models\ListTournament;
use App\Models\Studenttestresult;
use App\Models\TournamentStudentList;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class GeneratePDFReportController extends Controller
{
    public function generatePDFReport($id): \Illuminate\Http\Response
    {
        $listTournaments = ListTournament::where('tournament_id', $id)
            ->whereHas('tournamentStudentLists') // Фильтруем списки, которые имеют связанных студентов
            ->with(['tournamentStudentLists.student', 'templateStudentList']) // Загружаем связанные списки студентов и шаблоны списков студентов
            ->get();


        $pdf = Pdf::loadView('pdf.report-pdf', [
            'listTournaments' => $listTournaments,
        ])->setPaper('a4')->setOptions([
            'defaultFont' => 'DejaVu Sans'
        ]);
        // Возврат PDF потока в браузер
        return $pdf->stream('report.pdf');

    }
}
