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

/* UserController */
Route::middleware('api')->post('/create', 'UserController@create');
Route::middleware('api')->post('/login', 'UserController@login');
//Route::middleware('api')->post('/getInfo', 'UserController@getInfo');
//Route::middleware('api')->post('/changePass', 'UserController@changePass');
Route::middleware('api')->patch('/changePass', 'UserController@changePass');

/* GroupController */
Route::middleware('api')->post('/createGroup', 'GroupController@createGroup');
Route::middleware('api')->post('/inviteGroup', 'GroupController@inviteGroup');

/* ChatController */
Route::middleware('api')->post('/chat', 'ChatController@create');