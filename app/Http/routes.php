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

Route::get('/', 'HomeController@index');

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
	
	//Requirement
	Route::get('requirements/{requirement_id}', ['as' => 'admin.requirements.show', 'uses' => 'Admin\RequirementController@show']);
	Route::get('requirements', ['as' => 'admin.requirements.index', 'uses' => 'Admin\RequirementController@index']);
	Route::get('requirements/{requirement_id}/{newStat}', 'Admin\RequirementController@changeStat');
});

/*
* Local Route
*/
Route::group(['prefix' => 'local'], function(){
	//Requirement
	Route::get('requirements', ['as' => 'requirements.index', 'uses' => 'RequirementController@index']);
	Route::get('requirements/create', ['as' => 'requirements.create', 'uses' => 'RequirementController@create']);
	Route::post('requirements/store', ['as' => 'requirements.store', 'uses' => 'RequirementController@store']);
	Route::get('requirements/{requirement_id}', ['as' => 'requirements.show', 'uses' => 'RequirementController@show']);
	Route::get('requirements/{requirement_id}/edit', ['as' => 'requirements.edit', 'uses' => 'RequirementController@edit']);
	Route::put('requirements/{requirement_id}', ['as' => 'requirements.update', 'uses' => 'RequirementController@update']);
	Route::get('requirements/{requirement_id}/delete', ['as' => 'requirements.destroy', 'uses' => 'RequirementController@destroy']);
});

Route::auth();
Route::get('/home', 'HomeController@index');
//Confirm account
Route::post('/postConfirm', 'Auth\AuthController@postConfirm');


