<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div>
        @php
            // Функции для получения цвета пояса и полосок
            function getColorForLevel($level) {
                if ($level) {
                   $colors = [
                    'кю' => [
                        0 => '#FFFFFF',
                        10 => '#FF7F00',
                        9 => '#FF7F00',
                        8 => '#0000FF',
                        7 => '#0000FF',
                        6 => '#FFD700',
                        5 => '#FFD700',
                        4 => '#00FF00',
                        3 => '#00FF00',
                        2 => '#8B4513',
                        1 => '#8B4513',
                    ],
                    'дан' => [
                        1 => '#000000',
                        2 => '#000000',
                        3 => '#000000',
                        4 => '#000000',
                        5 => '#000000',
                        6 => '#000000',
                        7 => '#000000',
                        8 => '#000000',
                        9 => '#000000',
                        10 => '#000000',
                    ],
                ];

                list($number, $type) = explode(' ', $level);
                $number = (int) $number;
                $type = strtolower($type);

                return $colors[$type][$number] ?? '#000000';
                }

            }

            function getStripeColorForLevel($level) {
                if ($level) {
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

                list($number, $type) = explode(' ', $level);
                $number = (int) $number;
                $type = strtolower($type);

                return $stripeColors[$type][$number] ?? [];
                }

            }

            $beltColor = getColorForLevel($getState());
            $stripeColors = getStripeColorForLevel($getState());
        @endphp

        <div class="belt" style="background-color: {{ $beltColor }};">
            @if($stripeColors)
                @foreach ($stripeColors as $index => $stripeColor)
                    <div class="belt-stripe"
                         style="background-color: {{ $stripeColor }};
                left: {{ $index * 2 + 10 }}%; /* Добавляем смещение */">
                    </div>
                @endforeach

            @endif

        </div>

        <style>
            .belt {
                width: 26%;
                height: 20px;
                margin: 5px 0;
                position: relative;
                text-align: center;
                line-height: 20px;
            }

            .belt-stripe {
                position: absolute;
                top: 0;
                bottom: 0;
                width: 3px;
                left: 10px;
                /* Расположение полосок будет управляться через inline-стили */
            }
        </style>

    </div>
</x-dynamic-component>
