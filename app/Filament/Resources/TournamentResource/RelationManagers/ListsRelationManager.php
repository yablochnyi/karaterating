<?php

namespace App\Filament\Resources\TournamentResource\RelationManagers;

use App\Models\ListTournament;
use App\Models\TournamentStudentList;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                            ->suffix('лет')
                            ->integer()
                            ->required(),
                        Forms\Components\TextInput::make('age_to')
                            ->hiddenLabel()
                            ->prefix('Возраст до')
                            ->suffix('лет')
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
            ->modifyQueryUsing(fn(Builder $query) => $query->where('user_id', auth()->id()))
            ->columns([
                TextColumn::make('name')
                    ->label('Название списка')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('age_from')
                    ->label('Возраст от (лет)')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('age_to')
                    ->label('Возраст до (лет)')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('weight_from')
                    ->label('Вес от (кг)')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('weight_to')
                    ->label('Вес до (кг)')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('rang_from')
                    ->label('От (кю)')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('rang_to')
                    ->label('До (кю)')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('gender')
                    ->label('Пол')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn($state) => ($state === 'm' ? 'Мужской' : 'Женский')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->label('Прикрепить список')
                    ->recordSelectOptionsQuery(fn(Builder $query) => $query->where('user_id', auth()->id()))
                    ->multiple(),
            ])
            ->actions([
                Tables\Actions\Action::make('view_Students')
                    ->icon('heroicon-o-user-group')
                    ->url(fn ($record): string => url('panel/tournament-student-list/' . $record->id))
                    ->openUrlInNewTab()
                    ->label('Ученики'),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make()
//                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
//                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function isReadOnly(): bool
    {
        return false;
    }
}