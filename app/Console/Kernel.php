<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\QueueVerifiedUser;
use Carbon\Carbon;
use App\Utils\Queue\QueueTools;

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


        $schedule->call(function () {
            //delete those who has been 1 minute without entering
            $queueVerifiedUsersToDelete = QueueVerifiedUser::where('estimated_time', '<', Carbon::now())->get();
            foreach ($queueVerifiedUsersToDelete as $queueVerifiedUser) {
                $queueVerifiedUser->delete();
                QueueTools::refresh_position($queueVerifiedUser->queue->id, $queueVerifiedUser->position);
                QueueTools::refresh_estimated_time($queueVerifiedUser->queue->id);
            }

            //send notifications using this query
            //$test= QueueVerifiedUser::where('estimated_time', '<', Carbon::now()->addMinute(4))->get();
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
