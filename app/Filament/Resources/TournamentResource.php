<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TournamentResource\Pages;
use App\Filament\Resources\TournamentResource\RelationManagers;
use App\Infolists\Components\BeltDisplay;
use App\Models\OrganizationTournament;
use App\Models\Region;
use App\Models\Scale;
use App\Models\Tournament;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords\Tab;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;
use IbrahimBougaoua\FilamentSortOrder\Actions\DownStepAction;
use IbrahimBougaoua\FilamentSortOrder\Actions\UpStepAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\HtmlString;
use Livewire\Attributes\On;
use Njxqlus\Filament\Components\Infolists\LightboxImageEntry;

class TournamentResource extends Resource
{
    protected static ?string $model = Tournament::class;
    protected static ?string $modelLabel = 'Турнир';
    protected static ?string $pluralModelLabel = 'Турниры';
    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->hiddenLabel()
                            ->columnSpanFull()
                            ->required()
                            ->prefix('Название турнира'),
                        Forms\Components\Select::make('region_id')
                            ->options(Region::pluck('name', 'id'))
                            ->required()
                            ->hiddenLabel()
                            ->prefix('Регион прохождения'),
                        Forms\Components\Select::make('scale_id')
                            ->options(Scale::pluck('name', 'id'))
                            ->required()
                            ->hiddenLabel()
                            ->prefix('Масштаб турнира'),
                        Forms\Components\TextInput::make('age_from')
                            ->hiddenLabel()
                            ->required()
                            ->integer()
                            ->prefix('Возраст от'),
                        Forms\Components\TextInput::make('age_to')
                            ->hiddenLabel()
                            ->required()
                            ->integer()
                            ->prefix('Возраст до'),
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\Toggle::make('KY_up_to_8')
                                    ->required()
                                    ->onColor('success')
                                    ->offColor('danger')
                                    ->label('КЮ до 8'),
                                Forms\Components\Toggle::make('KY_from_8')
                                    ->required()
                                    ->onColor('success')
                                    ->offColor('danger')
                                    ->label('КЮ от 8'),
                                Forms\Components\Toggle::make('fight_for_third_place')
                                    ->required()
                                    ->onColor('success')
                                    ->offColor('danger')
                                    ->label('Бой за третье место'),

                            ])->columns(3),
                        Forms\Components\TextInput::make('tatami')
                            ->hiddenLabel()
                            ->required()
                            ->integer()
                            ->prefix('Количество татами'),
                        Forms\Components\TextInput::make('price')
                            ->hiddenLabel()
                            ->required()
                            ->integer()
                            ->prefix('Стоимость участия'),
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\DateTimePicker::make('date_commission')
                                    ->required()
                                    ->label('Дата комиссии'),
                                Forms\Components\DateTimePicker::make('date')
                                    ->required()
                                    ->label('Дата начала турнира'),
                                Forms\Components\DateTimePicker::make('date_finish')
                                    ->required()
                                    ->label('Дата завершения турнира')
                            ])->columns(3),
                        Forms\Components\FileUpload::make('regulation_document')
                            ->label('Положение')
                            ->directory('regulation_document')
                            ->openable()
                            ->downloadable()
                            ->required(),
                        Forms\Components\FileUpload::make('application_document')
                            ->label('Заявление')
                            ->directory('application_document')
                            ->openable()
                            ->downloadable()
                            ->required(),
                        Forms\Components\TextInput::make('address')
                            ->hiddenLabel()
                            ->required()
                            ->columnSpanFull()
                            ->prefix('Адрес')

                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $user = auth()->user();

                // Если пользователь авторизован как студент
                if ($user->role_id === User::Student) {
                    // Фильтруем турниры, к которым привязан студент
                    $query->whereHas('students', function ($query) use ($user) {
                        $query->where('student_id', $user->id);
                    });
                }
            })
            ->columns([
                Tables\Columns\Layout\Split::make([
                    Tables\Columns\TextColumn::make('name')
                        ->weight(FontWeight::Bold)
                        ->alignCenter()
                        ->badge(fn ($record) => now()->greaterThan($record->date_finish))
                        ->color(fn ($record) => now()->greaterThan($record->date_finish) ? 'success' : '') // Цвет меняется в зависимости от завершенности
                        ->extraAttributes(['style' => 'margin-bottom: 30px'])
                        ->getStateUsing(fn ($record) => now()->greaterThan($record->date_finish)
                            ? "Турнир {$record->name} завершен"
                            : $record->name
                        )
                        ->searchable(),

                ]),
                Tables\Columns\Layout\Panel::make([
                    Tables\Columns\Layout\Stack::make([
                        Tables\Columns\Layout\Split::make([
                            Tables\Columns\TextColumn::make('date_commission')
                                ->description('Дата комиссии', position: 'above')
                                ->icon('heroicon-o-calendar-date-range')
                                ->weight(FontWeight::Bold),
                            Tables\Columns\TextColumn::make('date')
                                ->description('Дата проведения турнира', position: 'above')
                                ->icon('heroicon-o-calendar-date-range')
                                ->weight(FontWeight::Bold),
                            Tables\Columns\TextColumn::make('date_finish')
                                ->description('Дата завершения турнира', position: 'above')
                                ->icon('heroicon-o-calendar-date-range')
                                ->weight(FontWeight::Bold),
                            Tables\Columns\TextColumn::make('price')
                                ->description('Стоимость', position: 'above')
                                ->money('RUB')
                                ->weight(FontWeight::Bold),
                        ])->extraAttributes(['style' => 'margin-bottom: 30px']),
                        Tables\Columns\Layout\Split::make([
                            Tables\Columns\TextColumn::make('region.name')
                                ->description('Регион', position: 'above')
                                ->icon('heroicon-o-globe-alt')
                                ->weight(FontWeight::Bold),
                            Tables\Columns\TextColumn::make('scale.name')
                                ->description('Масштаб', position: 'above')
                                ->icon('heroicon-o-globe-alt')
                                ->weight(FontWeight::Bold),
                            Tables\Columns\TextColumn::make('address')
                                ->description('Адрес', position: 'above')
                                ->icon('heroicon-o-globe-alt')
                                ->weight(FontWeight::Bold),
                        ])->extraAttributes(['style' => 'margin-bottom: 30px']),
                        Tables\Columns\Layout\Split::make([
                            Tables\Columns\TextColumn::make('treners.club')
                                ->badge()
                                ->color('success')

                        ]),

                    ]),

                ]),

            ])
            ->filters([
//                Tables\Filters\TrashedFilter::make()
//                    ->label('Удаленные турниры'),
//                    ->visible(fn() => Auth::user()->role_id === User::Organization),
                Tables\Filters\SelectFilter::make('region_id')
                    ->options(Region::pluck('name', 'id'))
                    ->preload()
                    ->multiple()
                    ->label('Фильтр по региону')

            ], layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\Action::make('send_application')
                    ->label('Подать заявку')
                    ->visible(function ($record){
                        return !$record->tournamentOrganizations->contains('applicant_organizer_id', Auth::id()) && $record->organization_id != Auth::id()
                            && $record->role_id === User::Organization;
                    })
                    ->action(function ($record) {
                        Notification::make()
                            ->title('Новая заявка')
                            ->body('Заявка на турнир ' . $record->name . ' от ' . Auth::user()->name)
                            ->actions([
                                Action::make('Посмотреть')
                                    ->button()
                                    ->openUrlInNewTab()
                                    ->url(OrganizationTournamentResource::getUrl())
                                    ->markAsRead(),
                            ])
                            ->viewData([
                                'tournament_id' => $record->id,
                                'applicant_organizer_id' => Auth::id(),
                                ])
                            ->sendToDatabase(User::find($record->organization_id));

                        OrganizationTournament::firstOrCreate([
                            'tournament_id' => $record->id,
                            'applicant_organizer_id' => Auth::id(),
                        ]);

                        Notification::make()
                            ->title('Заявка отправлена')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\ViewAction::make()->hidden(),
                Tables\Actions\EditAction::make()->hidden(fn ($record) => now()->greaterThan($record->date_finish)),
                Tables\Actions\DeleteAction::make(),

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

            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\TrenersRelationManager::class,
            RelationManagers\StudentsRelationManager::class,
            RelationManagers\ListsRelationManager::class,
            RelationManagers\PoolsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTournaments::route('/'),
            'create' => Pages\CreateTournament::route('/create'),
            'view' => Pages\ViewTournament::route('/{record}/view'),
            'edit' => Pages\EditTournament::route('/{record}/edit'),
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
