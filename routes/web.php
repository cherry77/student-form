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

Route::any('student/index',['uses' => 'StudentsController@index']);
Route::any('student/create',['uses' => 'StudentsController@create']);
Route::any('student/save',['uses' => 'StudentsController@save']);
Route::any('student/edit/{sid}',['uses' => 'StudentsController@edit']);
Route::any('student/detail/{sid}',['uses' => 'StudentsController@detail']);
Route::any('student/delete/{sid}',['uses' => 'StudentsController@delete']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
