<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewStudent extends ViewRecord
{
    protected static string $resource = StudentResource::class;

    use InteractsWithRecord;
    public function getTitle(): string|Htmlable
    {
        return $this->record->first_name . ' ' . $this->record->last_name;
    }

    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);
        $currentUser = auth()->user(); // Текущий авторизованный пользователь

        // Проверяем роль пользователя и связь тренера
        if ($currentUser->role_id !== User::Organization && $this->record->coach_id !== $currentUser->id) {
            abort(403, 'У вас нет прав для просмотра этой страницы.');
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()->visible(auth()->user()->role_id == User::Coach),
        ];
    }
}
