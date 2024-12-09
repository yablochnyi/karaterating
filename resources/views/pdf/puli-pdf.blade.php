<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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

                                <div class="match-top team"
                                     @if($isClickable) wire:click="mountAction('winner', { id: {{ $pool->id }} })" @endif
                                >
                                    <span class="image"></span>
                                    <span class="seed"></span>
                                    <span class="name">
        {{ $pool->student ? $pool->student->first_name . ' ' . $pool->student->last_name : 'TBD' }}<br>
        {{ $pool->student ? ($pool->student->club ?? $pool->student->trener->club) : null }}
    </span>

                                    <span class="score"
                                          style="
              @if($pool->type == 'final')
                  {{ $pool->student_id == $pool->winner_id ? 'color: gold;' : 'color: silver;' }}
              @elseif($pool->type == 'Round Robin')
                  {{ $pool->student_id == $pool->winner_id_1rd_robbin ? 'color: gold;' : '' }}
                  {{ $pool->student_id == $pool->winner_id_2rd_robbin ? 'color: silver;' : '' }}
                  {{ $pool->student_id == $pool->winner_id_3rd_robbin ? 'color: #cd7f32;' : '' }}
              @endif
          ">
        @if($pool->type == 'final')
                                            @if($pool->winner_id == null)
                                                <!-- Если победитель не определен, отображаем трофей -->
                                                <x-bi-trophy style="font-size: 24px;" />
                                            @elseif($pool->student_id == $pool->winner_id)
                                                <!-- Если победитель — текущий студент -->
                                                <span style="font-size: 24px; color: gold;">🥇</span>
                                            @elseif($pool->opponent_id == $pool->winner_id)
                                                <!-- Если победитель — оппонент -->
                                                <span style="font-size: 24px; color: silver;">🥈</span>
                                            @endif

                                        @elseif($pool->type == 'Round Robin')
                                            @if($pool->student_id == $pool->winner_id_1rd_robbin)
                                                <span style="font-size: 20px; color: gold;">🥇</span>
                                            @elseif($pool->student_id == $pool->winner_id_2rd_robbin)
                                                <span style="font-size: 20px; color: silver;">🥈</span>
                                            @elseif($pool->student_id == $pool->winner_id_3rd_robbin)
                                                <span style="font-size: 20px; color: #cd7f32;">🥉</span>
                                            @endif
                                        @elseif($pool->student_id == $pool->winner_id)

                                            <x-bi-trophy style="font-size: 24px;" />
                                        @endif
    </span>
                                </div>

                                <div class="score-input-container">
                                    <input type="text" wire:model.live="tatami_and_fight_number.{{ $pool->id }}"
                                           class="fight-score-input"
                                           placeholder="0">
                                </div>

                                <div class="match-bottom team"
                                     @if($isClickable) wire:click="mountAction('winner', { id: {{ $pool->id }} })" @endif
                                >
                                    <span class="image"></span>
                                    <span class="seed"> </span>
                                    <span class="name">
        {{ $pool->opponent ? $pool->opponent->first_name . ' ' . $pool->opponent->last_name : 'TBD' }}<br>
        {{ $pool->opponent ? ($pool->opponent->club ?? $pool->opponent->trener->club) : null }}
    </span>

                                    <span class="score"
                                          style="
              @if($pool->type == 'final')
                  {{ $pool->opponent_id == $pool->winner_id ? 'color: gold;' : 'color: silver;' }}
              @elseif($pool->type == 'Round Robin')
                  {{ $pool->opponent_id == $pool->winner_id_1rd_robbin ? 'color: gold;' : '' }}
                  {{ $pool->opponent_id == $pool->winner_id_2rd_robbin ? 'color: silver;' : '' }}
                  {{ $pool->opponent_id == $pool->winner_id_3rd_robbin ? 'color: #cd7f32;' : '' }}
              @endif
          ">
        @if($pool->type == 'final')
                                            @if($pool->winner_id == null)
                                                <!-- Если победитель не определен, отображаем трофей -->
                                                <x-bi-trophy style="font-size: 24px;" />
                                            @elseif($pool->opponent_id == $pool->winner_id)
                                                <!-- Если победитель — текущий оппонент -->
                                                <span style="font-size: 24px; color: gold;">🥇</span>
                                            @elseif($pool->student_id == $pool->winner_id)
                                                <!-- Если победитель — студент -->
                                                <span style="font-size: 24px; color: silver;">🥈</span>
                                            @endif

                                        @elseif($pool->type == 'Round Robin')
                                            @if($pool->opponent_id == $pool->winner_id_1rd_robbin)
                                                <span style="font-size: 20px; color: gold;">🥇</span>
                                            @elseif($pool->opponent_id == $pool->winner_id_2rd_robbin)
                                                <span style="font-size: 20px; color: silver;">🥈</span>
                                            @elseif($pool->opponent_id == $pool->winner_id_3rd_robbin)
                                                <span style="font-size: 20px; color: #cd7f32;">🥉</span>
                                            @endif
                                        @elseif($pool->opponent_id == $pool->winner_id)

                                            <x-bi-trophy style="font-size: 24px;" />
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
                @if($tournament->fight_for_third_place)
                    @php
                        $thirdPlacePool = $poolsByList->where('type', '3rd')->first();
                    @endphp
                    @if($thirdPlacePool)
                        <h3 class="third-place-title">Бой за 3 место</h3>
                        @php
                            // Проверка, есть ли оба участника в бою за 3 место
                            $isClickable = $thirdPlacePool->student && $thirdPlacePool->opponent && $tournament->organization_id == auth()->id();
                        @endphp

                        <div class="match third-place"
                             @if($isClickable) wire:click="mountAction('winner', { id: {{ $thirdPlacePool->id }} })" @endif
                             style="cursor: {{ $isClickable ? 'pointer' : 'default' }}">

                            <div class="match-top team">
                                <span class="image"></span>
                                <span class="seed">3rd</span>
                                <span class="name">
                        {{ $thirdPlacePool->student ? $thirdPlacePool->student->first_name . ' ' . $thirdPlacePool->student->last_name : 'TBD' }}<br>
                        {{ $thirdPlacePool->student ? ($thirdPlacePool->student->club ?? $thirdPlacePool->student->trener->club) : null }}

                    </span>
                                <span class="score" style="{{ $thirdPlacePool->type == '3rd' ? 'color: #cd7f32;' : '' }}">
                                @if($thirdPlacePool->winner_id === null)
                                        <x-bi-trophy/>
                                    @elseif($thirdPlacePool->student_id == $thirdPlacePool->winner_id)
                                        <span style="font-size: 24px;">🥉</span>
                                    @endif
                    </span>
                            </div>

                            <div class="score-input-container">
                                <input type="text" wire:model.live="tatami_and_fight_number.{{ $thirdPlacePool->id }}"
                                       class="fight-score-input"
                                       placeholder="0">
                            </div>

                            <div class="match-bottom team">
                                <span class="image"></span>
                                <span class="seed">3rd</span>
                                <span class="name">
                        {{ $thirdPlacePool->opponent ? $thirdPlacePool->opponent->first_name . ' ' . $thirdPlacePool->opponent->last_name : 'TBD' }}<br>
                        {{ $thirdPlacePool->opponent ? ($thirdPlacePool->opponent->club ?? $thirdPlacePool->opponent->trener->club) : null }}
                    </span>
                                <span class="score" style="{{ $thirdPlacePool->type == '3rd' ? 'color: #cd7f32;' : '' }}">
                                 @if($thirdPlacePool->winner_id === null)
                                        <x-bi-trophy/>
                                    @elseif($thirdPlacePool->opponent_id == $thirdPlacePool->winner_id)
                                        <span style="font-size: 24px;">🥉</span>
                                    @endif
                    </span>
                            </div>
                        </div>
                    @endif
                @endif
            </div>


        </div>
    @endforeach


