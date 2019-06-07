<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use \phpDocumentor\Reflection\Types\Integer;
use Faker\Generator as Faker;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('v1/places', 'PlaceController@get');
Route::post('v1/search', 'SearchController@getData');

Route::post('v1/detail', 'DetailController@get');
Route::post('v1/banners', 'BannerController@getBanners');

