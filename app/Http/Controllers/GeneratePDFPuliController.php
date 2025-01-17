<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use Spatie\Browsershot\Browsershot;

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

        // Генерируем PDF с помощью Browsershot
        $pdfContent = Browsershot::html(view('pdf.bracket', [
            'tournament' => $tournament,
            'poolsGroupedByListId' => $poolsGroupedByListId
        ])->render())  // Рендерим представление HTML в строку
//        ->setNodeBinary('/root/.nvm/versions/node/v23.1.0/bin/node')
//            ->setNpmBinary('/root/.nvm/versions/node/v23.1.0/bin/npm')
//            ->setChromePath('/usr/bin/chromium-browser')  // Указываем путь к вашему Chromium
            ->setIncludePath('/usr/local/bin')
            ->addChromiumArguments([
                'no-sandbox',
                'disable-setuid-sandbox',  // Иногда требуется для Linux-серверов
            ])
            ->pdf(); // Генерируем PDF

        // Возвращаем PDF в ответ
        return response($pdfContent)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="tournament-bracket.pdf"');
    }
}
