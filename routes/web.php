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

Route::get('blog', 'BlogController@index')->name('blog');
Route::get('blog/{id}', 
['uses' => 'BlogController@show', 'as' => 'show']);


Route::get('blog/create', 'PostsController@create')->name('create');
Route::post('blog/create', ['uses' => 'PostsController@store', 'as' => 'store']);


Route::delete('blog/{id}', 
['uses' => 'PostsController@destroy', 'as' => 'destroy']);

Route::get('blog/{id}/edit', 
['uses' => 'PostsController@edit', 'as' => 'show']);
