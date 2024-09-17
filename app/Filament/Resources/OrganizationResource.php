<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrganizationResource\Pages;
use App\Filament\Resources\OrganizationResource\RelationManagers;
use App\Models\Organization;
use App\Models\Region;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class OrganizationResource extends Resource
{
    protected static ?string $model = Organization::class;
    protected static ?string $slug = 'organizations';
    protected static ?string $modelLabel = 'Организация';
    protected static ?string $pluralModelLabel = 'Организации';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->columnSpanFull()
                            ->required()
                            ->label('Название организации'),
                        Forms\Components\TextInput::make('email')
                            ->required()
                            ->label('Email'),
                        Forms\Components\TextInput::make('password')
                            ->label('Пароль')
                            ->password()
                            ->revealable()
                            ->dehydrated(fn(?string $state): bool => filled($state))
                            ->required(fn(string $operation): bool => $operation === 'create'),
                        Forms\Components\Select::make('region_id')
                            ->label('Регион')
                            ->options(Region::all()->pluck('name', 'id')),
                        Forms\Components\TextInput::make('ref_token')
                            ->columnSpanFull()
                            ->readOnly()
                            ->label('Реферальная ссылка'),

                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Название организации')
                    ->searchable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListOrganizations::route('/'),
            'create' => Pages\CreateOrganization::route('/create'),
            'edit' => Pages\EditOrganization::route('/{record}/edit'),
        ];
    }
}
