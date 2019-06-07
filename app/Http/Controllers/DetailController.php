<?php

namespace App\Http\Controllers;

use App\Banner;
use App\detail;
use App\place;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    //
    public function get(){
        $place_id = \request('place_id');
        $places = place::find($place_id);
        $places->detail;
        return json_encode($places,JSON_UNESCAPED_UNICODE);
    }

}
