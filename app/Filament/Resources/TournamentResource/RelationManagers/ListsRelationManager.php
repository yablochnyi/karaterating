<?php

namespace App\Filament\Resources\TournamentResource\RelationManagers;

use App\Exports\StudentsExport;
use App\Exports\TournamentListExport;
use App\Models\ListTournament;
use App\Models\TournamentStudentList;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use IbrahimBougaoua\FilamentSortOrder\Actions\DownStepAction;
use IbrahimBougaoua\FilamentSortOrder\Actions\UpStepAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ListsRelationManager extends RelationManager
{
    protected static string $relationship = 'lists';
    protected static ?string $title = 'Списки';
    protected static ?string $modelLabel = 'Шаблон списка';
    protected static ?string $pluralModelLabel = 'Шаблоны списков';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Название списка')
                            ->columnSpanFull()
                            ->required(),
                        Forms\Components\TextInput::make('age_from')
                            ->hiddenLabel()
                            ->prefix('Возраст от')
                            ->integer()
                            ->required(),
                        Forms\Components\TextInput::make('age_to')
                            ->hiddenLabel()
                            ->prefix('Возраст до')
                            ->integer()
                            ->required(),
                        Forms\Components\TextInput::make('weight_from')
                            ->hiddenLabel()
                            ->prefix('Вес от')
                            ->suffix('кг')
                            ->integer()
                            ->required(),
                        Forms\Components\TextInput::make('weight_to')
                            ->hiddenLabel()
                            ->prefix('Вес до')
                            ->suffix('кг')
                            ->integer()
                            ->required(),
                        Forms\Components\TextInput::make('rang_from')
                            ->hiddenLabel()
                            ->prefix('От')
                            ->suffix('кю')
                            ->integer()
                            ->required(),
                        Forms\Components\TextInput::make('rang_to')
                            ->hiddenLabel()
                            ->prefix('До')
                            ->suffix('кю')
                            ->integer()
                            ->required(),
                        Forms\Components\Select::make('gender')
                            ->prefix('М/Ж')
                            ->hiddenLabel()
                            ->options([
                                'm' => 'М',
                                'f' => 'Ж',
                            ])
                            ->required(),
                    ])->columns(2)
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->query(function (Builder $query) {
                $query->join('list_tournaments', 'list_tournaments.template_student_list_id', '=', 'template_student_lists.id')
                    ->orderBy('list_tournaments.sort_order', 'asc'); // Указание таблицы в `orderBy`
            })
            ->columns([
                TextColumn::make('name')
                    ->label('Название списка')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Action::make('exportExcel')
                    ->label('Скачать списки в Excel') // Текст кнопки
                    ->action(function ($livewire) {
                        $listTournaments = ListTournament::where('tournament_id', $livewire->getOwnerRecord()->id)
                            ->whereHas('tournamentStudentLists') // Фильтруем списки с участниками
                            ->with(['tournamentStudentLists.student', 'templateStudentList'])
                            ->get();

                        return Excel::download(new TournamentListExport($listTournaments), 'tournament_students.xlsx');
                    })
                    ->color('warning'),
                Tables\Actions\Action::make('download_lists')
                    ->label('Скачать списки в PDF')
                    ->color('warning')
                    ->url(fn($livewire): string => url('panel/tournament-student-list-pdf/' . $livewire->getOwnerRecord()->id))
                    ->openUrlInNewTab(),
                Tables\Actions\CreateAction::make()
                    ->hidden(fn($livewire) => now()->greaterThan($livewire->getOwnerRecord()->date_finish))
                    ->visible(fn($livewire) => $livewire->getOwnerRecord()->organization_id === auth()->id())
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['user_id'] = auth()->id();

                        return $data;
                    }),
                Tables\Actions\AttachAction::make()
                    ->hidden(fn($livewire) => now()->greaterThan($livewire->getOwnerRecord()->date_finish))
                    ->visible(fn($livewire) => $livewire->getOwnerRecord()->organization_id === auth()->id())
                    ->preloadRecordSelect()
                    ->label('Прикрепить список')
                    ->recordSelectOptionsQuery(fn(Builder $query) => $query->where('user_id', auth()->id()))
                    ->multiple(),
            ])
            ->actions([
                Tables\Actions\Action::make('view_Students')
                    ->icon('heroicon-o-user-group')
                    ->url(fn($record): string => url('panel/tournament-student-list/' . $record->pivot->id))  // Допустим, отношение называется tournamentStudentList
                    ->openUrlInNewTab()
                    ->label('Ученики'),
                Tables\Actions\EditAction::make()
                    ->hidden(fn($livewire) => now()->greaterThan($livewire->getOwnerRecord()->date_finish))
                    ->visible(fn($livewire) => $livewire->getOwnerRecord()->organization_id === auth()->id()),
                Tables\Actions\DetachAction::make()
                    ->hidden(fn($livewire) => now()->greaterThan($livewire->getOwnerRecord()->date_finish))
                    ->visible(fn($livewire) => $livewire->getOwnerRecord()->organization_id === auth()->id()),
//                Tables\Actions\DeleteAction::make(),

            ])
            ->defaultSort('list_tournaments.sort_order', 'asc')

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make()
                        ->hidden(fn($livewire) => now()->greaterThan($livewire->getOwnerRecord()->date_finish))
                        ->visible(fn($livewire) => $livewire->getOwnerRecord()->user_id === auth()->id()),
//                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function isReadOnly(): bool
    {
        return false;
    }
}
