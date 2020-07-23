<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->get('/users', 'UsersController@index');
Route::middleware('auth:api')->get('/user/{id}', 'UsersController@view');
Route::middleware('auth:api')->post('/user/{id}/delete', 'UsersController@destroy');
Route::middleware('auth:api')->post('/user/search', 'UsersController@search');
Route::middleware('auth:api')->post('/user/{id}/update', 'UsersController@update');