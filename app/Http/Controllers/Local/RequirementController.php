<?php

namespace App\Http\Controllers\Local;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\District;
use App\Requirement;
use App\Http\Requests\RequirementFormRequest;
use App\Lib\NotiRequirement;
use App\Lib\ThisSystem;
use App\Lib\Mobile;
use App\Lib\Email;
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
		return redirect()->route('local.requirements.index')->with(['new_requirement_id' => $requirement->id]);
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
		$requirement = Requirement::with('projects')->find($id);
		$requirement->update([
			'name' => $request->get('name'),
			'info' => $request->get('info'),
			'desc' => $request->get('desc'),
			'town_id' => $request->get('town_id')
		]);
		if(count($requirement->projects) != 0)
		{
			$notiRequirement = new NotiRequirement(1, $id); //Default user_id = 1
			$thisSystem = new ThisSystem();
			$notiRequirement->attach($thisSystem);
			if($requirement->projects->first()->noti_phone == 1){
				$mobile = new Mobile();
				$notiRequirement->attach($mobile);
			}
			if($requirement->projects->first()->noti_email == 1){
				$email = new Email();
				$notiRequirement->attach($email);
			}
			$content = "Yêu cầu cứu trợ ".$requirement->name." (id: ".$requirement->id.") đã được cập nhật lại";
			$notiRequirement->pushNoti($content);
		}
		return redirect()->route('local.requirements.index')->with(['update_requirement_id' => $requirement->id]);
	}
	public function destroy($id){
		$requirement = Requirement::find($id);
		$requirement->delete();
		return redirect()->route('local.requirements.index')->with(['delete_requirement_id' => $requirement->id]);
	}
	public function history(){
		//Default city_id = 1 [DEMO]
		$districts = District::with('towns', 'towns.requirementsActive')->where('city_id', 1)->get();
		return view('local.requirement.history', compact('districts'));
	}
}
