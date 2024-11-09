<?php

namespace App\Filament\Resources\TournamentResource\RelationManagers;

use App\Models\Pool;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
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
                    ->selectRaw('MIN(id) as id, tournament_id, list_id')
                    ->groupBy('tournament_id', 'list_id')
                    ->orderBy('tournament_id', 'asc'); // Указываем явную сортировку
            })
            ->columns([
                Tables\Columns\TextColumn::make('templateStudentList.name')
                    ->label('Пуля')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                // Определите фильтры при необходимости
            ])
            ->headerActions([
                Tables\Actions\Action::make('download_lists')
                    ->label('Скачать пули')
                    ->color('warning')
                    ->url(fn($livewire): string => url('panel/tournament-student-puli-pdf/' . $livewire->getOwnerRecord()->id))
                    ->openUrlInNewTab(),
            ])
            ->actions([
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
