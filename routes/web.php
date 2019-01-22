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

Route::get('search', 'BlogController@search')->name('blog.search');

Route::get('myblog', 'BlogController@list')->name('blog.list');
Route::get('myblog/{post}/edit', 'BlogController@edit')->name('blog.edit');
Route::put('myblog/{post}', 'BlogController@update')->name('blog.update');

Route::get('blogcat/{id}', 'BlogController@getPostsByCategory')->name('blog.category');
Route::get('blog/{slug}', 
['uses' => 'BlogController@showBySlug', 'as' => 'post.show']);


Route::resource('categories','Admin\CategoryController');
Route::resource('tags','Admin\TagController');
Route::resource('posts','Admin\PostController');
Route::resource('users','Admin\UserController');
Route::resource('permissions','Admin\PermissionController');
Route::resource('roles','Admin\RoleController');

Route::delete('massDestroy','Admin\RoleController@massDestroy')->name('mass.destroy');

Route::resource('profile','ProfileController');

Route::get('/trashed', 'Admin\UserController@trashed')->name('users.trashed');

Route::post('/restore/{id}', 'Admin\UserController@restore')->name('users.restore');

Route::delete('/userdestroy/{id}', 'Admin\UserController@userdestroy')->name('user.force.destroy');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/feedback', 'FeedbackController@create');
Route::get('/feedbacks', 'Admin\FeedbackController@index')->name('feedbacks.index');
Route::post('/feedback/create', 'FeedbackController@store');
Route::get('/feedbacks/delete/{id}', 'Admin\FeedbackController@destroy');

// Socialite Register Routes

Route::get('social/{provider}', 'Auth\SocialController@redirect')->name('social.redirect');
Route::get('social/{provider}/callback', 'Auth\SocialController@callback')->name('social.callback');

// Можно использовать метод middleware для назначения посредника на маршрут:
// Route::get('admin', 'Admin\DashboardController')->middleware('auth');

// Для назначения нескольких посредников для маршрута:
Route::get('admin', 'Admin\DashboardController')->middleware('auth', 'admin');

Route::resource('pictures','Admin\PictureController');

