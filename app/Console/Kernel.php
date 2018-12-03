<?php

namespace MESL\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use MESL\Staff;
use Carbon;
use Mail;
use MESL\Mail\HappyBirthday;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        $schedule->call(function(){
            // $user = auth()->user();
            $birthday_users = Staff::where('DateofBirth', '!=', '')->where('DateofBirth', '!=', null)->with(['company'])->get();
            $birthdays = [];
            foreach ($birthday_users as $b_user) {
              if (Carbon::parse($b_user->DateofBirth)->isBirthday()) {
                $birthdays[] = $b_user;
              }
            }
            foreach ($birthdays as $staff) {
              Mail::to($staff->user)->send(new HappyBirthday($staff));
            }
        })->dailyAt('09:00');

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
