require('./bootstrap');
window.Vue = require('vue');
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

url = "https://chatapp-lara.herokuapp.com/";
var userId = localStorage.getItem("userId");

//ログアウトしていない場合はログイン画面を飛ばす
if(userId != '') location.href = url + "chs/menu/";


const app = new Vue({
  el: "#app", // Vue.jsを使うタグのIDを指定
  data: {
      // Vue.jsで使う変数はここに記述する
      mode: "login",
      submitText: "ログイン",
      toggleText: "新規登録",
      user:{
          userName: null,
          password: null,
          passAgain: null
      },
  },
  methods: {
      // Vue.jsで使う関数はここで記述する
      toggleMode: function() {
          if (app.mode == "login") {
              app.mode = "signup";
              app.submitText = "新規登録";
              app.toggleText = "ログイン";
          } else if (app.mode == "signup") {
              app.mode = "login";
              app.submitText = "ログイン";
              app.toggleText = "新規登録";
          }
      },

      submit: function() {
          if (app.mode == "login") {
            /* ============ ログイン処理 ============ */
            console.log("login処理");

                fetch(url + "api/chs/login", {
                  method: "POST",
                  headers: {
                      'Content-Type':'application/json'
                  },
                  body: JSON.stringify({
                      "userName": app.user.userName,
                      "password": app.user.password
                  })
              })
                  .then(function(response) {
                      console.log(response);
                      if (response.status == 200) {
                          return response.json();
                      }
                      // 200番以外のレスポンスはエラーを投げる
                      return response.json().then(function(json) {
                          throw new Error(json.message);
                      });
                  })
                  .then(function(json) {
                      // レスポンスが200番で返ってきたときの処理はここに記述する
                      var content = JSON.stringify(json, null, 2);
                      //console.log(content);

                      if(content != '0'){                   
                        localStorage.setItem('userId', json[0]['id']); 
                        localStorage.setItem('userName', app.user.userName);         
                        location.href = url + "chs/menu/";
                      }
                    })
                  .catch(function(err) {
                      // レスポンスがエラーで返ってきたときの処理はここに記述する
                  });

            /* ============ アカウント作成処理 ============ */
          } else if (app.mode == "signup") {
            console.log("アカウント作成処理");

              //パスワード不一致の処理
              if(app.user.password != app.user.passAgain) {
                alert('パスワードに誤りがあります。');
              } else if (app.user.password.length < 4 || app.user.password.length > 16){
                alert('パスワードは4文字以上、16文字以下で入力してください。');
              } 
              else  //パスワードが一致していたらアカウント作成のリクエストを送る
              {
                // APIにPOSTリクエストを送る
                fetch(url + "api/chs/create", {
                    method: "POST",
                    headers: {
                        'Content-Type':'application/json',
                    },
                    body: JSON.stringify({
                        "userName": app.user.userName,
                        "password": app.user.password
                    })
                })
                    .then(function(response) {
                        console.log(response);
                        if (response.status == 200) {
                            return response.json();
                        }
                        // 200番以外のレスポンスはエラーを投げる
                        return response.json().then(function(json) {
                            throw new Error(json.message);
                        });
                    })
                    .then(function(json) {
                        // レスポンスが200番で返ってきたときの処理はここに記述する
                        //console.log("200が返ってきたよ");
                        var content = JSON.stringify(json, null, 2);
                        console.log(content);//returnした内容表示できる
                   
                        if(content != '0'){
                            //localStorage.setItem('token', json.token);
                            localStorage.setItem('userId', json[0]['id']);
                            localStorage.setItem('userName', app.user.userName);         
                            location.href=url + "chs/menu/";
                        } else {
                            alert("そのユーザー名は既に使われています");
                        }
                    })
                    .catch(function(err) {
                        // レスポンスがエラーで返ってきたときの処理はここに記述する
                        console.log("エラーが返ってきたよ");
                    });
                }
          }
      }
  },

  created: function() {
      // Vue.jsの読み込みが完了したときに実行する処理はここに記述する
  },
  computed: {//passwordの長さを調べる
  },

});
