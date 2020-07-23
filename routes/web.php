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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('CheckRole');
Route::get('/admin', 'HomeController@admin')->name('admin');
Route::get('/show/{id}', 'UsersController@show')->name('show');
Route::get('/edit/{id}', 'UsersController@edit')->name('edit');
