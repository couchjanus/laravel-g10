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


Route::get('/hey', function()
{
    return 'Hello World';
});

Route::get('/hell', function() {
    return view('greeting');
});

Route::get('/jan', function() {
    return view('hello.greeting', ['name' => 'Janus']);
});

Route::get('/about', 'AboutController');

Route::get('/test', 'TestController@index');

Route::get('foo', ['uses' => 'TestController@fooIndex', 'as' => 'name']);

Route::get('bar', 'TestController@barIndex');

Route::get('bax', 'TestController@baxIndex');

Route::get('baz', 'TestController@bazIndex');

Route::get('bazuka', 'TestController@bazukaIndex');

Route::any('foom', function () {
    return 'Hello Foomar!';
});

Route::match(['get', 'post'], '/foobar', function () {
    return 'Hello FooBar!';
});

Auth::routes();
  
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
