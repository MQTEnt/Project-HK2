<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Project;

class ProjectController extends Controller
{
	public function index(){
		$projects = Project::all();
		return view('admin.project.index', compact('projects'));
	}
	public function approve($id){
		$project = Project::find($id);
		if($project->stat == 0)
		{
			$project->stat = 1;
			$project->project_stat = 1;
			$project->save();
		}
		return ['stat' => 'success'];
	}
	public function deny($id, Request $request){
		$project = Project::find($id);
		if($project->stat == 0)
		{
			$project->stat = 2;
			$project->note = $request->reason;
			$project->save();
		}
		return ['stat' => 'success'];
	}
	public function listProject(){
		$projects = Project::where('project_stat', 2)->get();
		return view('admin.chart.list-projects', compact('projects'));
	}
	public function rating($id, Request $request){
		$project = Project::find($id);
		if(is_numeric($request->rating) && is_numeric($request->money)){
			$project->rating = $request->rating;
			$project->money = $request->money;
			$project->save();
			return ['stat' => 'success'];
		}
		return ['stat' => 'false'];
	}
}
