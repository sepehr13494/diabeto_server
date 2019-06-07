<?php

namespace App\Http\Controllers;

use App\Banner;
use App\place;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    //
    public function getBanners(){
        $banners = Banner::all();
        $places = place::inRandomOrder()->take(5 - sizeof($banners))->get();
        foreach ($places as $value){
            $value->detail;
        }
        $myBanners = array('banners'=>$banners ,"places"=> $places);

        return json_encode($myBanners,JSON_UNESCAPED_UNICODE);
    }
}
