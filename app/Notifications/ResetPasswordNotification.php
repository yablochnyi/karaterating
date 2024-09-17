<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Filament\Facades\Filament;
use Illuminate\Support\Facades\Lang;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public function __construct(private readonly string $token)
    {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(Lang::get('Восстановление пароля'))
            ->greeting(Lang::get('Здравствуйте,') . " {$notifiable->name}!")
            ->line(Lang::get('Вы получили это письмо, потому что был получен запрос на сброс пароля для вашей учетной записи.'))
            ->action(Lang::get('Восстановить'), $this->resetUrl($notifiable))
            ->line(Lang::get('Ссылка для сброса пароля истечет через :count минут.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line(Lang::get('Если вы не запрашивали сброс пароля, никаких действий не требуется.'))
            ->salutation(Lang::get('С уважением,') . " Команда Karaterating");


    }

    protected function resetUrl(mixed $notifiable): string
    {
        return Filament::getResetPasswordUrl($this->token, $notifiable);
    }

}
