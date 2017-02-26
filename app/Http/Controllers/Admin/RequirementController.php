<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\District;
use App\Requirement;
use App\City;

class RequirementController extends Controller
{
	public function index(){
		//Default city_id = 1 [DEMO]
		$districts = District::with('towns', 'towns.requirements')->where('city_id', 1)->get();
		return view('admin.requirement.index', compact('districts'));
		// $requirements = Requirement::all();
		// return view('local.requirement', compact('requirement'))
	}
	public function show($id){
		$requirement = Requirement::find($id);
		return view('admin.requirement.show', compact('requirement'));
	}
	public function changeStat($id, $newStat){
		$requirement = Requirement::find($id);
		if($newStat == 'pending')
			$requirement->stat = 0;
		else
			if($newStat == 'accept')
				$requirement->stat = 1;
			else
				$requirement->stat = 2;
		$requirement->save();
		if($newStat == 'pending')
			return redirect()->route('admin.requirements.show', $id);
		return redirect()->route('admin.requirements.index');
	}
	public function history(){
		//Default city_id = 1 [DEMO]
		$districts = District::with('towns', 'towns.requirementsActive')->where('city_id', 1)->get();
		return view('admin.requirement.history', compact('districts'));
	}
	public function evalRequirement(){
		$cities = City::with('districts', 'districts.towns', 'districts.towns.requirementsActive')->get();
		return view('admin.chart.list-requirements', compact('cities'));
	}
	public function evaluateRequirement($id, Request $request){
		$requirement = Requirement::find($id);
		if(is_numeric($request->level) && is_numeric($request->reason))
		{
			$requirement->level = $request->level;
			$requirement->reason = $request->reason;
			$requirement->save();
			return ['stat' => 'success'];
		}
		return ['stat' => 'false'];
	}
}
