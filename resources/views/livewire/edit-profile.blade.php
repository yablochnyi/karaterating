<div>
    <main class="main">

        <style>
            .profile-container1 {
                margin-top: 32px;
                width: 780px;
                max-width: 100%;
            }

            .profile-columns1 {
                display: flex;
                justify-content: space-between;
                gap: 120px;
            }

            @media(max-width: 800px) {
                .profile-columns1 {
                    gap: 16px;
                }
            }

            .profile-column1 {
                display: flex;
                flex-direction: column;
                line-height: normal;
                margin-left: 0;
            }

            .profile-image-container1 {
                display: flex;
                margin-top: 8px;
                flex-grow: 1;
                flex-direction: column;
            }

            .profile-image-wrapper1 {
                display: flex;
                justify-content: center;
                align-items: center;
                border-radius: 5px;
                border: 1px solid rgba(232, 231, 232, 1);
                background-color: #fbfafb;
                aspect-ratio: 1;
                width: 280px;
                height: 280px;
            }

            .profile-image1 {
                width: 77px;
                height: 77px;
            }

            .rank-label1 {
                margin-top: 30px;
                color: #071c31;
                font: 500 14px/130% IBM Plex Mono, -apple-system, Roboto, Helvetica, sans-serif;
            }

            @media(max-width: 800px) {

                .profile-image-wrapper1 {
                    height: 35vw;
                    width: 35vw;
                }

                .profile-image1 {
                    width: 15vw;
                }
            }

            .rank-container1 {
                display: flex;
                margin-top: 8px;
                gap: 8px;
                padding: 10px 12px 10px 16px;
                border-radius: 5px;
                border: 2px solid rgba(232, 231, 232, 1);
                font-size: 16px;
                color: #707b93;
                font-weight: 400;
                letter-spacing: 0.32px;
                line-height: 150%;
            }

            .rank-value1 {
                flex: 1;
                font-family: IBM Plex Mono, sans-serif;
            }

            @media (max-width: 800px) {
                .rank-container1 {
                    margin-top: 4px;
                    padding: 3px 10px;
                    font-size: 12px;
                }

                .rank-label1 {
                    margin-top: 16px;
                    font-size: 12px;
                }

                .rank-container1 img {
                    width: 18px;
                    height: 18px;
                }
            }

            .rank-icon1 {
                width: 24px;
                aspect-ratio: 1;
                object-fit: auto;
                object-position: center;
            }

            .profile-details-column1 {
                display: flex;
                flex-direction: column;
                line-height: normal;
                width: 54%;
                margin-left: 20px;
            }

            .profile-details-container1 {
                display: flex;
                flex-grow: 1;
                flex-direction: column;
            }

            .name-gender-container1 {
                display: flex;
                gap: 20px;
            }

            .name-container1 {
                display: flex;
                flex-direction: column;
                width: 100%;
                white-space: nowrap;
            }

            .name-label1 {
                color: #071c31;
                font: 500 14px/130% IBM Plex Mono, -apple-system, Roboto, Helvetica, sans-serif;
            }

            .name-value1 {
                margin-top: 8px;
                padding: 10px 12px 10px 20px;
                border-radius: 5px;
                border: 2px solid rgba(232, 231, 232, 1);
                color: #071c31;
                letter-spacing: 0.32px;
                justify-content: center;
                font: 400 16px/150% IBM Plex Mono, -apple-system, Roboto, Helvetica, sans-serif;
            }

            .gender-container1 {
                display: flex;
                flex-direction: column;
            }

            .gender-label1 {
                color: #071c31;
                font: 500 14px/130% IBM Plex Mono, -apple-system, Roboto, Helvetica, sans-serif;
            }

            .gender-icon-wrapper1 {
                font-size: 20px;
                cursor: pointer;
                display: flex;
                justify-content: center;
                align-items: center;
                margin-top: 8px;
                padding: 0 20px;
                height: 100%;
                border-radius: 5px;
                border: 2px solid rgba(232, 231, 232, 1);
            }

            .gender-icon1 {
                width: 10px;
                aspect-ratio: 0.5;
                object-fit: auto;
                object-position: center;
                fill: #071c31;
            }

            .surname-label1 {
                margin-top: 30px;
                color: #071c31;
                font: 500 14px/130% IBM Plex Mono, -apple-system, Roboto, Helvetica, sans-serif;
            }

            .surname-input-wrapper1 {
                display: flex;
                margin-top: 8px;
                flex-direction: column;
                background-color: #fbfafb;
                font-size: 16px;
                color: #707b93;
                font-weight: 400;
                letter-spacing: 0.32px;
                line-height: 150%;
                justify-content: center;
            }

            .surname-input1 {
                height: 48px;
                padding: 10px 12px 10px 20px;
                border-radius: 5px;
                border: 2px solid rgba(232, 231, 232, 1);
                font-family: IBM Plex Mono, sans-serif;
                justify-content: center;
            }

            .email-label1 {
                margin-top: 30px;
                color: #071c31;
                font: 500 14px/130% IBM Plex Mono, -apple-system, Roboto, Helvetica, sans-serif;
            }

            .email-value1 {
                margin-top: 8px;
                height: 48px;
                padding: 10px 12px 10px 20px;
                border-radius: 5px;
                border: 2px solid rgba(232, 231, 232, 1);
                color: #707b93;
                white-space: nowrap;
                letter-spacing: 0.32px;
                justify-content: center;
                font: 400 16px/150% IBM Plex Mono, -apple-system, Roboto, Helvetica, sans-serif;
            }

            @media (max-width: 800px) {
                .email-value1 {
                    padding: 3px 10px;
                    margin-top: 4px;
                    height: 28px;
                    font-size: 12px;
                }

                .email-label1{
                    margin-top: 16px;
                    font-size: 12px;
                }

            }

            .birthdate-weight-container1 {
                display: flex;
                margin-top: 30px;
                gap: 20px;

            }

            .birthdate-container1 {
                display: flex;
                flex-direction: column;
                width: 100%;
            }

            .birthdate-label1 {
                color: #071c31;
                font: 500 14px/130% IBM Plex Mono, -apple-system, Roboto, Helvetica, sans-serif;
            }

            .birthdate-value1 {
                margin-top: 8px;
                padding: 10px 12px 10px 20px;
                border-radius: 5px;
                border: 2px solid rgba(232, 231, 232, 1);
                color: #707b93;
                letter-spacing: 0.32px;
                justify-content: center;
                font: 400 16px/150% IBM Plex Mono, -apple-system, Roboto, Helvetica, sans-serif;
            }

            .weight-container1 {
                display: flex;
                flex-direction: column;
                width: 100%;
            }

            .weight-label1 {
                color: #071c31;
                font: 500 14px/130% IBM Plex Mono, -apple-system, Roboto, Helvetica, sans-serif;
            }

            .weight-value1 {
                width: 55px;
                padding-left: 5px;
                margin-top: 8px;
                height: 48px;
                border-radius: 5px;
                border: 2px solid rgba(232, 231, 232, 1);
                color: #707b93;
                letter-spacing: 0.32px;
                justify-content: center;
                font: 400 16px/150% IBM Plex Mono, -apple-system, Roboto, Helvetica, sans-serif;
            }

            .container_edit_profile {
                max-width: 802px;
                padding: 0 16px;
            }

            @media (max-width: 800px) {
                .birthdate-weight-container1{
                    margin-top: 16px;
                }

                .birthdate-label1{
                    font-size: 12px;
                }

                .weight-label1{
                    font-size: 12px;

                }

                .birthdate-value1, .weight-value1{
                    margin-top: 4px;
                    padding: 3px 10px;
                    font-size: 12px;
                    width: 100%;
                    height: 28px;
                }
            }
        </style>

        <main class="container container_edit_profile">
            <style>
                .profile-edit-header {
                    width: 100%;
                    border-bottom: 1px solid rgba(232, 231, 232, 1);
                    color: #707b93;
                    letter-spacing: 0.48px;
                    margin-top: 57px;
                    margin-bottom: 32px;
                    padding: 14px 20px;
                    font: 500 24px/1.75 'IBM Plex Mono', -apple-system, Roboto, Helvetica, sans-serif;
                }

                @media (max-width: 800px) {

                    .surname-input-wrapper1 {
                        margin-top: 4px;
                    }

                    .surname-input1 {
                        padding: 3px 10px;
                        font-size: 12px;
                        height: 28px;
                    }

                    .profile-edit-header {
                        max-width: 100%;
                        margin: 16px 0;
                        padding: 4px 0;
                    }
                }
            </style>

            <header class="profile-edit-header">
                Редактировать профиль
            </header>
            <section class="profile-columns1">
                <section class="profile-column1">
                    <div class="profile-image-container1">
                        @if ($avatarPreorder)
                            <div class="profile-image-wrapper1">
                                <img src="{{ $avatarPreorder->temporaryUrl() }}" style="width: 100%; height: 100%; cursor: pointer;" alt="Profile Image" class="profile-image1" loading="lazy" onclick="document.getElementById('fileInput').click();" />
                                <input wire:model="avatarPreorder" type="file" id="fileInput" style="display: none;" onchange="handleFileUpload(this);" />
                            </div>
                        @elseif($avatar)
                            <div class="profile-image-wrapper1">
                                <img src="{{asset('storage/' . $avatar) }}" style="width: 100%; height: 100%; cursor: pointer;" alt="Profile Image" class="profile-image1" loading="lazy" onclick="document.getElementById('fileInput').click();" />
                                <input wire:model="avatar" type="file" id="fileInput" style="display: none;" onchange="handleFileUpload(this);" />
                            </div>
                        @else
                            <div class="profile-image-wrapper1">
                                <img src="{{ asset('assets/img/prof-im.svg') }}" alt="Profile Image" class="profile-image1" loading="lazy" style="cursor: pointer;" onclick="document.getElementById('fileInput').click();" />
                                <input wire:model="avatarPreorder" type="file" id="fileInput" style="display: none;" onchange="handleFileUpload(this);" />
                            </div>
                        @endif
                        <style>
                            .rank-container1 {
                                display: flex;
                                flex-direction: column;
                                align-items: center;
                                width: 100%;
                            }

                            .rank-select {
                                width: 100%;
                                /*padding: 10px;*/
                                font-size: 16px;
                                box-sizing: border-box;
                            }

                            .rank-icon {
                                margin-top: 10px;
                            }

                        </style>


                            <div class="none_mobile">
                                <h2 class="rank-label1">Кю / Дан</h2>
                                <div class="rank-container1">
                                    <select wire:model="ky" class="rank-select">
                                        <optgroup label="Кю">
                                            @for ($i = 10; $i >= 1; $i--)
                                                <option value="{{ $i }} кю">{{ $i }} кю</option>
                                            @endfor
                                        </optgroup>
                                        <optgroup label="Дан">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }} дан">{{ $i }} дан</option>
                                            @endfor
                                        </optgroup>
                                    </select>
                                </div>
                                <h2 class="surname-label1">Клуб</h2>
                                @if(\Illuminate\Support\Facades\Auth::user()->role_id == \App\Models\User::Coach)
                                <div class="surname-input-wrapper1">
                                    <input class="surname-input1" wire:model="club" placeholder="Название клуба"></input>
                                </div>
                                @endif
                            </div>

                    </div>
                </section>
                <section class="profile-details-column1">
                    <div class="profile-details-container1">
                        <div class="name-gender-container1">
                            <div class="name-container1">
                                <h2 class="name-label1">Имя</h2>
                                <input class="name-value1" wire:model="first_name" placeholder="Введите Имя"></input>
                            </div>
                            <div class="gender-container1">
                                <h2 class="gender-label1">М / Ж</h2>
                                <div class="gender-icon-wrapper1" wire:click="toggleGender">
                                    {{ $gender }}
                                </div>
                            </div>
                        </div>

                        <h2 class="surname-label1">Фамилия</h2>
                        <div class="surname-input-wrapper1">
                            <input class="surname-input1" wire:model="last_name" placeholder="Введите Фамилию"></input>
                        </div>
                        <div class="none_mobile">
                            <div class="name-gender-container1" style="margin-top: 30px">
                                <div class="name-container1">
                                    <h2 class="name-label1">E-mail</h2>
                                    <input class="name-value1" wire:model="email"></input>
                                </div>
                                <div class="gender-container1">
                                    <h2 class="gender-label1">Возраст</h2>
                                    <input class="weight-value1" wire:model="age" placeholder="25">
                                </div>
                            </div>

                            <div class="birthdate-weight-container1">
                                <div class="birthdate-container1">
                                    <h2 class="birthdate-label1">Дата Рождения</h2>
                                    <input type="date" class="birthdate-value1" wire:model="birthday" placeholder="10 / 03 /2020"></input>
                                </div>
                                <div class="weight-container1">
                                    <h2 class="weight-label1">Вес</h2>
                                    <input class="weight-value1" wire:model="weight" placeholder="25"></input>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </section>
            <div class="block_mobile">
                <h2 class="rank-label1">Кю / Дан</h2>
                <div class="rank-container1">
                    <select wire:model="ky" class="rank-select">
                        <optgroup label="Кю">
                            @for ($i = 10; $i >= 1; $i--)
                                <option value="{{ $i }} кю">{{ $i }} кю</option>
                            @endfor
                        </optgroup>
                        <optgroup label="Дан">
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }} дан">{{ $i }} дан</option>
                            @endfor
                        </optgroup>
                    </select>
                </div>
                <div class="birthdate-weight-container1">
                    <div class="birthdate-container1">
                        <h2 class="birthdate-label1">E-mail</h2>
                        <input class="birthdate-value1" wire:model="email"></input>
                    </div>
                    <div class="weight-container1">
                        <h2 class="weight-label1">Возраст</h2>
                        <input class="weight-value1" wire:model="age" placeholder="25"></input>
                    </div>
                </div>


                <div class="birthdate-weight-container1">
                    <div class="birthdate-container1">
                        <h2 class="birthdate-label1">Дата Рождения</h2>
                        <input class="birthdate-value1" wire:model="birthday" placeholder="10 / 03 /2020"></input>
                    </div>
                    <div class="weight-container1">
                        <h2 class="weight-label1">Вес</h2>
                        <input class="weight-value1" wire:model="weight" placeholder="25 кг"></input>
                    </div>
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

            <section class="documents-container">
                <h2 class="documents-title">Документы</h2>
                <div class="documents-grid">
                    <div class="documents-row">
                        <div class="document-item">
                            <div class="document-content">
                                <h3 class="document-name">Паспорт</h3>
                                @if ($passportPreorder)
                                    <div class="document-image-wrapper">
                                        <img src="{{ $passportPreorder->temporaryUrl() }}" style="width: 100%; height: 100%; cursor: pointer;" alt="Profile Image" class="document-image" loading="lazy" onclick="document.getElementById('passport').click();" />
                                        <input wire:model="passportPreorder" type="file" id="passport" style="display: none;" onchange="handleFileUpload(this);" />
                                    </div>
                                @elseif($passport)
                                    <div class="document-image-wrapper">
                                        <img src="{{asset('storage/' . $passport) }}" style="width: 100%; height: 100%; cursor: pointer;" alt="Profile Image" class="document-image" loading="lazy" onclick="document.getElementById('passport').click();" />
                                        <input wire:model="passport" type="file" id="passport" style="display: none;" onchange="handleFileUpload(this);" />
                                    </div>
                                @else
                                    <div class="document-image-wrapper">
                                        <img src="{{ asset('assets/img/prof-im.svg') }}" alt="Profile Image" class="document-image" loading="lazy" style="cursor: pointer;" onclick="document.getElementById('passport').click();" />
                                        <input wire:model="passportPreorder" type="file" id="passport" style="display: none;" onchange="handleFileUpload(this);" />
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="document-item">
                            <div class="document-content">
                                <h3 class="document-name">Марка</h3>
                                @if ($brandPreorder)
                                    <div class="document-image-wrapper">
                                        <img src="{{ $brandPreorder->temporaryUrl() }}" style="width: 100%; height: 100%; cursor: pointer;" alt="Profile Image" class="document-image" loading="lazy" onclick="document.getElementById('brand').click();" />
                                        <input wire:model="brandPreorder" type="file" id="brand" style="display: none;" onchange="handleFileUpload(this);" />
                                    </div>
                                @elseif($brand)
                                    <div class="document-image-wrapper">
                                        <img src="{{asset('storage/' . $brand) }}" style="width: 100%; height: 100%; cursor: pointer;" alt="Profile Image" class="document-image" loading="lazy" onclick="document.getElementById('brand').click();" />
                                        <input wire:model="brand" type="file" id="brand" style="display: none;" onchange="handleFileUpload(this);" />
                                    </div>
                                @else
                                    <div class="document-image-wrapper">
                                        <img src="{{ asset('assets/img/prof-im.svg') }}" alt="Profile Image" class="document-image" loading="lazy" style="cursor: pointer;" onclick="document.getElementById('brand').click();" />
                                        <input wire:model="brandPreorder" type="file" id="brand" style="display: none;" onchange="handleFileUpload(this);" />
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="document-item">
                            <div class="document-content">
                                <h3 class="document-name">Страховка</h3>
                                @if ($insurancePreorder)
                                    <div class="document-image-wrapper">
                                        <img src="{{ $insurancePreorder->temporaryUrl() }}" style="width: 100%; height: 100%; cursor: pointer;" alt="Profile Image" class="document-image" loading="lazy" onclick="document.getElementById('insurancePreorder').click();" />
                                        <input wire:model="insurancePreorder" type="file" id="insurancePreorder" style="display: none;" onchange="handleFileUpload(this);" />
                                    </div>
                                @elseif($insurance)
                                    <div class="document-image-wrapper">
                                        <img src="{{asset('storage/' . $insurance) }}" style="width: 100%; height: 100%; cursor: pointer;" alt="Profile Image" class="document-image" loading="lazy" onclick="document.getElementById('insurancePreorder').click();" />
                                        <input wire:model="insurance" type="file" id="insurancePreorder" style="display: none;" onchange="handleFileUpload(this);" />
                                    </div>
                                @else
                                    <div class="document-image-wrapper">
                                        <img src="{{ asset('assets/img/prof-im.svg') }}" alt="Profile Image" class="document-image" loading="lazy" style="cursor: pointer;" onclick="document.getElementById('insurancePreorder').click();" />
                                        <input wire:model="insurancePreorder" type="file" id="insurancePreorder" style="display: none;" onchange="handleFileUpload(this);" />
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="document-item">
                            <div class="document-content">
                                <h3 class="document-name">Карта IKO</h3>
                                @if ($iko_cardPreorder)
                                    <div class="document-image-wrapper">
                                        <img src="{{ $iko_cardPreorder->temporaryUrl() }}" style="width: 100%; height: 100%; cursor: pointer;" alt="Profile Image" class="document-image" loading="lazy" onclick="document.getElementById('iko_cardPreorder').click();" />
                                        <input wire:model="iko_cardPreorder" type="file" id="iko_cardPreorder" style="display: none;" onchange="handleFileUpload(this);" />
                                    </div>
                                @elseif($iko_card)
                                    <div class="document-image-wrapper">
                                        <img src="{{asset('storage/' . $iko_card) }}" style="width: 100%; height: 100%; cursor: pointer;" alt="Profile Image" class="document-image" loading="lazy" onclick="document.getElementById('iko_cardPreorder').click();" />
                                        <input wire:model="iko_card" type="file" id="iko_cardPreorder" style="display: none;" onchange="handleFileUpload(this);" />
                                    </div>
                                @else
                                    <div class="document-image-wrapper">
                                        <img src="{{ asset('assets/img/prof-im.svg') }}" alt="Profile Image" class="document-image" loading="lazy" style="cursor: pointer;" onclick="document.getElementById('iko_cardPreorder').click();" />
                                        <input wire:model="iko_cardPreorder" type="file" id="iko_cardPreorder" style="display: none;" onchange="handleFileUpload(this);" />
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="agreement-container">
                    <label for="input" class="region-checkbox">
                        <input wire:model="success_politic" type="checkbox" class="region-input" id="input" @if($success_politic) checked @endif>
                        <span></span>
                    </label>
                    <p class="agreement-text">
                        Я согласен с
                        <a href="#" class="agreement-link">договором оферты</a> и
                        <a href="#" class="agreement-link">политикой конфиденциальности</a>
                    </p>
                </div>
            </section>
            <style>
                .button-container1 {
                    display: flex;
                    gap: 20px;
                    font-size: 16px;
                    font-weight: 500;
                    line-height: 150%;
                    margin: 37px 0;
                }



                .button-container1 button {
                    width: 100%;
                }
                @media(max-width:800px){
                    .button-container1 {
                        flex-direction: column;
                        gap: 7px;
                        margin-bottom: 20px;
                    }
                }

                .cancel-button {
                    font-family: 'IBM Plex Sans', sans-serif;
                    justify-content: center;
                    align-items: center;
                    border-radius: 5px;
                    border: 1px solid rgba(217, 217, 217, 1);
                    background-color: #fff;
                    color: #071c31;
                    padding: 16px 24px;
                }

                .save-button {
                    font-family: 'IBM Plex Sans', sans-serif;
                    justify-content: center;
                    align-items: center;
                    border-radius: 5px;
                    border: 1px solid rgba(232, 231, 232, 1);
                    background-color: var(--accent, #095ec1);
                    color: #fff;
                    padding: 16px 24px;
                }
            </style>

            <div class="button-container1">
{{--                <button class="cancel-button">Отменить</button>--}}
                <button wire:click="update" class="save-button">Сохранить</button>
            </div>
        </main>
    </main>

</div>
