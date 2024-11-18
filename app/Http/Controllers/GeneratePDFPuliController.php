<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
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

//        return view('pdf.puli-pdf', [
//            'tournament' => $tournament,
//            'poolsGroupedByListId' => $poolsGroupedByListId
//        ]);
        // Передаем сгруппированные данные в шаблон
        return Pdf::view('pdf.puli-pdf', [
            'tournament' => $tournament,
            'poolsGroupedByListId' => $poolsGroupedByListId
        ])->format('a4')->name('your-invoice.pdf');

        // Получаем title из TemplateStudentList и сохраняем в свойство
//        $this->titleList = $this->tournament->pools->first()->listTournament->templateStudentList->name ?? 'Default Title';



    }
}
