<?php

namespace App\Filament\Resources\TournamentResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TrenersRelationManager extends RelationManager
{
    protected static string $relationship = 'treners';
    protected static ?string $title = 'Тренеры принимающие участие';

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
            ->modifyQueryUsing(fn (Builder $query) => $query->where('organization_id', auth()->id()))
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->label('Имя'),
                Tables\Columns\TextColumn::make('last_name')
                    ->label('Фамилия'),
                Tables\Columns\TextColumn::make('club')
                    ->label('Клуб'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->multiple()
                    ->recordSelectOptionsQuery(fn (Builder $query) => $query->where('organization_id', auth()->id()))
                    ->preloadRecordSelect(),
            ])
            ->actions([
//                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
//                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
//                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
