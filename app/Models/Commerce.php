<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class Commerce extends Model{

    use HasFactory;

    protected $table = 'commerces';

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
        'location',

    ];


    public function Queue()
    {
        return $this->belongsTo('App\Models\Currentqueue', 'id');
    }
}
