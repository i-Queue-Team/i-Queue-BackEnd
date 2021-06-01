<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueueVerifiedUser extends Model{

    use HasFactory;

    protected $table = 'queue_verified_users';

    protected $fillable = [
        'estimated_time'

    ];
    public function queue(){
        return $this->belongsTo(CurrentQueue::class,'queue_id','id');
    }
}
