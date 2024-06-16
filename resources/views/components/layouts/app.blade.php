<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
{{--    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">--}}
    <link rel="stylesheet" href="{{asset('assets/css/style.min.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap&_v=20240405221544"
          rel="stylesheet">
    <title>Авторизация</title>
</head>



<body>
<div class="wrapper">
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo-container">
                    <img
                            src="{{asset('assets/img/logo.png')}}"
                            alt="Logo icon" class="logo-icon"/>
                    <span class="logo-text">KARATERANG</span>
                </div>
                <nav class="nav-item">
                    <ul>
{{--                        <li class="student_status">--}}
{{--                            <a href="filter_region.html" class="coach_status link_nav">--}}
{{--                                <svg width="19.000000" height="19.000000" viewBox="0 0 19 19" fill="none"--}}
{{--                                     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">--}}
{{--                                    <defs/>--}}
{{--                                    <path id="Icon"--}}
{{--                                          d="M13.21 16.42C10.88 18.74 7.11 18.74 4.78 16.42C2.45 14.09 2.45 10.32 4.78 7.99C7.11 5.66 10.88 5.66 13.21 7.99C15.54 10.32 15.54 14.09 13.21 16.42ZM13.45 8.25L16.94 2.01C17.34 1.29 17.54 0.93 17.51 0.64C17.48 0.38 17.34 0.15 17.14 0C16.9 -0.17 16.48 -0.17 15.66 -0.17L13.61 -0.17C13.31 -0.17 13.16 -0.17 13.02 -0.13C12.9 -0.09 12.79 -0.02 12.69 0.06C12.58 0.16 12.5 0.29 12.35 0.55L9 6.25L5.64 0.55C5.49 0.29 5.41 0.16 5.3 0.06C5.21 -0.02 5.09 -0.09 4.97 -0.13C4.83 -0.17 4.68 -0.17 4.38 -0.17L2.33 -0.17C1.51 -0.17 1.09 -0.17 0.86 0C0.65 0.15 0.51 0.38 0.48 0.64C0.45 0.93 0.65 1.29 1.05 2.01L4.54 8.25M7.62 10.83L9 9.91L9 14.5M7.85 14.5L10.14 "--}}
{{--                                          stroke="#071C31" stroke-opacity="1.000000" stroke-width="1.500000"--}}
{{--                                          stroke-linejoin="round"/>--}}
{{--                                </svg>--}}

{{--                                <span class="nav-text">--}}
{{--                Турниры--}}
{{--              </span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                        <li class="select_drop coach_status">
                            <a href="#" class="link_nav select_drop_link">
                                <svg width="19.000000" height="19.000000" viewBox="0 0 19 19" fill="none"
                                     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <defs/>
                                    <path id="Icon"
                                          d="M13.21 16.42C10.88 18.74 7.11 18.74 4.78 16.42C2.45 14.09 2.45 10.32 4.78 7.99C7.11 5.66 10.88 5.66 13.21 7.99C15.54 10.32 15.54 14.09 13.21 16.42ZM13.45 8.25L16.94 2.01C17.34 1.29 17.54 0.93 17.51 0.64C17.48 0.38 17.34 0.15 17.14 0C16.9 -0.17 16.48 -0.17 15.66 -0.17L13.61 -0.17C13.31 -0.17 13.16 -0.17 13.02 -0.13C12.9 -0.09 12.79 -0.02 12.69 0.06C12.58 0.16 12.5 0.29 12.35 0.55L9 6.25L5.64 0.55C5.49 0.29 5.41 0.16 5.3 0.06C5.21 -0.02 5.09 -0.09 4.97 -0.13C4.83 -0.17 4.68 -0.17 4.38 -0.17L2.33 -0.17C1.51 -0.17 1.09 -0.17 0.86 0C0.65 0.15 0.51 0.38 0.48 0.64C0.45 0.93 0.65 1.29 1.05 2.01L4.54 8.25M7.62 10.83L9 9.91L9 14.5M7.85 14.5L10.14 "
                                          stroke="#071C31" stroke-opacity="1.000000" stroke-width="1.500000"
                                          stroke-linejoin="round"/>
                                </svg>

                                <span class="nav-text">
                Турниры
                <div class="select_icon">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M6.70711 11.2929C6.31658 10.9024 5.68342 10.9024 5.29289 11.2929C4.90237 11.6834 4.90237 12.3166 5.29289 12.7071L11.2929 18.7071C11.6715 19.0857 12.2811 19.0989 12.6757 18.7372L18.6757 13.2372C19.0828 12.864 19.1103 12.2314 18.7372 11.8243C18.364 11.4172 17.7314 11.3897 17.3243 11.7628L12.0301 16.6159L6.70711 11.2929Z"
                            fill="#071C31"/>
                  </svg>
                </div>
              </span>
                            </a>
                            <div class="select_list">
                                <ul>
                                    <li class="all_status">
                                        <a href="{{route('filter.region')}}">Расписание</a>
                                    </li>
                                    @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->role_id == \App\Models\User::Coach)
                                    <li class="coach_status"><a href="{{route('coach.tournament')}}">Заявить учеников</a></li>
                                    @endif
                                    @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->role_id == \App\Models\User::Organization)
                                    <li class="organizate_status"><a href="{{route('manage.tournament')}}">Мои турниры</a></li>
                                    @endif
                                </ul>
                            </div>
                        </li>
                        @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->role_id == \App\Models\User::Coach)
                        <li class="coach_status">
                            <a href="{{route('coach.student')}}" class="link_nav">
                                <svg width="20" height="18" viewBox="0 0 20 18" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M15.5 12.5171C16.8346 13.1876 17.9788 14.2635 18.814 15.6088C18.9794 15.8752 19.0621 16.0085 19.0907 16.1929C19.1488 16.5678 18.8924 17.0287 18.5433 17.177C18.3715 17.25 18.1782 17.25 17.7917 17.25M13.6667 8.57122C15.0249 7.89623 15.9583 6.49462 15.9583 4.875C15.9583 3.25538 15.0249 1.85377 13.6667 1.17878M11.8333 4.875C11.8333 7.15317 9.98651 9 7.70834 9C5.43016 9 3.58334 7.15317 3.58334 4.875C3.58334 2.59683 5.43016 0.75 7.70834 0.75C9.98651 0.75 11.8333 2.59683 11.8333 4.875ZM1.34596 15.3601C2.80741 13.1658 5.11359 11.75 7.70834 11.75C10.3031 11.75 12.6093 13.1658 14.0707 15.3601C14.3909 15.8409 14.551 16.0812 14.5325 16.3883C14.5182 16.6273 14.3615 16.92 14.1704 17.0645C13.9251 17.25 13.5877 17.25 12.9128 17.25H2.50383C1.82899 17.25 1.49157 17.25 1.24624 17.0645C1.05521 16.92 0.898501 16.6273 0.884151 16.3883C0.865721 16.0812 1.0258 15.8409 1.34596 15.3601Z"
                                            stroke="#071C31" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"/>
                                </svg>

                                Ученики
                            </a>
                        </li>
                        @endif
                        @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->role_id == \App\Models\User::Organization)
                        <li class="organizate_status">
                            <a href="{{route('organize.coach')}}" class="link_nav">
                                <svg width="22.000000" height="22.000000" viewBox="0 0 22 22" fill="none"
                                     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <desc>
                                        Created with Pixso.
                                    </desc>
                                    <defs>
                                        <clipPath id="clip6047_1204">
                                            <rect id="user-02" width="22.000000" height="22.000000" fill="white"
                                                  fill-opacity="0"/>
                                        </clipPath>
                                    </defs>
                                    <rect id="user-02" width="22.000000" height="22.000000" fill="#FFFFFF"
                                          fill-opacity="0"/>
                                    <g clip-path="url(#clip6047_1204)">
                                        <path id="Icon"
                                              d="M11 13.75C13.9 13.75 16.49 15.15 18.13 17.33C18.48 17.79 18.66 18.03 18.66 18.35C18.65 18.59 18.5 18.9 18.31 19.05C18.06 19.25 17.71 19.25 17.02 19.25L4.97 19.25C4.28 19.25 3.93 19.25 3.68 19.05C3.49 18.9 3.34 18.59 3.33 18.35C3.33 18.03 3.51 17.79 3.86 17.33C5.5 15.15 8.09 13.75 11 13.75ZM11 11C8.72 11 6.87 9.15 6.87 6.87C6.87 4.59 8.72 2.75 11 2.75C13.27 2.75 15.12 4.59 15.12 6.87C15.12 9.15 13.27 11 11 11Z"
                                              stroke="#071C31" stroke-opacity="1.000000" stroke-width="1.500000"
                                              stroke-linejoin="round"/>
                                    </g>
                                </svg>

                                Тренеры
                            </a>
                        </li>
                        @endif
                    </ul>
                </nav>
                @guest()
                <a href="{{route('login')}}" class="login-button">Войти</a>
                @endguest
                @auth()
                <div class="select_drop">
                    <div class="profile_header select_drop_link">
                        @if(isset(auth()->user()->first_name) || isset(auth()->user()->last_name))
                        <span>{{auth()->user()->first_name}}<br>{{auth()->user()->last_name}}</span>
                        @else
                            <span>{{auth()->user()->name}}</span>
                        @endif
                        @if(\Illuminate\Support\Facades\Auth::user()->avatar)
                                <img style="width: 35px; height: 35px" src="{{asset('storage/' . \Illuminate\Support\Facades\Auth::user()->avatar)}}">
                            @else
                                <img style="width: 35px; height: 35px" src="{{asset('assets/img/boy.png')}}">
                        @endif
                        <div class="select_icon">
                            <svg width="24.000000" height="24.000000" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink">
                                <desc>
                                    Created with Pixso.
                                </desc>
                                <defs/>
                                <path id="Path 94"
                                      d="M6.7 11.29C6.31 10.9 5.68 10.9 5.29 11.29C4.9 11.68 4.9 12.31 5.29 12.7L11.29 18.7C11.67 19.08 12.28 19.09 12.67 18.73L18.67 13.23C19.08 12.86 19.11 12.23 18.73 11.82C18.36 11.41 17.73 11.38 17.32 11.76L12.03 16.61L6.7 11.29Z"
                                      fill="#071C31" fill-opacity="1.000000" fill-rule="nonzero"/>
                            </svg>
                        </div>
                    </div>

                    <div class="select_list">
                        <ul>
                            @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->role_id == \App\Models\User::Student)
                            <li><a href="{{route('profile')}}">Профиль</a></li>
                            @endif
                            <li><a href="{{route('edit.profile')}}">Редактировать</a></li>
                            <li><livewire:logout /></li>
                        </ul>
                    </div>
                </div>
                @endauth
                <div class="menu">
                    <input type="checkbox" id="burger-checkbox" class="burger-checkbox">
                    <label for="burger-checkbox" class="burger"></label>
                    <ul class="menu-list">
                        <style>
                            .tournament-schedule {
                                display: flex;
                                flex-direction: column;
                                width: 220px;
                                justify-content: center;
                                position: relative;
                                color: #fff;
                                font-size: 20px;
                                font-weight: 700;
                                letter-spacing: 2%;
                                line-height: 24px;
                            }

                            .schedule-header {
                                display: flex;
                                gap: 12px;
                                padding: 0 20px;
                            }

                            .icon {
                                width: 32px;
                                aspect-ratio: 1;
                                object-fit: auto;
                                object-position: center;
                            }

                            .schedule-title {
                                margin: auto 0;
                                font-family: 'IBM Plex Mono', sans-serif;
                            }

                            .edit-section {
                                display: flex;
                                align-items: start;
                                margin-top: 12px;
                                padding-left: 32px;
                                gap: 12px;
                            }

                            .edit-icon {
                                width: 16px;
                                aspect-ratio: 0.18;
                                object-fit: auto;
                                object-position: center;
                                stroke: #fff;
                                stroke-width: 1.5px;
                                border: 2px solid rgba(255, 255, 255, 1);
                            }

                            .edit-options {
                                display: flex;
                                flex-direction: column;
                                margin-top: 17px;
                            }

                            .edit-text,
                            .register-students {
                                font-family: 'IBM Plex Mono', sans-serif;
                            }

                            .register-students {
                                margin-top: 35px;
                            }

                            .students-section,
                            .coaches-section,
                            .organizers-section {
                                display: flex;
                                gap: 12px;
                                padding: 0 20px;
                                white-space: nowrap;
                            }

                            .students-section {
                                margin-top: 32px;
                            }

                            .students-title,
                            .coaches-title,
                            .organizers-title {
                                margin: auto 0;
                                font-family: 'IBM Plex Mono', sans-serif;
                            }

                            .coaches-section {
                                margin-top: 32px;
                                line-height: 100%;
                            }

                            .organizers-section {
                                margin-top: 32px;
                            }
                        </style>

                        <div class="tournament-schedule">
                            @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->role_id == \App\Models\User::Coach)
                                <li class="coach_status"><a href="{{route('coach.tournament')}}">Заявить учеников</a></li>

                            <a href="{{route('filter.region')}}" class="schedule-header">
                                <h2 class="schedule-title">Расписание</h2>
                            </a>

                            <div class="organizate_status">
                                <a href="{{route('coach.tournament')}}" class="students-section">
                                    <h3 class="students-title">Заявить учеников</h3>
                                </a>
                            </div>
                            <div class="coach_status">
                                <a href="{{route('coach.student')}}" class="students-section ">
                                    <h3 class="students-title">Ученики</h3>
                                </a>
                            </div>
                            @endif
                                @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->role_id == \App\Models\User::Organization)
                                <div class="coach_status">
                                    <a href="{{route('manage.tournament')}}" class="students-section">
                                        <h3 class="students-title">Мои турниры</h3>
                                    </a>
                                </div>
                                <div class="organizate_status">
                                    <a href="coaches.html" class="coaches-section ">
                                        <h3 class="coaches-title">Тренеры</h3>
                                    </a>
                                </div>
                                @endif
                            @guest()
                            <a href="{{route('login')}}" class="login-button-mobile coaches-section">
                                <h3 class="coaches-title">Войти</h3>
                            </a>
                            @endguest
{{--                            <div class="organizate_status">--}}
{{--                                <div class="students-section">--}}
{{--                                    <h3 class="students-title">Организаторы</h3>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                        </div>
                        <div id="profile-header-mobile" class="tournament-schedule  tournament-schedule-before">
                            @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->role_id == \App\Models\User::Student)
                            <a href="{{route('profile')}}" class="students-section profile-header-mobile profile-header">

                                <h2 class="profile-name">
                                    Мой профиль
                                </h2>
                            </a>
                            @endif
                            <a href="{{route('edit.profile')}}" class="students-section profile-header-mobile profile-header">

                                <h2 class="profile-name">
                                    Редактировать
                                </h2>
                            </a>
                            <a href="#" id="unlog" class="students-section profile-header-mobile profile-header">

                                <h2 class="profile-name">
                                    <livewire:logout />
                                </h2>
                            </a>
                        </div>

                    </ul>
                </div>
            </div>
        </div>
    </header>
    {{$slot}}
</div>
<script src="{{asset('assets/js/app.min.js?_v=20240405221544')}}"></script>

</body>

</html>
