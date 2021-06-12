<?php

namespace App\Utils\Queue;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Statistic;
use App\Models\CurrentQueue;
use Illuminate\Http\Request;
use App\Models\QueueVerifiedUser;
use Illuminate\Support\Facades\DB;
use App\Utils\Responses\IQResponse;
use Symfony\Component\HttpFoundation\Response;

class QueueTools
{
    // store user in queue
    public static function storeStatistic(CurrentQueue $queue,QueueVerifiedUser $queueUser)
    {
        $transaction = function (CurrentQueue $queue, QueueVerifiedUser $queueUser){
            $statistic = new Statistic();
            $statistic->queue_id = $queue->id;
            $statistic->user_id = $queueUser->user_id;
            //posicion es igual a la funcion posicion
            $statistic->position = $queue->positions();
            //el tiempo estimado sera el actual con la adicion de los minutos recibidos de la funcion de tiempo estimado
            $statistic->estimated_time = self::estimatedTime($queueUser,$queue);
        };
        //validate queue
        //queue instance
        DB::transaction($transaction($queue,$queueUser));
    }

    public static function removeUserFromQueue(CurrentQueue $queue, QueueVerifiedUser $queueUser){
        $transaction = function (CurrentQueue $queue, QueueVerifiedUser $queueUser) {
            $queue->verifiedUsers->where('position'. '>', $queueUser->position)->update([
                'position' => DB::raw('position-1'),
            ]);
            $queue->current_capacity = $queue->current_capacity-1;
        };
        DB::transaction($transaction($queue,$queueUser));
    }

    public static function addOneToQueueCapacity(CurrentQueue $queue){
        $queue->current_capacity = $queue->current_capacity+1;
        $queue->save();
    }
    public static function refreshEstimatedTimes(CurrentQueue $queue){
        $refresh = function (CurrentQueue $queue){
            foreach($queue->verifiedUsers as $queueUser){
                $queueUser->estimated_time = self::estimatedTime($queueUser,$queue);
            }
        };
        date_default_timezone_set('Europe/Madrid');
        DB::transaction($refresh($queue));
    }

    public static function estimatedTime(QueueVerifiedUser $queueUser, CurrentQueue $queue) : string{
        return Carbon::now()->addMinute($queue->average_time * $queueUser->position)->format('Y-m-d H:i:s');
    }
    public static function alreadyInQueue(User $user, CurrentQueue $queue){
        foreach ($queue->verifiedUsers as $queueUser){
            if($queueUser->user_id = $user->id){
                return true;
            }
        }
        return false;
    }
}
