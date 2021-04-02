<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;
class Commerce extends Model
{
    use HasFactory;

/*
//HASHED ID !!!!!!!!!!!!!!! TODO
    //Hide predictable iD
    protected $hidden = [
        'id',
    ];
    //Hash Id function
    public function getHashedIdAttribute()
    {
        return $this->attributes['id'] =  Hashids::encode($this->attributes['id']);

    }
    //append hashed id to model
    protected $appends = ['Hashed_id'];

*/


    public function Queue()
    {
        return $this->belongsTo('App\Models\Currentqueue', 'id');
    }
}
