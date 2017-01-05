<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\RegionFormRequest;
use App\Town;
class TownController extends Controller
{
	public function store(RegionFormRequest $request){
		Town::create([
			'name' => $request->get('name'),
			'lat' => $request->get('lat'),
			'lon' => $request->get('lon'),
			'district_id' => $request->get('district_id')
		]);
		return ['stat' => 'success'];
	}
	public function update(RegionFormRequest $request, $town_id)
	{
		$town = Town::find($town_id);
		$town->update([
			'name' => $request->get('name'),
			'lat' => $request->get('lat'),
			'lon' => $request->get('lon')
		]);
		return ['stat' => 'success'];
	}
	public function destroy($town_id){
		$town = Town::find($town_id);
		$town->delete();
		return ['stat' => 'success'];
	}
}
