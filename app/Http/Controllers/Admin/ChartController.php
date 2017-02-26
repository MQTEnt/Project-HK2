<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Project;

class ChartController extends Controller
{
	public function index(){
		$projectEval = Project::select(['id', 'name', 'money'])->where('project_stat', 2)->orderBy('money', 'DESC')->take(5)->get();
		$projectRating = Project::select(['id', 'name', 'rating'])->where('project_stat', 2)->orderBy('rating', 'DESC')->take(5)->get();
		// return $projectEval;
		return view('admin.chart.index', compact(['projectEval', 'projectRating']));
	}
}
