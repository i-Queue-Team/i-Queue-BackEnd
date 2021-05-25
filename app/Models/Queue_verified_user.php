<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queue_verified_user extends Model{

    use HasFactory;

    protected $table = 'queue_verified_users';

    protected $fillable = [
        'estimated_time'

    ];
}
