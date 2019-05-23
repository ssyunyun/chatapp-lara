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

        $hashedPassword = hash('sha256',$password);
 
        //アカウント登録
        try {
            \App\Userinfo::create([
                'username' => $userName,
                'password' => $hashedPassword,
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
        
        $hashedPassword = hash('sha256',$password);

        //入力したユーザ名の情報をDBから取ってくる
        $data = \App\Userinfo::where('username', $userName)
            ->where('password', $hashedPassword)
            ->get();

        return $data;
    }


    /*========== DBからユーザー情報取得 ==========*/
    public function getInfo(Request $request) {

        $userId = $_GET["Id"];
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

        $hashedPassword = hash('sha256',$password);
        $hashedPassNew= hash('sha256',$passNew);
        $regPass = \App\Userinfo::where('id', $userId)->get('password');

        //return $regPass;
        if($regPass[0]->password == $hashedPassword){
            //パスワードの更新
            \App\Userinfo::where('id', $userId)->update(['password' => $hashedPassNew]);
            //'updated_at'の更新
            \App\Userinfo::where('id', $userId)->update(['updated_at' => $time]);
            return 1;
        } else {
            return 0;
        }
    }
}



