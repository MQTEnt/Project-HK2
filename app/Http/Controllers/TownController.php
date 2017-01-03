<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Town;
class TownController extends Controller
{
	public function store(Request $request){
		Town::create([
			'name' => $request->get('name'),
			'lat' => $request->get('lat'),
			'lon' => $request->get('lon'),
			'district_id' => $request->get('district_id')
		]);
		return ['stat' => 'success'];
	}
}
