<div>
    <main class="main_puli container">


        <style>
            .container_puli_list {
                display: flex;
                flex-direction: column;
                width: 100%;
                padding: 20px;
            }

            @media (max-width: 800px) {
                .container_puli_list{
                    width: 250%;
                }
            }

            .header_puli_list {
                border: 1px solid rgba(232, 231, 232, 1);
                border-top: none;
                border-left: none;
                border-right: none;
                display: grid;
                gap: 20px;
                grid: 1fr / 1fr 1.5fr 0.5fr 1fr 1fr 1fr 1.5fr 1.5fr;
                font-size: 14px;
                color: #707b93;
                font-weight: 400;
                letter-spacing: 0.28px;
                padding: 20px;
            }

            @media (max-width: 991px) {
                .header_puli_list {
                    grid: 30px / 70px 100px 50px 85px 70px 70px 110px 60px;
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
                grid: 1fr / 1fr 1.5fr 0.5fr 1fr 1fr 1fr 1.5fr 1.5fr;
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
                    grid: 30px / 70px 100px 50px 85px 70px 70px 110px 60px;
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
                width: 21px;
                height: auto;
                padding-left: 10px;
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

            .wrapper_puli{
                overflow-x: auto !important;
            }
        </style>
        <!-- <table>
            <thead>
                <tr>
                    <th scope="col">
                        <div class="bullet-wrapper">
                            <div class="bullet-text">Пуля</div>
                            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/6c920d8e516fda6838bd9d6025f44e4a29c0a1884d87ab533b17582f66790037?apiKey=64de9059607140be8c9d5acd9f2dfd62&"
                                alt="" class="icon" />
                        </div>
                    </th>
                    <th scope="col">
                        <div class="gender-wrapper">
                            <div class="gender-text">М/Ж</div>
                            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/9ec57a6c6ae72501621c8dac5bd8d0ab8b4a960f148b12c985f70efae9eafbeb?apiKey=64de9059607140be8c9d5acd9f2dfd62&"
                                alt="" class="icon" />
                        </div>
                    </th>
                    <th scope="col">Age</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Chris</th>
                    <td>HTML tables</td>
                    <td>22</td>
                </tr>
                <tr>
                    <th scope="row">Dennis</th>
                    <td>Web accessibility</td>
                    <td>45</td>
                </tr>
                <tr>
                    <th scope="row">Sarah</th>
                    <td>JavaScript frameworks</td>
                    <td>29</td>
                </tr>
                <tr>
                    <th scope="row">Karen</th>
                    <td>Web performance</td>
                    <td>36</td>
                </tr>
            </tbody>
        </table> -->

        <div class="container_puli_list">
            <div class="header_puli_list">

                <div class="gender-wrapper">
                    <div class="gender-text">М/Ж</div>

                </div>
                <div class="name-wrapper">
                    <div class="name-text">Фамилия и Имя</div>
                </div>
                <div class="name-wrapper">
                </div>
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
            @foreach($studentList->students as $student)
            <section class="participant-row">

                <div class="participant-name">{{ $student->gender ? ($student->gender == 'М' ? 'М' : 'Ж') : '' }}</div>
                <div class="participant-name">{{$student->first_name . ' ' . $student->last_name}}</div>
                <div class="participant-age"></div>
                <div class="participant-age">{{$student->age}} лет</div>
                <div class="participant-weight">{{$student->weight}} кг</div>
                <div class="participant-rank">{{$student->ky}}</div>
                @if(!empty($student->coach))
                    <div class="participant-club">{{$student->coach->club}}</div>
                    <div class="participant-coach">{{ $student->coach->first_name . ' ' . $student->coach->last_name }}</div>
                @endif
            </section>
            @endforeach
        </div>
    </main>
</div>
