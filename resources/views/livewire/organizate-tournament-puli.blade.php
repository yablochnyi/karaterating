<div>
    <main class="main_students" style="gap: 30px;">

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

            @media(max-width: 800px){
                .tournament-card1{
                    margin-bottom: 0;
                }
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
                                <span class="club-phname1">{{$coach->club}}</span>
                            @endforeach
                        </div>
                    </section>
                    <a href="puli_tour_organizate.html" class="tournament-button1">Пули</a>
                    <a href="puli_list_organizate.html" class="tournament-button1">Списки участников</a>
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
                            <a href="puli_tour_organizate.html" style="margin-top: 20px; width: 100%; padding: 16px 5px; text-align: center; color: #071c31;" class="position-button">Пули</a>
                            <a href="puli_list_organizate.html" class="application-button" style="padding: 16px 5px; text-align: center; color: #071c31;">Cписки участников</a>
                        </div>
                    </div>
                    <!--
                                <div class="tournament-inf__box" style="display: flex; justify-content: space-between;">
                                    <div class="tournament-location">
                                        <div class="tournament-address">
                                            <div class="address-details">
                                                <div class="tournament-pricing">
                                                    <div class="pricing-info">
                                                        <div class="commission-date-label">Комиссия</div>
                                                        <div class="commission-date-value">23.12.2024</div>
                                                    </div>
                                                </div>
                                                <div class="tournament-venue">
                                                    <div class="venue-info">
                                                        <div class="venue-label">Адрес:</div>
                                                        <div class="venue-address">
                                                            г.Москва ул. 3-Тверская-Ямская д43. стр.2 к1. пом.12
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tournament-pricing">
                                                    <div class="pricing-info">
                                                        <div class="price-label">Стоимость</div>
                                                        <div class="price-value">1.200р.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#" class="action-button" style="height: 52px;width: auto; font-size: 14px; padding: 16px 5px;font-weight: 400; display: flex; align-items: center;">Cформировать пулю</a>
                                </div>
                    -->
                </div>
            </div>
        </section>
        <style>
            .fighter-card {
                display: flex;
                flex-direction: column;
                justify-content: center;
                max-width: 211px;
                padding: 14px 30px;
                border: 1px solid rgba(232, 231, 232, 1);
                border-radius: 5px;
                background-color: #fff;
                font-size: 16px;
                color: #071c31;
                font-weight: 400;
            }

            .fighter-name,
            .fighter-mat {
                font-family: 'IBM Plex Mono', sans-serif;
                letter-spacing: 0.32px;
                text-transform: capitalize;
                margin-top: 10px;
            }

            .fighter-name {
                font-weight: 500;
            }

            .fighter-details {
                display: flex;
                align-items: center;
                margin-top: 10px;
                gap: 5px;
                font-size: 14px;
            }

            .fighter-icon {
                width: 15px;
                fill: #095ec1;
            }

            .fighter-stats {
                font-family: 'IBM Plex Mono', sans-serif;
            }

            .puli_edit{
                display: flex;
                gap: 30px;
                flex-wrap: wrap;
            }

            @media(max-width: 800px){
                .fighter-card{
                    padding: 3vw 3vw;
                    width: 44vw;
                }

                .puli_edit{
                    gap: 4vw;
                }
            }
        </style>
        <section>
            <div class="container">
                <div class="puli_edit">


                    <a href="puli_tour_organizate.html" class="fighter-card">
                        <h2 class="fighter-name">+ Формировать</h2>
                        <h2 class="fighter-name">&nbsp;&nbspПули</h2>
                    </a>

                    <a href="puli_tour_organizate.html" class="fighter-card">
                        <h2 class="fighter-name">Пуля 1</h2>
                        <p class="fighter-mat">Татами 1</p>
                        <div class="fighter-details">
                            <picture><img src="{{asset('assets/img/boys.svg')}}" alt="Fighter icon" class="fighter-icon" /></picture>
                            <p class="fighter-stats">12-13 • 30-35кг</p>
                        </div>
                    </a>
                </div>
            </div>
        </section>

    </main>
</div>
