<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Project;
use App\ProjectUser;
use App\Level;

class UserController extends Controller
{
    public function index()
    {
    	$users = User::where('role', 1)->get();
    	return view('admin.users.index')->with(compact('users'));
        
    }

    public function store(Request $request)
    {
    	  $request->validate([
       		'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6'     
    ]);
    	  $user = new User();
    	  $user->name = $request->input('name');
    	  $user->email = $request->input('email');
    	  $user->password = bcrypt($request->input('password'));
    	  $user->role = 1;
    	  $user->save();

    	return back()->with('notification', 'Usuario registrado exitosamente.');
    }

    public function edit($id)
    {
        
        
        $levels = Level::all();

    	$user = User::find($id);
        $projects = Project::all();
        $projects_user = ProjectUser::where('user_id', $user->id)->get();
        
    	return view('admin.users.edit')->with(compact('user', 'projects', 'projects_user', 'levels'));
    }

    public function update($id, Request $request)
    {
    	$request->validate([
       		'name' => 'required|max:255',
            'password' => 'sometimes|min:6﻿'     
    ]);
    	$user = User::find($id);
    	$user->name = $request->input('name');

    	$password = $request->input('password');
    	if ($password)
    	 {
    		$user->password = bcrypt($password);
    	}
    	$user->save();

    	return back()->with('notification', 'Usuario actualizado exitosamente.');
    }

     public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return back()->with('notification', 'El usuario se ha dado de baja exitosamente.');
    }
}
