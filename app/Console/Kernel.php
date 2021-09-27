<?php

namespace App\Console;

use App\Notifications\ExpiredMaterialNotification;
use App\Supply;
use App\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Notification;

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
        // $schedule->command('inspire')->hourly();
        $schedule->call(function (){
            $materialsWillExpired = Supply::expiredMaterials();
            if ($materialsWillExpired->count() >= 1){
                $admin = User::where('is_admin',1)->where('id',7)->get();
                foreach ($materialsWillExpired as $value){
                    Notification::send($admin, new ExpiredMaterialNotification($value));
                }
            }
        })->dailyAt('12:00');
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
