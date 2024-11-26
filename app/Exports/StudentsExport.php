<?php

namespace App\Exports;

use App\Models\Trainer;
use App\Models\Student;
use App\Models\Trener;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StudentsExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    protected $trainerName;
    protected $trainerId;
    protected $tournamentId;

    public function __construct($trainerId, $tournamentId)
    {
        $this->trainerId = $trainerId;
        $this->tournamentId = $tournamentId;
        $trainer = Trener::find($trainerId);
        $this->trainerName = $trainer
            ? $trainer->first_name . ' ' . $trainer->last_name
            : 'Тренер не найден';
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Базовый запрос для получения студентов, привязанных к тренеру
        $query = Student::select('first_name', 'last_name')
            ->where('coach_id', $this->trainerId);

        // Применяем фильтр по турниру, если он задан
        if (!empty($this->tournamentId['tournament_id'])) {
            $query->whereHas('tournaments', function ($subQuery) {
                $subQuery->where('tournaments.id', $this->tournamentId['tournament_id']);
            });
        }

        return $query->get();
    }


    /**
     * Заголовки для столбцов
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Имя',
            'Фамилия',
        ];
    }

    /**
     * События для форматирования Excel
     *
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        // Стиль общего заголовка
        $sheet->mergeCells('A1:E1');
        $sheet->setCellValue('A1', 'Список студентов под руководством: ' . $this->trainerName);
        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true, // Перенос текста в ячейке
            ],
        ]);

//        return [
//            // Стили для заголовков столбцов
//            2 => ['font' => ['bold' => true]], // Строка с заголовками
//        ];
    }

    /**
     * Установка ширины колонок
     *
     * @return array
     */
    public function columnWidths(): array
    {
        return [
            'A' => 20, // Ширина для столбца "Имя"
            'B' => 30, // Ширина для столбца "Фамилия"
        ];
    }
}

