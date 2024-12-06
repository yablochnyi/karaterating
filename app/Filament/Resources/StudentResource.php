<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Infolists\Components\BeltDisplay;
use App\Infolists\Components\Rating;
use App\Infolists\Components\SuccessDocument;
use App\Infolists\Components\TrenerClubToStudent;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\IconEntry;
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
use Illuminate\Support\HtmlString;
use Njxqlus\Filament\Components\Infolists\LightboxImageEntry;

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
        if (auth()->user()->role_id == User::Student || auth()->user()->role_id == User::Admin) {
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
                    ->sortable()
                    ->label('Имя'),
                TextColumn::make('last_name')
                    ->searchable()
                    ->sortable()
                    ->label('Фамилия'),
                TextColumn::make('age')
                    ->label('Возраст')
                    ->sortable()
                    ->suffix(' лет'),
                TextColumn::make('weight')
                    ->label('Вес')
                    ->sortable()
                    ->suffix(' кг'),
                TextColumn::make('rang')
                    ->sortable()
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
                                                        ? Carbon::parse($state)->format('d.m.Y')
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
                        LightboxImageEntry::make('certificate')
                            ->label('Сертификат')
                            ->size(200)
                            ->slideWidth('906px')
                            ->slideHeight('1200px')
                            ->href(fn(Model $record): string => url('storage/' . $record->certificate)),
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
                        Actions::make([
                            Action::make('is_success_insurance')
                                ->disabled(fn() => auth()->user()->role_id != User::Organization)
                                ->icon(function ($record) {
                                    return $record->is_success_insurance ? 'heroicon-m-check-circle' : 'heroicon-m-x-mark';
                                })
                                ->color(function ($record) {
                                    return $record->is_success_insurance ? 'success' : 'danger';
                                })
                                ->label(function ($record) {
                                    return $record->is_success_insurance ? 'Подтверждено' : 'Не подтверждено';
                                })
                                ->form([
                                    DatePicker::make('insurance_close_date')
                                        ->label('Дата завершения страхови'),
                                    Checkbox::make('is_success_insurance')
                                        ->label('Подтверждение'),
                                ])
                                ->fillForm(fn ($record): array => [
                                    'insurance_close_date' => $record->insurance_close_date,
                                    'is_success_insurance' => $record->is_success_insurance,
                                ])

                                ->action(function ($record, $data) {
                                    $record->update([
                                        'is_success_insurance' => $data['is_success_insurance'],
                                        'insurance_close_date' => $data['insurance_close_date'],
                                    ]);
                                }),
                        ]),
                        Actions::make([
                            Action::make('is_success_iko_card')
                                ->disabled(fn() => auth()->user()->role_id != User::Organization)
                                ->icon(function ($record) {
                                    return $record->is_success_iko_card ? 'heroicon-m-check-circle' : 'heroicon-m-x-mark';
                                })
                                ->color(function ($record) {
                                    return $record->is_success_iko_card ? 'success' : 'danger';
                                })
                                ->label(function ($record) {
                                    return $record->is_success_iko_card ? 'Подтверждено' : 'Не подтверждено';
                                })
                                ->form([
                                    Checkbox::make('is_iko_card_included_check')
                                        ->label('Нужна ли проверка при участии в турнире'),
                                    Checkbox::make('is_success_iko_card')
                                        ->label('Подтверждение'),
                                ])
                                ->fillForm(fn ($record): array => [
                                    'is_iko_card_included_check' => $record->is_iko_card_included_check,
                                    'is_success_iko_card' => $record->is_success_iko_card,
                                ])
                                ->action(function ($record, $data) {
                                    $record->update([
                                        'is_success_iko_card' => $data['is_success_iko_card'],
                                        'is_iko_card_included_check' => $data['is_iko_card_included_check'],
                                    ]);
                                }),
                        ]),
                        Actions::make([
                            Action::make('is_success_certificate')
                                ->disabled(fn() => auth()->user()->role_id != User::Organization)
                                ->icon(function ($record) {
                                    return $record->is_success_certificate ? 'heroicon-m-check-circle' : 'heroicon-m-x-mark';
                                })
                                ->color(function ($record) {
                                    return $record->is_success_certificate ? 'success' : 'danger';
                                })
                                ->label(function ($record) {
                                    return $record->is_success_certificate ? 'Подтверждено' : 'Не подтверждено';
                                })
                                ->form([
                                    Checkbox::make('is_certificate_included_check')
                                        ->label('Нужна ли проверка при участии в турнире'),
                                    Checkbox::make('is_success_certificate')
                                        ->label('Подтверждение'),
                                ])
                                ->fillForm(fn ($record): array => [
                                    'is_certificate_included_check' => $record->is_certificate_included_check,
                                    'is_success_certificate' => $record->is_success_certificate,
                                ])
                                ->action(function ($record, $data) {
                                    $record->update([
                                        'is_success_certificate' => $data['is_success_certificate'],
                                        'is_certificate_included_check' => $data['is_certificate_included_check'],
                                    ]);
                                }),
                        ]),
                        Actions::make([
                            Action::make('is_success_passport')
                                ->disabled(fn() => auth()->user()->role_id != User::Organization)
                                ->icon(function ($record) {
                                    return $record->is_success_passport ? 'heroicon-m-check-circle' : 'heroicon-m-x-mark';
                                })
                                ->color(function ($record) {
                                    return $record->is_success_passport ? 'success' : 'danger';
                                })
                                ->label(function ($record) {
                                    return $record->is_success_passport ? 'Подтверждено' : 'Не подтверждено';
                                })
                                ->action(function ($record) {
                                    $record->update([
                                        'is_success_passport' => !$record->is_success_passport,
                                    ]);
                                }),
                        ]),
                        Actions::make([
                            Action::make('is_success_brand')
                                ->disabled(fn() => auth()->user()->role_id != User::Organization)
                                ->icon(function ($record) {
                                    return $record->is_success_brand ? 'heroicon-m-check-circle' : 'heroicon-m-x-mark';
                                })
                                ->color(function ($record) {
                                    return $record->is_success_brand ? 'success' : 'danger';
                                })
                                ->label(function ($record) {
                                    return $record->is_success_brand ? 'Подтверждено' : 'Не подтверждено';
                                })
                                ->action(function ($record) {
                                    $record->update([
                                        'is_success_brand' => !$record->is_success_brand,
                                    ]);
                                }),
                        ]),

                        TextEntry::make('insurance_close_date')
                            ->formatStateUsing(function ($state): string {
                                return $state ? \Carbon\Carbon::parse($state)->format('d.m.Y') : 'Не указана';
                            })
                            ->label('Дата завершения'),
                        TextEntry::make('is_iko_card_included_check')
                            ->formatStateUsing(function ($state): string {
                                return $state ? 'Да' : 'Нет';
                            })
                            ->label('Участие в проверке документов'),
                        TextEntry::make('is_certificate_included_check')
                            ->formatStateUsing(function ($state): string {
                                return $state ? 'Да' : 'Нет';
                            })
                            ->label('Участие в проверке документов'),

                    ])->columns(5)

            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\TournamentsRelationManager::make()
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
