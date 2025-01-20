<x-filament-panels::page class="scrollable-page">
    <div wire:ignore>
        @if ($tournament->pools->where('type', 'Round Robin')->count() > 0 && $tournament->organization_id == auth()->id())
            <button
                wire:click="mountAction('winnerForThreeStudents', { pools: {{ $tournament->pools }} })"
                class="mt-2 filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action">
                Выбрать победителя
            </button>
        @endif
        @if ($tournament->pools->where('winner_id', null)->count() === $tournament->pools->count()
&& $tournament->pools->where('type', '!=', 'Round Robin')->count() > 0 && $tournament->organization_id == auth()->id())
            <button
                wire:click="mountAction('swapParticipants', { pools: {{ $tournament->pools }} })"
                class="mt-2 filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action">
                Переместить участников
            </button>
        @endif
    </div>

    <page size="A4" wire:ignore>
        @php

            //                        $titleList = $poolsByList->first()->listTournament->templateStudentList->name ?? 'Default Title';
            //                        $totalParticipants = $poolsByList->first()->listTournament->students->count();
            //
            //                        // Определяем высоту в зависимости от количества участников
            //                        $matchHeight = $totalParticipants <= 8 ? '260px' : ($totalParticipants <= 16 ? '130px' : '64.3px');
        @endphp
        <div class="tournament" wire:ignore>
            <div class="tournament__grid" wire:ignore>
                @php
                    $maxRound = $tournament->pools
                        ->where('type', '!=', '3rd')
                        ->max('round');

                    $totalParticipants = $tournament->pools->first()->listTournament->students->count();
