<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WaitConfirmationInvitationResource\Pages;
use App\Filament\Resources\WaitConfirmationInvitationResource\RelationManagers;
use App\Models\WaitConfirmationInvitation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WaitConfirmationInvitationResource extends Resource
{
    protected static ?string $model = WaitConfirmationInvitation::class;
    protected static ?string $modelLabel = 'Ожидаем подтверждение';
    protected static ?string $pluralModelLabel = 'Ожидаем подтверждения';
    protected static ?string $cluster = \App\Filament\Clusters\Trener::class;
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
            ->modifyQueryUsing(fn (Builder $query) => $query->where('confirmed', false)->where('inviting_id', auth()->id()))
            ->columns([
                Tables\Columns\TextColumn::make('email')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
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
            'index' => Pages\ListWaitConfirmationInvitations::route('/'),
//            'create' => Pages\CreateWaitConfirmationInvitation::route('/create'),
//            'edit' => Pages\EditWaitConfirmationInvitation::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        $modelClass = static::$model;

        return (string) $modelClass::where('confirmed', false)->where('inviting_id', auth()->id())->count();
    }
}
