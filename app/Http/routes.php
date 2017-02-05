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
Route::get('/requirement/{requirement_id}', function($requirement_id){
	//with project is just temporary
	return App\Requirement::with('towns', 'projects')->where('id', $requirement_id)->get();
});
Route::get('/message/seen/{message_id}', function($message_id){
	$message = App\Message::find($message_id);
	$message->opened = 1;
	$message->save();
	return ['stat' => 'success'];
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

	//Chart
	Route::get('charts/list-requirements', ['as' => 'admin.charts.list-requirements', function(){
		return view('admin.chart.list-requirements');
	}]);
	Route::get('charts/list-projects', ['as' => 'admin.charts.list-projects', function(){
		return view('admin.chart.list-projects');
	}]);
	Route::get('charts', ['as' => 'admin.charts.index', function(){
		return view('admin.chart.index');
	}]);

	//Organization
	Route::get('orgs', ['as' => 'admin.orgs.index', function(){
		return view('admin.orgs.index');
	}]);
});

/*
* Local Route
*/
Route::group(['prefix' => 'local'], function(){
	Route::get('projects/history-organization', ['as' => 'local.projects.history-organization', function(){
		return view('local.project.history');
	}]);
	//Danh sách toàn bộ project (của tất cả các tổ chức)
	Route::get('projects', ['as' => 'local.projects.index', function(){
		return view('local.project.index');
	}]);
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
	//Search
	Route::get('search', ['as' => 'local.search.index', 'uses' => function(){
		return view('local.search.index');
	}]);
	//Chart
	Route::get('charts', ['as' => 'local.charts.index', function(){
		return view('local.chart.index');
	}]);
});

/*
* Organization
*/
Route::group(['prefix' => 'organization'], function(){
	//Requirement
	Route::get('requirements/history', ['as' => 'organization.requirements.history', 'uses' => 'Organization\RequirementController@history']);
	Route::get('requirements/history-local', ['as' => 'organization.requirements.history-local', function(){
		return view('organization.requirement.history-local');
	}]);
	//Requirement (Danh sách các Requirement để đăng kí Project)
	Route::get('requirements', ['as' => 'organization.requirements.index', 'uses' => 'Organization\RequirementController@index']);
	//Project
	Route::get('projects/history-organization', ['as' => 'organization.projects.history-organization', function(){
		return view('organization.project.history');
	}]);
	Route::get('projects/create/{requirement_id}', ['as' => 'organization.projects.create', 'uses' => 'Organization\ProjectController@create']);
	Route::post('projects/store', ['as' => 'organization.project.store', 'uses' => 'Organization\ProjectController@store']);
	Route::get('projects/change-stat/{type_noti}/{requirement_id}', 'Organization\ProjectController@changeStat');

	//Danh sách các project (của 1 tổ chức)
	Route::get('projects/list', ['as' => 'organization.projects.list', function(){
		return view('organization.project.list');
	}]);
	//Danh sách toàn bộ project (của tất cả các tổ chức)
	Route::get('projects', ['as' => 'organization.projects.index', function(){
		return view('organization.project.index');
	}]);
	//Lịch sử cứu trợ của 1 tổ chức
	Route::get('projects/history-organization', ['as' => 'organization.projects.history-organization', function(){
		return view('organization.project.history-organization');
	}]);

	//Search
	Route::get('search', ['as' => 'organization.search.index', 'uses' => function(){
		return view('organization.search.index');
	}]);

	//Chart
	Route::get('charts', ['as' => 'organization.charts.index', function(){
		return view('organization.chart.index');
	}]);
});


Route::auth();
Route::get('/home', 'HomeController@index');
//Confirm account
Route::post('/postConfirm', 'Auth\AuthController@postConfirm');
//Mail
Route::get('/email', function(){
	Mail::send('email', [], function($message){
		$message->to('mqtent@gmail.com', 'Org')->subject('Email from Laravel');
	});
});
