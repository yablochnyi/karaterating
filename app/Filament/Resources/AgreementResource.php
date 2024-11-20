<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgreementResource\Pages;
use App\Filament\Resources\AgreementResource\RelationManagers;
use App\Models\Agreement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AgreementResource extends Resource
{
    protected static ?string $model = Agreement::class;
    protected static ?string $modelLabel = 'Договор';
    protected static ?string $pluralModelLabel = 'Договоры';
    protected static ?string $navigationIcon = 'heroicon-o-document';

    public static function form(Form $form): Form
    {
        $existingDiscounts = Agreement::all()->pluck('type')->toArray();
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\Select::make('type')
                        ->label('Тип')
                        ->required()
                        ->options(function ($operation) use ($existingDiscounts) {
                            if ($operation === 'create') {
                                return collect([
                                    'terms_of_service' => 'Договор оферты',
                                    'privacy_policy' => 'Политика конфиденциальности',
                                    'data_processing_consent' => 'Согласие на обработку персональных данных',
                                ])->except($existingDiscounts);
                            } else {
                                return collect([
                                    'terms_of_service' => 'Договор оферты',
                                    'privacy_policy' => 'Политика конфиденциальности',
                                    'data_processing_consent' => 'Согласие на обработку персональных данных',
                                ]);
                            }

                        })
                        ->disabled(fn($operation) => $operation === 'edit'),

                    Forms\Components\RichEditor::make('description')
                        ->label('Текст')
                        ->required(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->label('Документ')
                    ->formatStateUsing(function (string $state): string {
                        return [
                            'terms_of_service' => 'Договор оферты',
                            'privacy_policy' => 'Политика конфиденциальности',
                            'data_processing_consent' => 'Согласие на обработку персональных данных',
                        ][$state] ?? $state; // Возвращаем ключ, если перевода нет
                    }),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListAgreements::route('/'),
            'create' => Pages\CreateAgreement::route('/create'),
            'edit' => Pages\EditAgreement::route('/{record}/edit'),
        ];
    }
}
