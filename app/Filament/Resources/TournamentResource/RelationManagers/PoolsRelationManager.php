<?php

namespace App\Filament\Resources\TournamentResource\RelationManagers;

use App\Models\Pool;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class PoolsRelationManager extends RelationManager
{
    protected static string $relationship = 'pools';
    protected static ?string $title = 'Пули';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->modifyQueryUsing(function (Builder $query) {
                return $query
                    ->selectRaw('MIN(id) as id, tournament_id, list_id, MAX(tatami) as tatami') // Добавляем tatami в запрос
                    ->groupBy('tournament_id', 'list_id')
                    ->orderBy('tournament_id', 'asc'); // Указываем явную сортировку
            })
            ->columns([
                Tables\Columns\TextColumn::make('templateStudentList.name')
                    ->label('Пуля')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('tatami')
                    ->label('Татами') // Название столбца
                    ->sortable(), // Делаем поле сортируемым
            ])
            ->filters([
                SelectFilter::make('tatami')
                    ->label('Татами')
                    ->options(function ($livewire) {
                        $tatamiCount = $livewire->getOwnerRecord()->tatami; // Получаем значение tatami у родительской записи
                        $options = [];
                        for ($i = 1; $i <= $tatamiCount; $i++) {
                            $options[chr(64 + $i)] = chr(64 + $i); // Генерируем буквы алфавита (A, B, C...)
                        }
                        return $options;
                    })
            ])
            ->headerActions([
                Tables\Actions\Action::make('download_lists')
                    ->label('Скачать пули')
                    ->color('warning')
                    ->url(fn($livewire): string => url('panel/tournament-student-puli-pdf/' . $livewire->getOwnerRecord()->id))
                    ->openUrlInNewTab(),
            ])
            ->actions([
                Tables\Actions\Action::make('select_tatami')
                    ->label('Добавить в Татами')
                    ->icon('heroicon-o-cog')
                    ->action(function ($record, $data, $livewire) {
                        // Получаем записи, которые соответствуют группировке
                        $relatedRecords = Pool::where('tournament_id', $record->tournament_id)
                            ->where('list_id', $record->list_id)
                            ->get();

                        // Обновляем tatami для всех записей в группе
                        foreach ($relatedRecords as $relatedRecord) {
                            $relatedRecord->tatami = $data['tatami'];
                            $relatedRecord->save();
                        }
                        // Действие после подтверждения выбора
                        // Здесь можно обработать результат, например, сохранить выбранное значение
                        $record->tatami = $data['tatami'];
                        $record->save();
                    })
                    ->form([
                        // Выпадающий список с татами
                        Forms\Components\Select::make('tatami')
                            ->label('Выберите Татами')
                            ->options(function ($livewire) {
                                $tatamiCount = $livewire->getOwnerRecord()->tatami; // Получаем значение tatami у родительской записи
                                $options = [];
                                for ($i = 1; $i <= $tatamiCount; $i++) {
                                    $options[chr(64 + $i)] = chr(64 + $i); // Генерируем буквы алфавита (A, B, C...)
                                }
                                return $options;
                            })
                            ->required(),
                    ])
                    ->modalHeading('Выбор Татами')
                    ->color('primary')
            ->visible(fn($livewire) => $livewire->getOwnerRecord()->organization_id == auth()->id()),
                Tables\Actions\Action::make('view_pool')
                    ->icon('heroicon-o-trophy')
                    ->url(fn($record, $livewire): string => url('panel/tournament-puli/' . $record->list_id . '/tournament/' . $livewire->getOwnerRecord()->id))
                    ->openUrlInNewTab()
                    ->label('Посмотреть'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(), // Раскомментируйте, если нужно действие удаления
                ]),
            ]);
    }




}
