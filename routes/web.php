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



