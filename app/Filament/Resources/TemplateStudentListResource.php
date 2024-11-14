<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TemplateStudentListResource\Pages;
use App\Filament\Resources\TemplateStudentListResource\RelationManagers;
use App\Models\TemplateStudentList;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use IbrahimBougaoua\FilamentSortOrder\Actions\DownStepAction;
use IbrahimBougaoua\FilamentSortOrder\Actions\UpStepAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TemplateStudentListResource extends Resource
{
    protected static ?string $model = TemplateStudentList::class;
    protected static ?string $modelLabel = 'Шаблон списка';
    protected static ?string $pluralModelLabel = 'Шаблоны списков';
    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

    public static function form(Form $form): Form
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

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->where('user_id', auth()->id()))
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
            ->actions([
                Tables\Actions\EditAction::make(),
                DownStepAction::make(),
                UpStepAction::make(),
            ])
            ->defaultSort('sort_order', 'asc')
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
            'index' => Pages\ListTemplateStudentLists::route('/'),
            'create' => Pages\CreateTemplateStudentList::route('/create'),
            'edit' => Pages\EditTemplateStudentList::route('/{record}/edit'),
        ];
    }
}
