<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Events\CommentCreated;

//Chat用コントローラ
class ChatController extends Controller
{
    
    public function index() {// 新着順にメッセージ一覧を取得

        //$id = $_GET["Id"];
        //return \App\Talkinfos::where('groupid',$Id)->get();
    
    }
    
    public function create(Request $request) { // メッセージを登録

        $data = \App\Talkinfo::create([
            'comment' => $request->comment,
            'groupid' => $request->groupId,
            'userid' => $request->userId,
            'username' => $request->userName,
        ]);

        //event (new CommentCreated($data));
        event (new CommentCreated($request->groupId));
    }


    public function getTalk() {// 選択したグループのトーク情報を取得

        $id = $_GET["Id"];

        //bodyから情報を取得
        //$body = $request->all();
        //$groupId = $body['groupId'];

        //return \App\Talkinfos::where('groups_id', $groupId)->get();

        $pdo = DB::connection('pgsql');
        
        $getTalk = $pdo->select("select * from talkinfos where groupid = '$id'");
        $getUserName = $pdo->select("select * from talkinfos where id = '$id'");

        
        return $getTalk;



    }


}
