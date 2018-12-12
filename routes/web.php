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

Route::get('/about', 'AboutController');

Route::get('/test', 'TestController@index');

Route::get('blog', ['uses' => 'PostsController@index', 'as' => 'blog']);

Route::get('blog/create', 'PostsController@create')->name('create');
Route::post('blog/create', ['uses' => 'PostsController@store', 'as' => 'store']);

Route::get('blog/{id}', 
['uses' => 'PostsController@show', 'as' => 'show']);

Route::delete('blog/{id}', 
['uses' => 'PostsController@destroy', 'as' => 'destroy']);

Route::get('blog/{id}/edit', 
['uses' => 'PostsController@edit', 'as' => 'show']);
