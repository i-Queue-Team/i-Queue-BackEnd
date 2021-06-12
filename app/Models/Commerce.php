<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    public function imageUrl(){
        return $this->image ? url('/') . Storage::url('') . 'commerces/' . $this->image : "https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1650&q=80";
    }
}
