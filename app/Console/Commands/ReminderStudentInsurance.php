<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use App\Models\User;

class ReminderStudentInsurance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reminder-student-insurance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders to students about their insurance expiration dates.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all(); // Получаем всех пользователей
        $today = Carbon::today();

        foreach ($users as $user) {
            // Проверяем наличие insurance_close_date
            if (!$user->insurance_close_date) {
                continue; // Пропускаем, если дата не указана
            }

            $insuranceCloseDate = Carbon::parse($user->insurance_close_date);

            // Проверка на истечение через месяц
            if ($insuranceCloseDate->isSameDay($today->copy()->addMonth())) {
                Mail::to($user->email)->send(new \App\Mail\ReminderStudentInsurance($user->id, 'Ваше страхование истекает через месяц.'));
            }

            // Проверка на истечение через 10 дней
            if ($insuranceCloseDate->isSameDay($today->copy()->addDays(10))) {
                Mail::to($user->email)->send(new \App\Mail\ReminderStudentInsurance($user->id,'Ваше страхование истекает через 10 дней.'));
            }

            // Проверка на истечение сегодня
            if ($insuranceCloseDate->isSameDay($today)) {
                Mail::to($user->email)->send(new \App\Mail\ReminderStudentInsurance($user->id,'Ваше страхование истекает сегодня.'));
                $user->is_success_insurance = false;
                $user->save();
            }
        }

    }
}
