<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class Currentqueue extends Model{

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



    //commerce from queue
    public function Commerce()
    {
        return $this->hasOne('App\Models\Commerce', 'id');
    }
}
