<?php

namespace App\Filament\Resources\TournamentResource\RelationManagers;

use App\Http\Controllers\GeneratePuliController;
use App\Models\Pool;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use IbrahimBougaoua\FilamentSortOrder\Actions\DownStepAction;
use IbrahimBougaoua\FilamentSortOrder\Actions\UpStepAction;
use IbrahimBougaoua\FilaProgress\Tables\Columns\CircleProgress;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\HtmlString;

class PoolsRelationManager extends RelationManager
{
    protected static string $relationship = 'listWhereExistPools';
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
            ->columns([
                TextColumn::make('id'),
                CircleProgress::make('circle')
                    ->label('Завершенность')
                    ->getStateUsing(function ($record) {
                        $poolsTotal = '';
                        $poolsProgress = '';
                        $type = $record->pools->first()->type;
                        if ($type == 'Round Robin') {
                            $poolsTotal = Pool::where('tournament_id', $record->tournament_id)
                                ->where('list_id', $record->id)
                                ->count();


                            $poolsProgress = Pool::where('tournament_id', $record->tournament_id)
                                ->where('list_id', $record->id)
                                ->whereNotNull('winner_id_1rd_robbin')
                                ->whereNotNull('winner_id_2rd_robbin')
                                ->where('winner_id', '!=', null)
                                ->count();
//                            dd($poolsProgress);
                        } else {
                            $poolsTotal = Pool::where('tournament_id', $record->tournament_id)
                                ->where('list_id', $record->id)
                                ->whereNotNull('student_id')
                                ->whereNotNull('opponent_id')
                                ->count();

                            $poolsProgress = Pool::where('tournament_id', $record->tournament_id)
                                ->where('list_id', $record->id)
                                ->whereNotNull('student_id')
                                ->whereNotNull('opponent_id')
                                ->where('winner_id', '!=', null)
                                ->count();
                        }

                        return [
                            'total' => $poolsTotal,
                            'progress' => $poolsProgress,
                        ];
                    }),
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
                    }),


            ])

            ->headerActions([
                Tables\Actions\Action::make('download_lists')
                    ->label('Скачать пули')
                    ->color('warning')
//                    ->hidden()
                    ->url(fn($livewire): string => url('panel/tournament-student-puli-pdf/' . $livewire->getOwnerRecord()->id))
                    ->openUrlInNewTab(),
            ])
            ->actions([
                DownStepAction::make()
                    ->hidden(fn($livewire) => now()->greaterThan($livewire->getOwnerRecord()->date_finish))
                    ->visible(fn($livewire) => $livewire->getOwnerRecord()->organization_id == auth()->id())
                    ->label('Вниз'),
                UpStepAction::make()
                    ->hidden(fn($livewire) => now()->greaterThan($livewire->getOwnerRecord()->date_finish))
                    ->visible(fn($livewire) => $livewire->getOwnerRecord()->organization_id == auth()->id())
                    ->label('Вверх'),

                Tables\Actions\Action::make('select_tatami')
                    ->label('Добавить в Татами')
                    ->icon('heroicon-o-cog')
                    ->action(function ($record, $data, $livewire) {
                        // Получаем записи, которые соответствуют группировке
                        $relatedRecords = Pool::where('tournament_id', $record->tournament_id)
                            ->where('list_id', $record->id)
                            ->get();

                        // Обновляем tatami для всех записей в группе
                        foreach ($relatedRecords as $relatedRecord) {
                            $relatedRecord->tatami = $data['tatami'];
                            $relatedRecord->save();
                        }

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
                    ->hidden(fn($livewire) => now()->greaterThan($livewire->getOwnerRecord()->date_finish))
                    ->visible(fn($livewire) => $livewire->getOwnerRecord()->organization_id == auth()->id()),
                Tables\Actions\Action::make('view_pool')
                    ->icon('heroicon-o-trophy')
                    ->url(fn($record, $livewire): string => url('panel/tournament-puli/' . $record->id . '/tournament/' . $livewire->getOwnerRecord()->id))
                    ->openUrlInNewTab()
                    ->label('Посмотреть'),
                Tables\Actions\Action::make('regenerate_pool')
                    ->icon('heroicon-s-arrow-path-rounded-square')
                    ->color('danger')
                    ->action(function ($record, $data, $livewire) {
                        $index = new GeneratePuliController();
                        $index->generate($livewire->getOwnerRecord()->id, $record->list_id);
                    })
                    ->hidden(fn($livewire) => now()->greaterThan($livewire->getOwnerRecord()->date_finish))
                    ->visible(fn($livewire) => $livewire->getOwnerRecord()->organization_id == auth()->id())
                    ->label('Перегенерировать'),
            ])
            ->defaultSort('sort_order', 'asc')
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(), // Раскомментируйте, если нужно действие удаления
                ]),
            ]);
    }


}
