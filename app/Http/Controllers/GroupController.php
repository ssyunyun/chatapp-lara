<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    /*========== 新規グループ作成処理 ==========*/
    public function createGroup(Request $request) {

        //bodyから情報を取得
        $body = $request->all();
        $groupName = $body['groupName'];
        $groupComment = $body['groupComment'];
        $Id_seq = $body['Id_seq'];//連続したID: (e.g. "1,3,4,6")
        $Id_split = $body['Id_split'];//分けたID: (e.g. [1],[3],[4],[6])
        $num = count($Id_split);//追加するユーザー数:num
        $time = Carbon::now();


        //登録したいユーザーIDを全て調べ、１つでも存在しないIDがあったら0を返す
        for ($i = 0; $i < $num; $i++) {
            $check = \App\Userinfo::where('id', $Id_split[$i])->get();
            if(count($check)==0) return 0;
        }

        //全てのユーザーが存在していたら、グループを作成する
        \App\Groupinfo::create([
            'groupname' => $groupName,
            'comment' => $groupComment,
            'userid' => $Id_seq,
            'created_at' => $time,
            'updated_at' => $time,
        ]);
       
        //作成したグループのidを取得する
        $maxId = \App\Groupinfo::max('id');

        //グループ作成後、各ユーザーにも所属グループの追加を行う
        for ($i = 0; $i < $num; $i++) {
            //ユーザーの所属するグループ情報"groupid""groupname"を取得
            $GroupIds = \App\Userinfo::where('id', $Id_split[$i])->get('groupid');//DBに登録済みのグループID情報
            $GroupNames = \App\Userinfo::where('id', $Id_split[$i])->get('groupname');//DBに登録済みのグループ名情報

            //招待されたグループの情報を"groupid""groupname"に追加
            $NewIds = $this->addInformation ($GroupIds, $maxId, 'groupid');
            $NewNames = $this->addInformation ($GroupNames, $groupName, 'groupname');

            //DB更新
            \App\Userinfo::where('id', $Id_split[$i])->update(['groupid' => $NewIds]);
            \App\Userinfo::where('id', $Id_split[$i])->update(['groupname' => $NewNames]);
        }
        return 1;
    }
    
    /*========== ユーザー招待処理 ==========*/
    public function inviteGroup(Request $request) {

        //bodyから情報を取得
        $body = $request->all();
        $invitedGroupId = $body['invitedGroupId'];
        $Id_split = $body['Id_split'];
        $Id_seq = $body['Id_seq'];
        $pdo = DB::connection('pgsql');
        $time = Carbon::now();
        $num = count($Id_split);//招待するユーザー数:num

        //登録したいユーザーIDを全て調べ、１つでも存在しないIDがあったら0を返す
        for ($i = 0; $i < $num; $i++) {
            $check = \App\Userinfo::where('id', $Id_split[$i])->get();
            if(count($check)==0) return 0;
        }
        
        //入力したグループが存在するかチェック
        $checkGroup = \App\Groupinfo::where('id', $invitedGroupId)->get();
        if(count($checkGroup) == 0) return 0; 
        
    
        //*-----グループテーブルの更新-----*//
        //グループの"userid"を取得
        $GroupUserIds = \App\Groupinfo::where('id', $invitedGroupId)->get('userid');
        //取得した"userid"に、ユーザー情報を追加する
        $NewGroupUserIds = $this->addInformation ($GroupUserIds, $Id_seq, 'userid');
        //"userid"を更新する
        \App\Groupinfo::where('id', $invitedGroupId)->update(['userid' => $NewGroupUserIds]);


        //*-----ユーザーテーブルの更新-----*//
        //招待するグループ名を取得
        $groupName_arr = \App\Groupinfo::where('id', $invitedGroupId)->get('groupname');
        $groupName = $groupName_arr[0]['groupname'];

        for ($i = 0; $i < $num; $i++) {
            //ユーザーの所属するグループ情報"groupid""groupname"を取得
            $GroupIds = \App\Userinfo::where('id', $Id_split[$i])->get('groupid');//DBに登録済みのグループID情報
            $GroupNames = \App\Userinfo::where('id', $Id_split[$i])->get('groupname');//DBに登録済みのグループ名情報

            //招待されたグループの情報を"groupid""groupname"に追加
            $NewIds = $this->addInformation ($GroupIds, $invitedGroupId, 'groupid');
            $NewNames = $this->addInformation ($GroupNames, $groupName, 'groupname');

            //DB更新
            \App\Userinfo::where('id', $Id_split[$i])->update(['groupid' => $NewIds]);
            \App\Userinfo::where('id', $Id_split[$i])->update(['groupname' => $NewNames]);           
        }
        return 1;
    }

    //文字列を連結させて情報を追加する関数
    function addInformation ($content, $addedStr, $column){
        //新しいグループ情報を文字列で連結させる
        if ($content[0][$column]==null){//指定のカラムがnullの時
            $NewContent = $addedStr;
        } else {
            $NewContent = $content[0][$column].",".$addedStr;
       }
        return $NewContent;      
    }

}
