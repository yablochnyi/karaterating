<?php

namespace App\Filament\Resources\TrenerResource\Pages;

use App\Filament\Resources\TrenerResource;
use App\Mail\InvitationTrener;
use App\Models\WaitConfirmationInvitation;
use Closure;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Mail;

class ListTreners extends ListRecords
{
    protected static string $resource = TrenerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('resetStars')
                ->label('Добавить тренера')
                ->icon('heroicon-o-plus')
                ->color('success')
                ->form([
                    TextInput::make('email')
                    ->placeholder('Введите почту тренера или список через запятую')
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
                                Mail::to($email)->send(new InvitationTrener(auth()->id(), $email, 'Karaterating - Приглашение от организатора'));

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
