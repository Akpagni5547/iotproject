<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StreamController extends Controller
{
    public function lastCaptor(){
        return response()->json(
            ['humidite' => 34, "temperature" => 15]
        );
    }

    public function command(){

    }


}
