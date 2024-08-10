<div>
    <main class="main ">
        <section class="region-filter">
            <button class="region-filter-header">
                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/f76872aaca6b68ed25fa8df2edff5ad65a8583c26019f7ba31e9e6e15cab0a77?apiKey=64de9059607140be8c9d5acd9f2dfd62&"
                     alt="Filter icon" class="region-filter-icon" />
                <h3 class="region-filter-title">Фильтр по региону</h3>
            </button>

            <div class="region-option">
                <label for="input" class="region-checkbox">
                    <input type="checkbox" class="region-input" id="input">
                    <span></span>
                </label>
                <span class="region-label">Любой</span>
            </div>

            <div class="region-filters">
                @foreach($regions as $region)
                    <div class="region-option region-selected">
                        <label for="region-{{ $region->id }}" class="region-checkbox">
                            <input type="checkbox" class="region-input" id="region-{{ $region->id }}" wire:model.live="selectedRegions" value="{{ $region->id }}">
                            <span></span>
                        </label>
                        <span class="region-label">{{ $region->name }}</span>
                    </div>
                @endforeach
            </div>

        </section>

        <section class="region-cards">


            <div class="container">
                <div class="tournament-search">
                    <div class="search-container">
                        <input type="text" wire:model.live="q" class="search-input search-placeholder"
                               placeholder="Введите название турнира.." style="
                            background: rgba(243, 243, 243, 0.9) !important;">

{{--                        <button wire:click="updatedQ" class="search-button">--}}
{{--                            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/fc20d7d1d02c277b1709c70cd28d9262ededbf5a7abdd3ae20fa1fdf2b4aaaaa?apiKey=64de9059607140be8c9d5acd9f2dfd62&"--}}
{{--                                 alt="Search icon" class="search-icon" />--}}
{{--                            <span class="search-text">Поиск</span>--}}
{{--                        </button>--}}
{{--                        <button wire:click="updatedQ" class="search-button search-mobile">--}}
{{--                            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/fc20d7d1d02c277b1709c70cd28d9262ededbf5a7abdd3ae20fa1fdf2b4aaaaa?apiKey=64de9059607140be8c9d5acd9f2dfd62&amp;"--}}
{{--                                 alt="Search icon" class="search-icon">--}}
{{--                            <input style="background-color: transparent !important;" class="search-text" placeholder="Поиск" />--}}
{{--                        </button>--}}
                        <button class="region-filter-header region-filter-mobile">
                            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/f76872aaca6b68ed25fa8df2edff5ad65a8583c26019f7ba31e9e6e15cab0a77?apiKey=64de9059607140be8c9d5acd9f2dfd62&"
                                 alt="Filter icon" class="region-filter-icon" />
                            <h3 class="region-filter-title">Фильтр по региону</h3>
                        </button>
                    </div>

                </div>

                @foreach($tournaments as $tournament)
                <article class="tournament-card1">
                    <section class="tournament-info1">
                        <figure class="tournament-logo1">
                            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/0555a5a302fe361c894f3ca7856c2740de1a1d204751890d1209dd1fe76a8102?apiKey=64de9059607140be8c9d5acd9f2dfd62&"
                                 alt="Tournament Logo" class="tournament-logo-image1" />
                            <figcaption class="tournament-logo-text1">Инфо</figcaption>
                        </figure>
                        <div class="tournament-details1">
                            <h2 class="tournament-name1">{{$tournament->name}}</h2>

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
                    <div class="tournament-inf__box1">
                        <div class="tournament-location">
                            <div class="tournament-address">
                                <div class="address-details">
                                    <div class="tournament-venue">
                                        <div class="venue-info">
                                            <div class="venue-label">Адрес турнира:</div>
                                            <div class="venue-address">
                                                {{$tournament->address}}
                                            </div>
                                            <div class="commission-label">Адрес комиссии:</div>
                                            <div class="commission-address">
                                                {{$tournament->address}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tournament-pricing">
                                        <div class="pricing-info">
                                            <div class="price-label">Стоимость</div>
                                            <div class="price-value">{{$tournament->price}}р.</div>
                                            <div class="commission-date-label">Дата турнира</div>
                                            <div class="commission-date-value">{{$tournament->date}}</div>
                                            <div class="commission-date-label">Дата комиссии</div>
                                            <div class="commission-date-value">{{$tournament->date_commission}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tournament-actions">
                            <time class="tournament-date1">{{$tournament->date}}</time>
                            <div class="action-buttons">
                                <button class="position-button">Положение</button>
                                <button class="application-button">Заявление</button>
                            </div>
                        </div>
                    </div>
                    <section class="tournament-clubs1">
                        <div class="club-list1">
                            @foreach($tournament->coaches as $coach)
                            <span class="club-name1">{{$coach->club}}</span>
                            @endforeach
                        </div>
                    </section>
                    <a href="puli_tour.html" class="tournament-button1">Турнир</a>
                    <a href="{{route('puli.list', $tournament->id)}}" class="tournament-button1">Участники</a>
                </article>
                @endforeach
                @foreach($tournaments as $tournament)
                <div class="tournament-info">
                    <div class="tournament-main__box">

                        <div class="tournament_info-box">
                            <div class="info-button">
                                <img src="{{asset('assets/img/sfera.svg')}}"
                                     alt="" class="info-icon" loading="lazy" />
                                <button class="info-text">Инфо</button>
                            </div>
                            <div class="tournament-details">
                                <div class="tournament-details__box">
                                    <h2 class="tournament-name">{{$tournament->name}}</h2>

                                </div>
                                <div class="tournament-meta">
                                    <div class="region-info">
                                        <img src="{{asset('assets/img/sfera.svg')}}"
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

                        <div class="tournament-actions">
                            <div class="tournament-date">{{$tournament->date}}</div>
                            <a href="puli_tour.html" class="action-button">Турнир</a>
                            <a href="{{route('puli.list', $tournament->id)}}" class="action-button">Участники</a>
                        </div>
                    </div>
                    <div class="tournament-inf__box">
                        <div class="tournament-location">
                            <div class="tournament-address">
                                <div class="address-details">
                                    <div class="tournament-venue">
                                        <div class="venue-info">
                                            <div class="venue-label">Адрес турнира:</div>
                                            <div class="venue-address">
                                                {{$tournament->address}}
                                            </div>
                                            <div class="commission-label">Адрес комиссии:</div>
                                            <div class="commission-address">
                                                {{$tournament->address}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tournament-pricing">
                                        <div class="pricing-info">
                                            <div class="price-label">Стоимость</div>
                                            <div class="price-value">{{$tournament->price}}р.</div>
                                            <div class="commission-date-label">Дата турнира</div>
                                            <div class="commission-date-value">{{$tournament->date}}</div>
                                            <div class="commission-date-label">Дата комиссии</div>
                                            <div class="commission-date-value">{{$tournament->date_commission}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
{{--                        <div class="tournament-actions">--}}
{{--                            <div class="action-buttons">--}}
{{--                                <button class="position-button">Положение</button>--}}
{{--                                <button class="application-button">Заявление</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
                @endforeach
            </div>




        </section>
    </main>
</div>
