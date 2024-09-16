<?php

namespace App\Filament\Pages;

use App\Models\ListTournament;
use App\Models\StudentProcess;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Filament\Pages\Page;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;

class TournamentStudentList extends Page implements HasForms, HasTable, HasInfolists
{
    use InteractsWithTable;
    use InteractsWithForms;
    use InteractsWithInfolists;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.tournament-student-list';
    protected static ?string $slug = 'tournament-student-list/{id}';

    public $list;

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public function getTitle(): string|Htmlable
    {
        return __($this->list->templateStudentList->name ?? 'Список студентов');
    }

    public function mount($id)
    {
        $this->list = ListTournament::with(['templateStudentList', 'students'])->findOrFail($id);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query()->whereIn('id', $this->list->students->pluck('id')))
            ->columns([
                ImageColumn::make('avatar')
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
                // ...
            ])
            ->actions([
                Action::make('exchange_list')
                    ->label('Сменить список')
                    ->form([
                        Select::make('new_list_id')
                            ->label('Выберите новый список')
                            ->options(function () {
                                // Получаем ID текущего турнира
                                $tournamentId = $this->list->tournament_id;

                                // Получаем ID и названия списков для текущего турнира
                                $templateLists = ListTournament::where('tournament_id', $tournamentId)
                                    ->with('templateStudentList') // Получаем связанные списки
                                    ->get()
                                    ->pluck('templateStudentList.name', 'templateStudentList.id'); // Используем имена списков

                                return $templateLists;
                            })
                            ->required(),
                    ])
                ->action(function ($record, $data): void {
                    $exchange = \App\Models\TournamentStudentList::where('student_id', $record->id)
                        ->where('list_tournament_id', $this->list->template_student_list_id)
                        ->first();
                    $exchange->list_tournament_id = $data['new_list_id'];
                    $exchange->save();
                })
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function productInfolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->record($this->list->templateStudentList)
            ->schema([
                Section::make()
                    ->schema([
                        TextEntry::make('name')
                            ->label('Название списка')
                            ->columnSpanFull(),
                        TextEntry::make('age_from')
                            ->hiddenLabel()
                            ->prefix('Возраст от ')
                            ->suffix(' лет'),
                        TextEntry::make('age_to')
                            ->hiddenLabel()
                            ->prefix('Возраст до ')
                            ->suffix(' лет'),
                        TextEntry::make('weight_from')
                            ->hiddenLabel()
                            ->prefix('Вес от ')
                            ->suffix(' кг'),
                        TextEntry::make('weight_to')
                            ->hiddenLabel()
                            ->prefix('Вес до ')
                            ->suffix(' кг'),
                        TextEntry::make('rang_from')
                            ->hiddenLabel()
                            ->prefix('От ')
                            ->suffix(' кю'),
                        TextEntry::make('rang_to')
                            ->hiddenLabel()
                            ->prefix('До ')
                            ->suffix(' кю'),
                        TextEntry::make('gender')
                            ->formatStateUsing(function ($state) {
                                return $state == 'm' ? 'Мужской' : 'Женский';
                            })
                            ->hiddenLabel()

                    ])->columns(2)
            ]);
    }
}
