<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use Spatie\LaravelPdf\Facades\Pdf;
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

        // Создаем экземпляр Browsershot
        $browsershot = new Browsershot();

        // Указываем путь к бинарникам Node.js, NPM, Puppeteer, а также к Chromium
        $browsershot->setNodeBinary('/root/.nvm/versions/node/v23.1.0/bin/node')
            ->setNpmBinary('/root/.nvm/versions/node/v23.1.0/bin/npm')
            ->setChromePath('/usr/bin/chromium-browser')  // Укажите путь к вашему Chromium
            ->addChromiumArguments([
                'no-sandbox',
                'disable-setuid-sandbox',  // Иногда требуется для Linux-серверов
            ]);

        // Генерируем PDF с помощью Spatie Laravel PDF, используя настраиваемые параметры
        return Pdf::view('pdf.bracket', [
            'tournament' => $tournament,
            'poolsGroupedByListId' => $poolsGroupedByListId
        ])
            ->name('your-invoice.pdf');
    }
}
