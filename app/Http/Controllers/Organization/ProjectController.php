<?php

namespace App\Http\Controllers\Organization;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Project;
use App\Requirement;
use App\Http\Requests\ProjectFormRequest;
class ProjectController extends Controller
{
	public function create($requirement_id){
		return view('organization.project.create', compact('requirement_id'));
	}
	public function store(ProjectFormRequest $request){
		$requirement = Requirement::find($request->requirement_id);
		if($requirement->stat == 1)
		{
			if ($request->hasFile('plan')) {
				$filePlan = $request->file('plan');
				$filePlan->move(public_path().'/temp', $filePlan->getClientOriginalName());
			}
			Project::create([
				'name' => $request->name,
				'from_date' => $request->from_date,
				'to_date' => $request->to_date,
				'items' => $request->items,
				'user_id' => 1,
				'requirement_id' => $request->requirement_id,
				'stat' => 0,
				'plan' => 'temp/'.$filePlan->getClientOriginalName()
			]); //Default user_id, requirement_id
			return redirect()->route('organization.requirements.index');
		}
		else
			return "Không thể đăng ký";
	}
	public function changeStat($type_noti, $requirement_id){
		$requirement = Requirement::with('projects')->where('id', $requirement_id)->first();
		if($requirement->projects[0]->{$type_noti} == 1){
			$requirement->projects[0]->{$type_noti} = 0;
			$requirement->projects[0]->save();
		}
		else{
			$requirement->projects[0]->{$type_noti} = 1;
			$requirement->projects[0]->save();
		}
		return ['stat' => 'success'];
	}
}
