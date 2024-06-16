<div>
    <main class="main_students">

        <style>
            .container_tournament {
                max-width: 780px;
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

            .tournament-pricing{
                margin: 0;
            }

            .tournament-venue{
                width: auto;
                margin-right: 40px;
            }

            .commission-date-label{
                margin: 0;
            }

            .address-details{
                gap: 40px;
                align-items: center;
            }

            .tournament-address{
                border: 0;
            }
        </style>
        <section style="margin-top: 60px;">
            <div class="container">
                <article class="tournament-card1">
                    <section class="tournament-info1">
                        <figure class="tournament-logo1">
                            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/0555a5a302fe361c894f3ca7856c2740de1a1d204751890d1209dd1fe76a8102?apiKey=64de9059607140be8c9d5acd9f2dfd62&"
                                 alt="Tournament Logo" class="tournament-logo-image1" />
                        </figure>
                        <div class="tournament-details1">
                            <h2 class="tournament-name1">{{$tournament->name}}</h2>
                            <time class="tournament-date1">{{$tournament->date}}</time>
                            <div class="tournament-region1">
                                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/4fa33930a932f357605c6a156a367c2da425ff8d6a184fcdcdb0c0a96e54e12d?apiKey=64de9059607140be8c9d5acd9f2dfd62&"
                                     alt="Region Icon" class="region-icon1" />
                                <div class="region-details1">
                                    <span class="region-label1">Регион</span>
                                    <span class="region-name1">{{$tournament->region->name}}</span>
                                </div>
                            </div>
                            <div class="tournament-scale1">
                                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/22fb48c0475a4f528f45b6155b656048304b0d8e0ebdd5afc27b50878b8fb428?apiKey=64de9059607140be8c9d5acd9f2dfd62&"
                                     alt="Scale Icon" class="scale-icon1" />
                                <div class="scale-details1">
                                    <span class="scale-label1">Масштаб турнира</span>
                                    <span class="scale-name1">{{$tournament->scale->name}}</span>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="tournament-clubs1">
                        <div class="club-list1">
                            @foreach($tournament->coaches as $coach)
                            <span class="club-name1">{{$coach->club}}</span>
                            @endforeach
                        </div>
                    </section>
                    <a href="{{route('organize.tournament.puli', $tournament->id)}}" class="tournament-button1">Пули</a>
                    <a href="puli_list_organizate.html" class="tournament-button1">Список участников</a>
                </article>
                <div class="tournament-info">
                    <div class="tournament-main__box">
                        <div class="tournament_info-box">
                            <div class="info-button">
                                <img src="{{asset('assets/img/sfera.svg')}}"
                                     alt="" class="info-icon" loading="lazy" />
                            </div>
                            <div class="tournament-details">
                                <div class="tournament-details__box">
                                    <h2 class="tournament-name">{{$tournament->name}}</h2>
                                    <div class="tournament-status">Идут заявки</div>
                                </div>
                                <div class="tournament-meta">
                                    <div class="region-info">
                                        <img src="{{asset('assets/img/region.svg')}}"
                                             alt="" class="region-icon" loading="lazy" />
                                        <div class="region-details">
                                            <div class="region-label">Регион</div>
                                            <div class="region-value">{{$tournament->region->name}}</div>
                                        </div>
                                    </div>
                                    <div class="scale-info">
                                        <img src="{{asset('assets/img/scale.svg')}}"
                                             alt="" class="scale-icon" loading="lazy" />
                                        <div class="scale-details">
                                            <div class="scale-label">Масштаб турнира</div>
                                            <div class="scale-value">{{$tournament->scale->name}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="club-list">
                                    @foreach($tournament->coaches as $coach)
                                        <div class="club-item">{{$coach->club}}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="tournament-actions" style="width: auto;">
                            <div class="tournament-date">{{$tournament->date}}</div>
                            <a href="{{route('organize.tournament.puli', $tournament->id)}}" style="margin-top: 20px; width: 100%; padding: 16px 5px; color: #000; text-align: center;" class="position-button">Пули</a>
                            <a href="puli_list_organizate.html" class="application-button" style="padding: 16px 5px;color: #000; text-align: center;">Cписки участников</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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

        <section class="none_mobile">
            <div class="container">
                <div class="participant-list">
                    <style>
                        .participant-list-item-row{
                            grid: 1fr / 2fr 2fr 1fr 1fr;
                        }
                    </style>
                    @foreach($coaches as $coach)
                    <article class="participant-list-item">
                        <div class="participant-list-item-row">
                            <div class="participant-list-item-name">{{$coach->first_name . ' ' . $coach->last_name}}</div>
                            <div class="participant-list-item-age">{{$coach->club}}</div>
                            <div class="participant-list-item-rank">{{$coach->ky}}</div>
                            <div class="participant-list-item-fee">
                                @if(in_array($coach->id, $tournamentCoaches))
                                    <div class="participant-list-item-action participant-list-item-action-remove">
                                        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/985b0312b2685dcb918d0a7fe00dc4e23bd91a09ccf703c9a3f6fde44f5b2e66?apiKey=64de9059607140be8c9d5acd9f2dfd62&"
                                             alt="" class="participant-list-item-action-icon" />
                                        <a wire:click.prevent="removeCoach({{ $coach->id }})" class="participant-list-item-action-text">Убрать</a>
                                    </div>
                                @else
                                    <div class="participant-list-item-action participant-list-item-action-add">
                                        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/924f275d637cded57e1305ad66a57e044d0a48e468891f8aa249c303f312828b?apiKey=64de9059607140be8c9d5acd9f2dfd62&"
                                             alt="" class="participant-list-item-action-icon" />
                                        <a wire:click.prevent="addCoach({{ $coach->id }})" class="participant-list-item-action-text">Добавить</a>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </article>
                    @endforeach

                </div>
            </div>
        </section>

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

            @media(max-width: 800px) {
                .block_mobile {
                    display: block;
                }

                .none_mobile {
                    display: none;
                }

                .main_students{
                    gap: 30px;
                }
            }
        </style>

        <section class="block_mobile">
            <div class="container container_tournament">
                <div class="participant-card">
                    @foreach($coaches as $coach)
                    <div class="participant-info">
                        <div class="participant-details">
                            <h3 class="participant-name">{{$coach->first_name . ' ' . $coach->last_name}}</h3>
                            <div class="participant-stats">
                                <span class="participant-age">{{$coach->club}}</span>
                                <span class="participant-rank">{{$coach->ky}}</span>
                            </div>
                        </div>
                        @if(in_array($coach->id, $tournamentCoaches))
                            <div class="participant-list-item-action participant-list-item-action-remove">
                                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/985b0312b2685dcb918d0a7fe00dc4e23bd91a09ccf703c9a3f6fde44f5b2e66?apiKey=64de9059607140be8c9d5acd9f2dfd62&"
                                     alt="" class="participant-list-item-action-icon" />
                                <a wire:click.prevent="removeCoach({{ $coach->id }})" class="participant-list-item-action-text">Убрать</a>
                            </div>
                        @else
                            <div class="participant-list-item-action participant-list-item-action-add">
                                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/924f275d637cded57e1305ad66a57e044d0a48e468891f8aa249c303f312828b?apiKey=64de9059607140be8c9d5acd9f2dfd62&"
                                     alt="" class="participant-list-item-action-icon" />
                                <a wire:click.prevent="addCoach({{ $coach->id }})" class="participant-list-item-action-text">Добавить</a>
                            </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
</div>
