<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Events\CommentCreated;

class ChatController extends Controller
{

    public function create(Request $request) { // メッセージを登録

        \App\Talkinfo::create([
            'comment' => $request->comment,
            'groupid' => $request->groupId,
            'userid' => $request->userId,
            'username' => $request->userName,
        ]);

        event (new CommentCreated($request->groupId));
    }

    public function getComments() {// 選択したグループのトーク情報を取得

        $id = $_GET["Id"];

        $data = \App\Talkinfo::where('userid', $id)->get();
        return $data;
    }

}
