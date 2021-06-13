<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CurrentQueue extends Model{

    use HasFactory;

    protected $table = 'current_queues';
    /*
    //HASHED ID !!!!!!!!!!!!!!! TODO
    //Hide predictable iD
    protected $hidden = [
        'commerce_id',
        'id'
    ];
    //Hash Id function
    public function getHashedCommerceIdAttribute()
    {
        return $this->attributes['commerce_id'] =  Hashids::encode($this->attributes['commerce_id']);
    }
    //Hash Id function
    public function getHashedIdAttribute()
    {
        return $this->attributes['id'] =  Hashids::encode($this->attributes['id']);
    }
    //append hashed id to model
    protected $appends = ['Hashed_commerce_id', 'Hashed_id'];
    */
    protected $fillable = [
        'fixed_capacity',
        'average_time',

    ];



    public function verifiedUsers(){
        return $this->hasMany(QueueVerifiedUser::class,'queue_id');
    }
    //commerce from queue
    public function commerce(){
        return $this->belongsTo(Commerce::class,'commerce_id');
    }

    public function positions(){
        return $this->verifiedUsers()->count() + 1;
    }

    public function estimatedTime(QueueVerifiedUser $queueUser): string
    {
        return Carbon::now()->addMinute($this->average_time * $queueUser->position)->format('Y-m-d H:i:s');
    }
    public function alreadyInQueue(User $user)
    {
        foreach ($this->verifiedUsers as $queueUser) {
            if ($queueUser->user_id = $user->id) {
                return true;
            }
        }
        return false;
    }
    public function refreshQueue(){
        $this->refreshPositions($this);
        $this->refreshEstimatedTimes($this);
        $this->current_capacity = $this->positions()-1;
        $this->save();
    }
    private function refreshPositions()
    {
        $i = 0;
        foreach ($this->verifiedUsers()->orderBy('position', 'asc')->get() as $queueUser) {
            $i++;
            $queueUser->position = $i;
            $queueUser->save();
        }
    }
    private function refreshEstimatedTimes()
    {
        date_default_timezone_set('Europe/Madrid');
        foreach ($this->verifiedUsers as $queueUser) {
            $queueUser->estimated_time = $this->estimatedTime($queueUser, $this);
            $queueUser->save();
        }
    }
    public function storeStadistics(QueueVerifiedUser $queueUser)
    {
        $statistic = new Statistic();
        $statistic->queue_id = $this->id;
        $statistic->user_id = $queueUser->user_id;
        //posicion es igual a la funcion posicion
        $statistic->position = $this->positions();
        //el tiempo estimado sera el actual con la adicion de los minutos recibidos de la funcion de tiempo estimado
        $statistic->estimated_time = $this->estimatedTime($queueUser, $this);
        $statistic->save();
    }
}
