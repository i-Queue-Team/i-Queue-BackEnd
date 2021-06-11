<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\QueueVerifiedUser;
use App\Utils\Queue\QueueTools;
use Carbon\Carbon;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\RawMessageFromArray;
use Illuminate\Support\Facades\Storage;
use App\Models\CurrentQueue;
use App\Models\Commerce;
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
                    //delete the ones appearing with this one
        $queueVerifiedUsersToDelete = QueueVerifiedUser::where('estimated_time', '<', Carbon::now())->get();

        //$queueVerifiedUsersToDelete = QueueVerifiedUser::All();
        //return $queueVerifiedUsersToDelete;
        foreach ($queueVerifiedUsersToDelete as $queueVerifiedUser) {
            $queueVerifiedUser->delete();
            QueueTools::refresh_position($queueVerifiedUser->queue->id, $queueVerifiedUser->position);
            QueueTools::refresh_estimated_time($queueVerifiedUser->queue->id);
        }
        //instanciar la libreria de firebase
        $factory = (new Factory)->withServiceAccount(__DIR__ . '/firebase_credentials.json');
        $messaging = $factory->createMessaging();
        //iterar por los comercios
        $commerces = Commerce::all();
        foreach ($commerces as $commerce) {
            $commerceName = $commerce->name;
            $commerceImage = url('/') . Storage::url('') . 'commerces/' . $commerce->image;
            //recoger los datos de las colas en las cuales sus usuarios verificados quedan menos de 5 minutos para que sea su turno
            $QueueVerifiedUsersToSendNotif = CurrentQueue::find($commerce->id)->verifiedUsers->where('estimated_time', '<', Carbon::now()->addMinute(4));
            //si esta vacio no hacer nada
            if (!is_null($QueueVerifiedUsersToSendNotif)) {
                $users = $QueueVerifiedUsersToSendNotif->pluck('user');
                foreach ($users as $user) {
                    $userFirebaseToken = $user->remember_token_firebase;
                    $userName = $user->name;
                    $userEstimated_time = QueueVerifiedUser::where('user_id', '=', $user->id)->where('queue_id', '=', $commerce->id)->first()->estimated_time;
                    $userRemainingMinutes =  ltrim(gmdate('i', Carbon::parse($userEstimated_time)->diffInSeconds(Carbon::now())), 0);
                    //si el usuario tiene token entonces enviar notificacion
                    if (!is_null($userFirebaseToken)) {
                        $deviceToken = [$userFirebaseToken];
                        $message = new RawMessageFromArray([
                            'notification' => [
                                // https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#notification
                                'title' => "¡Hey, $userName! ",
                                'body' => "¡Te quedan $userRemainingMinutes minutos para entrar en $commerceName!",
                                'image' => "$commerceImage",
                            ],
                            'data' => [
                                'key_1' => 'Value 1',
                                'key_2' => 'Value 2',
                            ],
                            'android' => [
                                // https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#androidconfig
                                'ttl' => '3600s',
                                'priority' => 'high',
                                'notification' => [
                                    'title' => "¡Hey, $userName! ",
                                    'body' => "¡Te quedan $userRemainingMinutes minutos para entrar en $commerceName!",
                                    'icon' => 'stock_ticker_update',
                                    'color' => '#008080',
                                    'tag' => "$commerceName",
                                ],
                            ],
                            'apns' => [
                                // https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#apnsconfig
                                'headers' => [
                                    'apns-priority' => '10',
                                ],
                                'payload' => [
                                    'aps' => [
                                        'alert' => [
                                            'title' => "¡Hey, $userName! ",
                                            'body' => "¡Te quedan $userRemainingMinutes minutos para entrar en $commerceName!",
                                        ],
                                        'badge' => 1,
                                    ],
                                ],
                            ],
                            'webpush' => [
                                // https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#webpushconfig
                                'headers' => [
                                    'Urgency' => 'normal',
                                ],
                                'notification' => [
                                    'title' => "¡Hey, $userName! ",
                                    'body' => "¡Te quedan $userRemainingMinutes minutos para entrar en $commerceName!",
                                    'icon' => 'https://my-server/icon.png',
                                ],
                            ],
                            'fcm_options' => [
                                // https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#fcmoptions
                                'analytics_label' => 'some-analytics-label'
                            ]
                        ]);
                        $messaging->sendMulticast($message, $deviceToken);
                    }
                }
            }
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
