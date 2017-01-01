<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('admin.region');
});
//API
Route::get('/get-cities', function(){
	$cities = App\City::all();
	return $cities;
});
Route::get('/get-districts', function(){
	$districts = App\District::all();
	return $districts;
});

//Admin Route
Route::group(['prefix' => 'admin'], function(){
	//Region
	Route::get('region', ['as' => 'region.index', 'uses' => 'RegionController@index']);
});