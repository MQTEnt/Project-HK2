<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\District;
use App\City;
class RegionController extends Controller
{
	public function index(){
		$cities = City::all();
		//$district = District::all();
		return view('admin.region', compact(['cities']));
	}
}
