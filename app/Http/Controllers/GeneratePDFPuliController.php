<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use Spatie\Browsershot\Browsershot;
use Spatie\LaravelPdf\Facades\Pdf;

class GeneratePDFPuliController extends Controller
{
    public function generatePDFPuli($id)
    {
        $tournament = Tournament::with([
            'pools' => function ($query) use ($id) {
                $query->where('tournament_id', $id);
            },
            'pools.student',
            'pools.opponent',
            'pools.listTournament.templateStudentList'
        ])->findOrFail($id);

        // Группируем пулы по list_id
        $poolsGroupedByListId = $tournament->pools->groupBy('list_id');

        // Передаем сгруппированные данные в шаблон
//        return Pdf::view('pdf.puli-pdf', [
//            'tournament' => $tournament,
//            'poolsGroupedByListId' => $poolsGroupedByListId
//        ])->name('your-invoice.pdf');
//return view('pdf.bracket', compact('poolsGroupedByListId', 'tournament'));
        return Pdf::view('pdf.bracket', [
            'tournament' => $tournament,
            'poolsGroupedByListId' => $poolsGroupedByListId
        ])->name('your-invoice.pdf');

    }
}
