<div>
    <main class="main_students">
        <style>
            .input-container {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 20px;
                font-size: 16px;
                color: #707b93;
                font-weight: 400;
                letter-spacing: 0.32px;
                line-height: 150%;
            }


            .email-input {
                font-family: 'IBM Plex Mono', sans-serif;
                padding: 10px 12px 10px 20px;
                border: 2px solid rgba(232, 231, 232, 1);
                border-radius: 5px;
                justify-content: center;
                height: 48px;
                flex-grow: 1;
                background: transparent;

            }


            .hall-select {
                cursor: pointer;
                display: flex;
                gap: 8px;
                padding: 10px 12px 10px 20px;
                border: 2px solid rgba(232, 231, 232, 1);
                border-radius: 5px;
                flex-grow: 0.3;
            }

            .hall-label {
                font-family: 'IBM Plex Mono', sans-serif;
                flex: 1;
            }

            .arrow-icon {
                width: 24px;
                aspect-ratio: 1;
                object-fit: auto;
                object-position: center;
            }

            .add-button {
                display: flex;
                flex-direction: column;
                justify-content: center;
                padding: 16px 24px;
                background-color: #fff;
                border: 1px solid rgba(232, 231, 232, 1);
                border-radius: 5px;
                color: #095ec1;
                font-weight: 500;
                white-space: nowrap;
            }

            .add-icon-container {
                display: flex;
                gap: 10px;
            }

            .add-icon {
                width: 16px;
                aspect-ratio: 1;
                object-fit: auto;
                object-position: center;
                margin: auto 0;
            }

            .add-text {
                font-family: 'IBM Plex Mono', sans-serif;
            }

            .confirmation-container {
                display: flex;
                gap: 20px;
                margin: 22px 0 0 0;
                align-self: start;
            }

            .confirmation-text {
                margin: auto 0;
                font: 500 16px/130% 'IBM Plex Mono', -apple-system, Roboto, Helvetica, sans-serif;
                color: #071c31;
            }

            .email-list {
                display: flex;
                gap: 20px;
                font-size: 14px;
                color: #707b93;
                font-weight: 400;
                white-space: nowrap;
            }

            .email-item {
                font-family: 'IBM Plex Mono', sans-serif;
                justify-content: center;
                padding: 10px;
                border: 1px solid rgba(232, 231, 232, 1);
                border-radius: 5px;
                leading-trim: both;
                text-edge: cap;
            }

            .students_header {
                margin-top: 74px;
            }
        </style>

        <section class="students_header none_mobile" style="width: 100%;">
            <div class="container">
                <div class="input-container">
                    <input for="email-input" wire:model="emails" class="email-input" placeholder="Добавьте почты учеников, через запятую"></input>

                    <button class="add-button">
                        <div class="add-icon-container">
                            <img
                                    src="https://cdn.builder.io/api/v1/image/assets/TEMP/bd015786accaf6da58a8bf30670f8641b114efb20ed432ce1c63b653414d7fe0?apiKey=64de9059607140be8c9d5acd9f2dfd62&"
                                    alt="" class="add-icon" loading="lazy" />
                            <a wire:click.prevent="sendEmails" class="add-text">Добавить</a>
                        </div>
                    </button>
                </div>
                @if(count($waitConfirmStudent))
                <div class="confirmation-container">
                    <p class="confirmation-text">Ожидаем подтверждения</p>
                    <ul class="email-list">
                        @foreach($waitConfirmStudent as $email)
                            <li class="email-item">
                                {{$email->email}}
                                <button class="delete-button" wire:click.prevent="deleteEmail('{{ $email->id }}')">
                                    <i class="fas fa-times"></i> <!-- Иконка крестика -->
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </section>

        <style>
            .athlete-list {
                display: flex;
                flex-direction: column;
                font-size: 16px;
                color: #071c31;
                font-weight: 400;
            }

            .athlete-item {
                align-items: center;
                border-bottom: 1px solid rgba(232, 231, 232, 1);
                display: flex;
                gap: 20px;
                justify-content: space-between;
                padding: 6px 0;
            }

            .athlete-info {
                display: flex;
                gap: 10px;
                font-weight: 500;
                letter-spacing: 0.32px;
                padding: 0 6px;
            }

            .athlete-avatar {
                width: 48px;
                aspect-ratio: 1;
                object-fit: cover;
                border-radius: 5px;
            }

            .athlete-name {
                font-family: 'IBM Plex Mono', monospace;
                margin: auto 0;
            }

            .athlete-age,
            .athlete-weight {
                letter-spacing: 0.28px;
                margin: auto 0;
                font: 14px 'IBM Plex Mono', monospace;
            }

            .athlete-rank {
                font-family: 'IBM Plex Sans', sans-serif;
                margin: auto 0;
            }

            .athlete-location {
                display: flex;
                gap: 6px;
                align-items: center;
                color: #707b93;
                white-space: nowrap;
                margin: auto 0;
            }


            .location-icon {
                width: 24px;
                aspect-ratio: 1;
            }

            .location-name {
                font-family: 'IBM Plex Sans', sans-serif;
            }

            .athlete-score {
                letter-spacing: 0.28px;
                margin: auto 0;
                font: 500 14px 'IBM Plex Mono', monospace;
            }

            .athlete-delete {
                display: flex;
                gap: 10px;
                color: #c10914;
                font-weight: 500;
                white-space: nowrap;
                margin: auto 0;
                cursor: pointer;
            }

            .delete-icon {
                width: 16px;
                margin: auto 0;
            }

            .delete-text {
                font-family: 'IBM Plex Sans', sans-serif;
            }
        </style>

        <section class="athlete_list none_mobile">
            <div class="container">
                <div class="athlete-list">
                    @foreach($students as $student)
                    <article class="athlete-item">
                        <div class="athlete-info">
                            <img
                                    src="{{asset('storage/' . $student->avatar)}}"
                                    alt="Athlete avatar" class="athlete-avatar" />
                            <h3 class="athlete-name"><a href="{{ route('students.show', $student->id) }}">
                                    {{ $student->last_name . ' ' . $student->first_name }}
                                </a></h3>
                        </div>
                        <p class="athlete-age">{{$student->age}} лет</p>
                        <p class="athlete-weight">{{$student->weight}}кг</p>
                        <p class="athlete-rank">{{$student->ky}}</p>
{{--                        <div class="athlete-location">--}}
{{--                            <img--}}
{{--                                    src="https://cdn.builder.io/api/v1/image/assets/TEMP/5eb7de09060b06f0d1cf2b37151d8b74cea61858c705bc425469b4c774a44404?apiKey=64de9059607140be8c9d5acd9f2dfd62&"--}}
{{--                                    alt="" class="location-icon" />--}}
{{--                            <span class="location-name">Батайск</span>--}}
{{--                        </div>--}}
{{--                        <p class="athlete-score">15 / 8</p>--}}
                        <div class="athlete-delete">
                            <img
                                    src="https://cdn.builder.io/api/v1/image/assets/TEMP/391b49f6aeebcd74f101386b6e389e682e7dac4a75519529c3d16fcbac804e24?apiKey=64de9059607140be8c9d5acd9f2dfd62&"
                                    alt="" class="delete-icon" />
                            <a wire:click.prevent="deleteStudent({{$student->id}})" class="delete-text">Удалить</a>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </section>

        <style>
            .container-room {
                justify-content: flex-end;
                background-color: #fbfafb;
                display: flex;
                flex-direction: column;
                font-size: 12px;
                color: #707b93;
                font-weight: 400;
                padding: 80px 16px 18px;
            }

            .room-selection {
                border-radius: 5px;
                border: 2px solid rgba(232, 231, 232, 1);
                display: flex;
                gap: 8px;
                font-size: 14px;
                color: var(--707-b-93, #707b93);
                letter-spacing: 0.28px;
                line-height: 150%;
                padding: 10px 12px 10px 16px;
            }

            .room-selection-text {
                font-family: IBM Plex Mono, sans-serif;
                flex: 1;
                margin: auto 0;
            }

            .room-selection-icon {
                aspect-ratio: 1;
                object-fit: auto;
                object-position: center;
                width: 24px;
            }

            .confirmation-status {
                color: var(--071-c-31, #071c31);
                margin-top: 18px;
                font: 500 16px/130% IBM Plex Mono, -apple-system, Roboto, Helvetica, sans-serif;
            }

            .participant-list {
                display: flex;
                margin-top: 9px;
                gap: 5px;
                white-space: nowrap;
                flex-wrap: wrap;
            }

            .participant {
                leading-trim: both;
                text-edge: cap;
                font-family: IBM Plex Mono, sans-serif;
                justify-content: center;
                border-radius: 2px;
                border: 1px solid rgba(232, 231, 232, 1);
                padding: 5px;
            }

            .additional-participant {
                leading-trim: both;
                text-edge: cap;
                font-family: IBM Plex Mono, sans-serif;
                justify-content: center;
                border-radius: 2px;
                border: 1px solid rgba(232, 231, 232, 1);
                margin-top: 5px;
                white-space: nowrap;
                padding: 5px;
            }
        </style>

        <section class="container-room block_mobile">
            <style>
                .email-address {
                    align-self: stretch;
                    border-radius: 5px;
                    border: 2px solid rgba(232, 231, 232, 1);
                    color: #707b93;
                    white-space: nowrap;
                    letter-spacing: 0.28px;
                    justify-content: center;
                    padding-left:  20px;
                    height: 50px;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    font: 400 14px/150% IBM Plex Mono, -apple-system, Roboto, Helvetica, sans-serif;
                    margin-bottom: 10px;
                }
                .email_add{
                    color: #095EC1;
                    gap: 10px;
                    padding: 10px 20px;
                    border-left: 2px solid rgba(232, 231, 232, 1);

                }
            </style>

            <div class="email-address">

                    <input for="email-input" wire:model="emails" class="" placeholder="Добавьте почты"></input>

                    <button class="add-button">
                        <div class="add-icon-container">
                            <img
                                src="https://cdn.builder.io/api/v1/image/assets/TEMP/bd015786accaf6da58a8bf30670f8641b114efb20ed432ce1c63b653414d7fe0?apiKey=64de9059607140be8c9d5acd9f2dfd62&"
                                alt="" class="add-icon" loading="lazy" />
                            <a wire:click.prevent="sendEmails" class="add-text">Добавить</a>
                        </div>
                    </button>

            </div>

            @if(count($waitConfirmStudent))
            <h2 class="confirmation-status">Ожидаем подтверждения</h2>
            <div class="participant-list">
                @foreach($waitConfirmStudent as $email)
                <span class="participant">{{$email->email}}
                <button class="delete-button" wire:click.prevent="deleteEmail('{{ $email->id }}')">
                            <i class="fas fa-times"></i> <!-- Иконка крестика -->
                        </button>
                </span>
                @endforeach
            </div>
            @endif
        </section>

        <section class="container block_mobile">
            <style>
                .block_mobile {
                    display: none;
                }

                @media(max-width: 800px) {
                    .block_mobile {
                        display: block;
                    }
                    .none_mobile{
                        display: none;
                    }
                }

                .user-card {
                    border-bottom: 1px solid rgba(232, 231, 232, 1);
                    display: flex;
                    flex-direction: column;
                    font-size: 12px;
                    justify-content: center;
                }

                .user-info {
                    align-items: start;
                    display: flex;
                    margin-top: 5px;
                    gap: 8px;
                    justify-content: space-between;
                    padding: 5px 0;
                }

                .user-avatar {
                    width: 32px;
                    aspect-ratio: 1;
                    object-fit: cover;
                    object-position: center;
                    align-self: center;
                }

                .user-details {
                    display: flex;
                    flex-direction: column;
                    color: #707b93;
                    font-weight: 400;
                    gap: 5px;
                }

                .user-name {
                    color: #071c31;
                    font: 500 14px 'IBM Plex Sans', sans-serif;
                }

                .user-email {
                    font-family: 'IBM Plex Sans', sans-serif;
                }

                .user-stats {
                    display: flex;
                    gap: 12px;
                    padding: 1px 0;
                }

                .user-age,
                .user-weight,
                .user-rank,
                .user-record {
                    font-family: 'IBM Plex Sans', sans-serif;
                }

                .user-actions {
                    display: flex;
                    gap: 5px;
                    color: #c10914;
                    font-weight: 500;
                    white-space: nowrap;
                    padding: 1px 0;
                }

                .delete-icon {
                    width: 16px;
                    align-self: start;
                }

                .delete-text {
                    font-family: 'IBM Plex Sans', sans-serif;
                }
            </style>
            @foreach($students as $student)
            <article class="user-card">
                <div class="user-info">
                    <img
                            src="{{asset('storage/' . $student->avatar)}}"
                            alt="Athlete avatar" class="athlete-avatar" />
                    <div class="user-details">
                        <h2 class="user-name"><a href="{{ route('students.show', $student->id) }}">
                                {{ $student->last_name . ' ' . $student->first_name }}
                            </a></h2>
                        <p class="user-email">{{$student->email}}</p>
                        <div class="user-stats">
                            <span class="user-age">{{$student->age}} лет</span>
                            <span class="user-weight">{{$student->weight}}кг</span>
                            <span class="user-rank">{{$student->ky}}</span>
{{--                            <span class="user-record">15 / 8</span>--}}
                        </div>
                    </div>
                    <div class="user-actions">
                        <img
                                src="https://cdn.builder.io/api/v1/image/assets/TEMP/985b0312b2685dcb918d0a7fe00dc4e23bd91a09ccf703c9a3f6fde44f5b2e66?apiKey=64de9059607140be8c9d5acd9f2dfd62&"
                                alt="" class="delete-icon" />
                        <a wire:click.prevent="deleteStudent({{$student->id}})" class="delete-text">Удалить</a>
                    </div>
                </div>
            </article>
            @endforeach
        </section>
    </main>
</div>
