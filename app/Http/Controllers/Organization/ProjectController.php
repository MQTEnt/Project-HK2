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
				'plan' => 'temp/'.$filePlan->getClientOriginalName(),
				'project_stat' => 0,
				'progress' => 0
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
	public function listProject(){
		$projects = Project::all();
		return view('organization.project.list', compact('projects'));
	}
	public function update($id, Request $request){
		//coditional - stat
		$project = Project::find($id);
		if(($project->project_stat == 1 || $project->project_stat == 3) && $request->name != '')
		{
			$project->name = $request->name;
			$project->items = $request->items;
			$project->note = $request->note;
			$project->from_date = $request->from_date;
			$project->to_date = $request->to_date;
			$project->project_stat = $request->project_stat;
			$project->progress = $request->progress;
			$project->save();
			return ['stat' => 'success'];
		}
		return ['stat' => 'false'];
	}
}
