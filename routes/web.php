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

Route::get('tasks/index', 'TaskController@index')->name('task.index');
Route::get('/tasks/api/list', 'TaskController@list')->name('task.list');
Route::get('tasks/create', 'TaskController@create')->name('task.create');
