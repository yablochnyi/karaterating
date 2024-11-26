<?php

namespace App\Filament\Pages;

use App\Infolists\Components\BeltDisplay;
use App\Infolists\Components\Rating;
use App\Models\Student;
use App\Models\Tournament;
use App\Models\User;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;

class Profile extends Page implements HasForms, HasTable, HasInfolists
{
    use InteractsWithForms;
    use InteractsWithTable;
    use InteractsWithInfolists;



    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $title = 'Редактировать профиль';
    protected static string $view = 'filament.pages.profile';

    public ?array $data = [];

    public function mount(): void
    {
        $user = Auth::user();

        if (Auth::user()->role_id === User::Coach)
        {
            $this->form->fill($user->toArray());
        } else {
            $this->form->fill(array_merge(
                $user->toArray(),
                ['club' => $user->trener->club ?? null]
            ));
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(5)
                    ->schema([
                        Section::make()
                            ->schema([
                                FileUpload::make('avatar')
                                    ->label('Загрузите аватар')
                                    ->directory('avatar')
                                    ->required()
                                    ->image()
                                    ->columnSpan(['md' => 2])
                            ])->columnSpan(3),
                        Section::make()
                            ->schema([

                                TextInput::make('first_name')
                                    ->label('Введите имя')
                                    ->required(),
                                TextInput::make('last_name')
                                    ->label('Введите фамилию')
                                    ->required(),
                                Select::make('gender')
                                    ->prefix('М/Ж')
                                    ->hiddenLabel()
                                    ->options([
                                        'm' => 'М',
                                        'f' => 'Ж',
                                    ])
                                    ->required(),
                                TextInput::make('weight')
                                    ->prefix('Вес')
                                    ->hiddenLabel()
                                    ->required()
                                    ->integer()
                                    ->postfix('кг'),
                                TextInput::make('age')
                                    ->prefix('Возраст')
                                    ->hiddenLabel()
                                    ->required()
                                    ->integer()
                                    ->postfix('лет')
                                    ->columnSpanFull(),
                                TextInput::make('email')
                                    ->label('Email')
                                    ->required(),
                                DatePicker::make('birthday')
                                    ->label('Дата Рождения')
                                    ->format('d.m.y')
                                    ->required(),
                                Select::make('rang')
                                    ->prefix('Кю / Дан')
                                    ->hiddenLabel()
                                    ->required()
                                    ->options([
                                        'КЮ' => [
                                            '0 кю' => '0 кю',
                                            '10 кю' => '10 кю',
                                            '9 кю' => '9 кю',
                                            '8 кю' => '8 кю',
                                            '7 кю' => '7 кю',
                                            '6 кю' => '6 кю',
                                            '5 кю' => '5 кю',
                                            '4 кю' => '4 кю',
                                            '3 кю' => '3 кю',
                                            '2 кю' => '2 кю',
                                            '1 кю' => '1 кю',
                                        ],
                                        'Дан' => [
                                            '1 дан' => '1 дан',
                                            '2 дан' => '2 дан',
                                            '3 дан' => '3 дан',
                                            '4 дан' => '4 дан',
                                            '5 дан' => '5 дан',
                                            '6 дан' => '6 дан',
                                            '7 дан' => '7 дан',
                                            '8 дан' => '8 дан',
                                            '9 дан' => '9 дан',
                                            '10 дан' => '10 дан',
                                        ],
                                    ])->columnSpanFull(),
                                TextInput::make('club')
                                    ->hiddenLabel()
                                    ->prefix('Клуб')
                                    ->columnSpanFull()
                                    ->disabled(fn() => Auth::user()->role_id === User::Student)

                            ])->columns(2)->columnSpan(2),

                        Section::make('Документы')
                            ->schema([
                                FileUpload::make('passport')
                                    ->image()
                                    ->required()
                                    ->label('Будо паспорт'),
                                FileUpload::make('brand')
                                    ->image()
                                    ->required()
                                    ->label('Марка'),
                                FileUpload::make('insurance')
                                    ->image()
                                    ->required()
                                    ->label('Страховка'),
                                FileUpload::make('iko_card')
                                    ->image()
                                    ->required()
                                    ->label('Карта IKO'),
                                FileUpload::make('certificate')
                                    ->image()
                                    ->required()
                                    ->label('Сертификат'),
                                Checkbox::make('success_politic')
                                    ->label(new HtmlString(
                                        'Я согласен с <a href="' . url('panel/agreement-doc/1') . '" target="_blank" style="color: orange;">договором оферты</a> и <a href="' . url('panel/agreement-doc/2') . '" target="_blank" style="color: orange;">политикой конфиденциальности</a>'
                                    ))
                                    ->required()
                                    ->columnSpanFull(),

                                Checkbox::make('data_processing')
                                    ->label(new HtmlString(
                                        'Я согласен на <a href="' . url('panel/agreement-doc/3') . '" target="_blank" style="color: orange;">обработку моих персональных данных</a>'
                                    ))
                                    ->required()
                                    ->columnSpanFull(),

                            ])->columns(5)
                    ])

            ])
            ->statePath('data');
    }

    public function table(Table $table): Table
    {
        $student = Student::find(auth()->id()); // Получаем текущего авторизованного пользователя


        return $table
            ->query($student->tournaments()->getQuery()) // Преобразуем связь в Builder
            ->columns([
                TextColumn::make('name')
                    ->label('Турнир'),
                TextColumn::make('wins_losses')
                    ->label('Победы/Поражения')
                    ->getStateUsing(fn () => $student->getWinsAndLosses()['wins'] . ' / ' . $student->getWinsAndLosses()['losses']), // Формируем текст "Победы / Поражения"

            ])
            ->filters([
                // Добавьте фильтры, если нужно
            ])
            ->actions([
                // Добавьте действия, если нужно
            ])
            ->bulkActions([
                // Добавьте массовые действия, если нужно
            ]);
    }

    public function productInfolist(Infolist $infolist): Infolist
    {
        $student = Student::find(auth()->id());
        return $infolist
            ->record($student)
            ->schema([
                BeltDisplay::make('rang')
                    ->hiddenLabel(),

                Rating::make('rating')
                    ->hiddenLabel()
            ]);
    }

    public function create(): void
    {
        Auth::user()->update($this->form->getState());
        Notification::make()
            ->title('Данные сохранены')
            ->success()
            ->send();
    }

}
