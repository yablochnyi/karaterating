<x-filament-panels::page>
{{--    @php--}}
{{--        //    use Xoco70\LaravelTournaments\TreeGen\CreateSingleEliminationTree;--}}

{{--            use Xoco70\LaravelTournaments\TreeGen\CreateSingleEliminationTree;$singleEliminationTree = $championship->fightersGroups->where('round', '>=', $hasPreliminary + 1)->groupBy('round');--}}
{{--            if (sizeof($singleEliminationTree) > 0) {--}}
{{--            $treeGen = new CreateSingleEliminationTree($singleEliminationTree, $championship, $hasPreliminary);--}}
{{--            $treeGen->build();--}}
{{--            $match = [];--}}
{{--            //    dd($treeGen->brackets);--}}
{{--            }--}}
{{--    @endphp--}}
{{--    @if (sizeof($singleEliminationTree)>0)--}}

        @if (Request::is('championships/'.$championship->id.'/pdf'))
            <h1> {{$championship->buildName()}}</h1>
        @endif
        <form method="POST" action="{{ route('tree.update', ['championship' => $championship->id])}}"
              accept-charset="UTF-8">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" id="activeTreeTab" name="activeTreeTab" value="{{$championship->id}}"/>
            {{  $treeGen->printRoundTitles() }}

            <div id="brackets-wrapper"
                 style="padding-bottom: {{ ($championship->groupsByRound(1)->count() / 2 * 205) }}px">
                <!-- 205 px x 2 groups of 2-->
                @foreach ($treeGen->brackets as $roundNumber => $round)
                    @foreach ($round as $matchNumber => $match)
                        @include('laravel-tournaments::partials.tree.brackets.fight')

                        @if ($roundNumber != $treeGen->noRounds)
                            <div class="vertical-connector"
                                 style="top: {{  $match['vConnectorTop']  }}px; left: {{  $match['vConnectorLeft']  }}px; height: {{  $match['vConnectorHeight']  }}px;"></div>
                            <div class="horizontal-connector"
                                 style="top: {{  $match['hConnectorTop']  }}px; left: {{  $match['hConnectorLeft']  }}px;"></div>
                            <div class="horizontal-connector"
                                 style="top: {{  $match['hConnector2Top']  }}px; left: {{  $match['hConnector2Left']  }}px;"></div>
                        @endif
                    @endforeach
                @endforeach
            </div>



            <div class="clearfix"></div>
            <div align="right">
                <button type="submit" class="btn btn-success" id="update">
                    Update Tree
                </button>
            </div>


        </form>
        <style>

            label, form input[type=text], input[type=submit], textarea {
                float: left;
                clear: both;
            }


            textarea {
                height: 250px;
                font-family: arial, sans-serif;
            }

            input[type=submit] {
                background-color: #a2c257;
                border-color: #8ba446;
                color: white;
                cursor: pointer;
                margin: 0;
                width: 500px;
            }

            input:focus, textarea:focus {
                border-color: black;
            }

            .radio-label {
                margin-bottom: 20px;
            }

            #or {
                float: left;
                clear: both;
                width: 100%;
                text-align: center;
                font-weight: bold;
                margin-bottom: 20px;
            }

            #brackets-wrapper, #round-titles-wrapper {
                position: relative;
                margin-top: 20px;
                float: left;
            }

            #brackets-wrapper {
                top: 70px;
            }

            .round-title {
                height: 30px;
                text-align: center;
                line-height: 30px;
            }

            .round-title, .match-wrapper {
                border: 1px solid #cdc9c9;
                box-sizing: border-box;
                position: absolute;
                width: 150px;
                background-color: #f5f5f5;
            }

            .match-divider {
                width: 100%;
                float: left;
                border-top: 1px solid #cdc9c9;
            }

            .horizontal-connector, .vertical-connector {
                position: absolute;
            }

            .vertical-connector {
                border-left: 3px solid #cdc9c9;
                width: 3px;
            }

            .horizontal-connector {
                border-top: 3px solid #cdc9c9;
                width: 20px;
            }

            .player-wrapper {
                background-color: #f5f5f5;
                box-sizing: border-box;
                padding-left: 5px;
                width: 80%;
            }

            .score {
                background-color: #f0f0f0;
                box-sizing: border-box;
                text-align: center;
                width: 20%;
                border: 0;
                font-size: 16px;
                font-family: arial, sans-serif;
            }

            .player-wrapper, .score {
                float: right !important;
                height: 30px;
                line-height: 30px;
                overflow: hidden;
            }

            #version {
                color: #404040;
                width: 488px;
                text-align: center;
                margin-left: 20px;
            }

            .singleElimination_select {
                border: 0 none;
                height: 30px;
                width: 80%;
                background-color: #f5f5f5;
                -webkit-appearance: none;
                -moz-appearance: none;
                text-indent: 1px;
                text-overflow: '';
                font-size: 16px;
                font-family: arial, sans-serif;
            }

            .preliminary_select {
                border: 1px solid #cdc9c9;
                height: 30px;
                width: 100%;
                background-color: #f5f5f5;
                -webkit-appearance: none;
                -moz-appearance: none;
                text-indent: 1px;
                text-overflow: '';
                font-size: 16px;
                font-family: arial, sans-serif;
            }

            select::-ms-expand {
                display: none;
            }

            @media print {
                form, h1, #version {
                    display: none;
                }

                .round-title, .match-wrapper, .player-wrapper {
                    border-color: black;
                }

                .match-divider, .vertical-connector, .horizontal-connector, select {
                    border-color: black;
                }
            }

            #success {
                background-color: #DFF2BF;
            }

            .p-10 {
                padding: 10px;
            }

            .bg-grey {
                background-color: #EEE;
            }
        </style>
        {{--    <div class="theme theme-dark">--}}
        {{--        <div class="bracket disable-image">--}}
        {{--            <div class="column one">--}}
        {{--                @foreach($tournament->pools as $pool)--}}
        {{--                    <div class="match {{ $pool->winner_id ? ($pool->student_id == $pool->winner_id ? 'winner-top' : 'winner-bottom') : '' }}" wire:click="mountAction('winner', { id: {{ $pool->id }} })" style="cursor: pointer">--}}
        {{--                        <div class="match-top team" >--}}
        {{--                            <span class="image"></span>--}}
        {{--                            <span class="seed">1</span>--}}
        {{--                            <span class="name">{{$pool->student->first_name . ' ' . $pool->student->last_name}}</span>--}}
        {{--                            <span class="score">@if($pool->student_id == $pool->winner_id) <x-bi-trophy />@endif </span>--}}
        {{--                        </div>--}}
        {{--                        <div class="match-bottom team">--}}
        {{--                            <span class="image"></span>--}}
        {{--                            <span class="seed">8</span>--}}
        {{--                            <span class="name">{{$pool->opponent->first_name . ' ' . $pool->opponent->last_name}}</span>--}}
        {{--                            <span class="score">@if($pool->opponent_id == $pool->winner_id) <x-bi-trophy />@endif </span>--}}
        {{--                        </div>--}}
        {{--                        <div class="match-lines">--}}
        {{--                            <div class="line one"></div>--}}
        {{--                            <div class="line two"></div>--}}
        {{--                        </div>--}}
        {{--                        <div class="match-lines alt">--}}
        {{--                            <div class="line one"></div>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                @endforeach--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--    </div>--}}

        {{--    <style>--}}
        {{--        .theme {--}}
        {{--            /*height: 100%;*/--}}
        {{--            /*width: 100%;*/--}}
        {{--            position: absolute;--}}
        {{--        }--}}
        {{--        /*.bracket {*/--}}
        {{--        /*    padding: 40px;*/--}}
        {{--        /*    margin: 5px;*/--}}
        {{--        /*}*/--}}
        {{--        .bracket {--}}
        {{--            display: flex;--}}
        {{--            flex-direction: row;--}}
        {{--            position: relative;--}}
        {{--        }--}}
        {{--        .column {--}}
        {{--            display: flex;--}}
        {{--            flex-direction: column;--}}
        {{--            min-height: 100%;--}}
        {{--            justify-content: space-around;--}}
        {{--            align-content: center;--}}
        {{--        }--}}
        {{--        .match {--}}
        {{--            position: relative;--}}
        {{--            display: flex;--}}
        {{--            flex-direction: column;--}}
        {{--            min-width: 240px;--}}
        {{--            max-width: 240px;--}}
        {{--            height: 62px;--}}
        {{--            margin: 12px 24px 12px 0;--}}
        {{--        }--}}
        {{--        .match .match-top {--}}
        {{--            border-radius: 2px 2px 0 0;--}}
        {{--        }--}}
        {{--        .match .match-bottom {--}}
        {{--            border-radius: 0 0 2px 2px;--}}
        {{--        }--}}
        {{--        .match .team {--}}
        {{--            display: flex;--}}
        {{--            align-items: center;--}}
        {{--            width: 100%;--}}
        {{--            height: 100%;--}}
        {{--            border: 1px solid black;--}}
        {{--            position: relative;--}}
        {{--        }--}}
        {{--        .match .team span {--}}
        {{--            padding-left: 8px;--}}
        {{--        }--}}
        {{--        .match .team span:last-child {--}}
        {{--            padding-right: 8px;--}}
        {{--        }--}}
        {{--        .match .team .score {--}}
        {{--            margin-left: auto;--}}
        {{--        }--}}
        {{--        .match .team:first-child {--}}
        {{--            margin-bottom: -1px;--}}
        {{--        }--}}
        {{--        .match-lines {--}}
        {{--            display: block;--}}
        {{--            position: absolute;--}}
        {{--            top: 50%;--}}
        {{--            bottom: 0;--}}
        {{--            margin-top: 0px;--}}
        {{--            right: -1px;--}}
        {{--        }--}}
        {{--        .match-lines .line {--}}
        {{--            background: red;--}}
        {{--            position: absolute;--}}
        {{--        }--}}
        {{--        .match-lines .line.one {--}}
        {{--            height: 1px;--}}
        {{--            width: 12px;--}}
        {{--        }--}}
        {{--        .match-lines .line.two {--}}
        {{--            height: 44px;--}}
        {{--            width: 1px;--}}
        {{--            left: 11px;--}}
        {{--        }--}}
        {{--        .match-lines.alt {--}}
        {{--            left: -12px;--}}
        {{--        }--}}
        {{--        .match:nth-child(even) .match-lines .line.two {--}}
        {{--            transform: translate(0, -100%);--}}
        {{--        }--}}
        {{--        .column:first-child .match-lines.alt {--}}
        {{--            display: none;--}}
        {{--        }--}}
        {{--        .column:last-child .match-lines {--}}
        {{--            display: none;--}}
        {{--        }--}}
        {{--        .column:last-child .match-lines.alt {--}}
        {{--            display: block;--}}
        {{--        }--}}
        {{--        .column:nth-child(2) .match-lines .line.two {--}}
        {{--            height: 88px;--}}
        {{--        }--}}
        {{--        .column:nth-child(3) .match-lines .line.two {--}}
        {{--            height: 175px;--}}
        {{--        }--}}
        {{--        .column:nth-child(4) .match-lines .line.two {--}}
        {{--            height: 262px;--}}
        {{--        }--}}
        {{--        .column:nth-child(5) .match-lines .line.two {--}}
        {{--            height: 349px;--}}
        {{--        }--}}
        {{--        .disable-image .image,--}}
        {{--        .disable-seed .seed,--}}
        {{--        .disable-name .name,--}}
        {{--        .disable-score .score {--}}
        {{--            display: none !important;--}}
        {{--        }--}}
        {{--        .disable-borders {--}}
        {{--            border-width: 0px !important;--}}
        {{--        }--}}
        {{--        .disable-borders .team {--}}
        {{--            border-width: 0px !important;--}}
        {{--        }--}}
        {{--        .disable-seperator .match-top {--}}
        {{--            border-bottom: 0px !important;--}}
        {{--        }--}}
        {{--        .disable-seperator .match-bottom {--}}
        {{--            border-top: 0px !important;--}}
        {{--        }--}}
        {{--        .disable-seperator .team:first-child {--}}
        {{--            margin-bottom: 0px;--}}
        {{--        }--}}
        {{--        /* Dark Theme */--}}
        {{--        .theme-dark {--}}
        {{--            /*background: #0e1217;*/--}}
        {{--            border-color: #040607;--}}
        {{--        }--}}
        {{--        .theme-dark .match-lines .line {--}}
        {{--            background: #36404e;--}}
        {{--        }--}}
        {{--        .theme-dark .team {--}}
        {{--            /*background: #182026;*/--}}
        {{--            border-color: #232c36;--}}
        {{--            color: #6b798c;--}}
        {{--        }--}}
        {{--        .theme-dark .winner-top .match-top,--}}
        {{--        .theme-dark .winner-bottom .match-bottom {--}}
        {{--            background: #232c36;--}}
        {{--            color: #e3e8ef;--}}
        {{--            border-color: #36404e;--}}
        {{--            z-index: 1;--}}
        {{--        }--}}
        {{--        .theme-dark .winner-top .match-top .score,--}}
        {{--        .theme-dark .winner-bottom .match-bottom .score {--}}
        {{--            color: #03d9ce;--}}
        {{--        }--}}
        {{--        .theme-dark .match .seed {--}}
        {{--            font-size: 12px;--}}
        {{--            min-width: 10px;--}}
        {{--        }--}}
        {{--        .theme-dark .match .score {--}}
        {{--            font-size: 14px;--}}
        {{--        }--}}

        {{--    </style>--}}

</x-filament-panels::page>
