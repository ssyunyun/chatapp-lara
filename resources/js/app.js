require('./bootstrap');
window.Vue = require('vue');
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

//url = "http://127.0.0.1:8000/";

const app = new Vue({
    el: "#app",
    data: {
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
        //ログインと新規登録のモード変更
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
                fetch(url + "api/login", {
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
                    throw new Error();
                })
                .then(function(json) {
                    // レスポンスが200番で返ってきたときの処理はここに記述する
                    var content = JSON.stringify(json, null, 2);
                    console.log(content);//returnした内容表示できる

                    //ユーザデータを受け取れていない場合は.catchの処理へ
                    localStorage.setItem('userId', json[0][0]['id']);
                    localStorage.setItem('userName', json[0][0]['username']);
                    localStorage.setItem('token', json[1]);       
                    location.href = url + "menu";
                })
                .catch(function(err) {
                    alert("入力内容に誤りがあります");
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
                    fetch(url + "api/create", {
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
                        throw new Error();
                    })
                    .then(function(json) {
                        // レスポンスが200番で返ってきたときの処理はここに記述する
                        var content = JSON.stringify(json, null, 2);
                        console.log(content);//returnした内容表示できる
                    
                        //localStorage.setItem('token', json.token);
                        localStorage.setItem('userId', json[0][0]['id']);
                        localStorage.setItem('userName', json[0][0]['username']);
                        localStorage.setItem('token', json[1]);         
                        location.href=url + "menu";
                    })
                    .catch(function(err) {
                        alert("このユーザー名は既に使われています");
                    });
                }//else閉じ
            }//else if閉じ
        }//submit閉じ
    },//method閉じ
});
