<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Турнирная сетка</title>
</head>
<body>
<div class="theme theme-dark " wire:ignore>
    @foreach($tournament->pools->groupBy('list_id') as $listId => $poolsByList)

        <div class="page-break">
            @php
                $titleList = $poolsByList->first()->listTournament->templateStudentList->name ?? 'Default Title';
            @endphp
                <!-- Вывод ID каждого списка для проверки -->
            <div class="title">{{ $titleList }}</div>
            <div class="bracket disable-image " style="margin-bottom: 50px" wire:ignore>


                @php
                    // Определяем максимальный номер раунда для текущего list_id, исключая бои за третье место
                    $maxRound = $poolsByList->where('type', '!=', '3rd')->max('round');
                @endphp

                    <!-- Цикл по каждому раунду от 1 до максимального для текущего list_id -->
                @for ($round = 1; $round <= $maxRound; $round++)
                    <div class="column round-{{ $round }}">
                        <!-- Фильтрация пула для текущего раунда и текущего list_id -->
                        @foreach($poolsByList->where('round', $round) as $pool)
                            @php
                                // Проверяем, есть ли оба участника в бою
                                $isClickable = $pool->student && $pool->opponent && $tournament->organization_id == auth()->id();
                            @endphp

                            <div
                                class="match {{ $pool->winner_id ? ($pool->student_id == $pool->winner_id ? 'winner-top' : 'winner-bottom') : '' }}"
                                @if($isClickable) wire:click="mountAction('winner', { id: {{ $pool->id }} })" @endif
                                style="cursor: {{ $isClickable ? 'pointer' : 'default' }}">

                                <div class="match-top team">
                                    <span class="image"></span>
                                    <span class="seed"> </span>
                                    <span class="name">
                        {{ $pool->student ? $pool->student->first_name . ' ' . $pool->student->last_name : 'TBD' }}<br>
                        {{ $pool->student ? ($pool->student->club ?? $pool->student->trener->club) : null }}
                    </span>
                                    <span class="score"
                                          style="{{ $pool->type == 'final' ? ($pool->student_id == $pool->winner_id ? 'color: gold;' : 'color: silver;') : '' }}">
                        @if($pool->student_id == $pool->winner_id || ($pool->type == 'final' && $pool->opponent_id == $pool->winner_id))
                                            <x-bi-trophy/>
                                        @endif
                    </span>
                                </div>

                                <div class="match-bottom team">
                                    <span class="image"></span>
                                    <span class="seed"> </span>
                                    <span class="name">
                        {{ $pool->opponent ? $pool->opponent->first_name . ' ' . $pool->opponent->last_name : 'TBD' }}<br>
                        {{ $pool->opponent ? ($pool->opponent->club ?? $pool->opponent->trener->club) : null }}
                    </span>
                                    <span class="score"
                                          style="{{ $pool->type == 'final' ? ($pool->opponent_id == $pool->winner_id ? 'color: gold;' : 'color: silver;') : '' }}">
                        @if($pool->opponent_id == $pool->winner_id || ($pool->type == 'final' && $pool->student_id == $pool->winner_id))
                                            <x-bi-trophy/>
                                        @endif
                    </span>
                                </div>

                                <!-- Отображаем линии, только если это не последний раунд -->
                                @if ($round != $maxRound)
                                    <div class="match-lines">
                                        <div class="line one"></div>
                                        <div class="line two"></div>
                                    </div>
                                    <div class="match-lines alt">
                                        <div class="line one"></div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endfor



                <!-- Блок для боя за третье место для текущего list_id -->

            </div>
            @if($tournament->fight_for_third_place)
                @php
                    $thirdPlacePool = $poolsByList->where('type', '3rd')->first();
                @endphp
                @if($thirdPlacePool)
                    <div class="third-place-container" wire:ignore>
                        <h3 class="third-place-title">Бой за 3 место</h3>
                        <div class="match third-place"
                             @if($isClickable) wire:click="mountAction('winner', { id: {{ $thirdPlacePool->id }} })"
                             @endif
                             style="cursor: {{ $isClickable ? 'pointer' : 'default' }}">

                            <div class="match-top team">
                                <span class="image"></span>
                                <span class="seed">3rd</span>
                                <span class="name">
                                    {{ $thirdPlacePool->student ? $thirdPlacePool->student->first_name . ' ' . $thirdPlacePool->student->last_name : 'TBD' }}<br>
                                    {{ $thirdPlacePool->student ? ($thirdPlacePool->student->club ?? $thirdPlacePool->student->trener->club) : null }}
                                </span>
                                <span class="score" style="color: #cd7f32;">
                                    @if($thirdPlacePool->student_id == $thirdPlacePool->winner_id)
                                        <x-bi-trophy/>
                                    @endif
                                </span>
                            </div>

                            <div class="match-bottom team">
                                <span class="image"></span>
                                <span class="seed">3rd</span>
                                <span class="name">
                                    {{ $thirdPlacePool->opponent ? $thirdPlacePool->opponent->first_name . ' ' . $thirdPlacePool->opponent->last_name : 'TBD' }}<br>
                                    {{ $thirdPlacePool->opponent ? ($thirdPlacePool->opponent->club ?? $thirdPlacePool->opponent->trener->club) : null }}
                                </span>
                                <span class="score" style="color: #cd7f32;">
                                    @if($thirdPlacePool->opponent_id == $thirdPlacePool->winner_id)
                                        <x-bi-trophy/>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    @endforeach


