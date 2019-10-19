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
    return redirect()->route('task.index');
});

Route::get('tasks/index', 'TaskController@index')->name('task.index');
Route::get('tasks/api/list', 'TaskController@list')->name('task.list');
Route::get('tasks/create', 'TaskController@create')->name('task.create');
Route::post('tasks/store', 'TaskController@store')->name('task.store');
Route::get('tasks/{task}', 'TaskController@update')->name('task.update');
Route::get('tasks/{task}/show', 'TaskController@show')->name('task.show');
Route::put('tasks/{task}/edit', 'TaskController@edit')->name('task.edit');

Route::delete('/tasks/{task}/delete', 'TaskController@destroy')->name('task.destroy');
