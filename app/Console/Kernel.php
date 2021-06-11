<?php

namespace App\Console;

use App\Http\Resources\CommerceResource;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\QueueVerifiedUser;
use App\Utils\Queue\QueueTools;
use Carbon\Carbon;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\RawMessageFromArray;
use Illuminate\Support\Facades\Storage;
use App\Models\CurrentQueue;
use App\Models\Commerce;
use App\Utils\Notifications\NotificationUtils;

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


        $schedule->call(
            function () {
                //delete those who has been 1 minute without entering
                //delete the ones appearing with this one
                $queueVerifiedUsersToDelete = QueueVerifiedUser::where('estimated_time', '<', Carbon::now())->get();

                //$queueVerifiedUsersToDelete = QueueVerifiedUser::All();
                //return $queueVerifiedUsersToDelete;
                /*
                foreach ($queueVerifiedUsersToDelete as $queueVerifiedUser) {
                    $queueVerifiedUser->delete();
                    QueueTools::refresh_position($queueVerifiedUser->queue->id, $queueVerifiedUser->position);
                    QueueTools::refresh_estimated_time($queueVerifiedUser->queue->id);
                }*/


                //instanciar la libreria de firebase
                $factory = (new Factory)->withServiceAccount(__DIR__ . '/firebase_credentials.json');
                $messaging = $factory->createMessaging();

                $minutes = 5;
                foreach(QueueVerifiedUser::all() as $queueUser){
                    $minutesEstimated = Carbon::parse($queueUser->estimated_time)->diffInSeconds(Carbon::now()->addMinute($minutes),false)/-60;
                    if ($minutesEstimated < 0){
                        $queueUser->delete();
                        QueueTools::refresh_position($queueUser->queue->id, $queueUser->position);
                        QueueTools::refresh_estimated_time($queueUser->queue->id);
                        continue;
                    }
                    if ($minutesEstimated < $minutes){
                        //User is in notification time range
                        $user = $queueUser->user;
                        $token = $user->remember_token_firebase;
                        if($token){
                            //User can be notified from firebase
                            $commerce = $queueUser->queue->commerce;
                            $message = NotificationUtils::asRawFirebaseNotification($user,$commerce,(int)$minutesEstimated);
                            $messaging->sendMulticast($message, [$token]);
                        }
                    }
                }
            }
        )->everyMinute();
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
