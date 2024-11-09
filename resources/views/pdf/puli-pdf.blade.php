<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Турнирная сетка</title>
    <style>
        /* Упрощенные стили для таблицы */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
            font-size: 10px;
        }

        .match {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .team {
            margin: 2px 0;
        }

        /* Цвета для финала и боя за 3-е место */
        .gold { color: gold; }
        .silver { color: silver; }
        .bronze { color: #cd7f32; }
    </style>
</head>
<body>
<h1>Турнирная сетка</h1>

@php
    $maxRound = $tournament->pools
        ->where('type', '!=', '3rd')
        ->max('round');
@endphp

<table>
    <thead>
    <tr>
        @for ($round = 1; $round <= $maxRound; $round++)
            <th>Раунд {{ $round }}</th>
        @endfor
    </tr>
    </thead>
    <tbody>
    <tr>
        @for ($round = 1; $round <= $maxRound; $round++)
            <td>
                @foreach($tournament->pools->where('round', $round) as $pool)
                    <div class="match">
                        <div class="team">
                            {{ $pool->student ? $pool->student->first_name . ' ' . $pool->student->last_name : 'TBD' }}
                            @if($pool->student_id == $pool->winner_id)
                                <span class="{{ $pool->type == 'final' ? 'gold' : ($pool->type == '3rd' ? 'bronze' : '') }}">🏆</span>
                            @endif
                        </div>
                        <div class="team">
                            {{ $pool->opponent ? $pool->opponent->first_name . ' ' . $pool->opponent->last_name : 'TBD' }}
                            @if($pool->opponent_id == $pool->winner_id)
                                <span class="{{ $pool->type == 'final' ? 'gold' : ($pool->type == '3rd' ? 'bronze' : '') }}">🏆</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </td>
        @endfor
    </tr>
    </tbody>
</table>

<!-- Блок для боя за третье место -->
@if($tournament->fight_for_third_place && $maxRound > 1)
    <h3>Бой за 3 место</h3>
    @php
        $thirdPlacePool = $tournament->pools->where('type', '3rd')->first();
    @endphp

    @if($thirdPlacePool)
        <table style="width: 50%; margin: 0 auto;">
            <tr>
                <td>
                    <div class="team">
                        {{ $thirdPlacePool->student ? $thirdPlacePool->student->first_name . ' ' . $thirdPlacePool->student->last_name : 'TBD' }}
                        @if($thirdPlacePool->student_id == $thirdPlacePool->winner_id)
                            <span class="bronze">🥉</span>
                        @endif
                    </div>
                    <div class="team">
                        {{ $thirdPlacePool->opponent ? $thirdPlacePool->opponent->first_name . ' ' . $thirdPlacePool->opponent->last_name : 'TBD' }}
                        @if($thirdPlacePool->opponent_id == $thirdPlacePool->winner_id)
                            <span class="bronze">🥉</span>
                        @endif
                    </div>
                </td>
            </tr>
        </table>
    @else
        <p>Бой за третье место не найден.</p>
    @endif
@endif
</body>
</html>
