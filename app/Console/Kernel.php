<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;  // Добавить этот импорт

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\TestApi::class,
        \App\Console\Commands\CreateCompany::class,
        \App\Console\Commands\CreateAccount::class,
        \App\Console\Commands\CreateApiToken::class,
        \App\Console\Commands\CreateApiService::class,
        \App\Console\Commands\CreateTokenType::class,
        \App\Console\Commands\UpdateData::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('data:update')->twiceDaily(8, 20);  // Задача будет запускаться дважды в день в 8:00 и 20:00
      $schedule->command('log:info "Test command is running!"')->everyMinute();  // Пример команды для отладки
 }
    
    

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
