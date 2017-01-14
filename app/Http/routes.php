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

	//Project
	Route::get('projects', ['as' => 'admin.projects.index', function(){
		return view('admin.project.index');
	}]);
});

/*
* Local Route
*/
Route::group(['prefix' => 'local'], function(){
	Route::get('requirements/history-local', ['as' => 'local.requirements.history-local', function(){
		return view('local.requirement.history-local');
	}]);
	Route::get('requirements/history', ['as' => 'local.requirements.history', function(){
		return view('local.requirement.history');
	}]);
	//Requirement
	Route::get('requirements', ['as' => 'local.requirements.index', 'uses' => 'Local\RequirementController@index']);
	Route::get('requirements/create', ['as' => 'local.requirements.create', 'uses' => 'Local\RequirementController@create']);
	Route::post('requirements/store', ['as' => 'local.requirements.store', 'uses' => 'Local\RequirementController@store']);
	Route::get('requirements/{requirement_id}', ['as' => 'local.requirements.show', 'uses' => 'Local\RequirementController@show']);
	Route::get('requirements/{requirement_id}/edit', ['as' => 'local.requirements.edit', 'uses' => 'Local\RequirementController@edit']);
	Route::put('requirements/{requirement_id}', ['as' => 'local.requirements.update', 'uses' => 'Local\RequirementController@update']);
	Route::get('requirements/{requirement_id}/delete', ['as' => 'local.requirements.destroy', 'uses' => 'Local\RequirementController@destroy']);
});

/*
* Organization
*/
Route::group(['prefix' => 'organization'], function(){
	//Requirement
	Route::get('requirements', ['as' => 'organization.requirements.index', function(){
		return view('organization.requirement.index');
	}]);
	Route::get('projects/history-organization', ['as' => 'organization.projects.history-organization', function(){
		return view('organization.project.history');
	}]);
	Route::get('projects/create', ['as' => 'organization.projects.create', function(){
		return view('organization.project.create');
	}]);
	//Danh sách các project (của 1 tổ chức)
	Route::get('projects/list', ['as' => 'organization.projects.list', function(){
		return view('organization.project.list');
	}]);
	//Danh sách toàn bộ project (của tất cả các tổ chức)
	Route::get('projects', ['as' => 'organization.projects.index', function(){
		return view('organization.project.index');
	}]);
});

Route::auth();
Route::get('/home', 'HomeController@index');
//Confirm account
Route::post('/postConfirm', 'Auth\AuthController@postConfirm');


