<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TournamentListExport implements FromCollection, WithEvents, WithStyles
{
    protected $listTournaments;

    public function __construct($listTournaments)
    {
        $this->listTournaments = $listTournaments; // Данные турнира
    }

    public function collection()
    {
        $rows = [];

        foreach ($this->listTournaments as $listTournament) {
            // Добавляем заголовок категории
            $rows[] = [$listTournament->templateStudentList->name, '', '', '', '', '', '', ''];

            // Добавляем заголовок таблицы
            $rows[] = [
                '№ п/п',
                'Спортсмен',
                'Возраст',
                'Спортивный разряд',
                'Кю / Дан',
                'Вес',
                'Субъект РФ',
                'Тренер(ы)',
            ];

            // Добавляем данные
            $counter = 1;
            foreach ($listTournament->tournamentStudentLists as $studentList) {
                $rows[] = [
                    $counter++,
                    mb_strtoupper($studentList->student->last_name) . ' ' . $studentList->student->first_name,
                    $studentList->student->age . ' лет',
                    '0',
                    $studentList->student->rang,
                    $studentList->student->weight . ' кг',
                    $studentList->student->trener->club,
                    $studentList->student->trener->last_name . ' ' . mb_substr($studentList->student->trener->first_name, 0, 1) . '.',
                ];
            }
        }

        return new Collection($rows);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;
                $row = 1; // Начальная строка

                foreach ($this->listTournaments as $listTournament) {
                    // Заголовок категории
                    $sheet->mergeCells("A{$row}:H{$row}");
                    $sheet->getStyle("A{$row}")->applyFromArray([
                        'font' => ['bold' => true, 'size' => 14],
                        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                    ]);
                    $row++;

                    // Заголовок таблицы
                    $sheet->getStyle("A{$row}:H{$row}")->applyFromArray([
                        'font' => ['bold' => true],
                        'borders' => [
                            'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                        ],
                        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                    ]);
                    $row++;

                    // Данные таблицы
                    foreach ($listTournament->tournamentStudentLists as $studentList) {
                        $sheet->getStyle("A{$row}:H{$row}")->applyFromArray([
                            'borders' => [
                                'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                            ],
                            'alignment' => [
                                'vertical' => Alignment::VERTICAL_CENTER,
                                'horizontal' => Alignment::HORIZONTAL_LEFT,
                            ],
                        ]);
                        $row++;
                    }
                }
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Стили для всей таблицы
        return [
            'A:H' => [
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
            ],
        ];
    }
}
