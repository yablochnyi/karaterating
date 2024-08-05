<div>

            <div class="container_oraganizate_nav">
                <button class="button remove-button">
                    <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/7fa6cd468ee068fcb15cd40854ed982c973becf451822ae39fd97d73b8ab5773?apiKey=64de9059607140be8c9d5acd9f2dfd62&"
                         alt="" class="icon" />
                    <p class="text">Cнять</p>
                </button>
                <button class="button remove-button" wire:click="markAsWinner">
                    <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/3efd42b014008b810a0c254f5177998598a713ab72332d820acdaac536ca1048?apiKey=64de9059607140be8c9d5acd9f2dfd62&"
                         alt="" class="icon" />
                    <p class="text">Выиграл</p>
                </button>
                <button class="button remove-button">
                    <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/184c047c48ac5c1519a6c9426145596d2fdffa73ed35da619d2a49c1b0b751fc?apiKey=64de9059607140be8c9d5acd9f2dfd62&"
                         alt="" class="icon" />
                    <p class="text">Переместить</p>
                </button>
            </div>

    <main class="main_puli">
        <style>
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

            @media (max-width: 800px) {
                .puli_export{
                    padding: 10px;
                }
            }
            .container_oraganizate_nav {
                display: flex;
                gap: 20px;
                font-size: 14px;
                font-weight: 500;
                line-height: 171%;
                padding: 0 20px;
                position: fixed;
                bottom: 25px;
                right: 35px;
                z-index: 10;
            }

            @media (max-width:800px) {
                .container_oraganizate_nav {
                    flex-direction: column;
                    gap: 10px;
                    bottom: 10px;
                    right: 10px;
                }
            }

            .button {
                display: flex;
                gap: 10px;
                justify-content: center;
                align-items: center;
                border-radius: 34px;
                padding: 16px 24px;
                font-family: 'IBM Plex Mono', sans-serif;
                white-space: nowrap;
            }

            .icon {
                width: 18px;
                height: 18px;
                object-fit: contain;
            }

            .text {
                margin: 0;
            }

            .remove-button {
                color: #000505;
                background-color: #fff;
                border: 1px solid #e8e7e8;
                box-shadow: 0px 12px 20px -10px rgba(0, 0, 0, 0.15);
            }

            .remove-button:hover {
                border: 1px solid #095ec1;
                box-shadow: 0px 2px 10px 0px rgba(9, 94, 193, 0.4);
            }

            .remove-button:active {
                color: #095ec1;
                background-color: #deeeff;
                border: 1px solid #095ec1;
                box-shadow: 0px 2px 10px 0px rgba(9, 94, 193, 0.4);
            }
        </style>


        <div class="nav_puli_box nav_puli_active" id="nav_puli" style="background-color: #fafafb; ">

            <div class="puli__container" wire:ignore>
                @foreach($pool as $list)
                    <div id="match" class="match" wire:click="loadStudents({{ $list->id }})">
                        <div class="match-number">{{ $list->name }}</div>
                        <!--<div class="match-location">Tатами №12</div>-->
                        <div class="match-details">
                            @if($list->gender == 'male')
                                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/723f7d46cf93b41d46da476445cf5450caa752bc04925033d919e9cdba54e058?apiKey=64de9059607140be8c9d5acd9f2dfd62&"
                                     alt="" class="match-icon" />
                            @else
                                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/ae6c2b2ef1f1568aa83ce38ac287ee9ba7e60006c81e2ac784cbd9d9e72c04c4?apiKey=64de9059607140be8c9d5acd9f2dfd62&"
                                     alt="" class="match-icon" />
                            @endif
                            <div class="match-info">{{ $list->age_from }}-{{ $list->age_to }} • {{ $list->weight_from }}-{{ $list->weight_to }}кг</div>
                        </div>
                    </div>
                @endforeach

                <div class="new-match">
                    <button class="new-match-button">
                        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/d42cb134ee716ee06b53b7bd4fe57b3d0a711b1b10146fc1da9f9c3619c6fc0e?apiKey=64de9059607140be8c9d5acd9f2dfd62&"
                             alt="" class="new-match-icon" />
                        <div class="new-match-text">Новая пуля</div>
                    </button>
                    <div class="puli_export">
                        <svg width="24" height="20" viewBox="0 0 512 512" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>pdf-document</title>
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="add" fill="#000000" transform="translate(85.333333, 42.666667)">
                                    <path d="M75.9466667,285.653333 C63.8764997,278.292415 49.6246897,275.351565 35.6266667,277.333333 L1.42108547e-14,277.333333 L1.42108547e-14,405.333333 L28.3733333,405.333333 L28.3733333,356.48 L40.5333333,356.48 C53.1304778,357.774244 65.7885986,354.68506 76.3733333,347.733333 C85.3576891,340.027178 90.3112817,328.626053 89.8133333,316.8 C90.4784904,304.790173 85.3164923,293.195531 75.9466667,285.653333 L75.9466667,285.653333 Z M53.12,332.373333 C47.7608867,334.732281 41.8687051,335.616108 36.0533333,334.933333 L27.7333333,334.933333 L27.7333333,298.666667 L36.0533333,298.666667 C42.094796,298.02451 48.1897668,299.213772 53.5466667,302.08 C58.5355805,305.554646 61.3626692,311.370371 61.0133333,317.44 C61.6596233,323.558965 58.5400493,329.460862 53.12,332.373333 L53.12,332.373333 Z M150.826667,277.333333 L115.413333,277.333333 L115.413333,405.333333 L149.333333,405.333333 C166.620091,407.02483 184.027709,403.691457 199.466667,395.733333 C216.454713,383.072462 225.530463,362.408923 223.36,341.333333 C224.631644,323.277677 218.198313,305.527884 205.653333,292.48 C190.157107,280.265923 170.395302,274.806436 150.826667,277.333333 L150.826667,277.333333 Z M178.986667,376.32 C170.098963,381.315719 159.922142,383.54422 149.76,382.72 L144.213333,382.72 L144.213333,299.946667 L149.333333,299.946667 C167.253333,299.946667 174.293333,301.653333 181.333333,308.053333 C189.877212,316.948755 194.28973,329.025119 193.493333,341.333333 C194.590843,354.653818 189.18793,367.684372 178.986667,376.32 L178.986667,376.32 Z M254.506667,405.333333 L283.306667,405.333333 L283.306667,351.786667 L341.333333,351.786667 L341.333333,329.173333 L283.306667,329.173333 L283.306667,299.946667 L341.333333,299.946667 L341.333333,277.333333 L254.506667,277.333333 L254.506667,405.333333 L254.506667,405.333333 Z M234.666667,7.10542736e-15 L9.52127266e-13,7.10542736e-15 L9.52127266e-13,234.666667 L42.6666667,234.666667 L42.6666667,192 L42.6666667,169.6 L42.6666667,42.6666667 L216.96,42.6666667 L298.666667,124.373333 L298.666667,169.6 L298.666667,192 L298.666667,234.666667 L341.333333,234.666667 L341.333333,106.666667 L234.666667,7.10542736e-15 L234.666667,7.10542736e-15 Z" id="document-pdf">

                                    </path>
                                </g>
                            </g>
                        </svg>
                        <span>Экспорт</span>
                    </div>
                </div>

            </div>
        </div>

        <div class="puli_tour" wire:ignore.self>
            <div class="tour__step tour__step-one" wire:ignore.self>
                @if($students)
                    @foreach($students as $matchPool)
                        @if($matchPool->round == 1)
                        <div class="tour_block"  wire:key="{{ $matchPool->id }}">
                            @if($matchPool->student1)
                                <div class="fighter-info" wire:click="selectStudent({{ $matchPool->id }}, 'student1', {{ $matchPool->student1->id }})" style="{{ $selectedStudent && $selectedStudent['matchId'] == $matchPool->id && $selectedStudent['id'] == $matchPool->student1->id ? 'border: 2px solid red;' : '' }}">
                                    <div class="fighter-details">
                                        <img src="{{ asset('assets/img/girl.png') }}" alt="Fighter {{ $matchPool->student1->first_name . ' ' .  $matchPool->student1->last_name }}" class="fighter-image" />
                                        <p class="fighter-name">
                                            {{ $matchPool->student1->first_name . ' ' .  $matchPool->student1->last_name }}
                                        </p>
                                    </div>
                                    <p class="fighter-club">{{ $matchPool->student1->coach->club }}</p>
                                </div>
                            @else
                                <div class="fighter-info">
                                    <div class="fighter-details">
                                        <img src="{{ asset('assets/img/placeholder.png') }}" alt="No Fighter" class="fighter-image" />
                                        <p class="fighter-name">
                                            No Fighter
                                        </p>
                                    </div>
                                    <p class="fighter-club">No Club</p>
                                </div>
                            @endif

                            <p class="fight-number">Бой № {{ $loop->iteration }}</p>

                            @if($matchPool->student2)
                                <div class="fighter-info" wire:click="selectStudent({{ $matchPool->id }}, 'student2', {{ $matchPool->student2->id }})" style="{{ $selectedStudent && $selectedStudent['matchId'] == $matchPool->id && $selectedStudent['id'] == $matchPool->student2->id ? 'border: 2px solid red;' : '' }}">
                                    <div class="fighter-details">
                                        <img src="{{ asset('assets/img/girl.png') }}" alt="Fighter {{ $matchPool->student2->first_name . ' ' .  $matchPool->student2->last_name }}" class="fighter-image" />
                                        <p class="fighter-name">
                                            {{ $matchPool->student2->first_name . ' ' .  $matchPool->student2->last_name }}
                                        </p>
                                    </div>
                                    <p class="fighter-club">{{ $matchPool->student2->coach->club }}</p>
                                </div>
                            @else
                                <div class="fighter-info">
                                    <div class="fighter-details">
                                        <img src="{{ asset('assets/img/placeholder.png') }}" alt="No Fighter" class="fighter-image" />
                                        <p class="fighter-name">
                                            No Fighter
                                        </p>
                                    </div>
                                    <p class="fighter-club">No Club</p>
                                </div>
                            @endif
                        </div>
                        @endif
                    @endforeach
                @endif
            </div>

            <div class="tour__step tour__step-other">
                @if($students)
                    @foreach($students as $matchPool)
                        @if($matchPool->round == 2)
                            <div class="tour_block" wire:ignore wire:key="{{ $matchPool->id }}">
                                @if($matchPool->student1)
                                    <div class="fighter-info" wire:click="selectStudent({{ $matchPool->id }}, 'student1', {{ $matchPool->student1->id }})" style="{{ $selectedStudent && $selectedStudent['matchId'] == $matchPool->id && $selectedStudent['id'] == $matchPool->student1->id ? 'border: 2px solid red;' : '' }}">
                                        <div class="fighter-details">
                                            <img src="{{ asset('assets/img/girl.png') }}" alt="Fighter {{ $matchPool->student1->first_name . ' ' .  $matchPool->student1->last_name }}" class="fighter-image" />
                                            <p class="fighter-name">
                                                {{ $matchPool->student1->first_name . ' ' .  $matchPool->student1->last_name }}
                                            </p>
                                        </div>
                                        <p class="fighter-club">{{ $matchPool->student1->coach->club }}</p>
                                    </div>
                                @else
                                    <div class="fighter-info">
                                        <div class="fighter-details">
                                            <img src="{{ asset('assets/img/placeholder.png') }}" alt="No Fighter" class="fighter-image" />
                                            <p class="fighter-name">
                                                No Fighter
                                            </p>
                                        </div>
                                        <p class="fighter-club">No Club</p>
                                    </div>
                                @endif

                                <p class="fight-number">Бой № {{ $loop->iteration }}</p>

                                @if($matchPool->student2)
                                    <div class="fighter-info" wire:click="selectStudent({{ $matchPool->id }}, 'student2', {{ $matchPool->student2->id }})" style="{{ $selectedStudent && $selectedStudent['matchId'] == $matchPool->id && $selectedStudent['id'] == $matchPool->student2->id ? 'border: 2px solid red;' : '' }}">
                                        <div class="fighter-details">
                                            <img src="{{ asset('assets/img/girl.png') }}" alt="Fighter {{ $matchPool->student2->first_name . ' ' .  $matchPool->student2->last_name }}" class="fighter-image" />
                                            <p class="fighter-name">
                                                {{ $matchPool->student2->first_name . ' ' .  $matchPool->student2->last_name }}
                                            </p>
                                        </div>
                                        <p class="fighter-club">{{ $matchPool->student2->coach->club }}</p>
                                    </div>
                                @else
                                    <div class="fighter-info">
                                        <div class="fighter-details">
                                            <img src="{{ asset('assets/img/placeholder.png') }}" alt="No Fighter" class="fighter-image" />
                                            <p class="fighter-name">
                                                No Fighter
                                            </p>
                                        </div>
                                        <p class="fighter-club">No Club</p>
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
{{--            <div class="tour__step tour__last-step" style="">--}}
{{--                <div class="tour_block tour_block-opacity" style="opacity: 0;">--}}
{{--                    <div class="fighter-info">--}}
{{--                        <div class="fighter-details">--}}
{{--                            <img src="img/girl.png"--}}
{{--                                 alt="Fighter Kolosova Irina" class="fighter-image" />--}}
{{--                            <p class="fighter-name">--}}
{{--                                Колосова<br />--}}
{{--                                Ирина--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                        <p class="fighter-club">Спортивный клуб "Торнадо"</p>--}}
{{--                    </div>--}}
{{--                    <p class="fight-number">Бой №1</p>--}}
{{--                    <div class="fighter-info">--}}
{{--                        <div class="fighter-details">--}}
{{--                            <img src="img/girl.png"--}}
{{--                                 alt="Fighter Kolosova Irina" class="fighter-image" />--}}
{{--                            <p class="fighter-name">--}}
{{--                                Колосова<br />--}}
{{--                                Ирина--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                        <p class="fighter-club">Спортивный клуб "Торнадо"</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="tour_block">--}}
{{--                    <div class="fighter-info">--}}
{{--                        <div class="fighter-details">--}}
{{--                            <img src="img/girl.png"--}}
{{--                                 alt="Fighter Kolosova Irina" class="fighter-image" />--}}
{{--                            <p class="fighter-name">--}}
{{--                                Колосова<br />--}}
{{--                                Ирина--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                        <p class="fighter-club">Спортивный клуб "Торнадо"</p>--}}
{{--                    </div>--}}
{{--                    <p class="fight-number">Бой №1</p>--}}
{{--                    <div class="fighter-info">--}}
{{--                        <div class="fighter-details">--}}
{{--                            <img src="img/girl.png"--}}
{{--                                 alt="Fighter Kolosova Irina" class="fighter-image" />--}}
{{--                            <p class="fighter-name">--}}
{{--                                Колосова<br />--}}
{{--                                Ирина--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                        <p class="fighter-club">Спортивный клуб "Торнадо"</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="tour_block">--}}
{{--                    <div class="fighter-info">--}}
{{--                        <div class="fighter-details">--}}
{{--                            <img src="img/girl.png"--}}
{{--                                 alt="Fighter Kolosova Irina" class="fighter-image" />--}}
{{--                            <p class="fighter-name">--}}
{{--                                Колосова<br />--}}
{{--                                Ирина--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                        <p class="fighter-club">Спортивный клуб "Торнадо"</p>--}}
{{--                    </div>--}}
{{--                    <p class="fight-number">Бой №1</p>--}}
{{--                    <div class="fighter-info">--}}
{{--                        <div class="fighter-details">--}}
{{--                            <img src="img/girl.png"--}}
{{--                                 alt="Fighter Kolosova Irina" class="fighter-image" />--}}
{{--                            <p class="fighter-name">--}}
{{--                                Колосова<br />--}}
{{--                                Ирина--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                        <p class="fighter-club">Спортивный клуб "Торнадо"</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="tour_block tour_block-opacity" style="opacity: 0;">--}}
{{--                    <div class="fighter-info">--}}
{{--                        <div class="fighter-details">--}}
{{--                            <img src="img/girl.png"--}}
{{--                                 alt="Fighter Kolosova Irina" class="fighter-image" />--}}
{{--                            <p class="fighter-name">--}}
{{--                                Колосова<br />--}}
{{--                                Ирина--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                        <p class="fighter-club">Спортивный клуб "Торнадо"</p>--}}
{{--                    </div>--}}
{{--                    <p class="fight-number">Бой №1</p>--}}
{{--                    <div class="fighter-info">--}}
{{--                        <div class="fighter-details">--}}
{{--                            <img src="img/girl.png"--}}
{{--                                 alt="Fighter Kolosova Irina" class="fighter-image" />--}}
{{--                            <p class="fighter-name">--}}
{{--                                Колосова<br />--}}
{{--                                Ирина--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                        <p class="fighter-club">Спортивный клуб "Торнадо"</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="tour__step tour__step-other">--}}
{{--                <div class="tour_block">--}}
{{--                    <div class="fighter-info">--}}
{{--                        <div class="fighter-details">--}}
{{--                            <img src="img/girl.png"--}}
{{--                                 alt="Fighter Kolosova Irina" class="fighter-image" />--}}
{{--                            <p class="fighter-name">--}}
{{--                                Колосова<br />--}}
{{--                                Ирина--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                        <p class="fighter-club">Спортивный клуб "Торнадо"</p>--}}
{{--                    </div>--}}
{{--                    <p class="fight-number">Бой №1</p>--}}
{{--                    <div class="fighter-info">--}}
{{--                        <div class="fighter-details">--}}
{{--                            <img src="img/girl.png"--}}
{{--                                 alt="Fighter Kolosova Irina" class="fighter-image" />--}}
{{--                            <p class="fighter-name">--}}
{{--                                Колосова<br />--}}
{{--                                Ирина--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                        <p class="fighter-club">Спортивный клуб "Торнадо"</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </main>
</div>
