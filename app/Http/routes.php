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

/*
* API
*/
Route::get('/get-cities-districts', function(){
	return App\City::with('districts', 'districts.towns')->get();
});
Route::get('/town/{town_id}', function($town_id){
	return App\Town::find($town_id);
});

/*
* Admin Route
*/
Route::group(['prefix' => 'admin'], function(){
	//Region
	Route::get('region', ['as' => 'region.index', 'uses' => 'RegionController@index']);
	//Town
	Route::post('towns', 'TownController@store');
	Route::post('towns/{town_id}', 'TownController@update');
	Route::delete('towns/{town_id}', 'TownController@destroy');
});
Route::auth();
Route::get('/home', 'HomeController@index');
Route::post('/postConfirm', 'Auth\AuthController@postConfirm');

Route::get('/checkFunction', function(){
	$user = App\User::where('email', 'mrc@gmail.com')->first();
	var_dump($user->stat);
});