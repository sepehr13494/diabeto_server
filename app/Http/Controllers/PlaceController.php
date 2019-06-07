<?php

namespace App\Http\Controllers;

use App\place;

class PlaceController extends Controller
{

    //
    public function get(){
        $places = array();
        $page = \request('page');
        $startTime = \request('startTime');
        $endTime = \request('endTime');
        $category = \request('category');
        $workDays = \request('workDays');
        $mylat = \request('lat');
        $mylong = \request('long');
        if ($workDays != null && $workDays != ""){
            $days = json_decode($workDays, true);
        }else{
            $days = null;
        }
        $i = 0.00;
        $j = ($page+1)*10;

        do{

            $i += 0.01;
            $place_count = place::where(function ($query) use ($category) {
                if ($category != 0){
                    $query->where('category',$category);
                }
            })->where(function ($query) use ($startTime,$endTime) {
                if ($startTime != 0){
                    $query->where('endTime','>',$startTime);
                }
                if ($endTime != 24){
                    $query->where('startTime','<',$endTime);
                }
            })->whereBetween('lat',[$mylat-($i),$mylat+($i)])
                ->whereBetween('long',[$mylong-($i),$mylong+($i)])
                ->where(function ($query) use ($days) {
                    if ($days != null){
                        foreach($days as $select) {
                            $query->orWhere('workDays', 'like', '%'.$select.'%');
                        }
                    }
                })->count();

        }while($place_count<=$j && $i<0.5);

        $place = place::where(function ($query) use ($category) {
            if ($category != 0){
                $query->where('category',$category);
            }
        })->where(function ($query) use ($startTime,$endTime) {
            if ($startTime != 0){
                $query->where('endTime','>',$startTime);
            }
            if ($endTime != 24){
                $query->where('startTime','<',$endTime);
            }
        })->whereBetween('lat',[$mylat-($i),$mylat+($i)])
            ->whereBetween('long',[$mylong-($i),$mylong+($i)])
            ->where(function ($query) use ($days) {
                if ($days != null){
                    foreach($days as $select) {
                        $query->orWhere('workDays', 'like', '%'.$select.'%');
                    }
                }
            })->get();

        foreach ($place as $value){
            $distance = round($this->circle_distance($mylat,$mylong,$value->lat,$value->long),2,PHP_ROUND_HALF_UP);
            $each_row = array('place' => $value, 'distance' =>$distance);
            array_push($places,$each_row) ;
        }


        usort($places,array($this,'cmp'));
        //return json_encode($place_count."    ".$i,JSON_UNESCAPED_UNICODE);
        return json_encode($places,JSON_UNESCAPED_UNICODE);
    }

    function cmp(array $a, array $b) {
        if ($a['distance']<$b['distance']){
            return  -1;
        }else{
            return 1;
        }
    }


    function circle_distance($lat1, $lon1, $lat2, $lon2) {
        $rad = M_PI / 180;
        return acos(sin($lat2*$rad) * sin($lat1*$rad) + cos($lat2*$rad) * cos($lat1*$rad) * cos($lon2*$rad - $lon1*$rad)) * 6371;// Kilometers
    }
}
