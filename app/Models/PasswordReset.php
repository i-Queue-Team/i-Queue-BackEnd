<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'password_resets';
    protected $fillable = [
        'email',
        'token',

    ];
}
