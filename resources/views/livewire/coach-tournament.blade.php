<div>
    <main class="main_students">

        <style>
            .tournament-card4 {
                margin-top: 70px;
                border-radius: 3px;
                box-shadow: 0px 9px 15px -7.5px rgba(0, 0, 0, 0.05);
                border: 1px solid rgba(232, 231, 232, 1);
                background-color: #fff;
                display: flex;
                flex-direction: column;
                padding: 16px;
            }

            .tournament-header4 {
                display: flex;
                gap: 10px;
            }

            .tournament-logo4 {
                width: 45px;
                aspect-ratio: 1;
                object-fit: auto;
                object-position: center;
            }

            .tournament-info4 {
                display: flex;
                flex-direction: column;
                padding-bottom: 9px;
            }

            .tournament-name4 {
                color: #071c31;
                letter-spacing: 0.28px;
                font: 500 14px IBM Plex Mono, sans-serif;
            }

            .tournament-status4 {
                color: var(--accent, #095ec1);
                leading-trim: both;
                text-edge: cap;
                letter-spacing: -0.22px;
                margin-top: 10px;
                font: 400 11px/123% IBM Plex Mono, -apple-system, Roboto, Helvetica, sans-serif;
            }

            .tournament-details4 {
                display: flex;
                flex-wrap: wrap;
                align-content: flex-start;
                margin-top: 10px;
                gap: 3px;
                font-size: 11px;
            }

            .detail-icon4 {
                width: 25px;
                aspect-ratio: 1;
                object-fit: auto;
                object-position: center;
            }

            .detail-info4 {
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .detail-label4 {
                color: #707b93;
                leading-trim: both;
                text-edge: cap;
                font-family: IBM Plex Mono, sans-serif;
                font-weight: 400;
            }

            .detail-value4 {
                color: #071c31;
                font-family: IBM Plex Mono, sans-serif;
                font-weight: 500;
                letter-spacing: 0.22px;
            }

            .tournament-clubs4 {
                display: flex;
                flex-wrap: wrap;
                align-content: flex-start;
                margin-top: 10px;
                gap: 5px;
                font-size: 11px;
                color: #707b93;
                font-weight: 500;
                padding: 0 1px;
            }

            .club-list4 {
                display: flex;
                flex-direction: column;
                gap: 5px;
            }

            .club-item4 {
                leading-trim: both;
                text-edge: cap;
                font-family: IBM Plex Mono, sans-serif;
                justify-content: center;
                border-radius: 2px;
                border: 1px solid rgba(232, 231, 232, 1);
                padding: 5px;

            }

            .club-item4:last-child {
                align-self: flex-end;
            }

        </style>
        <style>
            .container_tournament {
                max-width: 812px;
                padding: 0 16px;
            }

            .tournament-card2 {
                display: flex;
                width: 100%;
                flex-direction: column;
                justify-content: center;
            }


            .tournament-header2 {
                display: flex;
                gap: 20px;
                width: 100%;
                flex-grow: 1;
            }


            .tournament-logo2 {
                aspect-ratio: 1;
                object-fit: auto;
                object-position: center;
                width: 88px;
                align-self: start;
            }

            .tournament-info2 {
                display: flex;
                flex-direction: column;
            }


            .tournament-title-container2 {
                justify-content: space-between;
                display: flex;
                width: 100%;
                gap: 20px;
            }


            .tournament-name2 {
                color: #071c31;
                letter-spacing: 0.36px;
                font: 500 18px IBM Plex Mono, sans-serif;
            }

            .tournament-status2 {
                color: var(--accent, #095ec1);
                leading-trim: both;
                text-edge: cap;
                letter-spacing: -0.28px;
                margin: auto 0;
                position: absolute;
                right: 20px;
                top: 20px;
                font: 400 14px/129% IBM Plex Mono, -apple-system, Roboto, Helvetica, sans-serif;
            }

            .tournament-region-container2 {
                align-content: flex-start;
                flex-wrap: wrap;
                align-self: start;
                display: flex;
                margin-top: 32px;
                gap: 10px;
                font-size: 14px;
            }

            .region-icon2 {
                aspect-ratio: 1;
                object-fit: auto;
                object-position: center;
                width: 36px;
            }

            .region-info2 {
                justify-content: center;
                display: flex;
                flex-direction: column;
            }

            .region-label2 {
                color: #707b93;
                leading-trim: both;
                text-edge: cap;
                font-family: IBM Plex Mono, sans-serif;
                font-weight: 400;
            }

            .region-name2 {
                color: #071c31;
                font-family: IBM Plex Mono, sans-serif;
                font-weight: 500;
                letter-spacing: 0.28px;
                margin-top: 8px;
            }

            .tournament-scale-container2 {
                align-content: flex-start;
                flex-wrap: wrap;
                align-self: start;
                display: flex;
                margin-top: 20px;
                gap: 10px;
                font-size: 14px;
            }

            .scale-icon2 {
                aspect-ratio: 1;
                object-fit: auto;
                object-position: center;
                width: 36px;
            }

            .scale-info2 {
                justify-content: center;
                display: flex;
                flex-direction: column;
            }

            .scale-label2 {
                color: #707b93;
                leading-trim: both;
                text-edge: cap;
                font-family: IBM Plex Mono, sans-serif;
                font-weight: 400;
            }

            .scale-name2 {
                color: #071c31;
                font-family: IBM Plex Mono, sans-serif;
                font-weight: 500;
                letter-spacing: 0.28px;
                margin-top: 8px;
            }

            .tournament-clubs2 {
                align-items: start;
                flex-wrap: wrap;
                justify-content: start;
                display: flex;
                margin-top: 32px;
                gap: 10px;
                font-size: 14px;
                color: #707b93;
                font-weight: 500;
            }

            .club-list2 {
                display: flex;
                flex-direction: column;
                align-items: start;
                gap: 10px;
            }

            .club-name2 {
                font-family: IBM Plex Mono, sans-serif;
                justify-content: center;
                border-radius: 5px;
                border: 1px solid rgba(232, 231, 232, 1);
                padding: 10px;
            }

            .tournament-card2-container {
                display: flex;
                gap: 20px;
                position: relative;
                border-radius: 5px;
                box-shadow: 0px 12px 20px -10px rgba(0, 0, 0, 0.05);
                border: 1px solid rgba(232, 231, 232, 1);
                background-color: #fff;
                display: flex;
                width: 100%;
                padding: 20px;
            }
        </style>
        <style>
            .participant-list {
                display: flex;
                flex-direction: column;
                font-size: 14px;
                color: #071c31;
                font-weight: 400;
                letter-spacing: 0.28px;
                width: 100%;
                padding: 0 20px;
            }

            .participant-list-header {
                border-bottom: 1px solid rgba(232, 231, 232, 1);
                display: flex;
                flex-direction: column;
                color: #707b93;
                justify-content: center;
                padding: 20px 0;
            }

            .participant-list-header-row {
                display: grid;
                gap: 20px;
                grid: 1fr / 3fr 1fr 1fr 1fr 2fr;
            }

            .participant-list-header-name,
            .participant-list-header-age,
            .participant-list-header-weight,
            .participant-list-header-rank,
            .participant-list-header-fee {
                font-family: IBM Plex Mono, sans-serif;
            }

            .participant-list-item {
                border-bottom: 1px solid rgba(232, 231, 232, 1);
                display: flex;
                flex-direction: column;
                justify-content: center;
                padding: 20px 0;
            }

            .participant-list-item-row {
                display: grid;
                grid: 1fr / 3fr 1fr 1fr 1fr 2fr;
                gap: 20px;
            }

            .participant-list-item-name {
                font-family: IBM Plex Mono, sans-serif;
                font-weight: 500;
            }

            .participant-list-item-age,
            .participant-list-item-weight,
            .participant-list-item-rank,
            .participant-list-item-fee {
                font-family: IBM Plex Mono, sans-serif;
            }

            .participant-list-item-fee {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding-right: 20px;
                gap: 10px;
            }

            .participant-list-item-action {
                display: flex;
                gap: 10px;
                font-weight: 500;
                white-space: nowrap;
            }

            .participant-list-item-action-remove {
                color: #c10914;
            }

            .participant-list-item-action-add {
                color: var(--accent, #095ec1);
            }

            .participant-list-item-action-icon {
                width: 16px;
                aspect-ratio: 1;
                object-fit: auto;
                object-position: center;
                align-self: start;
            }

            .participant-list-item-action-text {
                font-family: IBM Plex Mono, sans-serif;
            }
        </style>
        <style>
            .participant-card {
                display: flex;
                flex-direction: column;
            }

            .participant-info {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 5px 14px 5px 0;
                border-bottom: 1px solid rgba(232, 231, 232, 1);
            }

            .participant-details {
                display: flex;
                flex-direction: column;
            }

            .participant-name {
                color: #071c31;
                font: 500 14px 'IBM Plex Sans', sans-serif;
            }

            .participant-stats {
                display: flex;
                gap: 10px;
                margin-top: 5px;
                font-size: 12px;
                color: #707b93;
                font-weight: 400;
            }

            .participant-age,
            .participant-weight,
            .participant-rank {
                font-family: 'IBM Plex Sans', sans-serif;
            }

            .participant-status {
                color: #071c31;
                font-family: 'IBM Plex Mono', sans-serif;
                letter-spacing: 0.24px;
            }

            .participant-action {
                display: flex;
                gap: 5px;
                font-size: 12px;
                font-weight: 500;
                white-space: nowrap;
                align-self: flex-end;
                align-items: center;
            }

            .participant-action img {
                width: 16px;
                aspect-ratio: 1;
                object-fit: auto;
                object-position: center;
            }

            .remove-participant {
                color: #c10914;
                font-family: 'IBM Plex Sans', sans-serif;
            }

            .add-participant {
                color: var(--accent, #095ec1);
                font-family: 'IBM Plex Mono', sans-serif;
                letter-spacing: 0.24px;
            }

            .block_mobile {
                display: none;
            }

            .none_mobile {
                display: block;
            }

            @media (max-width: 800px) {
                .block_mobile {
                    display: block;
                }

                .none_mobile {
                    display: none;
                }

                .main_students {
                    gap: 32px;
                }
            }
        </style>


        @foreach($tournaments as $tournament)
            <section class="block_mobile container_tournament container">
                <article class="tournament-card4">
                    <header class="tournament-header4">
                        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/21d3705043c8d488b073668fc3f3c44a97ababa400e4dc973ee1172eda38fdac?apiKey=64de9059607140be8c9d5acd9f2dfd62&"
                             alt="Tournament logo" class="tournament-logo4"/>
                        <div class="tournament-info4">
                            <h2 class="tournament-name4">{{$tournament->name}}</h2>
                            <p class="tournament-status4">Идут заявки</p>
                        </div>
                    </header>
                    <section class="tournament-details4">
                        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/2296e0667941238ffce781f7d86c7a3576dfb661ae6dc6717d56a5c25e495a1b?apiKey=64de9059607140be8c9d5acd9f2dfd62&"
                             alt="Region icon" class="detail-icon4"/>
                        <div class="detail-info4">
                            <span class="detail-label4">Регион</span>
                            <span class="detail-value4">{{$tournament->region->name}}</span>
                        </div>
                    </section>
                    <section class="tournament-details4">
                        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/8eff9239ac69233c2a423ef2cdf81a6076a48f5702d216d70a399720a93b92d8?apiKey=64de9059607140be8c9d5acd9f2dfd62&"
                             alt="Tournament scale icon" class="detail-icon4"/>
                        <div class="detail-info4">
                            <span class="detail-label4">Масштаб турнира</span>
                            <span class="detail-value4">{{$tournament->scale->name}}</span>
                        </div>
                    </section>
                    <section class="tournament-clubs4">
                        <ul class="club-list4">
                            @foreach($tournaments as $tournament)
                                @foreach($tournament->coaches as $coach)
                                    <li class="club-item4">{{ $coach->club }}</li>
                                @endforeach
                            @endforeach
                        </ul>
                    </section>
                </article>
            </section>

            <section class="block_mobile">
                <div class="container container_tournament">
                    <div class="participant-card">
                        @foreach($students as $student)
                            <div class="participant-info">
                                <div class="participant-details">
                                    <h3 class="participant-name">{{$student->first_name . ' ' . $student->last_name}}</h3>
                                    <div class="participant-stats">
                                        <span class="participant-age">{{$student->age}} лет</span>
                                        <span class="participant-weight">{{$student->weight}}кг</span>
                                        <span class="participant-rank">{{$student->ky}}</span>
                                        <span class="participant-status">есть</span>
                                    </div>
                                </div>
                                @if($this->isStudentInTournament($student->id, $tournament->id))
                                    <div class="participant-action participant-action-rem">
                                        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/c23278d97be7f28388e2b6fe9fe3dbcc60fcb253e5566e5ac67f7bbee2412a57?apiKey=64de9059607140be8c9d5acd9f2dfd62&"
                                             alt=""/>
                                        <a wire:click.prevent="removeStudent({{ $student->id }}, {{ $tournament->id }})"
                                           class="remove-participant">Удалить</a>
                                    </div>
                                @else
                                    <div class="participant-action participant-action-add">
                                        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/924f275d637cded57e1305ad66a57e044d0a48e468891f8aa249c303f312828b?apiKey=64de9059607140be8c9d5acd9f2dfd62&"
                                             alt=""/>
                                        <a wire:click.prevent="addStudent({{ $student->id }}, {{ $tournament->id }})"
                                           class="add-participant">Добавить</a>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <section class="none_mobile" style="margin-top: 60px;">
                <div class="container container_tournament">
                    <div class="tournament-card2-container">
                        <img src="{{asset('assets/img/flag.svg')}}"
                             alt="Tournament logo" class="tournament-logo2"/>
                        <article class="tournament-card2">
                            <header class="tournament-header2">
                                <div class="tournament-info2">
                                    <div class="tournament-title-container2">
                                        <h1 class="tournament-name2">{{$tournament->name}}</h1>
                                        <p class="tournament-status2">Идут заявки</p>
                                    </div>
                                    <div class="tournament-region-container2">
                                        <img src="{{asset('assets/img/region.svg')}}"
                                             alt="Region icon" class="region-icon2"/>
                                        <div class="region-info2">
                                            <p class="region-label2">Регион</p>
                                            <p class="region-name2">{{$tournament->region->name}}</p>
                                        </div>
                                    </div>
                                    <div class="tournament-scale-container2">
                                        <img src="{{asset('assets/img/scale.svg')}}"
                                             alt="Scale icon" class="scale-icon2"/>
                                        <div class="scale-info2">
                                            <p class="scale-label2">Масштаб турнира</p>
                                            <p class="scale-name2">{{$tournament->scale->name}}</p>
                                        </div>
                                    </div>
                                </div>
                            </header>
                            <style></style>
                            <section class="tournament-clubs2">
                                <div class="club-list2">
                                    @foreach($tournaments as $tournament)
                                        @foreach($tournament->coaches as $coach)
                                            <p class="club-name2">{{ $coach->club }}</p>
                                        @endforeach
                                    @endforeach
                                </div>
                            </section>

                        </article>
                    </div>
                </div>
            </section>

            <section class="none_mobile">
                <div class="container container_tournament">
                    <div class="participant-list">
                        <header class="participant-list-header">
                            <div class="participant-list-header-row">
                                <div class="participant-list-header-name">Фамилия Имя</div>
                                <div class="participant-list-header-age">Возраст</div>
                                <div class="participant-list-header-weight">Вес</div>
                                <div class="participant-list-header-rank">Кю/Дан</div>
                                <div class="participant-list-header-fee">Деньги для участия</div>
                            </div>
                        </header>
                        @foreach($students as $student)
                            <article class="participant-list-item">
                                <div class="participant-list-item-row">
                                    <div class="participant-list-item-name">
                                        <a href="{{ route('students.show', $student->id) }}">
                                            {{ $student->last_name . ' ' . $student->first_name }}
                                        </a>
                                    </div>
                                    <div class="participant-list-item-age">{{$student->age}} лет</div>
                                    <div class="participant-list-item-weight">{{$student->weight}}кг</div>
                                    <div class="participant-list-item-rank">{{$student->ky}}</div>
                                    <div class="participant-list-item-fee">
                                        <span>есть</span>

                                        @if($this->isStudentInTournament($student->id, $tournament->id))
                                            <div class="participant-list-item-action participant-list-item-action-remove">
                                                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/985b0312b2685dcb918d0a7fe00dc4e23bd91a09ccf703c9a3f6fde44f5b2e66?apiKey=64de9059607140be8c9d5acd9f2dfd62&"
                                                     alt="" class="participant-list-item-action-icon"/>
                                                <a wire:click.prevent="removeStudent({{ $student->id }}, {{ $tournament->id }})"
                                                   class="participant-list-item-action-text">Убрать</a>
                                            </div>
                                        @else
                                            <div class="participant-list-item-action participant-list-item-action-add">
                                                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/924f275d637cded57e1305ad66a57e044d0a48e468891f8aa249c303f312828b?apiKey=64de9059607140be8c9d5acd9f2dfd62&"
                                                     alt="" class="participant-list-item-action-icon"/>
                                                <a wire:click.prevent="addStudent({{ $student->id }}, {{ $tournament->id }})"
                                                   class="participant-list-item-action-text">Добавить</a>
                                            </div>
                                        @endif

                                    </div>

                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endforeach

    </main>
</div>
