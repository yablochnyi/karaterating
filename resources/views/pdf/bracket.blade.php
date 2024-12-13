<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
@foreach($tournament->pools->groupBy('list_id') as $listId => $poolsByList)
    <page size="A4">
        @php
            $titleList = $poolsByList->first()->listTournament->templateStudentList->name ?? 'Default Title';
            $totalParticipants = $poolsByList->first()->listTournament->students->count();

            // Определяем высоту в зависимости от количества участников
            $matchHeight = $totalParticipants <= 8 ? '260px' : ($totalParticipants <= 16 ? '130px' : '64.3px');
        @endphp
        <div class="tournament_name">
            {{--        <h1>УЧЕБНО-ТРЕНИРОВОЧНЫЕ СБОРЫ ПО <br> КИОКУСИНКАЙ (8 КЮ)</h1>--}}
            <h2>{{ $titleList }}</h2>
        </div>
        <div class="tournament">
            <div class="tournament__grid">
                @php
                    // Определяем максимальный номер раунда для текущего list_id, исключая бои за третье место
                    $maxRound = $poolsByList->where('type', '!=', '3rd')->max('round');
                @endphp
                @for ($round = 1; $round <= $maxRound; $round++)
                    @if($round == 1)
                        <div class="tournament__round tournament__round--first-round">
                            @foreach($poolsByList->where('round', $round) as $pool)
                                <div class="tournament__match" style="min-height: {{ $matchHeight }};">
                                    <a class="tournament__match__team" href="#">
                                        <h4>{{ $pool->student ? ($pool->student->club ?? $pool->student->trener->club) : null }}</h4>
                                        <div class="tournament__match__team__info">
                                            <p>{{ $pool->student ? $pool->student->first_name . ' ' . $pool->student->last_name : 'TBD' }}</p>
                                            @if($pool->winner_id != null && $pool->type == 'final' && $pool->student_id != $pool->winner_id)
                                                <span style="font-size: 24px; color: silver;">🥈</span>
                                            @endif
                                            @if($pool->winner_id != null && $pool->student_id === $pool->winner_id)
                                                <x-bi-trophy style="font-size: 24px; margin-top: 8px" />
                                            @endif
                                        </div>
                                    </a>
                                    <h6 class="tournament__match__team__number">{{$pool->tatami_and_fight_number}}</h6>
                                    <a class="tournament__match__team" href="#">
                                        <h4>{{ $pool->opponent ? ($pool->opponent->club ?? $pool->opponent->trener->club) : null }}</h4>
                                        <div class="tournament__match__team__info">

                                            <p>{{ $pool->opponent ? $pool->opponent->first_name . ' ' . $pool->opponent->last_name : 'TBD' }}</p>
                                            @if($pool->winner_id != null && $pool->type == 'final' && $pool->opponent_id != $pool->winner_id)
                                                <span style="font-size: 24px; color: silver;">🥈</span>
                                            @endif
                                            @if($pool->winner_id != null && $pool->opponent_id === $pool->winner_id)
                                                <x-bi-trophy style="font-size: 24px; margin-top: 8px" />
                                            @endif

                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if($round == 2)
                        <div class="tournament__round tournament__round--first-round">
                            @foreach($poolsByList->where('round', $round) as $pool)
                                <div class="tournament__match" style="min-height: {{ $matchHeight }};">
                                    <a class="tournament__match__team" href="#">
                                        <h4>{{ $pool->student ? ($pool->student->club ?? $pool->student->trener->club) : null }}</h4>
                                        <div class="tournament__match__team__info">
                                            <p>{{ $pool->student ? $pool->student->first_name . ' ' . $pool->student->last_name : 'TBD' }}</p>
                                            @if($pool->winner_id != null && $pool->type == 'final' && $pool->student_id != $pool->winner_id)
                                                <span style="font-size: 24px; color: silver;">🥈</span>
                                            @endif
                                            @if($pool->winner_id != null && $pool->student_id === $pool->winner_id)
                                                <x-bi-trophy style="font-size: 24px; margin-top: 8px" />
                                            @endif
                                        </div>
                                    </a>
                                    <h6 class="tournament__match__team__number">{{$pool->tatami_and_fight_number}}</h6>
                                    <a class="tournament__match__team" href="#">
                                        <h4>{{ $pool->opponent ? ($pool->opponent->club ?? $pool->opponent->trener->club) : null }}</h4>
                                        <div class="tournament__match__team__info">

                                            <p>{{ $pool->opponent ? $pool->opponent->first_name . ' ' . $pool->opponent->last_name : 'TBD' }}</p>
                                            @if($pool->winner_id != null && $pool->type == 'final' && $pool->opponent_id != $pool->winner_id)
                                                <span style="font-size: 24px; color: silver;">🥈</span>
                                            @endif
                                            @if($pool->winner_id != null && $pool->opponent_id === $pool->winner_id)
                                                <x-bi-trophy style="font-size: 24px; margin-top: 8px" />
                                            @endif

                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if($round == 3)
                        <div class="tournament__round">
                            @foreach($poolsByList->where('round', $round) as $pool)
                                <div class="tournament__match" style="min-height: {{ $matchHeight }};">
                                    <a class="tournament__match__team" href="#">
                                        <h4>{{ $pool->student ? ($pool->student->club ?? $pool->student->trener->club) : null }}</h4>
                                        <div class="tournament__match__team__info">
                                            <p>{{ $pool->student ? $pool->student->first_name . ' ' . $pool->student->last_name : 'TBD' }}</p>
                                            @if($pool->winner_id != null && $pool->type == 'final' && $pool->student_id != $pool->winner_id)
                                                <span style="font-size: 24px; color: silver;">🥈</span>
                                            @endif
                                            @if($pool->winner_id != null && $pool->student_id === $pool->winner_id)
                                                <x-bi-trophy style="font-size: 24px; margin-top: 8px" />
                                            @endif
                                        </div>
                                    </a>
                                    <h6 class="tournament__match__team__number">{{$pool->tatami_and_fight_number}}</h6>
                                    <a class="tournament__match__team" href="#">
                                        <h4>{{ $pool->opponent ? ($pool->opponent->club ?? $pool->opponent->trener->club) : null }}</h4>
                                        <div class="tournament__match__team__info">

                                            <p>{{ $pool->opponent ? $pool->opponent->first_name . ' ' . $pool->opponent->last_name : 'TBD' }}</p>
                                            @if($pool->winner_id != null && $pool->type == 'final' && $pool->opponent_id != $pool->winner_id)
                                                <span style="font-size: 24px; color: silver;">🥈</span>
                                            @endif
                                            @if($pool->winner_id != null && $pool->opponent_id === $pool->winner_id)
                                                <x-bi-trophy style="font-size: 24px; margin-top: 8px" />
                                            @endif

                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if($round == 4)
                        <div class="tournament__round tournament__round--final">
                            @foreach($poolsByList->where('round', $round) as $pool)
                                <div class="tournament__match" style="min-height: {{ $matchHeight }};">
                                    <a class="tournament__match__team" href="#">
                                        <h4>{{ $pool->student ? ($pool->student->club ?? $pool->student->trener->club) : null }}</h4>
                                        <div class="tournament__match__team__info">
                                            <p>{{ $pool->student ? $pool->student->first_name . ' ' . $pool->student->last_name : 'TBD' }}</p>
                                            @if($pool->winner_id != null && $pool->type == 'final' && $pool->student_id != $pool->winner_id)
                                                <span style="font-size: 24px; color: silver;">🥈</span>
                                            @endif
                                            @if($pool->winner_id != null && $pool->student_id === $pool->winner_id)
                                                <x-bi-trophy style="font-size: 24px; margin-top: 8px" />
                                            @endif
                                        </div>
                                    </a>
                                    <h6 class="tournament__match__team__number">{{$pool->tatami_and_fight_number}}</h6>
                                    <a class="tournament__match__team" href="#">
                                        <h4>{{ $pool->opponent ? ($pool->opponent->club ?? $pool->opponent->trener->club) : null }}</h4>
                                        <div class="tournament__match__team__info">

                                            <p>{{ $pool->opponent ? $pool->opponent->first_name . ' ' . $pool->opponent->last_name : 'TBD' }}</p>
                                            @if($pool->winner_id != null && $pool->type == 'final' && $pool->opponent_id != $pool->winner_id)
                                                <span style="font-size: 24px; color: silver;">🥈</span>
                                            @endif
                                            @if($pool->winner_id != null && $pool->opponent_id === $pool->winner_id)
                                                <x-bi-trophy style="font-size: 24px; margin-top: 8px" />
                                            @endif

                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if($round == 5)
                            <div class="tournament__match" style="min-height: {{ $matchHeight }};">
                                <a class="tournament__match__team" href="#">
                                    <h4>{{ $pool->student ? ($pool->student->club ?? $pool->student->trener->club) : null }}</h4>
                                    <div class="tournament__match__team__info">
                                        <p>{{ $pool->student ? $pool->student->first_name . ' ' . $pool->student->last_name : 'TBD' }}</p>
                                        @if($pool->winner_id != null && $pool->type == 'final' && $pool->student_id != $pool->winner_id)
                                            <span style="font-size: 24px; color: silver;">🥈</span>
                                        @endif
                                        @if($pool->winner_id != null && $pool->student_id === $pool->winner_id)
                                            <x-bi-trophy style="font-size: 24px; margin-top: 8px" />
                                        @endif
                                    </div>
                                </a>
                                <h6 class="tournament__match__team__number">{{$pool->tatami_and_fight_number}}</h6>
                                <a class="tournament__match__team" href="#">
                                    <h4>{{ $pool->opponent ? ($pool->opponent->club ?? $pool->opponent->trener->club) : null }}</h4>
                                    <div class="tournament__match__team__info">

                                        <p>{{ $pool->opponent ? $pool->opponent->first_name . ' ' . $pool->opponent->last_name : 'TBD' }}</p>
                                        @if($pool->winner_id != null && $pool->type == 'final' && $pool->opponent_id != $pool->winner_id)
                                            <span style="font-size: 24px; color: silver;">🥈</span>
                                        @endif
                                        @if($pool->winner_id != null && $pool->opponent_id === $pool->winner_id)
                                            <x-bi-trophy style="font-size: 24px; margin-top: 8px" />
                                        @endif

                                    </div>
                                </a>
                            </div>
                    @endif
                @endfor
                @if($tournament->fight_for_third_place)
                    @php
                        $thirdPlacePool = $poolsByList->where('type', '3rd')->first();
                                    $totalParticipants = $poolsByList->first()->listTournament->students->count();


      $topPosition = $totalParticipants <= 4 ? '240' :
                       ($totalParticipants <= 8 ? '480' :
                       ($totalParticipants <= 16 ? '500' : '495'));
        $rightPosition = $totalParticipants <= 4 ? '350' :
                         ($totalParticipants <= 8 ? '250' :
                         ($totalParticipants <= 16 ? '230' : '210'));
                    @endphp
                    @if($thirdPlacePool)
                        <div class="tournament__round third_place"
                             style="top: {{ $topPosition }}px; right: {{ $rightPosition }}px;">
                            <div class="tournament__match third_place__match">
                                <a class="tournament__match__team" href="#">
                                    <h4>{{ $thirdPlacePool->student ? ($thirdPlacePool->student->club ?? $thirdPlacePool->student->trener->club) : null }}</h4>
                                    <div class="tournament__match__team__info">
                                        <p>{{ $thirdPlacePool->student ? $thirdPlacePool->student->first_name . ' ' . $thirdPlacePool->student->last_name : 'TBD' }}</p>
                                        @if($thirdPlacePool->winner_id != null && $thirdPlacePool->type == '3rd' && $thirdPlacePool->student_id != $thirdPlacePool->winner_id)
                                            <span style="font-size: 24px; color: silver;">🥈</span>
                                        @endif

                                    </div>
                                </a>
                                <h6 class="tournament__match__team__number">{{$thirdPlacePool->tatami_and_fight_number}}</h6>
                                <a class="tournament__match__team" href="#">
                                    <h4>{{ $thirdPlacePool->opponent ? ($thirdPlacePool->opponent->club ?? $thirdPlacePool->opponent->trener->club) : null }}</h4>
                                    <div class="tournament__match__team__info">
                                        <p>{{ $thirdPlacePool->opponent ? $thirdPlacePool->opponent->first_name . ' ' . $thirdPlacePool->opponent->last_name : 'TBD' }}</p>
                                        @if($thirdPlacePool->winner_id != null && $thirdPlacePool->type == '3rd' && $thirdPlacePool->opponent_id != $thirdPlacePool->winner_id)
                                            <span style="font-size: 24px; color: silver;">🥈</span>
                                        @endif

                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="third_place_text" style="top: {{ $topPosition - 20 }}px; right: {{ $rightPosition - 20 }}px;">
                            <p>БОЙ ЗА 3 МЕСТО</p>
                        </div>
                    @endif
                @endif

                @php
                    $final = $poolsByList->where('type', 'final')->first();
                @endphp
                @if($final)
                <div class="tournament__round tournament__round--winner">
                    <div class="tournament__match">
                        <a class="tournament__match__team" href="#">
                            @if($final->winner_id == null)

                            @elseif($final->student_id == $final->winner_id)
                                <h4>{{$final->student->club ?? $final->student->trener->club}}</h4>
                            @elseif($final->opponent_id == $final->winner_id)
                                <h4>{{$final->opponent->club ?? $final->opponent->trener->club}}</h4>
                            @endif
                            <div class="tournament__match__team__info">
                                @if($final->winner_id == null)

                                @elseif($final->student_id == $final->winner_id)
                                    <p>{{$final->student->last_name}} {{$final->student->first_name}}</p>
                                    <p style="font-size: 24px; color: gold;">🥇</p>
                                @elseif($final->opponent_id == $final->winner_id)
                                    <p>{{$final->opponent->last_name}} {{$final->opponent->first_name}}</p>
                                    <span style="font-size: 24px; color: gold;">🥇</span>
                                @endif

                            </div>
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </page>
@endforeach
<style>
    @import url("https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap");
    @import url("https://fonts.googleapis.com/css2?family=Righteous&display=swap");

    @page {
        size: A4;
        margin: 0;
    }

    @media print {
        html,
        body {
            width: 210mm;
            height: 297mm;

        }

        /* ... the rest of the rules ... */
    }

    page[size="A4"] {
        background: white;
        width: 21cm;
        height: 29.7cm;
        display: block;
        margin: 0 auto;
        margin-bottom: 0.5cm;
        box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
    }

    @media print {
        body,
        page[size="A4"] {
            margin: 0;
            box-shadow: 0;
        }
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: #fff;
    }


    .tournament_name {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .tournament_name > h1 {
        font-size: 28px;
        text-align: center;
        font-family: "Urbanist", sans-serif;
        font-weight: 900;
    }

    .tournament_name > h2 {
        font-size: 20px;
        font-weight: 500;
        font-family: "Urbanist", sans-serif;
    }

    .tournament {
        position: relative;
        min-height: 300px;
    }

    .tournament__grid {
        font-size: 0;
        line-height: 0;
        display: flex;
        align-items: stretch;
        min-height: 400px;
        font-family: "Urbanist", sans-serif;
    }

    .tournament__round {
        position: relative;
        flex: 1 0;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .tournament__match {
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        flex: 1 0;
        align-items: center;
    }

    .tournament__match:first-child {
        margin: 0 !important;
    }

    .tournament__round--first-round .tournament__match {
        padding-left: 0;
    }

    .tournament__round--winner .tournament__match {
        padding-right: 0;
        height: 32px;
    }

    .tournament__match:after {
        content: "";
        position: absolute;
        right: 0;
        width: 2px;
        background: rgba(0, 0, 0, 0.2);
        top: 25%;
        bottom: 25%;
    }

    .tournament__round--winner .tournament__match:after,
    .tournament__round--end-point .tournament__match:after {
        display: none;
    }

    .tournament__match__team {
        font-size: 7px;
        font-weight: bold;
        transition: color 0.3s ease;
        color: #000;
        text-decoration: none;
        box-sizing: border-box;
        background: rgba(0, 0, 0, 0.2);
        display: block;
        position: relative;
        width: 120px;
        height: 21px;
        line-height: 22px;
        padding-left: 4px;
        margin: auto;
        display: flex;
    }

    .tournament__match__team > h4 {
        padding-top: 4px;
    }

    .tournament__match__team__info {
        position: absolute;
        display: flex;
        justify-content: space-between; /* Размещает текст слева, иконку справа */
        align-items: center; /* Центрирует по вертикали */
        top: -5px;
        left: 0; /* Растягивает контейнер с левого края */
        right: 0; /* До правого края */
        width: 100%; /* Занимает всю ширину */
        font-size: 8px;
    }


    .tournament__match__team__info > p:last-child {
        font-size: 8px;
        left: 15px;
    }

    .tournament__match__team__info > p:nth-child(2) {
        font-size: 8px;
    }

    .tournament__match__team__number {
        position: absolute;
        right: 2px;
        top: 50%;
        bottom: 50%;
        right: 10px;
        font-size: 12px;
        font-weight: 800;
        color: #000;
        background-color: red;
    }

    .tournament__match__team:before,
    .tournament__match__team:after {
        content: "";
        position: absolute;
        top: 50%;
        width: 999px;
        height: 2px;
        margin-top: -1px;
        background: rgba(0, 0, 0, 0.2);
    }

    .tournament__match__team:after {
        left: 100%;
    }

    .tournament__round:last-child .tournament__match__team:after,
    .tournament__round--end-point .tournament__match__team:after {
        display: none;
    }

    .tournament__match__team:before {
        right: 100%;
    }

    .tournament__round:first-child .tournament__match__team:before {
        display: none;
    }

    .third_place {
        position: absolute;
        right: 210px;
        top: 495px;
    }

    .third_place__match:after {
        display: none;
    }

    .third_place_text {
        position: absolute;
        top: 470px;
        right: 190px;
    }

    .third_place_text > p {
        color: #000;
        font-size: 20px !important;
        font-weight: 600;
    }

</style>
</body>

</html>