</div>
<style>

    /* Контейнер для поля ввода */
    .score-input-container {
        position: absolute;
        top: 50%; /* Центрируем относительно всего блока */
        left: 90%; /* Центрируем по горизонтали */
        transform: translate(-50%, -50%); /* Точное выравнивание */
        z-index: 10; /* Поверх текста */
        background-color: transparent; /* Чтобы не перекрывалось блоками */
    }

    /* Стили для поля ввода */
    .fight-score-input {
        width: 50px; /* Ширина поля */
        height: 30px; /* Высота поля */
        text-align: center; /* Центровка текста внутри */
        border: 1px solid #ccc; /* Граница */
        border-radius: 5px; /* Закругленные углы */
        font-size: 14px; /* Размер шрифта */
        background-color: #fff; /* Белый фон */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Легкая тень */
        padding: 0; /* Без внутренних отступов */
        color: black;
    }

    .page-break {
        page-break-before: always; /* Новый блок всегда с новой страницы */
        width: 100%;
        height: auto;
        margin: 0 auto;
        transform-origin: top left; /* Масштабирование сверху слева */
        position: relative;
        overflow: hidden;
    }

    .title {
        margin-top: 50px;
        font-size: 18px;
        text-align: center;
    }

    /* Стили для дополнительного блока для третьего места */
    .third-place-container {
        margin-top: 40px;
        text-align: center;
    }

    .third-place-title {
        color: black;
        font-size: 18px;
        margin-bottom: 10px;
    }

    .third-place .match {
        background-color: #2d2d2d;
        display: inline-flex;
        margin: 0 auto;
    }

    .theme {
        /*height: 100%;*/
        /*width: 100%;*/
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
        min-width: 240px;
        max-width: 240px;
        height: 150px;
        margin: 35px 24px 12px 0;
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
        height: 100px;
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
        height: 250px;
    }

    .column:nth-child(3) .match-lines .line.two {
        height: 450px;
    }

    .column:nth-child(4) .match-lines .line.two {
        height: 600px;
    }

    .column:nth-child(5) .match-lines .line.two {
        height: 750px;
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
    .bracket {
        transform: scale(0.8); /* Scale down the entire bracket */
        transform-origin: top left; /* Maintain alignment */
        margin: 0 auto;
    }

    .match {
        height: 100px; /* Reduce match height */
        margin: 10px 12px; /* Reduce margin */
        min-width: 180px; /* Narrower match boxes */
    }

    .match .team {
        font-size: 12px; /* Smaller font size for team names */
        height: 50%; /* Adjust height */
    }

    .match .score {
        font-size: 12px; /* Smaller score font */
    }

    .match-lines .line.one {
        width: 8px; /* Narrower lines */
    }

    .match-lines .line.two {
        height: 50px; /* Reduce spacing between rounds */
    }

    .column {
        min-height: auto; /* Allow flexible column height */
    }

    .third-place-title, .title {
        font-size: 14px; /* Reduce title font size */
    }

    .page-break {
        transform: scale(0.9); /* Slightly shrink entire content on page */
    }

</style>
</body>
</html>
