<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrganizationTournamentResource\Pages;
use App\Filament\Resources\OrganizationTournamentResource\RelationManagers;
use App\Models\OrganizationTournament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrganizationTournamentResource extends Resource
{
    protected static ?string $model = OrganizationTournament::class;
    protected static ?string $modelLabel = 'Подключение организаторов';
    protected static ?string $pluralModelLabel = 'Подключение организаторов';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tournament.name')
                    ->label('Турнир'),
                Tables\Columns\TextColumn::make('organization.name')
                    ->label('Организация'),
                Tables\Columns\SelectColumn::make('is_success')
                    ->options([
                        'accepted' => 'Принят',
                        'canceled' => 'Отклонен',
                    ])
                    ->label('Статус')
            ])
            ->filters([
                //
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
//                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrganizationTournaments::route('/'),
//            'create' => Pages\CreateOrganizationTournament::route('/create'),
//            'edit' => Pages\EditOrganizationTournament::route('/{record}/edit'),
        ];
    }
}
