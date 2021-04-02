<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commerce extends Model
{
    use HasFactory;

    public function Queue()
    {
        return $this->belongsTo('App\Models\Currentqueue', 'id');

    }


}
