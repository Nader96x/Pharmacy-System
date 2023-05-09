<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected $commands = [
        Commands\NotifyInactiveUsersForMonth::class,
    ];
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('notify:users-not-logged-in-for-month')->daily();
        $schedule->command('sanctum:prune-expired --hours=24')->daily(); // remove expired tokens every 24 hours
        $schedule->command('queue:work')->everyMinute();
        $schedule->command('queue:queue:restart')->everyFiveMinutes();



    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
