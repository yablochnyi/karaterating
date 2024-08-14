<div>
    <main class="main">
        <div class="container container_profi">
            <div class="profile-wrapper">
                <div class="profile-image-box">
                    <div class="profile-image-column">
                        <div class="sensei-card">
                            <div class="sensei-card__header">
                                {{--                                <img src="{{asset('storage/' . $student->avatar)}}"--}}
                                <img src="{{asset('assets/img/ava_boy.png')}}"
                                     alt="Sensei character" class="sensei-card__background-image"/>
                                {{--                                <div class="sensei-card-item sensei-card__name">Сенсей</div>--}}

                                <div class="sensei-card-item sensei-card__level">{{$student->ky}}</div>
                            </div>
                            @php
                                function getColorForLevel($level) {
    // Карта цветов для уровней кю и дан
    $colors = [
    'кю' => [
        0 => '#FFFFFF', // 0 кю - белый
        10 => '#FF7F00', // 10 кю - оранжевый
        9 => '#FF7F00', // 9 кю - оранжевый
        8 => '#0000FF', // 8 кю - синий
        7 => '#0000FF', // 7 кю - синий
        6 => '#FFD700', // 6 кю - желтый
        5 => '#FFD700', // 5 кю - желтый
        4 => '#00FF00', // 4 кю - зеленый
        3 => '#00FF00', // 3 кю - зеленый
        2 => '#8B4513', // 2 кю - коричневый
        1 => '#8B4513', // 1 кю - коричневый
    ],
    'дан' => [
        1 => '#000000', // 1 дан - черный
        2 => '#000000', // 2 дан - черный
        3 => '#000000', // 3 дан - черный
        4 => '#000000', // 4 дан - черный
        5 => '#000000', // 5 дан - черный
        6 => '#000000', // 6 дан - черный
        7 => '#000000', // 7 дан - черный
        8 => '#000000', // 8 дан - черный
        9 => '#000000', // 9 дан - черный
        10 => '#000000' // 10 дан - черный
    ]
];
    // Разделяем строку на номер и тип
    list($number, $type) = explode(' ', $level);

    // Преобразуем номер в целое число
    $number = (int) $number;

    // Приводим тип к нижнему регистру для совместимости
    $type = strtolower($type);

    // Возвращаем соответствующий цвет, если он существует
    return $colors[$type][$number] ?? $colors['дан'];
}

                                function getStripeColorForLevel($level) {
    // Цвета полосок для уровней кю и дан
    $stripeColors = [
        'кю' => [
            0 => [],
            10 => [],
            9 => ['#0000FF'],
            8 => [],
            7 => ['#FFD700'],
            6 => [],
            5 => ['#00FF00'],
            4 => [],
            3 => ['#8B4513'],
            2 => [],
            1 => ['#FFD700'],
        ],
        'дан' => [
            1 => ['#FFD700'],
            2 => ['#FFD700', '#FFD700'],
            3 => ['#FFD700', '#FFD700', '#FFD700'],
            4 => ['#FFD700', '#FFD700', '#FFD700', '#FFD700'],
            5 => ['#FFD700', '#FFD700', '#FFD700', '#FFD700', '#FFD700'],
            6 => ['#FFD700', '#FFD700', '#FFD700', '#FFD700', '#FFD700', '#FFD700'],
            7 => ['#FFD700', '#FFD700', '#FFD700', '#FFD700', '#FFD700', '#FFD700', '#FFD700'],
            8 => ['#FFD700', '#FFD700', '#FFD700', '#FFD700', '#FFD700', '#FFD700', '#FFD700', '#FFD700'],
            9 => ['#FFD700', '#FFD700', '#FFD700', '#FFD700', '#FFD700', '#FFD700', '#FFD700', '#FFD700', '#FFD700'],
            10 => ['#FFD700', '#FFD700', '#FFD700', '#FFD700', '#FFD700', '#FFD700', '#FFD700', '#FFD700', '#FFD700', '#FFD700'],
        ],
    ];

    // Разделяем строку на номер и тип
    list($number, $type) = explode(' ', $level);

    // Преобразуем номер в целое число
    $number = (int) $number;

    // Приводим тип к нижнему регистру для совместимости
    $type = strtolower($type);

    // Возвращаем цвета полосок, если они существуют
    return $stripeColors[$type][$number] ?? [];
}
                            @endphp

                            <div class="belt" style="background-color: {{ getColorForLevel($student->ky) }};">
                                @foreach(getStripeColorForLevel($student->ky) as $stripeColor)
                                    <div class="belt-stripe" style="background-color: {{ $stripeColor }};"></div>
                                @endforeach
                            </div>

                            <style>
                                .belt {
                                    width: 100%; /* Ширина пояса */
                                    height: 20px; /* Высота пояса */
                                    margin: 5px 0; /* Отступы */
                                    position: relative; /* Для позиционирования полосок */
                                    text-align: center; /* Текст по центру */
                                    line-height: 20px; /* Высота строки для центрирования текста */

                                }

                                .belt-stripe {
                                    position: absolute; /* Для вертикального позиционирования полосок */
                                    top: 0;
                                    bottom: 0;
                                    width: 3px; /* Ширина полоски */
                                }

                                .belt-stripe:nth-child(1) {
                                    left: 5%;
                                }

                                .belt-stripe:nth-child(2) {
                                    left: 10%;
                                }

                                .belt-stripe:nth-child(3) {
                                    left: 15%;
                                }

                                .belt-stripe:nth-child(4) {
                                    left: 20%;
                                }

                                .belt-stripe:nth-child(5) {
                                    left: 25%;
                                }

                                .belt-stripe:nth-child(6) {
                                    left: 30%;
                                }

                                .belt-stripe:nth-child(7) {
                                    left: 35%;
                                }

                                .belt-stripe:nth-child(8) {
                                    left: 40%;
                                }

                                .belt-stripe:nth-child(9) {
                                    left: 45%;
                                }

                                .belt-stripe:nth-child(10) {
                                    left: 50%;
                                }


                            </style>


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
                                @if($isEditing)
                                    <span>
                                    <input type="number" wire:model="weight" min="0" style="width: 40px;"/>
                                    <button wire:click="saveWeight"
                                            style="border: none; background: none; cursor: pointer;">
                                        <img src="{{ asset('assets/img/icons/check.svg') }}" alt="Сохранить"
                                             style="width: 20px; height: 20px;">
                                    </button>
                                        </span>
                                @else
                                    <span>{{ $weight }} кг
                                    @if($student->coach_id == Auth::id())
                                            <img src="{{ asset('assets/img/edit.png') }}" alt="Редактировать"
                                                 wire:click="editWeight"
                                                 style="width: 15px; height: 15px; cursor: pointer;">
                                        @endif
                                </span>
                                @endif
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
                                <div class="profile-info-value">
                                    @if($isEditing)
                                        <input type="number" wire:model="weight" min="0" style="width: 60px;"/>
                                        <button wire:click="saveWeight"
                                                style="border: none; background: none; cursor: pointer;">
                                            <img src="{{ asset('assets/img/icons/check.svg') }}" alt="Сохранить"
                                                 style="width: 20px; height: 20px;">
                                        </button>
                                    @else
                                        {{ $weight }} кг
                                        @if($student->coach_id == Auth::id())
                                            <img src="{{ asset('assets/img/edit.png') }}" alt="Редактировать"
                                                 wire:click="editWeight"
                                                 style="width: 15px; height: 15px; cursor: pointer;">
                                        @endif
                                    @endif
                                </div>
                            </div>

                            <div class="profile-info-item">
                                <div class="profile-info-label">Тренер</div>
                                <div
                                    class="profile-info-value profile-info-link">{{$coach->first_name . ' ' . $coach->last_name}}</div>
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

                    <hr class="divider"/>

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
            <style>
                .documents-container {
                    display: flex;
                    flex-direction: column;
                    margin-top: 37px;
                }

                .block_mobile {
                    display: none;
                }

                @media(max-width: 800px) {

                    .name-gender-container1 {
                        gap: 16px;
                    }

                    .gender-icon1 {
                        width: 10px;
                        height: 10px;
                    }

                    .gender-label1 {
                        font-size: 12px;
                    }

                    .gender-icon-wrapper1 {
                        margin-top: 4px;
                        padding: 0 17px;
                    }

                    .surname-label1 {
                        margin-top: 5px;
                        font-size: 12px;
                    }

                    .name-label1 {
                        font-size: 12px;
                    }

                    .name-value1 {
                        margin-top: 4px;
                        padding: 3.5px 10px;
                        font-size: 12px;
                    }

                    .profile-details-column1 {
                        margin-left: 0;
                    }

                    .block_mobile {
                        display: block;
                    }

                    .none_mobile {
                        display: none;
                    }

                    .documents-container {
                        margin-top: 10px;
                    }
                }

                .documents-title {
                    width: 100%;
                    border-bottom: 1px solid rgba(232, 231, 232, 1);
                    color: #707b93;
                    letter-spacing: 0.48px;
                    justify-content: center;
                    padding: 0 20px;
                    font: 500 24px/42px IBM Plex Mono, -apple-system, Roboto, Helvetica, sans-serif;
                }

                @media (max-width: 800px) {
                    .documents-title {
                        max-width: 100%;
                        padding: 0;
                    }
                }

                .documents-grid {
                    margin-top: 33px;
                    width: 100%;
                }

                @media (max-width: 800px) {
                    .documents-grid {
                        max-width: 100%;
                        margin-top: 16px;
                    }
                }

                .documents-row {
                    gap: 20px;
                    display: flex;
                    justify-content: space-between;
                }

                @media (max-width: 800px) {
                    .documents-row {
                        flex-wrap: wrap;

                    }
                }

                .document-item {
                    display: flex;
                    flex-direction: column;
                    line-height: normal;
                    width: 25%;
                    margin-left: 0px;
                }

                @media (max-width: 800px) {
                    .document-item {
                        width: 46%;
                    }
                }

                .document-content {
                    display: flex;
                    flex-grow: 1;
                    flex-direction: column;
                }

                @media (max-width: 800px) {
                    .document-content {
                        margin-top: 20px;
                    }
                }

                .document-name {
                    color: var(--071-c-31, #071c31);
                    font: 500 14px/130% IBM Plex Mono, -apple-system, Roboto, Helvetica, sans-serif;
                }

                .document-image-wrapper {
                    justify-content: center;
                    align-items: center;
                    border-radius: 5px;
                    border: 2px solid rgba(232, 231, 232, 1);
                    background-color: #fbfafb;
                    display: flex;
                    margin-top: 18px;
                    padding: 10px 20px;
                    height: 240px;
                }

                .document-image {
                    aspect-ratio: 1;
                    object-fit: auto;
                    object-position: center;
                    width: 90px;
                }

                .agreement-container {
                    display: flex;
                    gap: 10px;
                    margin: 33px 0 0 0;
                }

                .agreement-checkbox {
                    justify-content: center;
                    align-items: center;
                    border-radius: 5px;
                    border: 2px solid rgba(232, 231, 232, 1);
                    background-color: #eafff2;
                    display: flex;
                    width: 25px;
                    height: 25px;
                    padding: 15px;
                }

                .agreement-checkbox-icon {
                    aspect-ratio: 1;
                    object-fit: auto;
                    object-position: center;
                    width: 25px;
                }

                .agreement-text {

                    margin: auto 0;
                    font: 500 14px/24px IBM Plex Mono, -apple-system, Roboto, Helvetica, sans-serif;
                }

                .agreement-text a {
                    color: #095ec1;
                }

                @media (max-width: 800px) {
                    .agreement-text {
                        max-width: 100%;
                    }
                }

                .agreement-link {
                    color: rgba(9, 94, 193, 1);
                }

                .visually-hidden {
                    position: absolute;
                    width: 1px;
                    height: 1px;
                    padding: 0;
                    margin: -1px;
                    overflow: hidden;
                    clip: rect(0, 0, 0, 0);
                    white-space: nowrap;
                    border: 0;
                }
            </style>
            @if($student->coach_id == \Illuminate\Support\Facades\Auth::id() || $coachBelongsToOrganizer)
            <section class="documents-container">
                <h2 class="documents-title">Документы</h2>
                <div class="documents-grid">
                    <div class="documents-row">
                        <div class="document-item">
                            <div class="document-content">
                                <h3 class="document-name">Паспорт</h3>
                                @if($student->passport)
                                    <div class="document-image-wrapper">
                                        <a data-fancybox="gallery" href="{{ asset('storage/' . $student->passport) }}" data-caption="Паспорт">
                                            <img src="{{ asset('storage/' . $student->passport) }}" style="width: 100%; height: 100%; cursor: pointer;" alt="Profile Image" class="document-image" loading="lazy" />
                                        </a>
                                    </div>
                                @else
                                    <div class="document-image-wrapper">
                                        <a data-fancybox="gallery" href="{{ asset('assets/img/prof-im.svg') }}" data-caption="Нет изображения">
                                            <img src="{{ asset('assets/img/prof-im.svg') }}" alt="Profile Image" class="document-image" loading="lazy" style="cursor: pointer;" />
                                        </a>
                                    </div>
                                @endif

                            </div>
                        </div>
                        <div class="document-item">
                            <div class="document-content">
                                <h3 class="document-name">Марка</h3>
                                @if($student->brand)
                                    <div class="document-image-wrapper">
                                        <a data-fancybox="gallery" href="{{ asset('storage/' . $student->brand) }}" data-caption="Марка">
                                            <img src="{{ asset('storage/' . $student->brand) }}" style="width: 100%; height: 100%; cursor: pointer;" alt="Profile Image" class="document-image" loading="lazy" />
                                        </a>
                                    </div>
                                @else
                                    <div class="document-image-wrapper">
                                        <a data-fancybox="gallery" href="{{ asset('assets/img/prof-im.svg') }}" data-caption="Нет изображения">
                                            <img src="{{ asset('assets/img/prof-im.svg') }}" alt="Profile Image" class="document-image" loading="lazy" style="cursor: pointer;" />
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="document-item">
                            <div class="document-content">
                                <h3 class="document-name">Страховка</h3>
                                @if($student->insurance)
                                    <div class="document-image-wrapper">
                                        <a data-fancybox="gallery" href="{{ asset('storage/' . $student->insurance) }}" data-caption="Страховка">
                                            <img src="{{ asset('storage/' . $student->insurance) }}" style="width: 100%; height: 100%; cursor: pointer;" alt="Profile Image" class="document-image" loading="lazy" />
                                        </a>
                                    </div>
                                @else
                                    <div class="document-image-wrapper">
                                        <a data-fancybox="gallery" href="{{ asset('assets/img/prof-im.svg') }}" data-caption="Нет изображения">
                                            <img src="{{ asset('assets/img/prof-im.svg') }}" alt="Profile Image" class="document-image" loading="lazy" style="cursor: pointer;" />
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="document-item">
                            <div class="document-content">
                                <h3 class="document-name">Карта IKO</h3>
                                @if($student->iko_card)
                                    <div class="document-image-wrapper">
                                        <a data-fancybox="gallery" href="{{ asset('storage/' . $student->iko_card) }}" data-caption="Карта IKO">
                                            <img src="{{ asset('storage/' . $student->iko_card) }}" style="width: 100%; height: 100%; cursor: pointer;" alt="Profile Image" class="document-image" loading="lazy" />
                                        </a>
                                    </div>
                                @else
                                    <div class="document-image-wrapper">
                                        <a data-fancybox="gallery" href="{{ asset('assets/img/prof-im.svg') }}" data-caption="Нет изображения">
                                            <img src="{{ asset('assets/img/prof-im.svg') }}" alt="Profile Image" class="document-image" loading="lazy" style="cursor: pointer;" />
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            @endif
{{--            <div class="profi_tabel_box">--}}
{{--                <div class="profi_tabel_title">Прошедшие турниры</div>--}}
{{--                <div class="profi_tabel">--}}
{{--                    <ul class="profi_tabel_head">--}}
{{--                        <li>Турнир</li>--}}
{{--                        <li>Дата</li>--}}
{{--                        <li>Рейтинг</li>--}}
{{--                    </ul>--}}
{{--                    <ul class="profi_tabel_body">--}}
{{--                        <li><a class="link_nav" href="puli_tour.html">Наименование турнира</a></li>--}}
{{--                        <li class="gray_text_mobile">24.04.2024</li>--}}
{{--                        <li>--}}
{{--                            <div class="profi_rang">--}}
{{--                                <span>+22</span>--}}
{{--                                <svg width="20" height="21" viewBox="0 0 20 21" fill="none"--}}
{{--                                     xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <rect x="0.75" y="1.25" width="18.5" height="18.5" rx="9.25" fill="#FFC803"--}}
{{--                                          stroke="#071C31" stroke-width="1.5"/>--}}
{{--                                </svg>--}}
{{--                            </div>--}}

{{--                        </li>--}}
{{--                    </ul>--}}
{{--                    <ul class="profi_tabel_body">--}}
{{--                        <li><a class="link_nav" href="puli_tour.html">Наименование турнира</a></li>--}}
{{--                        <li class="gray_text_mobile">24.04.2024</li>--}}
{{--                        <li style="padding-right: 25px;">-18</li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </main>
</div>
