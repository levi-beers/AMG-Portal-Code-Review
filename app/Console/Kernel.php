<?php

namespace AMGPortal\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->call(function () {app()->make(IOReportController::class)->storeioreport();})->everyMinute();
        $schedule->command('ioreport:monitor')->hourly()->withoutOverlapping();
        $schedule->command('contact:activity')->everyMinute()->withoutOverlapping();
        $schedule->command('database:monitor')->hourly()->withoutOverlapping();
        $schedule->command('ongage:stats')->hourly()->withoutOverlapping();
        $schedule->command('dashboard:datacount')->hourly()->withoutOverlapping();
        $schedule->command('leads:count')->dailyAt('00:00')->withoutOverlapping();
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
