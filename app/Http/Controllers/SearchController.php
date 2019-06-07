<?php

namespace App\Http\Controllers;

use App\place;

class SearchController extends Controller
{
    //
    public function getData(){
        $param = \request('param');
        $page = \request('page');
        $mylat = \request('lat');
        $mylong = \request('long');
        $places = array();
        $place = place::where('name','like','%'.$param.'%')->limit(10)->offset($page)->get();
        foreach ($place as $value){
            $distance = round($this->circle_distance($mylat,$mylong,$value->lat,$value->long),2,PHP_ROUND_HALF_UP);
            $each_row = array('place' => $value, 'distance' =>$distance);
            array_push($places,$each_row) ;
        }
        return json_encode($places,JSON_UNESCAPED_UNICODE);

    }

    function circle_distance($lat1, $lon1, $lat2, $lon2) {
        $rad = M_PI / 180;
        return acos(sin($lat2*$rad) * sin($lat1*$rad) + cos($lat2*$rad) * cos($lat1*$rad) * cos($lon2*$rad - $lon1*$rad)) * 6371;// Kilometers
    }

}
