<?php

   namespace App\Http\Controllers;
   //use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Controller;

   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\DB;
   use Carbon\Carbon;
   //use Response; // ←追加
   //use Input; // ←追加
 
/*
   use App\Model\User;
   use App\Model\Talk;
   use App\Model\Group;
*/

   class ChsController extends Controller
   {
       /*========== Indexページの表示 ==========*/
       public function index() {
          return view('chs.index'); 
       }

       /*========== Menuページの表示 ==========*/
       public function menu() {
          return view('chs.menu'); 
       }

       /*========== Mypageページの表示 ==========*/
       public function mypage() {
       return view('chs.mypage'); 
       }

       /*========== Settingページの表示 ==========*/
       public function setting() {
       return view('chs.setting'); 
       }

       /*========== Chatページの表示 ==========*/
       public function chat() {
       return view('chat.chat'); 
       }

    
      


       /*========== ユーザアカウント作成処理 ==========*/
       public function create(Request $request) {

        //bodyから情報を取得
        $body = $request->all();

        $userName = $body['userName'];
        $password = $body['password'];

        $time = Carbon::now();
        $pdo = DB::connection('pgsql');


        //入力したユーザ名が既に存在しているか確認し、無かったらデータ書き込み
        $check = $pdo->select("select * from userinfos where name = '$userName'");
        
        if(empty($check)) {
            $pdo->insert("insert into userinfos (name, password, created_at, updated_at) values ('$userName', '$password', '$time', '$time')");
            $id = $pdo->select("select id from userinfos where name = '$userName'");

            return $id;
        } 
        else {
            return 0;
        };

       }

       /*========== ログイン処理 ==========*/
        public function login(Request $request) {

            //bodyから情報を取得
            $body = $request->all();

            $userName = $body['userName'];
            $password = $body['password'];

            $pdo = DB::connection('pgsql');
            //return 10;

            //入力したユーザ名の情報をDBから取ってくる
            $check = $pdo->select("select * from userinfos where name = '$userName' and password = '$password'");
            $id = $pdo->select("select id from userinfos where name = '$userName'");


            //トークンでセッション管理に変更予定
            if(count($check) == 1)
            {
                return $id;
            } else {
                return 0;
            }
        }


       /*========== DBからデータ取得 ==========*/
       public function databaseInfo(Request $request) {

            $body = $request->all();
            $userId = $body['userId'];

            $pdo = DB::connection('pgsql');
            $getInfo = $pdo->select("select * from userinfos where id = '$userId'");
            
            return $getInfo;
     } 

     
        /*========== パスワード変更処理 ==========*/
        public function change(Request $request) {

            //bodyから情報を取得
            $body = $request->all();

            $userId = $body['userId'];
            $password = $body['password'];
            $passNew = $body['passNew'];

            //return $userId;

            $pdo = DB::connection('pgsql');

            //ユーザーIDを参照し、登録されてるパスワードをDBから取ってくる
            $regPass = $pdo->select("select password from userinfos where id = '$userId'");
            
            //return $regPass;
            //DBに登録されたパスワードと、入力したパスワードが一致したらパスワード変更
            if($regPass[0]->password == $password){
                $pdo->select("update userinfos set password = '$passNew' where id = '$userId'");
                return 1;
            } else if ($regPass[0]->password != $password){
                return 0;
            }

        }



        /*========== 新規グループ作成処理 ==========*/
        public function newGroup(Request $request) {

            //bodyから情報を取得
            $body = $request->all();

            $groupName = $body['groupName'];
            $groupComment = $body['groupComment'];
            $Id_split = $body['Id_split'];
            $Id_seq = $body['Id_seq'];

            //return $body;

            //追加するユーザー数:num
            $num = count($Id_split);

            $pdo = DB::connection('pgsql');
            $time = Carbon::now();

            //登録したいユーザーIDを全て調べ、１つでも存在しないIDがあったら0を返す
            for ($i = 0; $i < $num; $i++) {
                $check = $pdo->select("select * from userinfos where id = '$Id_split[$i]'");
                if(empty($check)) {
                    return 0;
                }
            }
            //全てのユーザーが存在していたら、グループを作成する
            $pdo->insert("insert into groupinfos (name, comment, userid, created_at, updated_at) values ('$groupName', '$groupComment', '$Id_seq', '$time', '$time')");
            
            //作成したグループのidを取得する
            $maxId_arr = $pdo->select("select max(id) from groupinfos");
            $maxId = $maxId_arr[0]->max;

            //グループ作成後、各ユーザーにも所属グループの追加を行う
            for ($i = 0; $i < $num; $i++) {
                $GroupIds = $pdo->select("select groups_id from userinfos where id = '$Id_split[$i]'");
                $GroupNames = $pdo->select("select groups from userinfos where id = '$Id_split[$i]'");
                //return $GroupIds;
                //新しいグループ情報を文字列で連結させる
                if (empty($GroupIds[0]->groups_id)){//指定のユーザーがまだどのグループにも所属していない場合
                    $NewIds = $maxId;
                    $NewNames = $groupName;    
                } else {
                    $NewIds = $GroupIds[0]->groups_id.",".$maxId;
                    $NewNames = $GroupNames[0]->groups.",".$groupName;
                }
                
                $pdo->insert("update userinfos set groups_id = '$NewIds' where id = '$Id_split[$i]'");
                $pdo->insert("update userinfos set groups = '$NewNames' where id = '$Id_split[$i]'");

            }
            return 1;
        }
        



        /*========== ユーザー招待処理 ==========*/
        public function invite(Request $request) {

            //bodyから情報を取得
            $body = $request->all();

            $invitedGroupId = $body['invitedGroupId'];
            $Id_split = $body['Id_split'];
            $Id_seq = $body['Id_seq'];

            $pdo = DB::connection('pgsql');
            $time = Carbon::now();

            //招待するユーザー数:num
            $num = count($Id_split);

            //登録したいユーザーIDを全て調べ、１つでも存在しないIDがあったら0を返す
            for ($i = 0; $i < $num; $i++) {
                $check = $pdo->select("select * from userinfos where id = '$Id_split[$i]'");
                if(empty($check)) {
                    return 0;
                }
            }
            //入力したグループが存在するかチェック
            $checkGroup = $pdo->select("select * from groupinfos where id = '$invitedGroupId'");
            if(empty($checkGroup)) return 0; 

            //*-----グループテーブルの更新-----*//
            //グループの"userid"を取得
            $GroupUserIds = $pdo->select("select userid from groupinfos where id = '$invitedGroupId'");
            //取得した"userid"に、ユーザー情報を追加する
            $NewGroupUserIds = $GroupUserIds[0]->userid.",".$Id_seq;
            //"userid"を更新する
            $pdo->insert("update groupinfos set userid = '$NewGroupUserIds' where id = '$invitedGroupId'");
            
            //*-----ユーザーテーブルの更新-----*//
            //招待するグループ名を取得
            $groupName_arr = $pdo->select("select name from groupinfos where id = '$invitedGroupId'");
            $groupName = $groupName_arr[0]->name;

            for ($i = 0; $i < $num; $i++) {
                //ユーザーの所属するグループ情報"groups_id"を取得
                $GroupIds = $pdo->select("select groups_id from userinfos where id = '$Id_split[$i]'");
                $GroupNames = $pdo->select("select groups from userinfos where id = '$Id_split[$i]'");

                //招待されたグループの情報を"groups_id"に追加
                if (empty($GroupIds[0]->groups_id)){//指定のユーザーがまだどのグループにも所属していない場合
                    $NewIds = $invitedGroupId;
                    $NewNames = $groupName;
                } else {
                    $NewIds = $GroupIds[0]->groups_id.",".$invitedGroupId;
                    $NewNames = $GroupNames[0]->groups.",".$groupName;

                }              
                $pdo->insert("update userinfos set groups_id = '$NewIds' where id = '$Id_split[$i]'");
                $pdo->insert("update userinfos set groups = '$NewNames' where id = '$Id_split[$i]'");

            }
            return 1;
        }

   }