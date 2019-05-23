<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class SessionController extends Controller
{

    public function startSession($userId, $token) {
        //login時にセッション情報を作成or更新
        $time = Carbon::now();

        $check = \App\Session::where('key', $userId)->get();
       
        if(count($check)==1){//セッション情報があったらupdate
            
            \App\Session::where('key', $userId)->update(['lastvisit' => $time]);
            \App\Session::where('key', $userId)->update(['token' => $token]);

            

        } else {//セッション情報が無かったらinsert
         
            \App\Session::create([
                'key' => $userId,
                'token' => $token,
                'lastvisit' => $time,
            ]);    
        }

        $updateInfo = \App\Session::where('key', $userId)->get();
        return $updateInfo;
    }
    
    public function updateVisitTime($userId) {
        //操作するたび更新する
        $time = Carbon::now();

        \App\Session::where('key', $userId)->update(['lastvisit' => $time]);
        
        $updateInfo = \App\Session::where('key', $userId)->get();
        return $updateInfo;
    }

    public function checkSession($userId, $token) {
        //アクセスが来た時にセッション情報を確認
        $time = Carbon::now();
        $sessionInfo = \App\Session::where('key', $userId)->get();
        $checkTime = $sessionInfo[0]->lastvisit;
        $checkToken = $sessionInfo[0]->token;
        if ($checkToken!=$token) {
            return 0;    
        }
        
        $diffTime = $time->diffInMinutes($checkTime);
        
        //最終アクセス日時との差が1時間以内であるかを判定
        if($diffTime <= 60){
            return 1;
        } else {
            return 0;
        }
    }

    public function deleteSession($userId) {
        //logout時にセッション情報を消す
        $time = Carbon::now();
        
        //削除する情報を取得しておく
        $updateInfo = \App\Session::where('key', $userId)->get();
        //Delete
        \App\Session::where('key', $userId)->delete();

        return $updateInfo;
    }

}
