<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use App\Mail\Invitation;
use App\Models\User;
use App\Models\WaitConfirmationInvitation;
use Closure;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Mail;

class ListStudents extends ListRecords
{
    protected static string $resource = StudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('resetStars')
                ->label('Добавить ученика')
                ->icon('heroicon-o-plus')
                ->color('success')
                ->visible(auth()->user()->role_id == User::Coach)
                ->form([
                    TextInput::make('email')
                        ->placeholder('Введите почту ученика или список через запятую')
                        ->rules([
                            fn (): Closure => function (string $attribute, $value, Closure $fail) {
                                $emails = explode(',', $value);
                                foreach ($emails as $email) {
                                    $email = trim($email);
                                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                        $fail("Вы ввели некорректно почты");
                                    }
                                }
                            },
                        ])
                ])
                ->action(function (array $data) {
                    $emails = array_map('trim', explode(',', $data['email']));
                    if ($emails) {
                        try {
                            foreach ($emails as $email) {
                                Mail::to($email)->send(new Invitation(auth()->id(), $email, 'Приглашение от тренера'));

                                WaitConfirmationInvitation::create([
                                    'inviting_id' => auth()->id(),
                                    'email' => $email,
                                ]);
                            }
                        } catch (\Exception $e) {

                        }
                    }
                })
                ->modalSubmitActionLabel('Отправить приглашение')

        ];
    }
}
