<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;

class ProjectController extends Controller
{
	public function index()
	{
		$projects = Project::withTrashed()->get();
		return view('admin.projects.index')->with(compact('projects'));
	}

	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required',
            //'description' => '',
			'start' => 'date'     
		]);
		Project::create($request->all());

		return back()->with('notification', 'Proyecto creado exitosamente.');

	}

	public function edit($id)
	{
		$project = Project::find($id);
		$categories = $project->categories;
		$levels = $project->levels;

		return view('admin.projects.edit')->with(compact('project', 'categories', 'levels'));
	}

	public function update($id, Request $request)
	{
		$request->validate([
			'name' => 'required',
            //'description' => '',
			'start' => 'date'     
		]);

		Project::find($id)->update($request->all());

		return back()->with('notification', 'Proyecto actualizado exitosamente.');
	}

	public function delete($id)
	{
		Project::find($id)->delete();

		return back()->with('notification', 'El proyecto se ha dado de baja exitosamente.');
	}

	public function restore($id)
	{
		Project::withTrashed()->find($id)->restore();

		return back()->with('notification', 'El proyecto se ha dado de alta exitosamente.');
	}
}
