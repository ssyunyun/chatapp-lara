<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /*========== ユーザアカウント作成処理 ==========*/
    public function create(Request $request) {

        //bodyから情報を取得
        $body = $request->all();

        $userName = $body['userName'];
        $password = $body['password'];
        $time = Carbon::now();
 
        //アカウント登録
        try {
            \App\Userinfo::create([
                'username' => $request->userName,
                'password' => $request->password,
                'created_at' => $time,
                'updated_at' => $time,
            ]);
        } catch (Exception $e) { //ユーザー名はユニークであるため、被った場合はエラー
            return 0;
        }
        
        //ユーザー情報を返す
        $data = \App\Userinfo::where('username', $userName)->get();
        return $data;
    }

    /*========== ログイン処理 ==========*/
    public function login(Request $request) {

        //bodyから情報を取得
        $body = $request->all();

        $userName = $body['userName'];
        $password = $body['password'];
        $time = Carbon::now();

        //入力したユーザ名の情報をDBから取ってくる
        $data = \App\Userinfo::where('username', $userName)
            ->where('password', $password)
            ->get();

        return $data;
    }


    /*========== DBからユーザー情報取得 ==========*/
    public function getInfo(Request $request) {

        $body = $request->all();
        $userId = $body['userId'];

        $data = \App\Userinfo::where('id', $userId)->get();
        
        return $data;
    }

    
    /*========== パスワード変更処理 ==========*/
    public function changePass(Request $request) {

        //bodyから情報を取得
        $body = $request->all();

        $userId = $body['userId'];
        $password = $body['password'];
        $passNew = $body['passNew'];
        $time = Carbon::now();


        $regPass = \App\Userinfo::where('id', $userId)->get('password');    

        //return $regPass;
        if($regPass[0]->password == $password){
            //パスワードの更新
            \App\Userinfo::where('id', $userId)->update(['password' => $passNew]);
            //アップデート時間の更新
            \App\Userinfo::where('id', $userId)->update(['updated_at' => $time]);

            return 1;

        } else {
            return 0;
        }
    }
}



