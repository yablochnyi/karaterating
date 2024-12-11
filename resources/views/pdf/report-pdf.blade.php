<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Таблица регистрации участников</title>
    <style>
        * {
            font-family: DejaVu Sans;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .section-title {
            font-weight: bold;
            text-align: center;
            padding: 10px 0;
            font-size: 1.2em;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>

<h2 class="section-title">ПРОТОКОЛ РЕГИСТРАЦИИ УЧАСТНИКОВ СОРЕВНОВАНИЙ</h2>

@foreach($listTournaments as $index => $listTournament)
    <!-- Добавляем новый класс для начала страницы с нового листа -->
    @if ($index > 0)
        <div class="page-break"></div>
    @endif

    <h3 class="section-title">
        {{ mb_strtoupper($listTournament->templateStudentList->name) }}
    </h3>

    <table>
        <thead>
        <tr>
            <th>№ п/п</th>
            <th>Спортсмен</th>
            <th>Возраст</th>
            <th>Спортивный разряд</th>
            <th>Кю / Дан</th>
            <th>Вес</th>
            <th>Субъект РФ</th>
            <th>Тренер(ы)</th>
        </tr>
        </thead>
        <tbody>
        @php $counter = 1; @endphp
        @foreach($listTournament->tournamentStudentLists as $studentList)
            <tr>
                <td>{{ $counter++ }}</td>
                <td>{{ mb_strtoupper($studentList->student->last_name) }} {{ $studentList->student->first_name }}</td>
                <td>{{ $studentList->student->age }} лет</td>
                <td>0</td>
                <td>{{ $studentList->student->rang }}</td>
                <td>{{ $studentList->student->weight }} кг</td>
                <td>{{ $studentList->student?->trener?->club }}</td>
                <td>{{ $studentList->student?->trener?->last_name }} {{ mb_substr($studentList->student?->trener?->first_name, 0, 1) }}.</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br><br>
@endforeach

</body>
</html>
