<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrenerResource\Pages;
use App\Filament\Resources\TrenerResource\RelationManagers;
use App\Infolists\Components\BeltDisplay;
use App\Models\Region;
use App\Models\Trener;
use Carbon\Carbon;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;
use Njxqlus\Filament\Components\Infolists\LightboxImageEntry;

class TrenerResource extends Resource
{
    protected static ?string $model = Trener::class;
    protected static ?string $modelLabel = 'Тренер';
    protected static ?string $pluralModelLabel = 'Тренеры';
    protected static ?string $cluster = \App\Filament\Clusters\Trener::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->where('organization_id', auth()->id());
            })
            ->columns([
                Tables\Columns\ImageColumn::make('avatar')
                    ->circular()
                    ->label('Фотография'),
                TextColumn::make('first_name')
                    ->searchable()
                    ->label('Имя'),
                TextColumn::make('last_name')
                    ->searchable()
                    ->label('Фамилия'),
                TextColumn::make('age')
                    ->label('Возраст')
                    ->suffix(' лет'),
                TextColumn::make('weight')
                    ->label('Вес')
                    ->suffix(' кг'),
                TextColumn::make('rang')
                    ->label('Кю / Дан'),
                TextColumn::make('club')
                    ->label('Клуб'),
            ])
            ->filters([
//                Tables\Filters\TrashedFilter::make()
//                    ->label('Удаленные тренеры'),

            ], layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make()
                    ->schema([
                        Split::make([
                            LightboxImageEntry::make('avatar')
                                ->hiddenLabel()
                                ->size(300)
                                ->slideWidth('906px')
                                ->slideHeight('1200px')
                                ->href(fn(Model $record): string => url('storage/' . $record->avatar)),

                            Grid::make(2)
                                ->schema([
                                    Group::make([
                                        TextEntry::make('first_name')
                                            ->label('Имя'),
                                        TextEntry::make('gender')
                                            ->label('Пол')
                                            ->formatStateUsing(function (string $state): HtmlString {
                                                return new HtmlString($state === 'm' ? 'Мужской' : ($state === 'f' ? 'Женский' : 'Не указан'));
                                            }),
                                        TextEntry::make('email')
                                            ->icon('heroicon-m-envelope')
                                            ->label('Email'),
                                        TextEntry::make('rang')
                                            ->label('Кю / Дан'),
                                    ]),
                                    Group::make([
                                        TextEntry::make('last_name')
                                            ->label('Фамилия'),
                                        TextEntry::make('weight')
                                            ->label('Вес'),
                                        TextEntry::make('birthday')
//                                            ->date()

//                                            ->formatStateUsing(function ($state) {
//                                                return
//                                                    $state
//                                                        ? Carbon::parse($state)->format('d.m.Y')
//                                                        : '-'
//                                                ;
//                                            })
                                            ->label('Дата Рождения'),
                                        TextEntry::make('club')
                                            ->label('Клуб')
                                    ]),
                                ]),

                        ])->from('lg'),

                        BeltDisplay::make('rang')
                            ->hiddenLabel(),

                    ]),

                Section::make('Документы')
                    ->schema([
                        LightboxImageEntry::make('passport')
                            ->size(200)
                            ->slideWidth('906px')
                            ->slideHeight('1200px')
                            ->href(fn(Model $record): string => url('storage/' . $record->passport))
                            ->label('Будо паспорт'),
                        LightboxImageEntry::make('brand')
                            ->label('Марка')
                            ->size(200)
                            ->slideWidth('906px')
                            ->slideHeight('1200px')
                            ->href(fn(Model $record): string => url('storage/' . $record->brand)),
                        LightboxImageEntry::make('insurance')
                            ->label('Страховка')
                            ->size(200)
                            ->slideWidth('906px')
                            ->slideHeight('1200px')
                            ->href(fn(Model $record): string => url('storage/' . $record->insurance)),
                        LightboxImageEntry::make('iko_card')
                            ->label('Карта IKO')
                            ->size(200)
                            ->slideWidth('906px')
                            ->slideHeight('1200px')
                            ->href(fn(Model $record): string => url('storage/' . $record->iko_card)),
//                                Checkbox::make('success_politic')
//                                    ->label('Я согласен с договором оферты и политикой конфиденциальности')
//                                    ->required()
//                                    ->columnSpanFull()
                    ])->columns(4)

            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\StudentsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTreners::route('/'),
            'create' => Pages\CreateTrener::route('/create'),
            'view' => Pages\ViewTrener::route('/{record}/view'),
            'edit' => Pages\EditTrener::route('/{record}/edit'),
        ];
    }

//    public static function getEloquentQuery(): Builder
//    {
//        return parent::getEloquentQuery()
//            ->withoutGlobalScopes([
//                SoftDeletingScope::class,
//            ]);
//    }
}
