<div>
    <style>
        .custom-checkbox {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .custom-checkbox input[type="checkbox"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }

        .custom-checkbox-label {
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.3s; /* Плавный переход цвета */
        }

        .custom-checkbox input[type="checkbox"]:checked {
            border-color: green;
            background-color: green;
        }
    </style>

    <div>
        <div class="custom-checkbox">
            <input
                type="checkbox"
                id="checkbox-{{ $record->id }}"
                name="checkbox-{{ $record->id }}"
                wire:model="state"
            wire:change="toggleState"
                @checked($state)
            >
            <label
                for="checkbox-{{ $record->id }}"
                class="custom-checkbox-label"
                style="{{ $state ? 'color: green;' : '' }}"
            >
                {{ $state ? 'Подтвержден' : 'Не подтвержден' }}
            </label>
        </div>
    </div>

</div>
