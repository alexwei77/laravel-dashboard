<?php

namespace App\Console;

use App\Console\Commands\MemberAccCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

//THINK thoroughly about the possibility of overlaps

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        '\App\Console\Commands\EmailEmployeeScores',
        '\App\Console\Commands\GetExpiringMembers',
        '\App\Console\Commands\Inspire',
        MemberAccCommand::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //insert name and signature of you command and define the time of execution
        $schedule->command('EmailEmployeeScores:emailscores')
                 ->everyMinute();
        $schedule->command('GetExpiringMembers:walkingdead')
                 ->daily();
        //run queue work 
        $schedule->command('queue:work')->everyMinute();

        $schedule->command('member:acc')->everyMinute();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
