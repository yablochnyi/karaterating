<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: "DejaVu Sans", sans-serif;
            font-size: 12px;
            line-height: 1.6;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .whitespace-nowrap {
            white-space: nowrap;
        }

        .text-sm {
            font-size: 12px;
        }
    </style>
</head>
<body>
<div class="container">
    <table>
        <tbody>
        <tr class="border-b">
            <th class="px-4 py-2 text-left text-sm whitespace-nowrap">Дата и время проведения:</th>
            <td class="px-4 py-2 text-sm">{{ \Carbon\Carbon::parse($report->created_at)->format('d.m.Y H:i') }}</td>
        </tr>
        <tr class="border-b">
            <th class="px-4 py-2 text-left text-sm">Обучающийся:</th>
            <td class="px-4 py-2 text-sm">{{ $report->studenttest->student->name }}</td>
        </tr>
        <tr class="border-b">
            <th class="px-4 py-2 text-left text-sm">Вид обучения:</th>
            <td class="px-4 py-2 text-sm">{{$report->studenttest->studentprogram->getConditiontype()}}</td>
        </tr>
        <tr class="border-b">
            <th class="px-4 py-2 text-left text-sm">Программа обучения:</th>
            <td class="px-4 py-2 text-sm">{{$report->studenttest->studentprogram->program->name}}</td>
        </tr>
        <tr class="border-b">
            <th class="px-4 py-2 text-left text-sm">Количество часов обучения:</th>
            <td class="px-4 py-2 text-sm">{{$report->studenttest->studentprogram->program_period}}</td>
        </tr>
        <tr class="border-b">
            <th class="px-4 py-2 text-left text-sm">Период обучения:</th>
            <td class="px-4 py-2 text-sm">
                @php
                    $months = [
                        1 => 'января',
                        2 => 'февраля',
                        3 => 'марта',
                        4 => 'апреля',
                        5 => 'мая',
                        6 => 'июня',
                        7 => 'июля',
                        8 => 'августа',
                        9 => 'сентября',
                        10 => 'октября',
                        11 => 'ноября',
                        12 => 'декабря',
                    ];

                    $dateStart = \Carbon\Carbon::parse($report->studenttest->studentprogram->date_start);
                    $dateFinish = \Carbon\Carbon::parse($report->studenttest->studentprogram->date_finish);

                    $startMonth = $months[$dateStart->month];
                    $finishMonth = $months[$dateFinish->month];
                @endphp

                с "{{ $dateStart->format('d') }}" {{ $startMonth }} {{ $dateStart->format('Y') }}г.
                по "{{ $dateFinish->format('d') }}" {{ $finishMonth }} {{ $dateFinish->format('Y') }}г.
            </td>
        </tr>
        <tr class="border-b">
            <th class="px-4 py-2 text-left text-sm">Вид аттестации:</th>
            <td class="px-4 py-2 text-sm">{{$report->studenttest->programtest->programprocess->name}}</td>
        </tr>
        <tr class="border-b">
            <th class="px-4 py-2 text-left text-sm">Результат:</th>
            <td class="px-4 py-2 text-sm">Форма
                аттестации: {{$report->studenttest->studentprogram->getExaminationtype()}}.
                Оценка: {{$report->studenttest->getStatusPass()}}. {{$report->results}} баллов
                ({{$report->getPercentResult()}}%).
                Преподаватель: {{$report->studenttest->studentprogram->pedagogue->name}}.
            </td>
        </tr>
        <tr class="border-b">
            <th class="px-4 py-2 text-left text-sm">Прокторы подключались:</th>
            <td class="px-4 py-2 text-sm">
                @foreach($proctorInfo as $info)
                    <p>{{ $info['name'] }}  {{ $info['time'] }}.</p>
                @endforeach
            </td>
        </tr>
        <tr class="border-b">
            <th class="px-4 py-2 text-left text-sm">IP адрес и браузер обучающегося:</th>
            <td class="px-4 py-2 text-sm">{{$report->ip}}</td>
        </tr>
        <tr class="border-b">
            <th class="px-4 py-2 text-left text-sm">Доп. настройки при прохождении аттестации:</th>
            <td class="px-4 py-2 text-sm">
                <ul class="list-disc pl-5">
                    @if($report->studenttest->studentprocess->enable_time_limit)
                        <li>Ограничение времени на прохождение
                            аттестации: {{ $report->studenttest->studentprocess->time_limit_minutes }} мин.
                        </li>
                    @endif
                    @if($report->studenttest->studentprocess->enable_auto_save_snapshots)
                        <li>Автоматическое сохранение снимков с камеры обучающегося.</li>
                    @endif
                    @if($report->studenttest->studentprocess->enable_auto_save_screenshots)
                        <li>Автоматическое сохранение снимков экрана обучающегося:
                            каждые {{ $report->studenttest->studentprocess->time_interval_screenshots }} мин.
                        </li>
                    @endif
                    @if($report->studenttest->studentprocess->enable_mandatory_passport_verification)
                        <li>Обязательное прохождение идентификации по паспорту обучающегося.</li>
                    @endif
                    @if($report->studenttest->studentprocess->enable_proctor_connection_simulation)
                        <li>Имитация подключения прокторов к аттестации обучающегося.</li>
                    @endif
                    @if($report->studenttest->studentprocess->enable_mandatory_microphone_access)
                        <li>Обязательный доступ к микрофону обучающегося.</li>
                    @endif
                    @if($report->studenttest->studentprocess->enable_mandatory_camera_access)
                        <li>Обязательный доступ к камере обучающегося.</li>
                    @endif
                    @if($report->studenttest->studentprocess->enable_mandatory_screen_access)
                        <li>Обязательный доступ к экрану обучающегося.</li>
                    @endif
                    @if($report->studenttest->studentprocess->enable_quantity_try)
                        <li>Количество попыток: {{ $report->studenttest->studentprocess->quantity_try }}</li>
                    @endif
                </ul>
            </td>
        </tr>
        @if(!empty($report->identify_user))
            <tr class="border-b">
                <th class="px-4 py-2 text-left text-sm">Идентификация обучающегося:</th>
                <td class="px-4 py-2 text-sm">
                    @if(file_exists(public_path($report->identify_user)))
                        @php
                            $imageData = base64_encode(file_get_contents(public_path($report->identify_user)));
                            $src = 'data:'.mime_content_type(public_path($report->identify_user)).';base64,'.$imageData;
                        @endphp
                        <img src="{{ $src }}" style="max-width: 20%" class="w-24 h-auto border cursor-pointer">
                    @endif
                </td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
</body>
</html>


