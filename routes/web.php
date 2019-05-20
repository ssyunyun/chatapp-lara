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
    return view('test');
});



/* ChsController */
Route::get('/chs', 'ChsController@index');
Route::get('/menu', 'ChsController@menu');
Route::get('/chs/menu/mypage', 'ChsController@mypage');
Route::get('/chs/menu/setting', 'ChsController@setting');

Route::get('/chs/menu/chat', 'ChsController@chat');

Route::group(['middleware'=>['api']], function () {
    Route::post('/chs/create', 'ChsController@create');
    Route::post('/chs/login', 'ChsController@login');
    Route::post('/chs/menu_db', 'ChsController@databaseInfo');
    Route::post('/chs/menu/chat_db', 'ChatController@create'); // チャット登録
    Route::post('/chs/menu/setting/newGroup', 'ChsController@newGroup'); // グループ作成
    Route::post('/chs/menu/setting/invite', 'ChsController@invite'); // グループ作成
    //Route::post('/chs/menu/chatInfo', 'ChatController@getTalk');
});


/* ChatController */
Route::get('/chs/menu/chat_db', 'ChatController@index'); // メッセージ一覧を取得
Route::get('/chs/menu/chatInfo', 'ChatController@getTalk');






/*
Route::post('/chs/create', function(Request $request) {
    echo '<pre>' . 'aaaaaa' . '</pre>';
    return view('chs/index');
});
*/




