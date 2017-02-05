<?php

namespace App\Http\Controllers\Organization;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Requirement;
use App\City;
class RequirementController extends Controller
{
	public function index(){
		//Default city id = 1
		$cities = City::with('districts')->where('id', 1)->get();
		return view('organization.requirement.index', compact('cities'));
	}
	public function history(){
		//Default city id = 1
		$cities = City::with('districts')->where('id', 1)->get();
		return view('organization.requirement.history', compact('cities'));
		//dd($cities);
	}
}
