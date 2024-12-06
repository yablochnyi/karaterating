<?php

namespace App\Filament\Resources\TrenerResource\RelationManagers;

use App\Exports\StudentsExport;
use App\Filament\Resources\StudentResource\Pages\ViewStudent;
use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class StudentsRelationManager extends RelationManager
{
    protected static string $relationship = 'students';
    protected static ?string $modelLabel = 'Ученик';
    protected static ?string $pluralModelLabel = 'Ученики';
    protected static ?string $title = 'Ученики';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\ImageColumn::make('avatar')
                    ->circular()
                    ->label('Фотография'),
                TextColumn::make('first_name')
                    ->searchable()
                    ->sortable()
                    ->label('Имя'),
                TextColumn::make('last_name')
                    ->searchable()
                    ->sortable()
                    ->label('Фамилия'),
                TextColumn::make('age')
                    ->label('Возраст')
                    ->sortable()
                    ->suffix(' лет'),
                TextColumn::make('weight')
                    ->label('Вес')
                    ->sortable()
                    ->suffix(' кг'),
                TextColumn::make('rang')
                    ->sortable()
                    ->label('Кю / Дан'),
                TextColumn::make('coach_id')
                    ->formatStateUsing(function ($record) {
                        return $record->trener->first_name . ' ' . $record->trener->last_name;
                    })
                    ->label('Тренер')

            ])
            ->filters([
                Filter::make('tournament')
                    ->form([
                        Select::make('tournament_id')
                            ->label('Турнир')
                            ->options(function () {
                                return \App\Models\Tournament::whereHas('treners')
                                    ->pluck('name', 'id')
                                    ->toArray();
                            }),
                    ])
                    ->query(function (Builder $query, array $data) {
                        if (!empty($data['tournament_id'])) {
                            $query->whereHas('tournaments', function (Builder $subQuery) use ($data) {
                                $subQuery->where('tournaments.id', $data['tournament_id']);
                            });
                        }
                    })
                    ->indicateUsing(function (array $data): ?string {
                        return !empty($data['tournament_id'])
                            ? 'Фильтр по турниру: ' . \App\Models\Tournament::find($data['tournament_id'])->name
                            : null;
                    }),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Action::make('exportPDF')
                    ->label('Скачать в PDF') // Текст кнопки
                    ->action(function ($livewire) {
                        $filters = $livewire->tableFilters['tournament'] ?? [];
                        return Excel::download(new StudentsExport($livewire->getOwnerRecord()->id, $filters), 'students.pdf', \Maatwebsite\Excel\Excel::MPDF);
                    })
                    ->visible(fn($livewire) =>
                        $livewire->getOwnerRecord()->organization_id === Auth::id()
                        || $livewire->getOwnerRecord()->id === Auth::id()
                    )
                    ->color('warning'),
                Action::make('exportExcel')
                    ->label('Скачать в Excel') // Текст кнопки
                    ->action(function ($livewire) {
                        $filters = $livewire->tableFilters['tournament'] ?? [];
                        return Excel::download(new StudentsExport($livewire->getOwnerRecord()->id, $filters), 'students.xlsx');
                    })
                    ->visible(fn($livewire) =>
                        $livewire->getOwnerRecord()->organization_id === Auth::id()
                        || $livewire->getOwnerRecord()->id === Auth::id()
                    )
                    ->color('warning')

            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Просмотр') // Текст кнопки
                    ->icon('heroicon-o-eye') // Иконка (опционально)
                    ->url(fn($record) => route('filament.admin.trener.resources.students.view', $record->id)) // Генерация URL
                    ->openUrlInNewTab()
                    ->visible(function ($record, $livewire) {
                        // Получаем текущего пользователя
                        $currentUser = auth()->user();

                        // Кнопка видима, если:
                        return (
                            // Пользователь является организатором
                            $livewire->getOwnerRecord()->organization_id == $currentUser->id
                            // Или он — тренер для этой записи
                            || $record->coach_id == $currentUser->id
                        );
                    }),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

}
