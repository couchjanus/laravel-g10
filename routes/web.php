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
Route::resource('users','Admin\UserController');

Route::resource('profile','ProfileController');

Route::get('/trashed', 'Admin\UserController@trashed')->name('users.trashed');

Route::post('/restore/{id}', 'Admin\UserController@restore')->name('users.restore');

Route::delete('/userdestroy/{id}', 'Admin\UserController@userdestroy')->name('user.force.destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
