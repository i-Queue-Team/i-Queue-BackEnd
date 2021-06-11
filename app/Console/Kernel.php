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
                foreach ($queueVerifiedUsersToDelete as $queueVerifiedUser) {
                    $queueVerifiedUser->delete();
                    QueueTools::refresh_position($queueVerifiedUser->queue->id, $queueVerifiedUser->position);
                    QueueTools::refresh_estimated_time($queueVerifiedUser->queue->id);
                }
                //instanciar la libreria de firebase
                $factory = (new Factory)->withServiceAccount(__DIR__ . '/firebase_credentials.json');
                $messaging = $factory->createMessaging();
                //iterar por los comercios
                foreach (Commerce::all() as $commerce) {
                    $commerceResource = new CommerceResource($commerce);
                    //recoger los datos de las colas en las cuales sus usuarios verificados quedan menos de 5 minutos para que sea su turno
                    $QueueVerifiedUsersToSendNotif = $commerce->queue->verifiedUsers->where('estimated_time', '<', Carbon::now()->addMinute(4))->pluck('user')->toArray();
                    foreach ($QueueVerifiedUsersToSendNotif as $user) {
                        $userFirebaseToken = $user->remember_token_firebase;
                        $userEstimated_time = $user->queues->where('queue_id', '=', $commerce->queue->id)->first()->estimated_time;
                        $userRemainingMinutes =  ltrim(gmdate('i', Carbon::parse($userEstimated_time)->diffInSeconds(Carbon::now())), 0);
                        //si el usuario tiene token entonces enviar notificacion
                        if (!is_null($userFirebaseToken)) {
                            $message = new RawMessageFromArray([
                                'notification' => [
                                    // https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#notification
                                    'title' => "¡Hey, $user->name! ",
                                    'body' => "¡Te quedan $userRemainingMinutes minutos para entrar en $commerce->name!",
                                    'image' => "$commerceResource->image",
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
                                        'title' => "¡Hey, $user->name! ",
                                        'body' => "¡Te quedan $userRemainingMinutes minutos para entrar en $commerce->name!",
                                        'icon' => 'stock_ticker_update',
                                        'color' => '#008080',
                                        'tag' => $commerce->name,
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
                                                'title' => "¡Hey, $user->name! ",
                                                'body' => "¡Te quedan $userRemainingMinutes minutos para entrar en $commerce->name!",
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
                                        'title' => "¡Hey, $user->name! ",
                                        'body' => "¡Te quedan $userRemainingMinutes minutos para entrar en $commerce->name!",
                                        'icon' => $commerceResource->image
                                    ],
                                ],
                                'fcm_options' => [
                                    // https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#fcmoptions
                                    'analytics_label' => 'some-analytics-label'
                                ]
                            ]);
                            $messaging->sendMulticast($message, [$userFirebaseToken]);
                        }
                    }
                }
            }


            //send notifications using this query
            //$test= QueueVerifiedUser::where('estimated_time', '<', Carbon::now()->addMinute(4))->get();
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
