<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div>
{{--        {{ $getState() }}--}}
        <div class="profile-stats-row">
            <div class="profile-stats-item">
                <div class="profile-stats-label">Рейтинг</div>
                <div class="profile-stats-value">0</div>
            </div>
            <div class="profile-stats-item">
                <div class="profile-stats-label">Золото 🥇</div>
                <div class="profile-stats-icon-wrapper">
                    <div class="profile-stats-icon-text">0</div>
                </div>
            </div>
            <div class="profile-stats-item">
                <div class="profile-stats-label">Серебро 🥈</div>
                <div class="profile-stats-icon-wrapper">
                    <div class="profile-stats-icon-text">0</div>
                </div>
            </div>
            <div class="profile-stats-item">
                <div class="profile-stats-label">Бронза 🥉</div>
                <div class="profile-stats-icon-wrapper">
                    <div class="profile-stats-icon-text">0</div>
                </div>
            </div>
            <div class="profile-stats-record">
                <div class="profile-stats-label">Победы/Поражения</div>
                <div class="profile-info-value">0 / 0</div>
            </div>
        </div>
        <style>
            .profile-stats-container {
                display: flex;
                flex-wrap: wrap;
            }

            .profile-stats-row {
                display: flex;
                flex-wrap: wrap;
                gap: 16px; /* Отступы между элементами */
            }

            .profile-stats-item,
            .profile-stats-record {
                display: flex;
                align-items: center;
                flex: 1;
                min-width: 150px; /* Минимальная ширина для элементов */
            }

            .profile-stats-label {
                font-weight: bold;
                margin-right: 8px; /* Отступ между лейблом и значением */
            }

            .profile-stats-value,
            .profile-info-value {
                font-size: 14px;
            }

            .profile-stats-icon-wrapper {
                display: flex;
                align-items: center;
            }

            .profile-stats-icon {
                width: 16px;
                height: 16px;
                margin-right: 4px; /* Отступ между иконкой и текстом */
            }

            .profile-stats-icon-gold {
                background-color: gold;
            }

            .profile-stats-icon-silver {
                background-color: silver;
            }

            .profile-stats-icon-bronze {
                background-color: bronze;
            }

            .profile-stats-icon-text {
                font-size: 14px;
            }

        </style>
    </div>
</x-dynamic-component>
