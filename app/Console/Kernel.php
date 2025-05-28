<?php

namespace App\Console;

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
    protected $commands =[
        Commands\CheckExpiryDates::class,
        Commands\CourseNotEnrolled::class,
        Commands\CourseNotPurchased::class,
        Commands\VerifyDocument::class,
        Commands\ScheduleTestCommand::class,
        Commands\CourseExpireReminder::class,
        Commands\SendPaymentReminder::class

    ];
    protected function schedule(Schedule $schedule)
    {

        $schedule->command('verify:document')->dailyAt('08:00');
        $schedule->command('course:notpurchase')->everyTwoDays()->at('08:00');
        $schedule->command('course:notenrolled')->everyThreeDays()->at('08:00');
        $schedule->command('test:check')->dailyAt()->at('08:00');
        $schedule->command('reminder:course')->everyTwoDays()->at('08:00');
        $schedule->command('coupons:statusupdate')->dailyAt()->at('08:00');
        $schedule->command('optional:ects')->everyTwoDays()->at('08:00');
        $schedule->command('payment:reminder')->everyMinutes(); // or ->everyMinute()
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