<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ProjectUser;
use App\Project;
use App\Level;

class ProjectUserController extends Controller
{
	public function store(Request $request)
	{
		

		$project_id = $request->input('project_id');
		$user_id = $request->input('user_id');
		$level_id = $request->input('level_id');

		$project_user = ProjectUser::where('project_id', $project_id)->where('user_id', $user_id)->first();

		if ($project_user) 
		{
			return back()->with('info', 'El usuario ya pertenece a este proyecto.');
		}
		if (! $project_id || ! $level_id) 
		{
			return back()->with('info', 'Seleccione un nivel y / o proyecto.');
		}

		$project_user = new ProjectUser();
		$project_user->project_id = $request->input('project_id');
		$project_user->user_id = $request->input('user_id');
		$project_user->level_id = $request->input('level_id');
		$project_user->save();

		return back()->with('notification', 'La asignación se ha hecho exitosamente.');
	}

	/*public function update(Request $request)
	{
		$request->validate([
			'project_id' => 'required',
			'level_id' => 'required',
			
		]);
		$project_id = $request->input('project_id');
		$project = Project::find($project_id);
		$project->name = $request->input('name');
		$project->save();
		$level_id = $request->input('level_id');
		$level = Level::find($level_id);
		$level->name = $request->input('name');
		$level->save();
		//$projectuser = ProjectUser::findOrFail($id);
		//$projectuser->project_id = $request->input('project_id');
		//$projectuser->level_id = $request->input('level_id');
		
		$projectuser->save();

		return back()->with('notification', 'actualizado exitosamente.');

	}*/

	public function delete($id)
	{
		ProjectUser::find($id)->delete();
		return back()->with('notification', 'La eliminación se ha hecho exitosamente.');
	}

}
