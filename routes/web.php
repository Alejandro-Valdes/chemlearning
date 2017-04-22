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

use App\User as User;
use App\Role as Role;
use App\Permission as Permission;

Auth::routes();

Route::get('/', 'TopicController@index');

Route::get('/new-topic', 'TopicController@create');
Route::post('/new-topic', 'TopicController@store');
Route::get('/topic/{id}', 'TopicController@show');
Route::get('/topic/{id}/edit', 'TopicController@edit');
Route::post('/topic/{id}/update', 'TopicController@update');
Route::delete('/topic/{id}/delete', 'TopicController@destroy');

Route::post('/topic/{topic_id}/question/{id}', 'QuestionController@answer');
Route::get('/topic/{topic_id}/new-question', 'QuestionController@create');
Route::post('/topic/{topic_id}/new-question', 'QuestionController@store');
Route::get('/topic/{topic_id}/question/{id}', 'QuestionController@show');

Route::get('/admin/usuarios', 'AdminController@index');
Route::post('/admin/usuarios/{id}/guardar', 'AdminController@update');



Route::get('setup-entrust', function() {
	$admin = new Role();
	$admin->name = 'admin';
	$admin->save();

	$teacher = new Role();
	$teacher->name = 'teacher';
	$teacher->save();

	$user = new Role();
	$user->name = 'user';
	$user->save();



	$add_user = new Permission();
	$add_user->name = 'can_add_user';
	$add_user->save();

	$modify_user = new Permission();
	$modify_user->name = 'can_modify_user';
	$modify_user->save();

	$delete_user = new Permission();
	$delete_user->name = 'can_delete_user';
	$delete_user->save();

	$add_topic = new Permission();
	$add_topic->name = 'can_add_topic';
	$add_topic->save();

	$modify_topic = new Permission();
	$modify_topic->name = 'can_modify_topic';
	$modify_topic->save();

	$delete_topic = new Permission();
	$delete_topic->name = 'can_delete_topic';
	$delete_topic->save();

	$add_question = new Permission();
	$add_question->name = 'can_add_question';
	$add_question->save();

	$modify_question = new Permission();
	$modify_question->name = 'can_modify_question';
	$modify_question->save();

	$delete_question = new Permission();
	$delete_question->name = 'can_delete_question';
	$delete_question->save();



	$admin->attachPermission($add_user);
	$admin->attachPermission($modify_user);
	$admin->attachPermission($delete_user);
	$admin->attachPermission($add_topic);
	$admin->attachPermission($modify_topic);
	$admin->attachPermission($delete_topic);
	$admin->attachPermission($add_question);
	$admin->attachPermission($modify_question);
	$admin->attachPermission($delete_question);

	$teacher->attachPermission($add_topic);
	$teacher->attachPermission($modify_topic);
	$teacher->attachPermission($delete_topic);
	$teacher->attachPermission($add_question);
	$teacher->attachPermission($modify_question);
	$teacher->attachPermission($delete_question);


	// setup an admin
	$user = User::where('name', 'admin')->get()->first();
	$userRole = Role::where('name', 'admin')->get()->first();
	$user->attachRole($userRole);

	return 'success';
});