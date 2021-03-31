<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currentqueue extends Model
{
    use HasFactory;


    //commerce from queue
    public function Commerce()
    {
        return $this->hasOne('App\Models\Commerce', 'id');
    }
}
