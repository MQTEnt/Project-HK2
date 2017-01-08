<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\District;
use App\Requirement;
use App\Http\Requests\RequirementFormRequest;
class RequirementController extends Controller
{
	public function index(){
		//Default city_id = 1 [DEMO]
		$districts = District::with('towns', 'towns.requirements')->where('city_id', 1)->get();
		return view('local.requirement.index', compact('districts'));
		// $requirements = Requirement::all();
		// return view('local.requirement', compact('requirement'))
	}
	public function create(){
		//Default city_id = 1 [DEMO]
		$districts = District::with('towns', 'towns.requirements')->where('city_id', 1)->get();
		return view('local.requirement.create', compact('districts'));
	}
	public function store(RequirementFormRequest $request){
		$requirement = new Requirement();
		$requirement->name = $request->get('name');
		$requirement->info = $request->get('info');
		$requirement->desc = $request->get('desc');
		$requirement->town_id = $request->get('town_id');
		$requirement->save();
		return redirect()->route('requirements.index')->with(['new_requirement_id' => $requirement->id]);
	}
	public function show($id){
		$requirement = Requirement::find($id);
		return view('local.requirement.show', compact('requirement'));
	}
	public function edit($id){
		$requirement = Requirement::find($id);
		$districts = District::with('towns', 'towns.requirements')->where('city_id', 1)->get();
		return view('local.requirement.edit', compact(['districts', 'requirement']));
	}
	public function update(RequirementFormRequest $request, $id){
		$requirement = Requirement::find($id);
		$requirement->update([
			'name' => $request->get('name'),
			'info' => $request->get('info'),
			'desc' => $request->get('desc'),
			'town_id' => $request->get('town_id')
		]);
		return redirect()->route('requirements.index')->with(['update_requirement_id' => $requirement->id]);
	}
	public function destroy($id){
		$requirement = Requirement::find($id);
		$requirement->delete();
		return redirect()->route('requirements.index')->with(['delete_requirement_id' => $requirement->id]);
	}
}
