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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'TopicController@index');

Route::get('/new-topic', 'TopicController@create');
Route::post('/new-topic', 'TopicController@store');
Route::get('/topic/{id}', 'TopicController@show');
Route::get('/topic/{id}/edit', 'TopicController@edit');
Route::post('/topic/{id}/update', 'TopicController@update');
Route::delete('/topic/{id}/delete', 'TopicController@destroy');

Route::get('/topic/{topic_id}/new-question', 'QuestionController@create');
Route::post('/topic/{topic_id}/new-question', 'QuestionController@store');
Route::get('/topic/{topic_id}/question/{id}', 'QuestionController@show');

use App\Role as Role;
use App\Permission as Permission;
Route::get('setup-entrust', function() {
	// para que solo admin pueda agregar / modificar / borrar
	$admin = new Role();
	$admin->name = 'Admin';
	$admin->save();

	$add = new Permission();
	$add->name = 'can_add';
	$add->save();

	$modify = new Permission();
	$modify->name = 'can_modify';
	$modify->save();

	$delete = new Permission();
	$delete->name = 'can_add';
	$delete->save();

	$admin->attachPermission($add);
	$admin->attachPermission($modify);
	$admin->attachPermission($delete);

	// $user1 = User::find(1);
	// $user1->attachRole($admin);

	return 'success';
});