</div>
<style>
    .title {
        font-size: 18px;
        font-weight: bold;
        text-align: left;
        margin-top: 20px;
        line-height: 1.2em;
        max-width: 100%; /* Ограничивает ширину */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }


    .page-break {
        page-break-before: always;
        margin-top: 50px;
        width: 210mm;
        /*height: 297mm;*/
    }
    .tournament-scale {
        transform: scale(0.7); /* Уменьшите значение, чтобы все элементы вместились */
        transform-origin: top left;
    }
    /* Устанавливаем размеры для страницы A4 */
    body, .page-break {
        margin: 10px;
        padding: 0;
        box-sizing: border-box;
    }

    /* Стили для дополнительного блока для третьего места */
    .third-place-container {
        margin-top: 40px;
        text-align: center;
    }

    .third-place-title {
        color: #e3e8ef;
        font-size: 18px;
        margin-bottom: 10px;
    }

    .third-place .match {
        background-color: #2d2d2d;
        display: inline-flex;
        margin: 0 auto;
    }

    .theme {
        /*height: 30%;*/
        /*width: 30%;*/
        position: absolute;
    }

    /*.bracket {*/
    /*    padding: 40px;*/
    /*    margin: 5px;*/
    /*}*/
    .bracket {
        display: flex;
        flex-direction: row;
        position: relative;
    }

    .column {
        display: flex;
        flex-direction: column;
        min-height: 100%;
        justify-content: space-around;
        align-content: center;
    }

    .match {
        position: relative;
        display: flex;
        flex-direction: column;
        /*min-width: 240px;*/
        max-width: 240px;
        /*height: 62px;*/
        margin: 35px 24px 12px 0;

        min-width: 200px; /* Уменьшите ширину */
        height: 40px; /* Уменьшите высоту */
        /*margin: 20px 10px 16px 0; !* Сократите отступы *!*/
    }

    .match .match-top {
        border-radius: 2px 2px 0 0;
    }

    .match .match-bottom {
        border-radius: 0 0 2px 2px;
    }

    .match .team {
        display: flex;
        align-items: center;
        width: 100%;
        height: 100%;
        border: 1px solid black;
        position: relative;
    }

    .match .team span {
        padding-left: 8px;
    }

    .match .team span:last-child {
        padding-right: 8px;
    }

    .match .team .score {
        margin-left: auto;
    }

    .match .team:first-child {
        margin-bottom: -1px;
    }

    .match-lines {
        display: block;
        position: absolute;
        top: 50%;
        bottom: 0;
        margin-top: 0px;
        right: -1px;
    }

    .match-lines .line {
        background: red;
        position: absolute;
    }

    .match-lines .line.one {
        height: 1px;
        width: 12px;
    }

    .match-lines .line.two {
        height: 44px;
        width: 1px;
        left: 11px;
    }

    .match-lines.alt {
        left: -12px;
    }

    .match:nth-child(even) .match-lines .line.two {
        transform: translate(0, -100%);
    }

    .column:first-child .match-lines.alt {
        display: none;
    }

    .column:last-child .match-lines {
        display: none;
    }

    .column:last-child .match-lines.alt {
        display: block;
    }

    .column:nth-child(2) .match-lines .line.two {
        height: 88px;
    }

    .column:nth-child(3) .match-lines .line.two {
        height: 175px;
    }

    .column:nth-child(4) .match-lines .line.two {
        height: 262px;
    }

    .column:nth-child(5) .match-lines .line.two {
        height: 349px;
    }

    .disable-image .image,
    .disable-seed .seed,
    .disable-name .name,
    .disable-score .score {
        display: none !important;
    }

    .disable-borders {
        border-width: 0px !important;
    }

    .disable-borders .team {
        border-width: 0px !important;
    }

    .disable-seperator .match-top {
        border-bottom: 0px !important;
    }

    .disable-seperator .match-bottom {
        border-top: 0px !important;
    }

    .disable-seperator .team:first-child {
        margin-bottom: 0px;
    }

    /* Dark Theme */
    .theme-dark {
        /*background: #0e1217;*/
        border-color: #040607;
    }

    .theme-dark .match-lines .line {
        background: #36404e;
    }

    .theme-dark .team {
        /*background: #182026;*/
        border-color: #232c36;
        color: #6b798c;
    }

    .theme-dark .winner-top .match-top,
    .theme-dark .winner-bottom .match-bottom {
        background: #232c36;
        color: #e3e8ef;
        border-color: #36404e;
        z-index: 1;
    }

    .theme-dark .winner-top .match-top .score,
    .theme-dark .winner-bottom .match-bottom .score {
        color: #03d9ce;
    }

    .theme-dark .match .seed {
        font-size: 12px;
        min-width: 10px;
    }

    .theme-dark .match .score {
        font-size: 14px;
    }

</style>
</body>
</html>
