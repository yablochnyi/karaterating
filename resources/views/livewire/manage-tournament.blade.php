<div>
    <main class="main ">

        <section class="region-cards">
            <div class="container">

                @foreach($manageTournaments as $tournament)
                <article class="tournament-card1">
                    <section class="tournament-info1">
                        <figure class="tournament-logo1">
                            <img src="{{asset('assets/img/sfera.svg')}}"
                                 alt="Tournament Logo" class="tournament-logo-image1" />
                        </figure>
                        <div class="tournament-details1">
                            <h2 class="tournament-name1">{{$tournament->name}}</h2>
                            <div class="tournament-status">Идут заявки</div>
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
                    <div class="tournament-inf__box1" style="display: flex;">
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
                                            <div class="commission-date-value">{{$tournament->date}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tournament-actions">
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
                    <a href="{{route('organize.tournament', $tournament->id)}}" class="tournament-button1">Тренеры</a>
                    <a href="{{route('organize.tournament.puli', $tournament->id)}}" class="tournament-button1">Подробнее</a>
                </article>
                @endforeach
                    @foreach($manageTournaments as $tournament)
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
                                    <button class="edit_btn">Редактировать</button>
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
                        <div class="tournament-actions">
                            <div class="tournament-date">2024-12-03</div>
                            <a href="{{route('organize.tournament', $tournament->id)}}" class="action-button">Тренеры</a>
                            <a href="{{route('organize.tournament.puli', $tournament->id)}}" class="action-button">Подробнее</a>
                        </div>
                    </div>
                    <div class="tournament-inf__box" style="display: flex;">
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
                            <div class="action-buttons">
                                <button class="position-button">Положение</button>
                                <button class="application-button">Заявление</button>
                            </div>
                        </div>
                    </div>
                </div>
                    @endforeach

                <style>
                    .edit_cart {
                        height: 0;
                        opacity: 0;
                        visibility: hidden;
                        transition: all .5s;
                    }

                    .tournament-add-row {
                        display: flex;
                        justify-content: space-between;
                        width: 100%;
                        gap: 55px;
                    }

                    .tournament-add-column {
                        display: flex;
                        flex-direction: column;
                        flex-grow: 1;
                        gap: 20px;
                    }

                    .tournament-add-container {
                        transition: all .5s;
                        min-height: 50px;
                        cursor: pointer;
                        margin: 28px 0;
                        display: flex;
                        flex-direction: column;
                        justify-content: center;
                        align-items: center;
                        padding: 16px 24px;
                        background-color: #fff;
                        border: 1px solid rgba(232, 231, 232, 1);
                        border-radius: 5px;
                        box-shadow: 0px 10px 20px 0px rgba(0, 0, 0, 0.05);
                        font-size: 14px;
                        color: var(--000505, #000505);
                        font-weight: 400;
                        line-height: 171%;
                    }

                    .tournament-add-wrapper {
                        display: flex;
                        gap: 10px;
                    }

                    .tournament-add-icon {
                        width: 18px;
                        aspect-ratio: 1;
                        object-fit: auto;
                        object-position: center;
                    }

                    .tournament-add-text {
                        margin: auto 0;
                        font-family: IBM Plex Mono, sans-serif;
                        leading-trim: both;
                        text-edge: cap;
                    }

                    .block_mobile {
                        display: none;
                    }

                    @media(max-width: 800px) {
                        .none_mobile {
                            display: none;
                        }

                        .block_mobile {
                            display: block;
                        }
                    }
                </style>

                <div class="tournament-add-container">
                    <div class="tournament-add-wrapper">
                        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/d42cb134ee716ee06b53b7bd4fe57b3d0a711b1b10146fc1da9f9c3619c6fc0e?apiKey=64de9059607140be8c9d5acd9f2dfd62&"
                             alt="Add tournament icon" class="tournament-add-icon" />
                        <div class="tournament-add-text">Добавить турнир</div>
                    </div>
                    <div class="edit_cart none_mobile">
                        @if ($errors->any())
                            <div class="error-messages">
                                @foreach ($errors->all() as $error)
                                    <p class="error">{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                        <div class="tournament-add-row">
                            <div class="tournament-add-column">
                                <svg width="88" height="88" viewBox="0 0 88 88" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_8002_7415)">
                                        <path
                                                d="M44 88C68.3008 88 88 68.3008 88 44C88 19.6992 68.3008 0 44 0C19.6992 0 0 19.6992 0 44C0 68.3008 19.6992 88 44 88Z"
                                                fill="#DEEEFF" />
                                        <path
                                                d="M52.936 27.456C54.2587 29.248 54.92 31.168 54.92 33.216C54.92 34.6667 54.6 35.968 53.96 37.12C53.32 38.272 52.3173 39.5733 50.952 41.024C49.7573 42.2613 48.8827 43.4347 48.328 44.544C47.7733 45.6107 47.4107 46.6133 47.24 47.552C47.112 48.448 46.9627 49.8773 46.792 51.84C46.792 52.8213 46.4507 53.5467 45.768 54.016C45.0853 54.4427 44.3813 54.656 43.656 54.656C41.736 54.656 40.776 53.504 40.776 51.2C40.776 49.9627 40.9893 48.4907 41.416 46.784C41.8427 45.0773 42.632 43.2213 43.784 41.216C44.168 40.5333 44.6587 39.8507 45.256 39.168C45.896 38.4853 46.3013 38.0373 46.472 37.824C47.1547 37.0987 47.7307 36.352 48.2 35.584C48.6693 34.7733 48.904 34.0693 48.904 33.472C48.904 32.7893 48.7973 32.256 48.584 31.872C48.4133 31.488 48.136 31.0613 47.752 30.592C47.1973 29.952 46.472 29.44 45.576 29.056C44.68 28.672 43.848 28.48 43.08 28.48C41.8427 28.48 40.6907 28.7147 39.624 29.184C38.6 29.6107 37.768 30.1867 37.128 30.912C36.5307 31.5947 36.232 32.2987 36.232 33.024C36.232 34.2187 36.4667 35.1147 36.936 35.712C37.4053 36.2667 37.64 36.7787 37.64 37.248C37.64 37.504 37.576 37.8027 37.448 38.144C36.936 39.3387 36.0613 39.936 34.824 39.936C33.2453 39.936 32.0933 39.3387 31.368 38.144C30.6427 36.9493 30.28 35.4347 30.28 33.6C30.28 31.8507 30.8347 30.1867 31.944 28.608C33.0533 26.9867 34.6747 25.664 36.808 24.64C38.9413 23.616 41.48 23.104 44.424 23.104C46.1307 23.104 47.7307 23.488 49.224 24.256C50.7173 24.9813 51.9547 26.048 52.936 27.456ZM43.656 57.088C44.936 57.088 45.96 57.536 46.728 58.432C47.368 59.072 47.688 59.9467 47.688 61.056C47.688 61.9947 47.24 62.784 46.344 63.424C45.448 64.0213 44.4667 64.32 43.4 64.32C42.632 64.32 41.8853 64.1067 41.16 63.68C40.264 63.04 39.816 61.9093 39.816 60.288C39.816 59.4347 40.2 58.688 40.968 58.048C41.7787 57.408 42.6747 57.088 43.656 57.088Z"
                                                fill="#095EC1" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_8002_7415">
                                            <rect width="88" height="88" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>


                            </div>
                            <div class="tournament-add-column" style="flex-grow: 3;">
                                <input type="text" wire:model="name" class="title" placeholder="Название">
                                <style>
                                    .title {
                                        font-family: 'IBM Plex Mono', sans-serif;
                                        align-items: start;
                                        border: 1px solid rgba(232, 231, 232, 1);
                                        border-radius: 3px;
                                        color: #071c31;
                                        white-space: nowrap;
                                        justify-content: center;
                                        padding: 11px 15px;
                                        height: 40px;
                                    }
                                </style>
                                <div class="tournament-add-row">
                                    <div class="tournament-scale-container ">
                                        <div class="select_drop" style="width:197px;padding: 0;">
                                            <select class="tournament-scale" wire:model="scale" style="width: 100%;">
                                                <option value="">Выберите масштаб</option>
                                                @foreach($scales as $scale)
                                                    <option class="tournament-scale" value="{{ $scale->id }}">{{ $scale->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="tatami-count-container">
                                            <div class="tatami-count-label">Количество татами</div>
                                            <input type="text" wire:model="tatami" class="tatami-count"
                                                   style="width: 33px;height: 33px;" placeholder="22">
                                        </div>
                                        <div class="third-place-fight-container">
                                            <label for="input" class="region-checkbox">
                                                <input type="checkbox" wire:model="fight_for_third_place" class="region-input" id="input">
                                                <span></span>
                                            </label>
                                            <div class="third-place-fight-text" >Бой за третье место</div>
                                        </div>
                                        <div class="third-place-fight-container">
                                            <livewire:components.session-lists />

                                        </div>
                                    </div>
                                    <style>
                                        .filter-container {
                                            display: flex;
                                            flex-direction: column;
                                        }

                                        @media (max-width: 991px) {
                                            .filter-container {
                                                margin-top: 40px;
                                            }
                                        }

                                        .age-filter {
                                            display: flex;
                                            justify-content: space-between;
                                            gap: 20px;
                                            font-size: 14px;
                                            color: #707b93;
                                            font-weight: 400;
                                        }

                                        .age-from,
                                        .age-to {
                                            display: flex;
                                            justify-content: center;
                                            align-items: center;
                                            gap: 13px;
                                            padding: 0 1px;
                                        }

                                        .age-label {
                                            font-family: 'IBM Plex Mono', sans-serif;
                                            margin: 0;
                                        }

                                        .age-input {
                                            font-family: 'IBM Plex Mono', sans-serif;
                                            justify-content: center;
                                            border-radius: 3px;
                                            border: 1px solid #e8e7e8;
                                            white-space: nowrap;
                                            text-align: center;
                                        }

                                        @media (max-width: 991px) {
                                            .age-input {
                                                white-space: initial;
                                            }
                                        }

                                        .weight-filter {
                                            display: flex;
                                            justify-content: space-between;
                                            width: 100%;
                                            gap: 20px;
                                            font-size: 14px;
                                            color: #707b93;
                                            font-weight: 400;
                                            margin-top: 32px;
                                        }

                                        .weight-from,
                                        .weight-to {
                                            display: flex;
                                            justify-content: center;
                                            align-items: center;
                                            gap: 14px;
                                            padding: 0 1px;
                                        }

                                        .weight-label {
                                            font-family: 'IBM Plex Mono', sans-serif;
                                            margin: 0;
                                        }

                                        .weight-input {
                                            font-family: 'IBM Plex Mono', sans-serif;
                                            justify-content: center;
                                            border-radius: 3px;
                                            border: 1px solid #e8e7e8;
                                            white-space: nowrap;
                                            text-align: center;
                                        }

                                        @media (max-width: 991px) {
                                            .weight-input {
                                                white-space: initial;
                                            }
                                        }

                                        .kyu-filter {
                                            display: flex;
                                            justify-content: space-between;
                                            width: 100%;
                                            gap: 20px;
                                            padding: 7px 0;
                                            margin-top: 32px;
                                        }

                                        .kyu-option {
                                            display: flex;
                                            gap: 10px;
                                            align-items: center;
                                        }

                                        .kyu-checkbox {
                                            display: flex;
                                            justify-content: center;
                                            align-items: center;
                                            width: 17px;
                                            height: 17px;
                                            border-radius: 3px;
                                            border: 1px solid #e8e7e8;
                                            background-color: #eafff2;
                                            padding: 10px;
                                        }

                                        .kyu-checkbox img {
                                            width: 17px;
                                            aspect-ratio: 1;
                                            object-fit: contain;
                                        }

                                        .kyu-label {
                                            color: #707b93;
                                            font: 400 14px/171% 'IBM Plex Mono', sans-serif;
                                            margin: 0;
                                        }

                                        .gender-filter {
                                            display: flex;
                                            justify-content: space-between;
                                            width: 100%;
                                            gap: 20px;
                                            padding: 7px 0;
                                            margin-top: 6px;
                                        }

                                        .gender-option {
                                            display: flex;
                                            gap: 10px;
                                            align-items: center;
                                        }

                                        .gender-checkbox {
                                            display: flex;
                                            justify-content: center;
                                            align-items: center;
                                            width: 17px;
                                            height: 17px;
                                            border-radius: 3px;
                                            border: 1px solid #e8e7e8;
                                            background-color: #eafff2;
                                            padding: 10px;
                                        }

                                        .gender-checkbox img {
                                            width: 17px;
                                            aspect-ratio: 1;
                                            object-fit: contain;
                                        }

                                        .gender-label {
                                            color: #707b93;
                                            font: 400 14px/171% 'IBM Plex Mono', sans-serif;
                                            margin: 0;
                                        }
                                    </style>

                                    <section class="filter-container">
                                        <div class="age-filter">
                                            <div class="age-from">
                                                <p class="age-label">Возраст от</p>
                                                <input type="text" wire:model="age_from" class="age-input" placeholder="13"
                                                       style="width: 33px;height: 33px;">

                                            </div>
                                            <div class="age-to">
                                                <p class="age-label">и до</p>
                                                <input type="text" wire:model="age_to" class="age-input" placeholder="13"
                                                       style="width: 33px;height: 33px;">
                                            </div>
                                        </div>

{{--                                        <div class="weight-filter">--}}
{{--                                            <div class="weight-from">--}}
{{--                                                <p class="weight-label">Вес от</p>--}}
{{--                                                <input type="text" class="weight-input" placeholder="66"--}}
{{--                                                       style="width: 33px;height: 33px;">--}}
{{--                                            </div>--}}
{{--                                            <div class="weight-to">--}}
{{--                                                <p class="weight-label">и до</p>--}}
{{--                                                <input type="text" class="weight-input" placeholder="80"--}}
{{--                                                       style="width: 33px;height: 33px;">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                        <div class="kyu-filter">
                                            <div class="kyu-option">
                                                <label for="input5" class="region-checkbox">
                                                    <input type="checkbox" wire:model="KY_up_to_8" class="region-input" id="input5">
                                                    <span></span>
                                                </label>
                                                <p class="kyu-label">КЮ до 8</p>
                                            </div>
                                            <div class="kyu-option">
                                                <label for="input1" class="region-checkbox">
                                                    <input type="checkbox" wire:model="KY_from_8" class="region-input" id="input1">
                                                    <span></span>
                                                </label>
                                                <p class="kyu-label">КЮ от 8</p>
                                            </div>
                                        </div>

{{--                                        <div class="gender-filter">--}}
{{--                                            <div class="gender-option">--}}
{{--                                                <label for="input2" class="region-checkbox">--}}
{{--                                                    <input type="checkbox" class="region-input" id="input2">--}}
{{--                                                    <span></span>--}}
{{--                                                </label>--}}
{{--                                                <p class="gender-label">Мужской</p>--}}
{{--                                            </div>--}}
{{--                                            <div class="gender-option">--}}
{{--                                                <label for="input3" class="region-checkbox">--}}
{{--                                                    <input type="checkbox" class="region-input" id="input3">--}}
{{--                                                    <span></span>--}}
{{--                                                </label>--}}
{{--                                                <p class="gender-label">Женский</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </section>
                                </div>

                                <style>
                                    .tournament-scale-container {
                                        display: flex;
                                        flex-direction: column;
                                        font-size: 14px;
                                        color: #707b93;
                                        font-weight: 400;
                                    }

                                    .tournament-scale {
                                        display: flex;
                                        justify-content: center;
                                        align-items: center;
                                        gap: 20px;
                                        border: 1px solid rgba(232, 231, 232, 1);
                                        border-radius: 3px;
                                        color: #071c31;
                                        padding: 6px 14px;
                                    }

                                    .tournament-scale-text {
                                        font-family: 'IBM Plex Mono', sans-serif;
                                    }

                                    .tournament-scale-icon {
                                        width: 8px;
                                        fill: #071c31;
                                    }

                                    .tatami-count-container {
                                        display: flex;
                                        justify-content: space-between;
                                        align-items: center;
                                        gap: 20px;
                                        margin-top: 26px;
                                        padding: 0 1px;
                                    }

                                    .tatami-count-label {
                                        font-family: 'IBM Plex Mono', sans-serif;
                                    }

                                    .tatami-count {
                                        font-family: 'IBM Plex Mono', sans-serif;
                                        display: flex;
                                        justify-content: center;
                                        align-items: center;
                                        border: 1px solid rgba(232, 231, 232, 1);
                                        border-radius: 3px;
                                        padding: 6px 7px;
                                        white-space: nowrap;
                                    }

                                    .third-place-fight-container {
                                        display: flex;
                                        align-items: center;
                                        gap: 10px;
                                        margin-top: 26px;
                                        line-height: 171%;
                                    }

                                    .third-place-fight-checkbox {
                                        width: 17px;
                                        height: 17px;
                                        border: 1px solid rgba(232, 231, 232, 1);
                                        border-radius: 3px;
                                        background-color: #fff;
                                        padding: 10px;
                                    }

                                    .third-place-fight-text {
                                        font-family: 'IBM Plex Mono', sans-serif;
                                    }
                                </style>
                            </div>
                            <div class="tournament-add-column" style="flex-grow: 2;">
                                <style>
                                    .commission-container {
                                        display: flex;
                                        flex-grow: 1;
                                        flex-direction: column;
                                        font-size: 14px;
                                        font-weight: 400;
                                    }

                                    @media (max-width: 991px) {
                                        .commission-container {
                                            margin-top: 40px;
                                        }
                                    }

                                    .commission-header {
                                        display: flex;
                                        gap: 20px;
                                        justify-content: space-between;
                                    }

                                    @media (max-width: 991px) {
                                        .commission-header {
                                            white-space: initial;
                                        }
                                    }

                                    .commission-label {
                                        color: #707b93;
                                        font-family: 'IBM Plex Mono', sans-serif;
                                        margin: auto 0;
                                    }

                                    .commission-date {
                                        font-family: 'IBM Plex Mono', sans-serif;
                                        justify-content: center;
                                        border-radius: 3px;
                                        border: 1px solid rgba(232, 231, 232, 1);
                                        color: #071c31;
                                        padding: 6px 28px;
                                    }

                                    @media (max-width: 991px) {
                                        .commission-date {
                                            white-space: initial;
                                            padding: 0 20px;
                                        }
                                    }

                                    .participation-cost {
                                        display: flex;
                                        margin-top: 27px;
                                        gap: 18px;
                                    }

                                    .cost-label {
                                        color: #707b93;
                                        font-family: 'IBM Plex Mono', sans-serif;
                                        margin: auto 0;
                                    }

                                    .cost-value {
                                        font-family: 'IBM Plex Mono', sans-serif;
                                        justify-content: center;
                                        border-radius: 3px;
                                        border: 1px solid rgba(232, 231, 232, 1);
                                        color: #071c31;
                                        white-space: nowrap;
                                    }

                                    .address {
                                        resize: none;
                                        font-family: 'IBM Plex Mono', sans-serif;
                                        align-items: start;
                                        border-radius: 3px;
                                        border: 1px solid rgba(232, 231, 232, 1);
                                        margin-top: 27px;
                                        color: #707b93;
                                        white-space: nowrap;
                                        justify-content: center;
                                        padding: 10px;
                                    }

                                    @media (max-width: 991px) {
                                        .address {
                                            padding-right: 20px;
                                            white-space: initial;
                                        }
                                    }
                                </style>

                                <section class="commission-container">
                                    <style>
                                        .region-container {
                                            display: flex;
                                            align-items: center;
                                            justify-content: space-between;
                                            margin-bottom: 20px;
                                            gap: 20px;
                                            height: 40px;
                                            padding: 10px 15px;
                                            border: 1px solid rgba(232, 231, 232, 1);
                                            border-radius: 3px;
                                            color: var(--707-b-93, #707b93);
                                        }

                                        .region-label {
                                            font-family: 'IBM Plex Mono', monospace;
                                        }

                                        .arrow-icon {
                                            width: 7px;
                                            margin: auto 0;
                                            fill: var(--071-c-31, #071c31);
                                            stroke: var(--071-c-31, #071c31);
                                            stroke-width: 0.3px;
                                        }
                                    </style>

{{--                                    <div class="select_drop">--}}
{{--                                        <section class="region-container select_drop_link">--}}
{{--                                            <span  class="region-label">Регион прохождени</span>--}}
{{--                                            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/cd76616d53facf229262a1d74a3dbfd273019f6c2e8507bddb4ec42dfcd7011b?apiKey=64de9059607140be8c9d5acd9f2dfd62&"--}}
{{--                                                 alt="Arrow icon" class="arrow-icon select_icon" loading="lazy" />--}}
{{--                                        </section>--}}
{{--                                        <div class="select_list" style="margin-top: -20px; width:237px;padding: 0;">--}}
{{--                                            <ul>--}}
{{--                                                @foreach($regions as $region)--}}
{{--                                                <li class="all_status">--}}
{{--                                                    <a wire:click.prevent="region({{$region->id}})" href="">{{$region->name}}</a>--}}
{{--                                                </li>--}}
{{--                                                @endforeach--}}

{{--                                            </ul>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="select_drop">
                                        <select class="region-container" wire:model="region" style="width: 100%;">
                                            <option class="region-label" value="">Регион прохождения</option>
                                            @foreach($regions as $region)
                                                <option class="all_status" value="{{ $region->id }}">{{ $region->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <header class="commission-header">
                                        <h3 class="commission-label">Комиссия</h3>
                                        <input type="date" wire:model="date_commission" class="commission-date"></input>
                                    </header>

                                    <div class="participation-cost">
                                        <p class="cost-label">Стоимость участия</p>
                                        <input type="text" wire:model="price" class="cost-value"
                                               style="text-align: center; width: 80px; height: 30px;"
                                               placeholder="1200">
                                    </div>

                                    <textarea class="address" wire:model="address" placeholder="адрес.."
                                              style="height: 100%;"></textarea>
                                </section>
                            </div>
                            <div class="tournament-add-column">
                                <input type="date" wire:model="date" class="date-container"></input>
                                <style>
                                    .date-container {
                                        display: flex;
                                        justify-content: center;
                                        align-items: center;
                                        border: 1px solid rgba(232, 231, 232, 1);
                                        border-radius: 3px;
                                        color: #071c31;
                                        font: 500 18px 'IBM Plex Mono', monospace;
                                        letter-spacing: 0.36px;
                                        padding: 9px 13px;
                                        white-space: nowrap;
                                    }

                                    @media (max-width: 991px) {
                                        .date-container {
                                            white-space: initial;
                                        }
                                    }
                                </style>
                            </div>
                        </div>
                        <div class="tournament-add-row">
                            <style>
                                .club-list {
                                    display: flex;
                                    margin-top: 13px;
                                    width: 100%;
                                    gap: 20px;
                                    font-weight: 500;
                                    justify-content: space-between;
                                    padding: 0 1px;
                                }

                                @media (max-width: 991px) {
                                    .club-list {
                                        max-width: 100%;
                                        flex-wrap: wrap;
                                    }
                                }

                                .club-list-items {
                                    display: flex;
                                    gap: 20px;
                                    font-size: 14px;
                                    color: #707b93;
                                    margin: auto 0;
                                }

                                @media (max-width: 991px) {
                                    .club-list-items {
                                        flex-wrap: wrap;
                                    }
                                }

                                .club-item {
                                    font-family: 'IBM Plex Mono', sans-serif;
                                    justify-content: center;
                                    border-radius: 5px;
                                    border: 1px solid rgba(232, 231, 232, 1);
                                    padding: 8px;
                                }

                                .add-club-btn {
                                    font-family: 'IBM Plex Mono', sans-serif;
                                    justify-content: center;
                                    border-radius: 5px;
                                    border: 1px solid rgba(232, 231, 232, 1);
                                    padding: 10px;
                                }

                                .save-btn {
                                    justify-content: center;
                                    border-radius: 5px;
                                    border: 1px solid rgba(232, 231, 232, 1);
                                    background-color: var(--accent, #095ec1);
                                    color: #fff;
                                    white-space: nowrap;
                                    padding: 10px 24px;
                                    font: 16px/150% 'IBM Plex Sans', sans-serif;
                                }
                            </style>

                            <section class="club-list">
                                <div class="club-list-items">
{{--                                    <span class="club-item">Спортивный клуб "Торнадо" х</span>--}}
{{--                                    <span class="club-item">Кекушин каратэ-до "Тигр" х</span>--}}
{{--                                    <button class="add-club-btn">+ добавить клуб</button>--}}
                                </div>
                                <button wire:click="$dispatch('openModal')" class="save-btn">Создать список</button>
                                <button wire:click="create" class="save-btn">Сохранить</button>
                            </section>
                        </div>
                    </div>
                    <div class="edit_cart block_mobile">
                        <style>
                            .tournament-scale10 {
                                display: flex;
                                align-items: center;
                                justify-content: space-between;
                                border: 1px solid rgba(232, 231, 232, 1);
                                border-radius: 2.25px;
                                padding: 3px 10px;
                                gap: 20px;
                                font-size: 12px;
                                color: #071c31;
                                font-weight: 400;
                            }

                            .tournament-scale-text10 {
                                font-family: 'IBM Plex Mono', sans-serif;
                            }

                            .tournament-scale-icon10 {
                                width: 6px;
                                fill: #071c31;
                            }

                            .tournament-name10 {
                                padding: 8px 10px;
                                margin-top: 16px;
                                color: #707b93;
                                font: 400 12px 'IBM Plex Mono', sans-serif;
                                border: 1px solid rgba(232, 231, 232, 1);
                                border-radius: 2.25px;
                                text-align: start;
                            }

                            .tournament-date10,
                            .tatami-count10 {
                                display: flex;
                                justify-content: space-between;
                                margin-top: 16px;
                                gap: 20px;
                                font-size: 12px;
                                color: #707b93;
                                font-weight: 400;
                            }

                            .tournament-date-label10,
                            .tatami-count-label10 {
                                font-family: 'IBM Plex Mono', sans-serif;
                                margin: auto 0;
                            }

                            .tournament-date-value10 {
                                font-family: 'IBM Plex Mono', sans-serif;
                                text-align: center;
                                border: 1px solid rgba(232, 231, 232, 1);
                                border-radius: 2.25px;
                                white-space: nowrap;
                                padding: 4px 5px;
                            }

                            .tatami-count-value10 {
                                font-family: 'IBM Plex Mono', sans-serif;
                                text-align: center;
                                border: 1px solid rgba(232, 231, 232, 1);
                                border-radius: 2.25px;
                                white-space: nowrap;
                                padding: 3px;
                            }

                            .third-place-match10 {
                                display: flex;
                                margin-top: 16px;
                                gap: 7px;
                                font-size: 12px;
                                color: #707b93;
                                font-weight: 400;
                                line-height: 150%;
                                padding: 5px 10px;
                            }

                            .third-place-match-checkbox10 {
                                width: 13px;
                                height: 12px;
                                padding: 8px;
                                border: 1px solid rgba(232, 231, 232, 1);
                                border-radius: 2.25px;
                                background-color: #fff;
                            }

                            .third-place-match-label10 {
                                font-family: 'IBM Plex Mono', sans-serif;
                                margin: auto 0;
                            }

                            .age-range10 {
                                display: flex;
                                justify-content: space-between;
                                margin-top: 16px;
                                width: 100%;
                                gap: 8px;
                                font-size: 12px;
                                font-weight: 400;
                            }

                            .age-from10,
                            .age-to10 {
                                display: flex;
                                justify-content: center;
                                gap: 9px;
                                padding: 0 1px;
                            }

                            .age-from-label10,
                            .age-to-label10 {
                                color: #707b93;
                                font-family: 'IBM Plex Mono', sans-serif;
                                flex-grow: 1;
                                margin: auto 0;
                            }

                            .age-from-value10 {
                                font-family: 'IBM Plex Mono', sans-serif;
                                text-align: center;
                                height: 30px;
                                border: 1px solid rgba(9, 94, 193, 1);
                                border-radius: 2.25px;
                                color: #071c31;
                                white-space: nowrap;
                                padding: 4px;
                            }

                            .age-to-value10 {
                                font-family: 'IBM Plex Mono', sans-serif;
                                text-align: center;
                                height: 30px;
                                border: 1px solid rgba(232, 231, 232, 1);
                                border-radius: 2.25px;
                                white-space: nowrap;
                                padding: 4px 3px;
                            }

                            .weight-range10 {
                                display: flex;
                                justify-content: space-between;
                                margin-top: 16px;
                                width: 100%;
                                gap: 15px;
                                font-size: 12px;
                                color: #707b93;
                                font-weight: 400;
                            }

                            .weight-from10,
                            .weight-to10 {
                                display: flex;
                                justify-content: center;
                                gap: 5px;
                                padding: 0 1px;
                            }

                            .weight-from-label10,
                            .weight-to-label10 {
                                font-family: 'IBM Plex Mono', sans-serif;
                                flex-grow: 1;
                                margin: auto 0;
                            }

                            .weight-from-value10,
                            .weight-to-value10 {
                                font-family: 'IBM Plex Mono', sans-serif;
                                text-align: center;
                                height: 30px;
                                border: 1px solid rgba(232, 231, 232, 1);
                                border-radius: 2.25px;
                                white-space: nowrap;
                                padding: 4px;
                            }

                            .kyu-range10 {
                                display: flex;
                                margin-top: 16px;
                                gap: 16px;
                            }

                            .kyu-to10,
                            .kyu-from10 {
                                display: flex;
                                gap: 7px;
                                flex: 1;
                            }

                            .kyu-to-icon10,
                            .kyu-from-icon10 {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                width: 13px;
                                height: 13px;
                                padding: 8px;
                                border: 1px solid rgba(232, 231, 232, 1);
                                border-radius: 2.25px;
                                background-color: #eafff2;
                            }

                            .kyu-to-icon10 img,
                            .kyu-from-icon10 img {
                                width: 13px;
                            }

                            .kyu-to-label10,
                            .kyu-from-label10 {
                                color: #707b93;
                                margin: auto 0;
                                font: 400 12px/150% 'IBM Plex Mono', -apple-system, Roboto, Helvetica, sans-serif;
                            }

                            .gender10 {
                                display: flex;
                                margin-top: 16px;
                                gap: 16px;
                            }

                            .male10,
                            .female10 {
                                display: flex;
                                gap: 7px;
                                flex: 1;
                            }

                            .male-icon10,
                            .female-icon10 {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                width: 13px;
                                height: 13px;
                                padding: 8px;
                                border: 1px solid rgba(232, 231, 232, 1);
                                border-radius: 2.25px;
                                background-color: #eafff2;
                            }

                            .male-icon img10,
                            .female-icon img10 {
                                width: 13px;
                            }

                            .male-label10,
                            .female-label10 {
                                color: #707b93;
                                margin: auto 0;
                                font: 400 12px/150% 'IBM Plex Mono', -apple-system, Roboto, Helvetica, sans-serif;
                            }

                            .region10 {
                                display: flex;
                                justify-content: space-between;
                                align-items: center;
                                margin-top: 16px;
                                padding: 3px 10px;
                                gap: 20px;
                                font-size: 12px;
                                color: #707b93;
                                font-weight: 400;
                                border: 1px solid rgba(232, 231, 232, 1);
                                border-radius: 2.25px;
                            }

                            .region-label10 {
                                font-family: 'IBM Plex Mono', sans-serif;
                            }

                            .region-icon10 {
                                width: 6px;
                                fill: #071c31;
                                stroke: #071c31;
                                stroke-width: 0.225px;
                            }

                            .commission-schedule10 {
                                display: flex;
                                justify-content: space-between;
                                margin-top: 16px;
                                gap: 20px;
                                font-size: 12px;
                                color: #707b93;
                                font-weight: 400;
                            }

                            .commission-schedule-label10 {
                                font-family: 'IBM Plex Mono', sans-serif;
                                margin: auto 0;
                            }

                            .commission-schedule-value10 {
                                font-family: 'IBM Plex Mono', sans-serif;
                                text-align: center;
                                border: 1px solid rgba(232, 231, 232, 1);
                                border-radius: 2.25px;
                                white-space: nowrap;
                                padding: 4px 5px;
                            }

                            .participation-cost10 {
                                display: flex;
                                justify-content: space-between;
                                margin-top: 16px;
                                padding: 0 1px;
                                gap: 20px;
                                color: #707b93;
                                font-weight: 400;
                            }

                            .participation-cost-label10 {
                                margin: auto 0;
                                font: 12px 'IBM Plex Mono', sans-serif;
                            }

                            .participation-cost-value10 {
                                text-align: center;
                                border: 1px solid rgba(232, 231, 232, 1);
                                border-radius: 2.25px;
                                white-space: nowrap;
                                padding: 2px 5px;
                                font: 14px 'IBM Plex Mono', sans-serif;
                            }

                            .address10 {
                                margin-top: 16px;
                                padding: 5px 10px;
                                height: 50px;
                                color: #707b93;
                                font: 400 12px 'IBM Plex Mono', sans-serif;
                                text-align: start;
                                border: 1px solid rgba(232, 231, 232, 1);
                                border-radius: 2.25px;
                                white-space: nowrap;
                            }
                        </style>

                        <div style="display: flex; gap: 20px;">
                            <svg width="45" height="45" viewBox="0 0 45 45" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_8002_7660)">
                                    <path
                                            d="M22.5 45C34.9265 45 45 34.9265 45 22.5C45 10.0735 34.9265 0 22.5 0C10.0735 0 0 10.0735 0 22.5C0 34.9265 10.0735 45 22.5 45Z"
                                            fill="#DEEEFF" />
                                    <path
                                            d="M28.0314 14.5777C28.8068 15.6281 29.1945 16.7537 29.1945 17.9542C29.1945 18.8046 29.0069 19.5674 28.6317 20.2428C28.2566 20.9181 27.6688 21.6809 26.8684 22.5313C26.1681 23.2566 25.6554 23.9445 25.3302 24.5948C25.0051 25.22 24.7925 25.8078 24.6924 26.3581C24.6174 26.8833 24.5298 27.7212 24.4298 28.8717C24.4298 29.447 24.2297 29.8722 23.8295 30.1473C23.4293 30.3974 23.0166 30.5225 22.5914 30.5225C21.4659 30.5225 20.9032 29.8472 20.9032 28.4966C20.9032 27.7712 21.0282 26.9083 21.2783 25.9079C21.5285 24.9074 21.9912 23.8194 22.6665 22.6439C22.8916 22.2437 23.1792 21.8435 23.5294 21.4433C23.9046 21.0431 24.1422 20.7805 24.2422 20.6554C24.6424 20.2303 24.98 19.7926 25.2552 19.3423C25.5303 18.8671 25.6679 18.4544 25.6679 18.1043C25.6679 17.7041 25.6053 17.3914 25.4803 17.1663C25.3802 16.9412 25.2177 16.6911 24.9926 16.416C24.6674 16.0408 24.2422 15.7407 23.717 15.5156C23.1917 15.2905 22.704 15.1779 22.2538 15.1779C21.5285 15.1779 20.8532 15.3155 20.2279 15.5906C19.6276 15.8407 19.1399 16.1784 18.7647 16.6036C18.4145 17.0038 18.2394 17.4165 18.2394 17.8417C18.2394 18.542 18.377 19.0672 18.6521 19.4174C18.9273 19.7425 19.0648 20.0427 19.0648 20.3178C19.0648 20.4679 19.0273 20.6429 18.9523 20.843C18.6521 21.5434 18.1394 21.8935 17.4141 21.8935C16.4886 21.8935 15.8133 21.5434 15.3881 20.843C14.9629 20.1427 14.7503 19.2548 14.7503 18.1793C14.7503 17.1538 15.0755 16.1784 15.7258 15.253C16.3761 14.3025 17.3265 13.5272 18.5771 12.9269C19.8277 12.3266 21.3159 12.0265 23.0417 12.0265C24.0421 12.0265 24.98 12.2516 25.8554 12.7018C26.7309 13.127 27.4562 13.7523 28.0314 14.5777ZM22.5914 31.9481C23.3418 31.9481 23.9421 32.2108 24.3923 32.736C24.7674 33.1112 24.955 33.6239 24.955 34.2742C24.955 34.8245 24.6924 35.2872 24.1672 35.6623C23.6419 36.0125 23.0667 36.1876 22.4414 36.1876C21.9912 36.1876 21.5535 36.0625 21.1283 35.8124C20.603 35.4372 20.3404 34.7744 20.3404 33.824C20.3404 33.3238 20.5655 32.8861 21.0157 32.5109C21.4909 32.1357 22.0162 31.9481 22.5914 31.9481Z"
                                            fill="#095EC1" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_8002_7660">
                                        <rect width="45" height="45" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>


                            <div>
{{--                                <div class="tournament-scale10">--}}
                                <div class="select_drop" style="margin-top: 16px;">
                                    <select class="region-container" wire:model="scale" style="width: 100%; margin-bottom: 0px">
                                        <option value="">Выберите масштаб</option>
                                        @foreach($scales as $scale)
                                            <option class="tournament-scale" value="{{ $scale->id }}">{{ $scale->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

{{--                                </div>--}}
                                <input class="tournament-name10" style="width: 100%" placeholder="Hазваниие турнира"></input>
                                <div class="tournament-date10">
                                    <div class="tournament-date-label10">Дата турнира</div>
                                    <input type="date" placeholder="2024-11-03" class="tournament-date-value10"></input>
                                </div>
                                <div class="tatami-count10">
                                    <div class="tatami-count-label10">Колличество татами</div>
                                    <input placeholder="22" style="width: 30px;" class="tatami-count-value10"></input>
                                </div>
                                <div class="third-place-match10">
                                    <label for="input12" class="region-checkbox">
                                        <input type="checkbox" class="region-input" id="input12">
                                        <span></span>
                                    </label>
                                    <div class="third-place-match-label10">Бой за третье место</div>
                                </div>
                                <div class="age-range10">
                                    <div class="age-from10">
                                        <div class="age-from-label10">Возраст от</div>
                                        <input style="width: 30px;" placeholder="12" class="age-from-value10"></input>
                                    </div>
                                    <div class="age-to10">
                                        <div class="age-to-label10">и до</div>
                                        <input style="width: 30px" placeholder="13" class="age-to-value10"></input>
                                    </div>
                                </div>
                                <div class="weight-range10">
                                    <div class="weight-from10">
                                        <div class="weight-from-label10">Вес от</div>
                                        <input placeholder="66" style="width: 30px" class="weight-from-value10"></input>
                                    </div>
                                    <div class="weight-to10">
                                        <div class="weight-to-label10">и до</div>
                                        <input placeholder="80" style="width: 30px" class="weight-to-value10"></input>
                                    </div>
                                </div>
                                <div class="kyu-range10">
                                    <div class="kyu-to10">
                                        <label for="input123" class="region-checkbox">
                                            <input type="checkbox" class="region-input" id="input123">
                                            <span></span>
                                        </label>
                                        <div class="kyu-to-label10">КЮ до 8</div>
                                    </div>
                                    <div class="kyu-from10">
                                        <label for="input126" class="region-checkbox">
                                            <input type="checkbox" class="region-input" id="input126">
                                            <span></span>
                                        </label>
                                        <div class="kyu-from-label10">КЮ от 8</div>
                                    </div>
                                </div>
{{--                                <div class="gender10">--}}
{{--                                    <div class="male10">--}}
{{--                                        <label for="input125" class="region-checkbox">--}}
{{--                                            <input type="checkbox" class="region-input" id="input125">--}}
{{--                                            <span></span>--}}
{{--                                        </label>--}}
{{--                                        <div class="male-label10">Мужской</div>--}}
{{--                                    </div>--}}
{{--                                    <div class="female10">--}}
{{--                                        <label for="input124" class="region-checkbox">--}}
{{--                                            <input type="checkbox" class="region-input" id="input124">--}}
{{--                                            <span></span>--}}
{{--                                        </label>--}}
{{--                                        <div class="female-label10">Женский</div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="">
{{--                                    <div class="region10 ">--}}
                                        <div class="select_drop" style="margin-top: 16px">
                                            <select class="region-container" wire:model="region" style="width: 100%;">
                                                <option class="region-label" value="">Регион прохождения</option>
                                                @foreach($regions as $region)
                                                    <option class="all_status" value="{{ $region->id }}">{{ $region->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
{{--                                    </div>--}}
                                </div>
                                <div class="commission-schedule10">
                                    <div class="commission-schedule-label10">Расписание коммисии</div>
                                    <input type="date" placeholder="2024-11-03" class="commission-schedule-value10"></input>
                                </div>
                                <div class="participation-cost10">
                                    <div class="participation-cost-label10">Стоимость участия</div>
                                    <input placeholder="1200" class="participation-cost-value10"></input>
                                </div>
                                <input placeholder="адрес.." style="width: 100%;" class="address10"></input>
                            </div>
                        </div>
                        <a href="#" class="tournament-button1">Сохранить</a>
                    </div>
                </div>
            </div>


        </section>
<livewire:create-list-modal />

    </main>

</div>
