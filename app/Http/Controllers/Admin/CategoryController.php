<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    public function store(Request $request)
	{
		$request->validate([
			'name' => 'required',    
		]);

		Category::create($request->all());

		return back()->with('notification', 'Categoría creada exitosamente.');

	}

	public function update(Request $request)
	{
		$request->validate([
			'name' => 'required',    
		]);

		$category_id = $request->input('category_id');
		$category = Category::find($category_id);
		$category->name = $request->input('name');
		$category->save();

		return back()->with('notification', 'Categoría actualizada exitosamente.');
	}

		public function delete($id)
	{
		Category::find($id)->delete();
		return back()->with('notification', 'La categoría ha sido eliminada exitosamente.');
	}
}

