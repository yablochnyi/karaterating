<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ResetStudentMarks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:student-marks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Удаляет подтверждение марок у всех учеников раз в год, 1 января';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        User::query()->update(['is_success_brand' => false]);

        $this->info('Подтверждения марок успешно сброшены у всех учеников.');
    }
}
