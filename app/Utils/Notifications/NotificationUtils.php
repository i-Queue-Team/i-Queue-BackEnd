<?php
namespace App\Utils\Notifications;

use App\Models\Commerce;
use App\Models\User;
use Kreait\Firebase\Messaging\RawMessageFromArray;

class NotificationUtils{
    public static function asRawFirebaseNotification(User $user, Commerce $commerce,int $time) : RawMessageFromArray{
        $title = "¡Hey, $user->name!";
        $body = "¡Te quedan $time minutos para entrar en $commerce->name!";
        $image = $commerce->imageUrl();

        return new RawMessageFromArray([
            'notification' => [
                // https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#notification
                'title' => $title,
                'body' => $body,
                'image' => $image,
            ],
            //We dont pass more information in the notification
            /*'data' => [
                'key_1' => 'Value 1',
                'key_2' => 'Value 2',
            ],*/
            'android' => [
                // https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#androidconfig
                'ttl' => '3600s',
                'priority' => 'high',
                'notification' => [
                    'title' => $title,
                    'body' => $body,
                    'icon' => 'stock_ticker_update',
                    'color' => '#008080',
                    'tag' => "$commerce->id",
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
                            'title' => $title,
                            'body' => $body,
                        ],
                        // We dont want to override the notification count. This should be handled client-side
                        //'badge' => 1,
                    ],
                ],
            ],
            'webpush' => [
                // https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#webpushconfig
                'headers' => [
                    'Urgency' => 'normal',
                ],
                'notification' => [
                    'title' => $title,
                    'body' => $body,
                    'icon' => $image,
                ],
            ],
            //We dont use Firebase Analytics
            /*'fcm_options' => [
                // https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#fcmoptions
                'analytics_label' => 'some-analytics-label'
            ]*/
        ]);

    }
}
?>
