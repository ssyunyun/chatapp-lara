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

Route::group(['middleware' => ['api']], function(){
    

    Route::post('/create', 'UserController@create');
    Route::post('/login', 'UserController@login');


    /* SessionController */
    Route::group(['middleware' => ['check.session', 'update.session']], function(){
        Route::get('/getInfo', 'UserController@getInfo');
        Route::get('/getComments', 'ChatController@getComments');// メッセージ一覧を取得

        Route::patch('/changePass', 'UserController@changePass');
        Route::post('/createGroup', 'GroupController@createGroup');
        Route::post('/inviteGroup', 'GroupController@inviteGroup');
        Route::post('/chat', 'ChatController@create');
       
    });

});