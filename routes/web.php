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
//单请求路由
Route::get('/', function () {
    return view('welcome');
});



Route::group(['middleware', ['web']], function () {
	Route::get('student/index', ['uses' => 'StudentController@index']);
	Route::any('student/create', ['uses' => 'StudentController@create']);
	Route::any('student/save', ['uses' => 'StudentController@save']);
	Route::any('student/update/{id}', ['uses' => 'StudentController@update']);
	Route::any('student/detail/{id}', ['uses' => 'StudentController@detail']);
	Route::any('student/delete/{id}', ['uses' => 'StudentController@delete']);
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::any('upload', 'StudentController@upload')->name('upload');
Route::any('cache1', 'StudentController@cache1')->name('cache1');
Route::any('cache2', 'StudentController@cache2')->name('cache2');
Route::any('error', 'StudentController@error')->name('error');
Route::any('mail', 'StudentController@mail')->name('mail');
Route::any('queue', 'StudentController@queue')->name('queue');
