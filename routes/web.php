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

/* View */
Route::get('/login', function (){
    return view('login');
});
Route::get('/menu', function (){
    return view('menu');
});
Route::get('/mypage', function (){
    return view('mypage');
});
Route::get('/setting', function (){
    return view('setting');
});
Route::get('/chat', function (){
    return view('chat');
});