//dd($tournament->pools->first()->listTournament->templateStudentList);
//                    dd($tournament->pools->first()->listTournament->students);
                    // Определяем высоту в зависимости от количества участников
                    $matchHeight = $totalParticipants <= 8 ? '260px' : ($totalParticipants <= 16 ? '130px' : '64.3px');

                @endphp
                @for ($round = 1; $round <= $maxRound; $round++)
                    @if($round == 1)
                        <div class="tournament__round tournament__round--first-round">
                            @foreach($tournament->pools->where('round', $round) as $pool)
                                @php
                                    $isClickable = $pool->student && $pool->opponent && $tournament->organization_id == auth()->id();
                                @endphp
                                <div class="tournament__match" style="min-height: {{ $matchHeight }};">
                                    <a class="tournament__match__team" href="#"
                                       @if($isClickable) wire:click.prevent="mountAction('winner', { id: {{ $pool->id }} })" @endif
                                    >
                                        <h4>{{ $pool->student ? $pool->student?->trener?->club : null }}</h4>
                                        <div class="tournament__match__team__info">
                                            <p>{{ $pool->student ? $pool->student->last_name . ' ' . $pool->student->first_name : 'TBD' }}</p>
                                            @if($pool->winner_id != null && $pool->type == 'final' && $pool->student_id != $pool->winner_id)
                                                <span style="font-size: 24px; color: silver;">🥈</span>
                                            @endif
                                            @if($pool->type == 'Round Robin')
                                                @if($pool->winner_id_1rd_robbin != null && $pool->student_id == $pool->winner_id_1rd_robbin)
                                                    <span style="font-size: 20px; color: gold;">🥇</span>
                                                @elseif($pool->winner_id_2rd_robbin != null && $pool->student_id == $pool->winner_id_2rd_robbin)
                                                    <span style="font-size: 20px; color: silver;">🥈</span>
                                                @elseif($pool->winner_id_3rd_robbin != null && $pool->student_id == $pool->winner_id_3rd_robbin)
                                                    <span style="font-size: 20px; color: #cd7f32;">🥉</span>
                                                @endif
                                            @endif
                                            @if($pool->winner_id != null && $pool->student_id === $pool->winner_id)
                                                <x-bi-trophy style="font-size: 24px; margin-top: 8px"/>
                                            @endif
                                        </div>
                                    </a>
                                    <input type="text" wire:model.live="tatami_and_fight_number.{{ $pool->id }}"
                                           class="tournament__match__team__number"
                                           placeholder="0"
                                           @if($tournament->organization_id != auth()->id()) disabled @endif
                                    >
                                    <a class="tournament__match__team" href="#"
                                       @if($isClickable) wire:click.prevent="mountAction('winner', { id: {{ $pool->id }} })" @endif
                                    >
                                        <h4>{{ $pool->opponent ? $pool->opponent?->trener?->club : null }}</h4>
                                        <div class="tournament__match__team__info">

                                            <p>{{ $pool->opponent ? $pool->opponent->last_name . ' ' . $pool->opponent->first_name : 'TBD' }}</p>
                                            @if($pool->winner_id != null && $pool->type == 'final' && $pool->opponent_id != $pool->winner_id)
                                                <span style="font-size: 24px; color: silver;">🥈</span>
                                            @endif
                                            @if($pool->type == 'Round Robin')
                                                @if($pool->winner_id_1rd_robbin != null && $pool->opponent_id == $pool->winner_id_1rd_robbin)
                                                    <span style="font-size: 20px; color: gold;">🥇</span>
                                                @elseif($pool->winner_id_2rd_robbin != null && $pool->opponent_id == $pool->winner_id_2rd_robbin)
                                                    <span style="font-size: 20px; color: silver;">🥈</span>
                                                @elseif($pool->winner_id_3rd_robbin != null && $pool->opponent_id == $pool->winner_id_3rd_robbin)
                                                    <span style="font-size: 20px; color: #cd7f32;">🥉</span>
                                                @endif
                                            @endif
                                            @if($pool->winner_id != null && $pool->opponent_id === $pool->winner_id)
                                                <x-bi-trophy style="font-size: 24px; margin-top: 8px"/>
                                            @endif

                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if($round == 2)
                        <div class="tournament__round tournament__round--first-round">
                            @foreach($tournament->pools->where('round', $round) as $pool)
                                @php
                                    $isClickable = $pool->student && $pool->opponent && $tournament->organization_id == auth()->id();
                                @endphp
                                <div class="tournament__match" style="min-height: {{ $matchHeight }};">
                                    <a class="tournament__match__team" href="#"
                                       @if($isClickable) wire:click.prevent="mountAction('winner', { id: {{ $pool->id }} })" @endif
                                    >
                                        <h4>{{ $pool->student ? $pool->student?->trener?->club : null }}</h4>
                                        <div class="tournament__match__team__info">
                                            <p>{{ $pool->student ? $pool->student->last_name . ' ' . $pool->student->first_name : 'TBD' }}</p>
                                            @if($pool->winner_id != null && $pool->type == 'final' && $pool->student_id != $pool->winner_id)
                                                <span style="font-size: 24px; color: silver;">🥈</span>
                                            @endif
                                            @if($pool->type == 'Round Robin')
                                                @if($pool->student_id == $pool->winner_id_1rd_robbin)
                                                    <span style="font-size: 20px; color: gold;">🥇</span>
                                                @elseif($pool->student_id == $pool->winner_id_2rd_robbin)
                                                    <span style="font-size: 20px; color: silver;">🥈</span>
                                                @elseif($pool->student_id == $pool->winner_id_3rd_robbin)
                                                    <span style="font-size: 20px; color: #cd7f32;">🥉</span>
                                                @endif
                                            @endif
                                            @if($pool->winner_id != null && $pool->student_id === $pool->winner_id)
                                                <x-bi-trophy style="font-size: 24px; margin-top: 8px"/>
                                            @endif
                                        </div>
                                    </a>
                                    <input type="text" wire:model.live="tatami_and_fight_number.{{ $pool->id }}"
                                           class="tournament__match__team__number"
                                           placeholder="0"
                                           @if($tournament->organization_id != auth()->id()) disabled @endif
                                    >
                                    <a class="tournament__match__team" href="#"
                                       @if($isClickable) wire:click.prevent="mountAction('winner', { id: {{ $pool->id }} })" @endif
                                    >
                                        <h4>{{ $pool->opponent ? $pool->opponent?->trener?->club : null }}</h4>
                                        <div class="tournament__match__team__info">

                                            <p>{{ $pool->opponent ? $pool->opponent->last_name . ' ' . $pool->opponent->first_name : 'TBD' }}</p>
                                            @if($pool->winner_id != null && $pool->type == 'final' && $pool->opponent_id != $pool->winner_id)
                                                <span style="font-size: 24px; color: silver;">🥈</span>
                                            @endif
                                            @if($pool->type == 'Round Robin')
                                                @if($pool->opponent_id == $pool->winner_id_1rd_robbin)
                                                    <span style="font-size: 20px; color: gold;">🥇</span>
                                                @elseif($pool->opponent_id == $pool->winner_id_2rd_robbin)
                                                    <span style="font-size: 20px; color: silver;">🥈</span>
                                                @elseif($pool->opponent_id == $pool->winner_id_3rd_robbin)
                                                    <span style="font-size: 20px; color: #cd7f32;">🥉</span>
                                                @endif
                                            @endif
                                            @if($pool->winner_id != null && $pool->opponent_id === $pool->winner_id)
                                                <x-bi-trophy style="font-size: 24px; margin-top: 8px"/>
                                            @endif

                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if($round == 3)
                        <div class="tournament__round">
                            @foreach($tournament->pools->where('round', $round) as $pool)
                                @php
                                    $isClickable = $pool->student && $pool->opponent && $tournament->organization_id == auth()->id();
                                @endphp
                                <div class="tournament__match" style="min-height: {{ $matchHeight }};">
                                    <a class="tournament__match__team" href="#"
                                       @if($isClickable) wire:click.prevent="mountAction('winner', { id: {{ $pool->id }} })" @endif
                                    >
                                        <h4>{{ $pool->student ? $pool->student?->trener?->club : null }}</h4>
                                        <div class="tournament__match__team__info">
                                            <p>{{ $pool->student ? $pool->student->last_name . ' ' . $pool->student->first_name : 'TBD' }}</p>
                                            @if($pool->winner_id != null && $pool->type == 'final' && $pool->student_id != $pool->winner_id)
                                                <span style="font-size: 24px; color: silver;">🥈</span>
                                            @endif
                                            @if($pool->type == 'Round Robin')
                                                @if($pool->student_id == $pool->winner_id_1rd_robbin)
                                                    <span style="font-size: 20px; color: gold;">🥇</span>
                                                @elseif($pool->student_id == $pool->winner_id_2rd_robbin)
                                                    <span style="font-size: 20px; color: silver;">🥈</span>
                                                @elseif($pool->student_id == $pool->winner_id_3rd_robbin)
                                                    <span style="font-size: 20px; color: #cd7f32;">🥉</span>
                                                @endif
                                            @endif
                                            @if($pool->winner_id != null && $pool->student_id === $pool->winner_id)
                                                <x-bi-trophy style="font-size: 24px; margin-top: 8px"/>
                                            @endif
                                        </div>
                                    </a>
                                    <input type="text" wire:model.live="tatami_and_fight_number.{{ $pool->id }}"
                                           class="tournament__match__team__number"
                                           placeholder="0"
                                           @if($tournament->organization_id != auth()->id()) disabled @endif
                                    >
                                    <a class="tournament__match__team" href="#"
                                       @if($isClickable) wire:click.prevent="mountAction('winner', { id: {{ $pool->id }} })" @endif
                                    >
                                        <h4>{{ $pool->opponent ? $pool->opponent?->trener?->club : null }}</h4>
                                        <div class="tournament__match__team__info">

                                            <p>{{ $pool->opponent ? $pool->opponent->last_name . ' ' . $pool->opponent->first_name : 'TBD' }}</p>
                                            @if($pool->winner_id != null && $pool->type == 'final' && $pool->opponent_id != $pool->winner_id)
                                                <span style="font-size: 24px; color: silver;">🥈</span>
                                            @endif
                                            @if($pool->type == 'Round Robin')
                                                @if($pool->opponent_id == $pool->winner_id_1rd_robbin)
                                                    <span style="font-size: 20px; color: gold;">🥇</span>
                                                @elseif($pool->opponent_id == $pool->winner_id_2rd_robbin)
                                                    <span style="font-size: 20px; color: silver;">🥈</span>
                                                @elseif($pool->opponent_id == $pool->winner_id_3rd_robbin)
                                                    <span style="font-size: 20px; color: #cd7f32;">🥉</span>
                                                @endif
                                            @endif
                                            @if($pool->winner_id != null && $pool->opponent_id === $pool->winner_id)
                                                <x-bi-trophy style="font-size: 24px; margin-top: 8px"/>
                                            @endif

                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if($round == 4)
                        <div class="tournament__round tournament__round--final">
                            @foreach($tournament->pools->where('round', $round) as $pool)
                                @php
                                    $isClickable = $pool->student && $pool->opponent && $tournament->organization_id == auth()->id();
                                @endphp
                                <div class="tournament__match" style="min-height: {{ $matchHeight }};">
                                    <a class="tournament__match__team" href="#"
                                       @if($isClickable) wire:click.prevent="mountAction('winner', { id: {{ $pool->id }} })" @endif
                                    >
                                        <h4>{{ $pool->student ? $pool->student?->trener?->club : null }}</h4>
                                        <div class="tournament__match__team__info">
                                            <p>{{ $pool->student ? $pool->student->last_name . ' ' . $pool->student->first_name : 'TBD' }}</p>
                                            @if($pool->winner_id != null && $pool->type == 'final' && $pool->student_id != $pool->winner_id)
                                                <span style="font-size: 24px; color: silver;">🥈</span>
                                            @endif
                                            @if($pool->type == 'Round Robin')
                                                @if($pool->student_id == $pool->winner_id_1rd_robbin)
                                                    <span style="font-size: 20px; color: gold;">🥇</span>
                                                @elseif($pool->student_id == $pool->winner_id_2rd_robbin)
                                                    <span style="font-size: 20px; color: silver;">🥈</span>
                                                @elseif($pool->student_id == $pool->winner_id_3rd_robbin)
                                                    <span style="font-size: 20px; color: #cd7f32;">🥉</span>
                                                @endif
                                            @endif
                                            @if($pool->winner_id != null && $pool->student_id === $pool->winner_id)
                                                <x-bi-trophy style="font-size: 24px; margin-top: 8px"/>
                                            @endif
                                        </div>
                                    </a>
                                    <input type="text" wire:model.live="tatami_and_fight_number.{{ $pool->id }}"
                                           class="tournament__match__team__number"
                                           placeholder="0"
                                           @if($tournament->organization_id != auth()->id()) disabled @endif
                                    >
                                    <a class="tournament__match__team" href="#"
                                       @if($isClickable) wire:click.prevent="mountAction('winner', { id: {{ $pool->id }} })" @endif
                                    >
                                        <h4>{{ $pool->opponent ? $pool->opponent?->trener?->club : null }}</h4>
                                        <div class="tournament__match__team__info">

                                            <p>{{ $pool->opponent ? $pool->opponent->last_name . ' ' . $pool->opponent->first_name : 'TBD' }}</p>
                                            @if($pool->winner_id != null && $pool->type == 'final' && $pool->opponent_id != $pool->winner_id)
                                                <span style="font-size: 24px; color: silver;">🥈</span>
                                            @endif
                                            @if($pool->type == 'Round Robin')
                                                @if($pool->opponent_id == $pool->winner_id_1rd_robbin)
                                                    <span style="font-size: 20px; color: gold;">🥇</span>
                                                @elseif($pool->opponent_id == $pool->winner_id_2rd_robbin)
                                                    <span style="font-size: 20px; color: silver;">🥈</span>
                                                @elseif($pool->opponent_id == $pool->winner_id_3rd_robbin)
                                                    <span style="font-size: 20px; color: #cd7f32;">🥉</span>
                                                @endif
                                            @endif
                                            @if($pool->winner_id != null && $pool->opponent_id === $pool->winner_id)
                                                <x-bi-trophy style="font-size: 24px; margin-top: 8px"/>
                                            @endif

                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if($round == 5)
                        @php
                            $isClickable = $pool->student && $pool->opponent && $tournament->organization_id == auth()->id();
                        @endphp
                        <div class="tournament__match" style="min-height: {{ $matchHeight }};">
                            <a class="tournament__match__team" href="#"
                               @if($isClickable) wire:click.prevent="mountAction('winner', { id: {{ $pool->id }} })" @endif
                            >
                                <h4>{{ $pool->student ? $pool->student?->trener?->club : null }}</h4>
                                <div class="tournament__match__team__info">
                                    <p>{{ $pool->student ? $pool->student->last_name . ' ' . $pool->student->first_name : 'TBD' }}</p>
                                    @if($pool->winner_id != null && $pool->type == 'final' && $pool->student_id != $pool->winner_id)
                                        <span style="font-size: 24px; color: silver;">🥈</span>
                                    @endif
                                    @if($pool->type == 'Round Robin')
                                        @if($pool->student_id == $pool->winner_id_1rd_robbin)
                                            <span style="font-size: 20px; color: gold;">🥇</span>
                                        @elseif($pool->student_id == $pool->winner_id_2rd_robbin)
                                            <span style="font-size: 20px; color: silver;">🥈</span>
                                        @elseif($pool->student_id == $pool->winner_id_3rd_robbin)
                                            <span style="font-size: 20px; color: #cd7f32;">🥉</span>
                                        @endif
                                    @endif
                                    @if($pool->winner_id != null && $pool->student_id === $pool->winner_id)
                                        <x-bi-trophy style="font-size: 24px; margin-top: 8px"/>
                                    @endif
                                </div>
                            </a>
                            <input type="text" wire:model.live="tatami_and_fight_number.{{ $pool->id }}"
                                   class="tournament__match__team__number"
                                   placeholder="0"
                                   @if($tournament->organization_id != auth()->id()) disabled @endif
                            >
                            <a class="tournament__match__team" href="#"
                               @if($isClickable) wire:click.prevent="mountAction('winner', { id: {{ $pool->id }} })" @endif
                            >
                                <h4>{{ $pool->opponent ? $pool->opponent?->trener?->club : null }}</h4>
                                <div class="tournament__match__team__info">

                                    <p>{{ $pool->opponent ? $pool->opponent->last_name . ' ' . $pool->opponent->first_name : 'TBD' }}</p>
                                    @if($pool->winner_id != null && $pool->type == 'final' && $pool->opponent_id != $pool->winner_id)
                                        <span style="font-size: 24px; color: silver;">🥈</span>
                                    @endif
                                    @if($pool->type == 'Round Robin')
                                        @if($pool->opponent_id == $pool->winner_id_1rd_robbin)
                                            <span style="font-size: 20px; color: gold;">🥇</span>
                                        @elseif($pool->opponent_id == $pool->winner_id_2rd_robbin)
                                            <span style="font-size: 20px; color: silver;">🥈</span>
                                        @elseif($pool->opponent_id == $pool->winner_id_3rd_robbin)
                                            <span style="font-size: 20px; color: #cd7f32;">🥉</span>
                                        @endif
                                    @endif
                                    @if($pool->winner_id != null && $pool->opponent_id === $pool->winner_id)
                                        <x-bi-trophy style="font-size: 24px; margin-top: 8px"/>
                                    @endif

                                </div>
                            </a>
                        </div>
                    @endif
                @endfor
                @if($tournament->fight_for_third_place)
                    @php
                        $thirdPlacePool = $tournament->pools->where('type', '3rd')->first();
                                    $totalParticipants = $tournament->pools->first()->listTournament->students->count();


      $topPosition = $totalParticipants <= 4 ? '230' :
                       ($totalParticipants <= 8 ? '490' :
                       ($totalParticipants <= 16 ? '490' : '495'));
        $rightPosition = $totalParticipants <= 4 ? '350' :
                         ($totalParticipants <= 8 ? '350' :
                         ($totalParticipants <= 16 ? '260' : '210'));
                    @endphp
                    @if($thirdPlacePool)
                        @php
                            // Проверка, есть ли оба участника в бою за 3 место
                            $isClickable = $thirdPlacePool->student && $thirdPlacePool->opponent && $tournament->organization_id == auth()->id();
                        @endphp
                        <div class="tournament__round third_place"
                             style="top: {{ $topPosition }}px; right: {{ $rightPosition }}px;">
                            <div class="tournament__match third_place__match">
                                <a class="tournament__match__team" href="#"
                                   @if($isClickable) wire:click.prevent="mountAction('winner', { id: {{ $thirdPlacePool->id }} })" @endif>
                                    <h4>{{ $thirdPlacePool->student ? $thirdPlacePool->student->trener->club : null }}</h4>
                                    <div class="tournament__match__team__info">
                                        <p>{{ $thirdPlacePool->student ? $thirdPlacePool->student->last_name . ' ' . $thirdPlacePool->student->first_name : 'TBD' }}</p>
                                        @if($thirdPlacePool->winner_id != null && $thirdPlacePool->type == '3rd' && $thirdPlacePool->student_id == $thirdPlacePool->winner_id)
                                            <span style="font-size: 24px; color: silver;">🥉</span>
                                        @endif

                                    </div>
                                </a>
                                <input type="text" wire:model.live="tatami_and_fight_number.{{ $thirdPlacePool->id }}"
                                       class="tournament__match__team__number"
                                       placeholder="0"
                                       @if($tournament->organization_id != auth()->id()) disabled @endif
                                >
                                <a class="tournament__match__team" href="#"
                                   @if($isClickable) wire:click.prevent="mountAction('winner', { id: {{ $thirdPlacePool->id }} })" @endif>
                                    <h4>{{ $thirdPlacePool->opponent ? $thirdPlacePool->opponent->trener->club : null }}</h4>
                                    <div class="tournament__match__team__info">
                                        <p>{{ $thirdPlacePool->opponent ? $thirdPlacePool->opponent->last_name . ' ' . $thirdPlacePool->opponent->first_name : 'TBD' }}</p>
                                        @if($thirdPlacePool->winner_id != null && $thirdPlacePool->type == '3rd' && $thirdPlacePool->opponent_id == $thirdPlacePool->winner_id)
                                            <span style="font-size: 24px; color: silver;">🥉</span>
                                        @endif

                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="third_place_text"
                             style="top: {{ $topPosition - 20 }}px; right: {{ $rightPosition - 20 }}px;">
                            <p>БОЙ ЗА 3 МЕСТО</p>
                        </div>
                    @endif
                @endif

                @php
                    $final = $tournament->pools->where('type', 'final')->first();
                    $firstRoundRobinPool = $tournament->pools->firstWhere('type', 'Round Robin');
                @endphp


                @if($final)
                    <div class="tournament__round tournament__round--winner">
                        <div class="tournament__match">
                            <a class="tournament__match__team" href="#">
                                @if($final->winner_id == null)
                                @elseif($final->student_id == $final->winner_id)
                                    <h4>{{$final->student->trener->club}}</h4>
                                @elseif($final->opponent_id == $final->winner_id)
                                    <h4>{{$final->opponent->trener->club}}</h4>
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
                @elseif($firstRoundRobinPool)
                    <div class="tournament__round tournament__round--winner">
                        <div class="tournament__match">
                            <a class="tournament__match__team" href="#">
                                @if($firstRoundRobinPool->winner_id_1rd_robbin == null)
                                @elseif($firstRoundRobinPool->student_id == $firstRoundRobinPool->winner_id_1rd_robbin)
                                    <h4>{{$firstRoundRobinPool->student->trener->club}}</h4>
                                @elseif($firstRoundRobinPool->opponent_id == $firstRoundRobinPool->winner_id_1rd_robbin)
                                    <h4>{{$firstRoundRobinPool->opponent->trener->club}}</h4>
                                @endif
                                <div class="tournament__match__team__info">
                                    @if($firstRoundRobinPool->winner_id == null)
                                    @elseif($firstRoundRobinPool->student_id == $firstRoundRobinPool->winner_id_1rd_robbin)
                                        <p>{{$firstRoundRobinPool->student->last_name}} {{$firstRoundRobinPool->student->first_name}}</p>
                                        <p style="font-size: 24px; color: gold;">🥇</p>
                                    @elseif($firstRoundRobinPool->opponent_id == $firstRoundRobinPool->winner_id_1rd_robbin)
                                        <p>{{$firstRoundRobinPool->opponent->last_name}} {{$firstRoundRobinPool->opponent->first_name}}</p>
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
            /*background: white;*/
            width: 21cm;
            height: 29.7cm;
            display: block;
            /*margin: 0 auto;*/
            margin-bottom: 0.5cm;
            /*box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);*/
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

        .scrollable-page {
            display: flex; /* Используем flexbox */
            overflow-x: auto; /* Разрешаем горизонтальный скролл */
            white-space: nowrap; /* Отключаем перенос строк */
            width: 100%; /* Ширина блока */
        }

        .scrollable-page > * {
            flex: 0 0 auto; /* Элементы не будут растягиваться */
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
            min-height: 64.3px;
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
            width: 60px;
            margin-top: -10px;
            right: 2px;
             /*margin-bottom: 30px;*/
            top: 50%;
            bottom: 50%;
            right: 10px;
            font-size: 12px;
            font-weight: 800;
            color: #000;
            /* background-color: red; */
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

</x-filament-panels::page>
