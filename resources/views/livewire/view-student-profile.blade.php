<div>
    <main class="main">
        <div class="container container_profi">
            <div class="profile-wrapper">
                <div class="profile-image-box">
                    <div class="profile-image-column">
                        <div class="sensei-card">
                            <div class="sensei-card__header">
                                <img src="{{asset('storage/' . $student->avatar)}}"
                                     alt="Sensei character" class="sensei-card__background-image" />
{{--                                <div class="sensei-card-item sensei-card__name">Сенсей</div>--}}

                                <div class="sensei-card-item sensei-card__level">{{$student->ky}}</div>
                            </div>
                            <img src="{{asset('assets/img/sensei-card.png' )}}"
                                 alt="Sensei character portrait" class="sensei-card__portrait" />
                        </div>

                    </div>
                    <div class="profi_name">
{{--                        <div class="profile_balance">--}}
{{--                                <span>--}}
{{--                                    Баланс <br>--}}
{{--                                    <strong>2,854руб.</strong>--}}
{{--                                </span>--}}
{{--                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"--}}
{{--                                 xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path d="M9 3.75V14.25M3.75 9H14.25" stroke="#071C31" stroke-width="1.4"--}}
{{--                                      stroke-linecap="round" stroke-linejoin="round" />--}}
{{--                            </svg>--}}

{{--                        </div>--}}
                        <span>
                                {{$student->first_name}} <br>
                                {{$student->last_name}}
                            </span>
                        <div class="age_mobile_profi">
                            <div class="age_mobile_profi_block">
                                Возраст<br>
                                <span>{{$student->age}} лет</span>
                            </div>
                            <div class="age_mobile_profi_block">
                                Вес<br>
                                <span>{{$student->weight}}кг</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-details-column">
                    <div class="profile-details-wrapper">
                        <div class="profile_name">
                                <span>
                                    {{$student->first_name}} <br>
                                {{$student->last_name}}
                                </span>
{{--                            <div class="profile_balance">--}}
{{--                                    <span>--}}
{{--                                        Баланс <br>--}}
{{--                                        <strong>2, 854 руб.</strong>--}}
{{--                                    </span>--}}
{{--                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"--}}
{{--                                     xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <path d="M9 3.75V14.25M3.75 9H14.25" stroke="#071C31" stroke-width="1.4"--}}
{{--                                          stroke-linecap="round" stroke-linejoin="round" />--}}
{{--                                </svg>--}}


{{--                            </div>--}}
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-item">
                                <div class="profile-info-label">Возраст</div>
                                <div class="profile-info-value">{{$student->age}} лет</div>
                            </div>
                            <div class="profile-info-item">
                                <div class="profile-info-label">Вес</div>
                                <div class="profile-info-value">{{$student->weight}}кг</div>
                            </div>
                            <div class="profile-info-item">
                                <div class="profile-info-label">Тренер</div>
                                <div class="profile-info-value profile-info-link">{{$coach->first_name . ' ' . $coach->last_name}}</div>
                            </div>
                            <div class="profile-info-item">
                                <div class="profile-info-label">Клуб</div>
                                <div class="profile-info-value profile-info-link">{{$coach->club}}</div>
                            </div>
                        </div>
                        <div class="profile-stats-row">
                            <div class="profile-stats-item">
                                <div class="profile-stats-label">Рейтинг</div>
                                <div class="profile-stats-value">0</div>
                            </div>
                            <div class="profile-stats-item">
                                <div class="profile-stats-label">Золото</div>
                                <div class="profile-stats-icon-wrapper">
                                    <div class="profile-stats-icon profile-stats-icon-gold"></div>
                                    <div class="profile-stats-icon-text">0</div>
                                </div>
                            </div>
                            <div class="profile-stats-item">
                                <div class="profile-stats-label">Серебро</div>
                                <div class="profile-stats-icon-wrapper">
                                    <div class="profile-stats-icon profile-stats-icon-silver"></div>
                                    <div class="profile-stats-icon-text">0</div>
                                </div>
                            </div>
                            <div class="profile-stats-item">
                                <div class="profile-stats-label">Бронза</div>
                                <div class="profile-stats-icon-wrapper">
                                    <div class="profile-stats-icon profile-stats-icon-bronze"></div>
                                    <div class="profile-stats-icon-text">0</div>
                                </div>
                            </div>
                            <div class="profile-stats-record">
                                <div class="profile-stats-label">Победы/Поражения</div>
                                <div class="profile-info-value">0 / 0</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-details-column-mobile">
                    <style>
                        .club-name {
                            color: #707b93;
                            font-family: 'IBM Plex Mono', sans-serif;
                            font-weight: 400;
                        }

                        .club-value {
                            color: #095ec1;
                            font-family: 'IBM Plex Mono', sans-serif;
                            font-weight: 500;
                            letter-spacing: 0.24px;
                            margin-top: 6px;
                        }

                        .coach-label {
                            color: #707b93;
                            font-family: 'IBM Plex Mono', sans-serif;
                            font-weight: 400;
                        }

                        .coach-name {
                            color: #095ec1;
                            font-family: 'IBM Plex Mono', sans-serif;
                            font-weight: 500;
                            letter-spacing: 0.24px;
                            margin-top: 6px;
                        }

                        .divider {
                            border: 1px solid #e8e7e8;
                            background-color: #e8e7e8;
                            min-height: 1px;
                            margin-top: 15px;
                            width: 100%;
                        }

                        .rating-label {
                            color: #707b93;
                            font-family: 'IBM Plex Mono', sans-serif;
                            font-weight: 400;
                        }

                        .rating-value {
                            color: #071c31;
                            font-family: 'IBM Plex Mono', sans-serif;
                            font-weight: 500;
                            letter-spacing: 0.24px;
                            margin-top: 13px;
                        }

                        .record-label {
                            color: #707b93;
                            font-family: 'IBM Plex Mono', sans-serif;
                            font-weight: 400;
                        }

                        .record-value {
                            color: #071c31;
                            font-family: 'IBM Plex Mono', sans-serif;
                            font-weight: 500;
                            letter-spacing: 0.24px;
                            margin-top: 8px;
                        }

                        .medal-label {
                            color: #707b93;
                            font-family: 'IBM Plex Mono', sans-serif;
                            font-weight: 400;
                        }

                        .medal-count {
                            color: #071c31;
                            font-weight: 500;
                            letter-spacing: 0.24px;
                            font-family: 'IBM Plex Mono', sans-serif;
                            margin: auto 0;
                        }

                        .gold-medal {
                            border-radius: 20px;
                            border: 1px solid #071c31;
                            background-color: #ffc803;
                            width: 15px;
                            height: 15px;
                        }

                        .silver-medal {
                            border-radius: 20px;
                            border: 1px solid #071c31;
                            background-color: #c5e0e5;
                            width: 15px;
                            height: 15px;
                        }

                        .bronze-medal {
                            border-radius: 20px;
                            border: 1px solid #071c31;
                            background-color: #e97706;
                            width: 15px;
                            height: 15px;
                        }
                    </style>

                    <header class="athlete-header">
                        <div class="club-info">
                            <p class="club-name">Клуб</p>
                            <p class="club-value">{{$coach->club}}</p>
                        </div>
                        <div class="coach-info">
                            <p class="coach-label">Тренер</p>
                            <p class="coach-name">{{$coach->first_name . ' ' . $coach->last_name}}</p>
                        </div>
                    </header>

                    <hr class="divider" />

                    <section class="athlete-stats">
                        <div class="rating-info">
                            <p class="rating-label">Общий рейтинг</p>
                            <p class="rating-value">0</p>
                        </div>
                        <div class="record-info">
                            <p class="record-label">Победы/Поражения</p>
                            <p class="record-value">0 / 0</p>
                        </div>
                    </section>

                    <section class="medal-stats">
                        <div class="gold-info">
                            <p class="medal-label">Золото</p>
                            <div class="medal-wrapper">
                                <span class="gold-medal"></span>
                                <span class="medal-count">0</span>
                            </div>
                        </div>
                        <div class="silver-info">
                            <p class="medal-label">Серебро</p>
                            <div class="medal-wrapper">
                                <span class="silver-medal"></span>
                                <span class="medal-count">0</span>
                            </div>
                        </div>
                        <div class="bronze-info">
                            <p class="medal-label">Бронза</p>
                            <div class="medal-wrapper">
                                <span class="bronze-medal"></span>
                                <span class="medal-count">0</span>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <div class="profi_tabel_box">
                <div class="profi_tabel_title">Прошедшие турниры</div>
                <div class="profi_tabel">
                    <ul class="profi_tabel_head">
                        <li>Турнир</li>
                        <li>Дата</li>
                        <li>Рейтинг</li>
                    </ul>
                    <ul class="profi_tabel_body">
                        <li><a class="link_nav" href="puli_tour.html">Наименование турнира</a></li>
                        <li class="gray_text_mobile">24.04.2024</li>
                        <li>
                            <div class="profi_rang">
                                <span>+22</span>
                                <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <rect x="0.75" y="1.25" width="18.5" height="18.5" rx="9.25" fill="#FFC803"
                                          stroke="#071C31" stroke-width="1.5" />
                                </svg>
                            </div>

                        </li>
                    </ul>
                    <ul class="profi_tabel_body">
                        <li ><a class="link_nav" href="puli_tour.html">Наименование турнира</a></li>
                        <li class="gray_text_mobile">24.04.2024</li>
                        <li style="padding-right: 25px;">-18</li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
</div>
