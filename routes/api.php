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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::middleware('api')->post('/chs/create', 'ChsController@create');
Route::middleware('api')->post('/chs/login', 'ChsController@login');
Route::middleware('api')->post('/chs/menu_db', 'ChsController@databaseInfo');
//Route::middleware('api')->post('/chs/menu/chat', 'ChsController@chat');
Route::middleware('api')->post('/chs/menu/chat_db', 'ChatController@create');
Route::middleware('api')->post('/chs/menu/mypage/changePass', 'ChsController@change');
Route::middleware('api')->post('/chs/menu/setting/newGroup', 'ChsController@newGroup');
Route::middleware('api')->post('/chs/menu/setting/invite', 'ChsController@invite');

//Route::middleware('api')->post('/chs/menu/chatInfo', 'ChatController@getTalk');




