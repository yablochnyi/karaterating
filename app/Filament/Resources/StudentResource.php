<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Infolists\Components\BeltDisplay;
use App\Infolists\Components\Rating;
use App\Infolists\Components\TrenerClubToStudent;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Faker\Provider\Text;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;
use Njxqlus\Filament\Components\Infolists\LightboxImageEntry;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;
    protected static ?string $cluster = \App\Filament\Clusters\Trener::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $modelLabel = 'Ученик';
    protected static ?string $pluralModelLabel = 'Ученики';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    public static function shouldRegisterNavigation(): bool
    {
        if (auth()->user()->role_id == User::Student || auth()->user()->role_id == User::Admin ) {
            return false;
        } else {
            return true;
        }
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('weight')
                ->label('Вес')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->where(function ($query) {
                    $query->whereHas('trener', function ($query) {
                        $query->whereHas('organization', function ($query) {
                            $query->where('id', auth()->id()); // Фильтр по организации тренеров
                        });
                    })
                        ->orWhereHas('trener', function ($query) {
                            $query->where('id', auth()->id()); // Фильтр по тренеру
                        });
                });
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
                TextColumn::make('coach_id')
                    ->formatStateUsing(function ($record) {
                        return $record->trener->first_name . ' ' . $record->trener->last_name;
                })
                ->label('Тренер')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->hidden(),
                Tables\Actions\EditAction::make()->visible(auth()->user()->role_id == User::Coach),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->visible(auth()->user()->role_id == User::Coach),
                ]),
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
                                            ->formatStateUsing(function (?string $state): HtmlString {
                                                return new HtmlString(
                                                    $state
                                                        ? Carbon::parse($state)->format('d.m.y')
                                                        : '-'
                                                );
                                            })
                                            ->label('Дата Рождения'),
                                       TextEntry::make('trener')
                                           ->label('Тренер')
                                           ->formatStateUsing(function (object $state): HtmlString {
                                               return new HtmlString($state->first_name . ' ' . $state->last_name);
                                           }),
                                       TrenerClubToStudent::make('club')
                                           ->label('Клуб'),

                                    ]),
                                ]),

                        ])->from('lg'),

                        BeltDisplay::make('rang')
                            ->hiddenLabel(),

                        Rating::make('rating')
                        ->hiddenLabel()

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
                            ->slideWidth('906px')
                            ->slideHeight('1200px')
                            ->size(200)
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'view' => Pages\ViewStudent::route('/{record}/view'),
//            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
