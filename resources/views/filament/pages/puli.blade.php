<x-filament-panels::page>

    <div class="theme theme-dark">
{{--        <button type="submit"--}}
{{--                wire:click="toggleSwapping"--}}
{{--                class="mt-2 filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action">--}}
{{--            Переместить участников--}}
{{--        </button>--}}
        <div class="bracket disable-image" >

            @php
                // Определяем максимальный номер раунда, исключая бои за третье место
                $maxRound = $tournament->pools
                    ->where('type', '!=', '3rd')
                    ->max('round');
            @endphp


                <!-- Цикл по каждому раунду от 1 до максимального -->
            @for ($round = 1; $round <= $maxRound; $round++)
                <div class="column round-{{ $round }}" >
                    <!-- Фильтрация пула для текущего раунда и исключение боев за третье место -->
                    @foreach($tournament->pools->where('round', $round) as $pool)
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

                                <span class="score" style="{{ $pool->type == 'final' ? ($pool->student_id == $pool->winner_id ? 'color: gold;' : 'color: silver;') : '' }}">
                                @if($pool->student_id == $pool->winner_id || ($pool->type == 'final' && $pool->opponent_id == $pool->winner_id))
                                    <x-bi-trophy/>
                                @endif
                                </span>

                            </div>
                            @if($isSwapping)
                                <input type="checkbox" wire:model="selectedIds" value="{{ $pool->student_id }}" />
                            @endif
                            <div class="match-bottom team">
                                <span class="image"></span>
                                <span class="seed"> </span>
                                <span class="name">
                                {{ $pool->opponent ? $pool->opponent->first_name . ' ' . $pool->opponent->last_name : 'TBD' }}<br>
                                {{ $pool->opponent ? ($pool->opponent->club ?? $pool->opponent->trener->club) : null }}
                                </span>

                                <span class="score" style="{{ $pool->type == 'final' ? ($pool->opponent_id == $pool->winner_id ? 'color: gold;' : 'color: silver;') : '' }}">
                                @if($pool->opponent_id == $pool->winner_id || ($pool->type == 'final' && $pool->student_id == $pool->winner_id))
                                    <x-bi-trophy/>
                                @endif
                                </span>

                            </div>
                            @if($isSwapping)
                                <input type="checkbox" wire:model="selectedIds" value="{{ $pool->opponent_id }}" />
                            @endif
                            <div class="match-lines">
                                <div class="line one"></div>
                                <div class="line two"></div>
                            </div>
                            <div class="match-lines alt">
                                <div class="line one"></div>
                            </div>
                        </div>

                    @endforeach
                </div>
            @endfor


        </div>


        <!-- Блок для боя за третье место -->
        @if($tournament->fight_for_third_place && $maxRound > 1)
            <div class="third-place-container" wire:ignore>
                <h3 class="third-place-title">Бой за 3 место</h3>

                @php
                    // Получаем бой за третье место, где type == '3rd'
                    $thirdPlacePool = $tournament->pools->where('type', '3rd')->first();
                @endphp

                @if($thirdPlacePool)
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
                            <span class="score" style="{{ $thirdPlacePool->type == '3rd' ? 'color: #cd7f32;' : '' }}">
                        @if($thirdPlacePool->opponent_id == $thirdPlacePool->winner_id)
                                    <x-bi-trophy/>
                                @endif
                    </span>
                        </div>
                    </div>
                @else
                    <p>Бой за третье место не найден.</p>
                @endif
            </div>
        @endif



    </div>

    <style>
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
            height: 62px;
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

</x-filament-panels::page>
