<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueueVerifiedUser extends Model{

    use HasFactory;

    protected $table = 'queue_verified_users';

    protected $fillable = [
        'estimated_time',
        'name',

    ];
    public function queue(){
        return $this->belongsTo(CurrentQueue::class,'queue_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    protected $casts = [
        'queue_id' => 'int',
    ];
}
