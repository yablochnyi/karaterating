<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use App\Mail\InvitationStudent;
use App\Mail\InvitationTrener;
use App\Models\User;
use App\Models\WaitConfirmationInvitation;
use AxonC\FilamentCopyablePlaceholder\Forms\Components\CopyablePlaceholder;
use Closure;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\HtmlString;

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
                    CopyablePlaceholder::make('response')
                        ->label('Или скопируйте ссылку')
                        ->content(url('/panel/register?ref=' . auth()->user()->ref_token))
                        ->icon('heroicon-o-link')
                        ->extraAttributes([
                            'class' => 'flex border-md-2 gap-2',
                        ])
                        ->iconOnly(),

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
                                Mail::to($email)->send(new InvitationStudent(auth()->id(), $email, 'Karaterating - Приглашение от тренера'));

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
