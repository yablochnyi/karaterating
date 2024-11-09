<?php

namespace App\Filament\Resources\TournamentResource\RelationManagers;

use App\Models\ListTournament;
use App\Models\OrganizatePuliListStudent;
use App\Models\TournamentStudentList;
use App\Models\TournamentTrener;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->multiple()
                    ->preloadRecordSelect()
                    ->recordTitle(fn (Model $record) => "{$record->first_name} {$record->last_name}")
                    ->recordSelectOptionsQuery(fn(Builder $query) => $query->where('coach_id', auth()->id()))
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
                                ){
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
                Tables\Actions\EditAction::make()
                    ->hidden(auth()->user()->role_id == User::Student),
                Tables\Actions\DetachAction::make()
                    ->label(function ($record) {
                        if (auth()->user()->id == $record->id) {
                            return 'Отказаться';
                        } else {
                            return 'Открепить';
                        }
                    })
                    ->hidden(function ($record) {
                        return auth()->user()->role_id == User::Student && auth()->user()->id != $record->id;
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
