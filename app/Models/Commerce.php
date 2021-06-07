<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class Commerce extends Model{

    use HasFactory;

    protected $table = 'commerces';
    public $timestamps = false;

    /*
//HASHED ID !!!!!!!!!!!!!!! TODO
    //Hide predictable iD

public function getIdAttribute($value)
    {
        return Hashids::encode($value);
    }

*/
    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'user_id',
        'info',

    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
    ];
    public function queue()
    {
        return $this->hasOne(CurrentQueue::class,'commerce_id');
    }

    public function admin(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
