require('./bootstrap');
window.Vue = require('vue');
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

url = "http://127.0.0.1:8000/";

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