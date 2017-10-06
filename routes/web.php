<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/seleccionar/proyecto/{id}', 'HomeController@selectProject')->name('selectProject');

//Incident
Route::get('/reportar', 'IncidentController@create')->name('create');
Route::post('/reportar', 'IncidentController@store')->name('store');

Route::get('/incidencia/{id}/editar', 'IncidentController@edit')->name('edit');
Route::post('/incidencia/{id}/editar', 'IncidentController@update')->name('update');

Route::get('/ver/{id}', 'IncidentController@show')->name('show');

Route::get('/incidencia/{id}/atender', 'IncidentController@take')->name('take');
Route::get('/incidencia/{id}/resolver', 'IncidentController@solve')->name('solve');
Route::get('/incidencia/{id}/abrir', 'IncidentController@open')->name('open');
Route::get('/incidencia/{id}/derivar', 'IncidentController@nextLevel')->name('nextLevel');

//Message
Route::post('/mensajes', 'MessageController@store')->name('store');


Route::group(['middleware' => 'admin', 'namespace' => 'Admin'], function (){
	//User
	Route::get('/usuarios', 'UserController@index')->name('index');
	Route::post('/usuarios', 'UserController@store')->name('store');
	
	Route::get('/usuario/{id}', 'UserController@edit')->name('edit');
	Route::post('/usuario/{id}', 'UserController@update')->name('update');

	Route::get('/usuario/{id}/eliminar', 'UserController@delete')->name('delete');
	
	//Project
	Route::get('/proyectos', 'ProjectController@index')->name('index');
	Route::post('/proyectos', 'ProjectController@store')->name('store');
	
	Route::get('/proyecto/{id}', 'ProjectController@edit')->name('edit');
	Route::post('/proyecto/{id}', 'ProjectController@update')->name('update');

	Route::get('/proyecto/{id}/eliminar', 'ProjectController@delete')->name('delete');
	Route::get('/proyecto/{id}/restaurar', 'ProjectController@restore')->name('restore');

	//Category
	Route::post('/categorias', 'CategoryController@store')->name('store');
	Route::post('/categoria/editar', 'CategoryController@update')->name('update');
	Route::get('/categoria/{id}/eliminar', 'CategoryController@delete')->name('delete');

	//Level
	Route::post('/niveles', 'LevelController@store')->name('store');
	Route::post('/nivel/editar', 'LevelController@update')->name('update');
	Route::get('/nivel/{id}/eliminar', 'LevelController@delete')->name('delete');

	//Project-User
	Route::post('/proyecto-usuario', 'ProjectUserController@store')->name('store');
	Route::post('/proyecto-usuario/editar', 'ProjectUserController@update')->name('update');
	Route::get('/proyecto-usuario/{id}/eliminar', 'ProjectUserController@delete')->name('delete');

	//Config
	Route::get('/config', 'ConfigController@index')->name('index');
});

