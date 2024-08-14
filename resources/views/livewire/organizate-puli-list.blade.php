<div>
    <main class="main_puli">
        <div class="nav_puli_box nav_puli_active" id="nav_puli">

            <div class="puli__container" wire:ignore>
                @foreach($tournament->lists as $list)
                    <div id="match" class="match" wire:click="loadStudents({{ $list->id }})">
                        <div class="match-number">{{ $list->name }}</div>
                        <!--<div class="match-location">Tатами №12</div>-->
                        <div class="match-details">
{{--                            @if($list->gender == 'male')--}}
{{--                                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/723f7d46cf93b41d46da476445cf5450caa752bc04925033d919e9cdba54e058?apiKey=64de9059607140be8c9d5acd9f2dfd62&"--}}
{{--                                     alt="" class="match-icon" />--}}
{{--                            @else--}}
{{--                                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/ae6c2b2ef1f1568aa83ce38ac287ee9ba7e60006c81e2ac784cbd9d9e72c04c4?apiKey=64de9059607140be8c9d5acd9f2dfd62&"--}}
{{--                                     alt="" class="match-icon" />--}}
{{--                            @endif--}}
                            <div class="match-info">{{ $list->age_from }}-{{ $list->age_to }} • {{ $list->weight_from }}-{{ $list->weight_to }}кг</div>
                            <button class="edit-button" wire:click.prevent="editMatchDetails({{ $list->id }})">
                                <i class="fas fa-edit">
                                </i>
                            </button>
                        </div>
                    </div>
                @endforeach


                <div class="new-match">

                    <div class="puli_export">
                        <svg width="21" height="18" viewBox="0 0 21 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.10059 13.8V16.2C6.10059 16.4122 6.18487 16.6157 6.3349 16.7657C6.48493 16.9157 6.68841 17 6.90059 17H18.9006C19.1128 17 19.3162 16.9157 19.4663 16.7657C19.6163 16.6157 19.7006 16.4122 19.7006 16.2V1.8C19.7006 1.58783 19.6163 1.38434 19.4663 1.23431C19.3162 1.08429 19.1128 1 18.9006 1H6.90059C6.68841 1 6.48493 1.08429 6.3349 1.23431C6.18487 1.38434 6.10059 1.58783 6.10059 1.8V4.2" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M10.9004 9H19.7004" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M10.9004 5H19.7004" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M2.0998 4.19922H10.0998C10.0998 4.19922 10.8998 4.19922 10.8998 4.99922V12.9992C10.8998 12.9992 10.8998 13.7992 10.0998 13.7992H2.0998C2.0998 13.7992 1.2998 13.7992 1.2998 12.9992V4.99922C1.2998 4.99922 1.2998 4.19922 2.0998 4.19922Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M4.10059 6.60254L8.10059 11.4025" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8.10059 6.60254L4.10059 11.4025" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M13.0039 1V13H19.6999" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>


                        <span>Экспорт</span>
                    </div>

                </div>
            </div>
        </div>

        <style>
            .container_puli_list {
                display: flex;
                flex-direction: column;
                width: 100%;
                padding: 20px;
            }

            @media (max-width: 800px) {
                .container_puli_list{
                    width: 260%;
                }
            }

            .puli_export {
                gap: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 15px 35px;
                box-sizing: border-box;
                border: 1px solid rgb(232, 231, 232);
                border-radius: 5px;
                color: rgb(0, 5, 5);
                font-size: 12px;
                font-weight: 400;
                line-height: 24px;
                letter-spacing: 0%;
                background: rgb(255, 255, 255);
                position: absolute;
                z-index: 10;

                left: 50%;
                transform: translateX(-50%);
                cursor: pointer;
                margin: 65px 1px 1px 1px;

            }

            .wrapper_puli{
                overflow-x: auto !important;
            }

            @media (max-width: 800px) {
                .puli_export{
                    padding: 10px;
                }
            }

            .header_puli_list {
                border: 1px solid rgba(232, 231, 232, 1);
                border-top: none;
                border-left: none;
                border-right: none;
                display: grid;
                gap: 20px;
                grid: 1fr / 0.5fr 0.5fr 1fr 1.5fr 0.5fr 1fr 1fr 1fr 1.5fr 1.5fr;
                font-size: 14px;
                color: #707b93;
                font-weight: 400;
                letter-spacing: 0.28px;
                padding: 20px;
            }

            @media (max-width: 991px) {
                .header_puli_list {
                    grid: 30px / 35px 30px 100px 60px 60px 85px 75px 80px 100px 80px;
                }
            }

            @media (max-width: 991px) {
                .header {
                    flex-wrap: wrap;
                }
            }

            .bullet-wrapper {
                display: flex;
                gap: 0px;
                color: var(--095-ec-1, #095ec1);
                white-space: nowrap;
            }

            @media (max-width: 991px) {
                .bullet-wrapper {
                    white-space: initial;
                }
            }

            .bullet-text {
                font-family: IBM Plex Mono, sans-serif;
                margin: auto 0;
            }

            .icon {
                width: 24px;
                height: 24px;
                object-fit: contain;
            }

            .gender-wrapper {
                display: flex;
                gap: 0px;
                white-space: nowrap;
                padding: 0 1px;
            }

            @media (max-width: 991px) {
                .gender-wrapper {
                    white-space: initial;
                }
            }

            .gender-text {
                font-family: IBM Plex Mono, sans-serif;
                margin: auto 0;
            }

            .name-wrapper {
                display: flex;
                gap: 0px;
            }

            .name-text {
                font-family: IBM Plex Mono, sans-serif;
                flex: 1;
                margin: auto 0;
            }

            .age-wrapper {
                display: flex;
                gap: 0px;
                white-space: nowrap;
            }

            @media (max-width: 991px) {
                .age-wrapper {
                    white-space: initial;
                }
            }

            .age-text {
                font-family: IBM Plex Mono, sans-serif;
                margin: auto 0;
            }

            .weight-wrapper {
                display: flex;
                gap: 0px;
                white-space: nowrap;
            }

            @media (max-width: 991px) {
                .weight-wrapper {
                    white-space: initial;
                }
            }

            .weight-text {
                font-family: IBM Plex Mono, sans-serif;
                margin: auto 0;
            }

            .rank-wrapper {
                display: flex;
                gap: 0px;
                white-space: nowrap;
            }

            @media (max-width: 991px) {
                .rank-wrapper {
                    white-space: initial;
                }
            }

            .rank-text {
                font-family: IBM Plex Mono, sans-serif;
                margin: auto 0;
            }

            .club-wrapper {
                display: flex;
                gap: 0px;
                white-space: nowrap;
            }

            @media (max-width: 991px) {
                .club-wrapper {
                    white-space: initial;
                }
            }

            .club-text {
                font-family: IBM Plex Mono, sans-serif;
                flex: 1;
                margin: auto 0;
            }

            .coach-wrapper {
                display: flex;
                gap: 0px;
                white-space: nowrap;
            }

            @media (max-width: 991px) {
                .coach-wrapper {
                    white-space: initial;
                }
            }

            .coach-text {
                font-family: IBM Plex Mono, sans-serif;
                flex: 1;
                margin: auto 0;
            }

            .participant-row {
                display: grid;
                gap: 20px;
                grid: 1fr / 0.5fr 0.5fr 1fr 1.5fr 0.5fr 1fr 1fr 1fr 1.5fr 1.5fr;
                border: 1px solid rgba(232, 231, 232, 1);
                border-top: none;
                border-left: none;
                border-right: none;
                width: 100%;
                gap: 20px;
                padding: 20px;
            }

            @media (max-width: 991px) {
                .participant-row {
                    max-width: 100%;
                    grid: 30px / 35px 30px 100px 60px 60px 85px 75px 80px 100px 80px;
                    flex-wrap: wrap;
                }
            }

            .participant-number-wrapper {
                align-self: stretch;
                display: flex;
                gap: 10px;
            }

            .participant-number-icon {
                display: flex;
                justify-content: center;
                align-items: center;
                width: 24px;
                height: 24px;
                border-radius: 5px;
                border: 2px solid rgba(232, 231, 232, 1);
                background-color: #eafff2;
                padding: 15px;
            }

            .participant-number {
                color: var(--071-c-31, #071c31);
                text-align: center;
                margin: auto 0;
                font: 500 14px/171% IBM Plex Mono, -apple-system, Roboto, Helvetica, sans-serif;
            }

            .participant-arrow {
                width: 9px;
                height: auto;
                align-self: stretch;
                margin: auto 0;
            }

            .participant-name,
            .participant-age,
            .participant-weight,
            .participant-rank {
                color: #071c31;
                letter-spacing: 0.28px;
                align-self: stretch;
                margin: auto 0;
                font: 400 14px IBM Plex Mono, sans-serif;
            }

            .participant-club,
            .participant-coach {
                color: var(--071-c-31, #071c31);
                letter-spacing: 0.28px;
                align-self: stretch;
                margin: auto 0;
                font: 400 14px IBM Plex Mono, sans-serif;
            }
        </style>
        @if(!empty($students))
            <div class="container_puli_list">
                <div class="header_puli_list">
                    <div class="name-wrapper">
                        <div class="name-text">Документы</div>
                    </div>
                    <div class="name-wrapper"></div>
                    <div class="document-wrapper">
                        <div class="document-text">Фамилия и Имя</div>
                    </div>
                    <div class="name-wrapper"></div>
                    <div class="age-wrapper">
                        <div class="age-text">Возраст</div>
                    </div>
                    <div class="weight-wrapper">
                        <div class="weight-text">Вес</div>
                    </div>
                    <div class="rank-wrapper">
                        <div class="rank-text">Кю/Дан</div>
                    </div>
                    <div class="club-wrapper">
                        <div class="club-text">Клуб</div>
                    </div>
                    <div class="coach-wrapper">
                        <div class="coach-text">Тренер</div>
                    </div>
                </div>

                <style>
                    .region-checkbox span {
                        height: 30px;
                        width: 30px;

                    }
                </style>

                @foreach($students as $entry)
                    <section class="participant-row">
                        <div class="participant-name" style="color: rgb(9, 94, 193);">
                            <a href="">Проверить</a>
                        </div>
                        <div class="name-wrapper"></div>
{{--                        <div class="participant-name">{{ $entry->student->first_name }} {{ $entry->student->last_name }}</div>--}}
                        <div class="participant-name"><a href="{{ route('students.show', $entry->student->id) }}">
                                {{ $entry->student->last_name . ' ' . $entry->student->first_name }}
                            </a></div>
{{--                        <h2 class="user-name"><a href="{{ route('students.show', $student->id) }}">--}}
{{--                                {{ $student->last_name . ' ' . $entry->student->first_name }}--}}
{{--                            </a></h2>--}}
                        <div class="name-wrapper"></div>
                        <div class="participant-age">{{ $entry->student->age }} лет</div>
                        <div class="participant-weight">{{ $entry->student->weight }} кг</div>
                        <div class="participant-rank">{{ $entry->student->ky }}</div>
                        @if(!empty($entry->student->coach))
                        <div class="participant-club">{{$entry->student->coach->club}}</div>
                        <div class="participant-coach">{{$entry->student->coach->first_name . ' ' . $entry->student->coach->last_name}}</div>
                        @else
                            <div class="participant-club"></div>
                            <div class="participant-coach"></div>
                        @endif
                        <div class="participant-name" style="color: rgb(9, 94, 193);">
                            <a wire:click.prevent="$dispatch('openModalExchangeList', { tournamentId: {{ $tournament->id }}, studentId: {{ $entry->student->id }} })" href="">Переместить в другой список</a>

                        </div>
                    </section>
                @endforeach
            </div>
        @endif
        @if($showModal)
            <!-- Модальное окно -->
            <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.75); display: flex; align-items: center; justify-content: center;">
                <div style="background: white; padding: 16px; border-radius: 8px; width: 100%; max-width: 500px;">
                    <h2 style="font-size: 24px; margin-bottom: 16px;">Переместить ученика</h2>
                    <form wire:submit.prevent="exchange">
                        <!-- Поля формы -->
                        <div style="margin-bottom: 16px;">
                            <label style="display: block; margin-bottom: 4px;">Списки</label>
                            <select wire:model="targetListId" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                                <option value="">Выберите</option>
                                @foreach($tournamentLists as $list)
                                    <option value="{{$list->id}}">{{$list->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div style="display: flex; justify-content: flex-end;">
                            <button type="button" wire:click="$set('showModal', false)" style="margin-right: 8px; padding: 8px 16px; background: #ccc; color: white; border: none; border-radius: 4px;">Отмена</button>
                            <button type="submit" style="padding: 8px 16px; background: #007bff; color: white; border: none; border-radius: 4px;">Переместить</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
        @if($editList)
            <!-- Модальное окно -->
            <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.75); display: flex; align-items: center; justify-content: center;">
                <div style="background: white; padding: 16px; border-radius: 8px; width: 100%; max-width: 500px;">
                    <h2 style="font-size: 24px; margin-bottom: 16px;">{{ 'Редактировать список'}}</h2>
                    <form wire:submit.prevent="{{ 'updateList'}}">
                        <!-- Поля формы -->
                        <div style="margin-bottom: 16px;">
                            <label style="display: block; margin-bottom: 4px;">Название списка</label>
                            <input type="text" wire:model="name" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"/>
                            @error('name') <span style="color: red;">{{ $message }}</span> @enderror
                        </div>
                        <div style="margin-bottom: 16px;">
                            <label style="display: block; margin-bottom: 4px;">Возраст (от - до)</label>
                            <div style="display: flex; gap: 8px;">
                                <input type="number" wire:model="ageFrom" style="flex: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"/>
                                <input type="number" wire:model="ageTo" style="flex: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"/>
                            </div>
                            @error('ageFrom') <span style="color: red;">{{ $message }}</span> @enderror
                            @error('ageTo') <span style="color: red;">{{ $message }}</span> @enderror
                        </div>
                        <div style="margin-bottom: 16px;">
                            <label style="display: block; margin-bottom: 4px;">Вес (от - до)</label>
                            <div style="display: flex; gap: 8px;">
                                <input type="number" wire:model="weightFrom" style="flex: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"/>
                                <input type="number" wire:model="weightTo" style="flex: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"/>
                            </div>
                            @error('weightFrom') <span style="color: red;">{{ $message }}</span> @enderror
                            @error('weightTo') <span style="color: red;">{{ $message }}</span> @enderror
                        </div>
                        <div style="margin-bottom: 16px;">
                            <label style="display: block; margin-bottom: 4px;">Кю (от - до)</label>
                            <div style="display: flex; gap: 8px;">
                                <input type="number" wire:model="kyuFrom" style="flex: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"/>
                                <input type="number" wire:model="kyuTo" style="flex: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"/>
                            </div>
                            @error('kyuFrom') <span style="color: red;">{{ $message }}</span> @enderror
                            @error('kyuTo') <span style="color: red;">{{ $message }}</span> @enderror
                        </div>
                        <div style="margin-bottom: 16px;">
                            <label style="display: block; margin-bottom: 4px;">Пол</label>
                            <select wire:model="gender" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                                <option value="">Выберите</option>
                                <option value="М">Мужской</option>
                                <option value="Ж">Женский</option>
                            </select>
                            @error('gender') <span style="color: red;">{{ $message }}</span> @enderror
                        </div>
                        <div style="display: flex; justify-content: flex-end;">
                            <button type="button" wire:click="$set('editList', false)" style="margin-right: 8px; padding: 8px 16px; background: #ccc; color: white; border: none; border-radius: 4px;">Отмена</button>

                            <button type="submit" style="padding: 8px 16px; background: #007bff; color: white; border: none; border-radius: 4px;">{{'Обновить'}}</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </main>
</div>
