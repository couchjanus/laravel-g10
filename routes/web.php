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
Route::get('blogcat/{id}', 'BlogController@getPostsByCategory')->name('blog.category');
Route::get('blog/{slug}', 
['uses' => 'BlogController@showBySlug', 'as' => 'post.show']);

Route::resource('categories','Admin\CategoryController');
Route::resource('tags','Admin\TagController');
Route::resource('posts','Admin\PostController');
