<?php

namespace App\Filament\Resources\TournamentResource\RelationManagers;

use App\Filament\Resources\StudentResource\Pages\ViewStudent;
use App\Models\ListTournament;
use App\Models\OrganizatePuliListStudent;
use App\Models\TournamentStudentList;
use App\Models\TournamentTrener;
use App\Models\Trener;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;

class StudentsRelationManager extends RelationManager
{
    protected static string $relationship = 'students';
    protected static ?string $title = 'Ученики принимающие участие';
    protected static ?string $modelLabel = 'Ученик';
    protected static ?string $pluralModelLabel = 'Ученики';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('weight')
                    ->required()
                    ->prefix('Вес')
                    ->suffix('кг')
                    ->hiddenLabel()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\ImageColumn::make('avatar')
                    ->circular()
                    ->label('Фотография'),
                Tables\Columns\IconColumn::make('name')
                    ->boolean()
                    ->getStateUsing(function ($record, $livewire) {
                        $parent = $livewire->getOwnerRecord();
                        $dateFinish = $parent->date_finish;

                        return $record->is_success_passport &&
                            $record->is_success_brand &&
                            $record->is_success_insurance &&
                            $record->insurance_close_date &&
                            $record->insurance_close_date > $dateFinish &&
                            (!$record->is_iko_card_included_check || $record->is_success_iko_card) &&
                            (!$record->is_certificate_included_check || $record->is_success_certificate);
                    })
                    ->label(new HtmlString('Документы'))
                    ->default(false),

                CheckboxColumn::make('is_success_weight')
                    ->label(new HtmlString('Подтверждение<br>веса'))
                    ->toggleable()
                    ->disabled(fn($livewire) => $livewire->getOwnerRecord()->organization_id != auth()->id())
                    ->getStateUsing(function ($record) {
                        return $record->pivot->is_success_weight;
                    })
                    ->afterStateUpdated(function ($state, $record) {
                        $record->pivot->is_success_weight = $state;
                        $record->pivot->save();
                    })
                    ->hidden(fn($livewire) => now()->greaterThan($livewire->getOwnerRecord()->date_finish)),


