<div>
    @if($showModal)
        <!-- Модальное окно -->
        <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.75); display: flex; align-items: center; justify-content: center;">
            <div style="background: white; padding: 16px; border-radius: 8px; width: 100%; max-width: 500px;">
                <h2 style="font-size: 24px; margin-bottom: 16px;">{{ $listIndex !== null ? 'Редактировать список' : 'Создать список' }}</h2>
                <form wire:submit.prevent="{{ $listIndex !== null ? 'updateList' : 'createList' }}">
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
                        <button type="button" wire:click="$set('showModal', false)" style="margin-right: 8px; padding: 8px 16px; background: #ccc; color: white; border: none; border-radius: 4px;">Отмена</button>
                        @if($listIndex !== null)
                            <button type="button" wire:click="deleteList" style="margin-right: 8px; padding: 8px 16px; background: #ff0000; color: white; border: none; border-radius: 4px;">Удалить</button>
                        @endif
                        <button type="submit" style="padding: 8px 16px; background: #007bff; color: white; border: none; border-radius: 4px;">{{ $listIndex !== null ? 'Обновить' : 'Создать' }}</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
