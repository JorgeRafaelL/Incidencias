<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Level;

class LevelController extends Controller
{

	public function byProject($id)
	{
		return Level::where('project_id', $id)->get();
	}

     public function store(Request $request)
	{
		$request->validate([
			'name' => 'required',    
		]);

		Level::create($request->all());

		return back()->with('notification', 'Nivel creado exitosamente.');

	}

		public function update(Request $request)
	{
		$request->validate([
			'name' => 'required',    
		]);

		$level_id = $request->input('level_id');
		$level = Level::find($level_id);
		$level->name = $request->input('name');
		$level->save();

		return back()->with('notification', 'Nivel actualizado exitosamente.');
	}

	public function delete($id)
	{
		Level::find($id)->delete();
		return back()->with('notification', 'El nivel ha sido eliminado exitosamente.');
	}
}
