<?php

namespace App\Filament\Resources\TournamentResource\RelationManagers;

use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

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
                    ->recordTitle(fn(Model $record) => "{$record->first_name} {$record->last_name}")
                    ->recordSelectOptionsQuery(fn(Builder $query) => $query->where('organization_id', auth()->id()))
                    ->preloadRecordSelect(),
            ])
            ->actions([
//                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make()
                    ->visible(fn($record) => $record->organization_id === auth()->id()),
//                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
//                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function isReadOnly(): bool
    {
        return false;
    }
}
