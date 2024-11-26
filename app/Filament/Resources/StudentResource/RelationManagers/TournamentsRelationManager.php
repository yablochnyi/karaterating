<?php

namespace App\Filament\Resources\StudentResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TournamentsRelationManager extends RelationManager
{
    protected static string $relationship = 'tournaments';
    protected static ?string $modelLabel = 'Турнир';
    protected static ?string $pluralModelLabel = 'Турниры';
    protected static ?string $title = 'Турниры';

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
                TextColumn::make('name')
                    ->searchable()
                    ->label('Турнир'),
                TextColumn::make('wins_losses')
                    ->label('Победы/Поражения')
                    ->getStateUsing(fn ($livewire) => $livewire->getOwnerRecord()->getWinsAndLosses()['wins'] . ' / ' . $livewire->getOwnerRecord()->getWinsAndLosses()['losses']),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
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
