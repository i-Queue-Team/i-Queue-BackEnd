<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commerce;
use App\Models\Currentqueue;

class CommerceController extends Controller
{

    function list()
    {
        return Commerce::all();
    }
    function CurrentQueue()
    {
        $CurrentQueue = Currentqueue::find(3);
        if ($CurrentQueue) {
            return $CurrentQueue->Commerce;
        } else {
            return "Error";
        }
    }
}
