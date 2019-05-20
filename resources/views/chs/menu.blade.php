<!DOCTYPE html>
<html>
  <head>
    <!--<link rel="stylesheet" href="{{ asset('css/style.css')}}">--> 
    <!--<script src ="js/jquery.min.js"></script>-->
    <!--<script src="https://unpkg.com/vue/dist/vue.js"></script>-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    
    <meta name="viewport" content="width=device-width">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Main Menu</title>
  </head>

  <body>
    <div class="ui text container" id = "menu">
      <button class="ui green button" v-on:click="selectMypage">マイページ</button>
      <button class="ui green button" v-on:click="selectSetting">設定</button>

      <h1 class="ui dividing header">Main Menu</h1><br>
      <form class="ui form">
        <div class="field"><br>
          <h2>グループ検索</h2>
          <div class="field">
            <input type="text" name="group-name" placeholder="検索...">
          </div>
        </div>
      </form>

      <h2>グループ一覧</h2>

      <div class="ui list" v-for="(list, i) in groups">
        <button class="ui large fluid button" v-on:click="selectGroup(i)">
        @{{ list }}
        </button>
      </div>
    </div>

  
  </body>
        
</html>





<script>

require('./bootstrap');
window.Vue = require('vue');
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

url = "https://chatapp-lara.herokuapp.com/";

var val = localStorage.getItem("userId");
console.log("id = " + val);

const menu = new Vue({
  el: "#menu", // Vue.jsを使うタグのIDを指定
  data: {
      // Vue.jsで使う変数はここに記述する
      userId: val,
      groups: [],
      groupIds: []

  },
  methods: {
      // Vue.jsで使う関数はここで記述する
      window:onload = function() {

            /* ============ データベースからグループ情報を取得する ============ */
                fetch(url + "api/chs/menu_db", {
                  method: "POST",
                  headers: {
                      'Content-Type':'application/json'
                  },
                  body: JSON.stringify({
                      "userId": menu.userId
                  })
              })
                  .then(function(response) {
                      console.log("response受け取ったよ");
                      console.log(response);
                      if (response.status == 200) {
                          return response.json();
                      }
                      // 200番以外のレスポンスはエラーを投げる
                      return response.json().then(function(json) {
                        console.log("200以外だよ");
                          throw new Error(json.message);
                      });
                  })
                  .then(function(json) {
                      // レスポンスが200番で返ってきたときの処理はここに記述する
                      console.log("200返ってきたよ");
                      var content = JSON.stringify(json, null, 2);            
                      var group = json[0]['groups'];
                      var group_id = json[0]['groups_id'];
         
                      //連結した文字列をセパレートする
                      group_split = separateString(group);
                      group_id_split = separateString(group_id);
                      
                      menu.groups = group_split;
                      menu.groupIds = group_id_split;

                    })
                  .catch(function(err) {
                      // レスポンスがエラーで返ってきたときの処理はここに記述する
                      console.log("エラーだよ");
                  });

      },

    selectGroup: function(id) {
        //グループ選択したときの処理を書く

        console.log(id);//配列の番号

        var groupId = menu.groupIds[id];//配列の番号に対応するグループ固有のIDを取得
        var groupName = menu.groups[id];//配列の番号に対応するグループ名を取得
        
        console.log(groupName);
        localStorage.setItem('groupId', groupId);
        localStorage.setItem('groupName', groupName);
        location.href=url + "chs/menu/chat";



        /*
        fetch(url + "api/chs/menu/chatInfo", {
            method: "POST",
            headers: {
                'Content-Type':'application/json'
            },
            body: JSON.stringify({
                "groupId": groupId
            })
        })
            .then(function(response) {
                console.log("response受け取ったよ");
                //console.log(response);
                if (response.status == 200) {
                    return response.json();
                }
                // 200番以外のレスポンスはエラーを投げる
                return response.json().then(function(json) {
                  console.log("200以外だよ");
                    throw new Error(json.message);
                });
            })
            .then(function(json) {
                // レスポンスが200番で返ってきたときの処理はここに記述する
                console.log("200返ってきたよ");
                var content = JSON.stringify(json, null, 2);
                console.log(content);//returnした内容表示できる            
   
                //location.href=url + "chs/menu/chat";
              })
            .catch(function(err) {
                // レスポンスがエラーで返ってきたときの処理はここに記述する
                console.log("エラーだよ");
            });
            */
    },

    
    selectMypage: function() {
        
        console.log("selectMypage処理");
        //マイページを選択したときの処理を書く
        fetch(url + "api/chs/menu_db", {
            method: "POST",
            headers: {
                'Content-Type':'application/json'
            },
            body: JSON.stringify({
                "userId": menu.userId
            })
        })
            .then(function(response) {
                console.log("response受け取ったよ");
                console.log(response);
                if (response.status == 200) {
                    return response.json();
                }
                // 200番以外のレスポンスはエラーを投げる
                return response.json().then(function(json) {
                  console.log("200以外だよ");
                    throw new Error(json.message);
                });
            })
            .then(function(json) {
                // レスポンスが200番で返ってきたときの処理はここに記述する
                console.log("200返ってきたよ");
                var content = JSON.stringify(json, null, 2);
                console.log(content);//returnした内容表示できる            
   
                localStorage.setItem('userName', json[0]['name']);
                localStorage.setItem('userPassword', json[0]['password']);
                localStorage.setItem('userIcon', json[0]['icon']);
                location.href=url + "chs/menu/mypage";
              })
            .catch(function(err) {
                // レスポンスがエラーで返ってきたときの処理はここに記述する
                console.log("エラーだよ");
            });
    },

    selectSetting: function() {
        //設定を選択したときの処理を書く
        console.log("selectSetting処理");
        location.href=url + "chs/menu/setting";
    },




  },

});

function separateString(contents) {
    contents_sp = contents.split(",");
    return contents_sp;
  }




  </script>