                TextColumn::make('first_name')
                    ->searchable(['first_name', 'last_name'])
                    ->formatStateUsing(function ($record) {
                        return $record->first_name . ' ' . $record->last_name;
                    })
                    ->label('Имя'),
//                TextColumn::make('last_name')
//                    ->searchable()
//                    ->label('Фамилия'),
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
                SelectFilter::make('coach_id')
                    ->label('Фильтр по тренеру')
                    ->preload()
                    ->searchable()
                    ->options(fn () => Trener::query()
                        ->select('id', 'first_name', 'last_name')
                        ->get()
                        ->mapWithKeys(fn ($trener) => [
                            $trener->id => trim("{$trener->first_name} {$trener->last_name}") ?: 'Unknown',
                        ])
                        ->toArray()
                    )
            ])

            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->multiple()
                    ->preloadRecordSelect()
                    ->recordTitle(fn(Model $record) => "{$record->first_name} {$record->last_name}")
                    ->recordSelectOptionsQuery(fn(Builder $query, $livewire) => $query->where('coach_id', auth()->id())
                        ->where(function ($subQuery) use ($livewire) {
                            $parentRecord = $livewire->getOwnerRecord(); // Получаем $parentRecord из $livewire

                            // Если выбрано только KY_up_to_8
                            if ($parentRecord->KY_up_to_8 && !$parentRecord->KY_from_8) {
                                $subQuery->whereRaw('CAST(REGEXP_REPLACE(rang, "[^0-9]", "") AS UNSIGNED) IN (0, 10, 9)');
                            } // Если выбрано только KY_from_8
                            elseif ($parentRecord->KY_from_8 && !$parentRecord->KY_up_to_8) {
                                $subQuery->whereRaw('CAST(REGEXP_REPLACE(rang, "[^0-9]", "") AS UNSIGNED) IN (1, 2, 3, 4, 5, 6, 7, 8)');
                            }
                        })
                    )
                    ->hidden(function ($livewire) {
                        $trener = TournamentTrener::where('tournament_id', $livewire->getOwnerRecord()->id)
                            ->where('trener_id', Auth::id())->exists();
                        return auth()->user()->role_id == User::Student ||
                            auth()->user()->role_id == User::Organization ||
                            !$trener;
                    })
                    ->after(function ($data, $livewire) {
                        $parentRecord = $livewire->getOwnerRecord();
                        $lists = $parentRecord->lists;
                        $studentIds = $data['recordId'] ?? [];

                        // Получение студентов по ID
                        $students = \App\Models\User::whereIn('id', $studentIds)->get()->keyBy('id');

                        foreach ($students as $student) {
                            $addedToList = false;

                            $rankString = $student->rang;

                            // Удаляем все символы, кроме цифр
                            $rankNumber = filter_var($rankString, FILTER_SANITIZE_NUMBER_INT);

                            if ($rankNumber == 0) {
                                $rankNumber = 10;
                            }

                            foreach ($lists as $list) {
                                if (
                                    $student->age >= $list->age_from && $student->age <= $list->age_to &&
                                    $student->weight >= $list->weight_from && $student->weight <= $list->weight_to &&
                                    $student->gender == $list->gender &&
                                    (
                                        // Диапазон "от" определенного ранга (например, от 8 кю до 1 кю)
                                        ($list->rang_from > $list->rang_to && $rankNumber <= $list->rang_from && $rankNumber >= $list->rang_to) ||

                                        // Диапазон "до" определенного ранга (например, до 8 кю)
                                        ($list->rang_from <= $list->rang_to && $rankNumber >= $list->rang_to)
                                    )
                                ) {
                                    TournamentStudentList::create(
                                        [
                                            'list_tournament_id' => $list->pivot->id,
                                            'student_id' => $student->id,
                                        ]);
                                    $addedToList = true;
                                    break;
                                }
                            }
                            if (!$addedToList) {
                                $defaultList = \App\Models\TemplateStudentList::firstOrCreate([
                                    'name' => 'Ученики которые не попали в списки',
                                    'age_from' => 0,
                                    'age_to' => 100,
                                    'weight_from' => 0,
                                    'weight_to' => 100,
                                    'rang_from' => 0,
                                    'rang_to' => 100,
                                    'gender' => 'all',
                                    'user_id' => $parentRecord->organization_id,
                                ]);
                                $listTournament = ListTournament::firstOrCreate([
                                    'tournament_id' => $parentRecord->id,
                                    'template_student_list_id' => $defaultList->id,
                                ]);
                                TournamentStudentList::create(
                                    [
                                        'list_tournament_id' => $listTournament->id,
                                        'student_id' => $student->id,
                                    ]);
                            }
                        }

                    })
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Просмотр') // Текст кнопки
                    ->icon('heroicon-o-eye') // Иконка (опционально)
                    ->url(fn($record) => route('filament.admin.trener.resources.students.view', $record->id)) // Генерация URL
                    ->openUrlInNewTab()
                    ->visible(function ($record, $livewire) {
                        // Получаем текущего пользователя
                        $currentUser = auth()->user();

                        // Кнопка видима, если:
                        return (
                            // Пользователь является организатором
                            $livewire->getOwnerRecord()->organization_id == $currentUser->id
                            // Или он — тренер для этой записи
                            || $record->coach_id == $currentUser->id
                        );
                    }),
                Tables\Actions\EditAction::make()
                    ->hidden(function ($record, $livewire) {
                        return auth()->user()->role_id == User::Student || $record->coach_id != auth()->id() || now()->greaterThan($livewire->getOwnerRecord()->date_finish);
                    }),
                Tables\Actions\DetachAction::make()
                    ->label(function ($record) {
                        return auth()->user()->id == $record->id ? 'Отказаться' : 'Открепить';
                    })
                    ->hidden(fn($livewire) => now()->greaterThan($livewire->getOwnerRecord()->date_finish))
                    ->visible(function ($record, $livewire) {
                        // Получаем текущего пользователя
                        $currentUser = auth()->user();

                        // Кнопка видима, если:
                        return (
                            // Пользователь является организатором
                            $livewire->getOwnerRecord()->organization_id == $currentUser->id
                            // Или он является владельцем записи
                            || $currentUser->id == $record->id
                            // Или он — тренер для этой записи
                            || $record->coach_id == $currentUser->id
                        );
                    })
                    ->after(function ($record, $livewire) {
                        // Получить текущий турнир
                        $parentRecord = $livewire->getOwnerRecord();
                        $tournamentId = $parentRecord->id;

                        // Найти все записи ListTournament для текущего турнира
                        $listTournaments = ListTournament::where('tournament_id', $tournamentId)->get();

                        // Удалить записи из TournamentStudentList для всех найденных списков
                        foreach ($listTournaments as $listTournament) {
                            TournamentStudentList::where('student_id', $record->id)
                                ->where('list_tournament_id', $listTournament->id)
                                ->delete();
                        }
                    })
            ])
            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DetachBulkAction::make()
//                        ->hidden(auth()->user()->role_id == User::Student),
//                ]),
            ]);
    }

    public function isReadOnly(): bool
    {
        return false;
    }
}
