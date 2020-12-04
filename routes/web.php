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
    return view('home');
});

Route::get('/login', 'AuthController@login')->name('login');
Route::post('/postlogin', 'AuthController@postlogin');
Route::get('/logout', 'AuthController@logout');

Route::group(['middleware' => ['auth','checkRole:admin']], function(){
	Route::get('/students', 'StudentsController@index');
	Route::post('/students/create', 'StudentsController@create');
	Route::get('/students/{id}/edit', 'StudentsController@edit');
	Route::post('/students/{id}/update', 'StudentsController@update');
	Route::get('/students/{id}/delete', 'StudentsController@destroy');
	Route::get('/students/{id}/profile', 'StudentsController@profile');
	Route::post('/students/{id}/addnilai', 'StudentsController@addnilai');
	Route::get('/students/{id}/{idmakul}/deletenilai', 'StudentsController@deletenilai');
	Route::get('/students/exportExcel', 'StudentsController@exportExcel');
	Route::get('/students/exportPdf', 'StudentsController@exportPdf');
	Route::get('/teachers/{id}/profile', 'TeachersController@profile');

});

Route::group(['middleware' => ['auth','checkRole:admin,students']], function(){
	Route::get('/dashboard', 'DashboardController@index');
});