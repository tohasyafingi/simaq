<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\GenerateSitemap::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // generate sitemap daily at 02:00
        $schedule->command('sitemap:generate')->dailyAt('02:00')->withoutOverlapping();

        // Example: run a custom command every 5 minutes (useful for short tasks)
        // $schedule->command('your:command')->everyFiveMinutes()->withoutOverlapping()->timezone('Asia/Jakarta')->sendOutputTo(storage_path('logs/your-command.log'));

        // Example: schedule a Closure hourly
        // $schedule->call(function () {
        //     // your code here
        // })->hourly()->timezone('Asia/Jakarta');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
