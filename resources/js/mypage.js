require('./bootstrap');
window.Vue = require('vue');
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

url = "http://127.0.0.1:8000/";

var userId = localStorage.getItem("userId");
var userName = localStorage.getItem("userName");
console.log(userId);
console.log(userName);

const mypage = new Vue({
  el: "#mypage", // Vue.jsを使うタグのIDを指定
  data: {
      // Vue.jsで使う変数はここに記述する
      userId: userId,
      userName: userName,
      password: null,
      passNew: null,
      passNewAgain: null
  },
  methods: {

    submit: function() {
        /* ============ パスワード変更処理 ============ */
        console.log("パスワード変更処理");
        
        //パスワード不一致の処理
        if(mypage.passNew != mypage.passNewAgain) {
            alert('新規のパスワードに誤りがあります。');
        } else if (mypage.passNew.length < 4 || mypage.passNew.length > 16){
            alert('パスワードは4文字以上、16文字以下で入力してください。');
        } 
        else //新規のパスワードが問題なければ、既存のパスワードが正しいかチェックして変更する
        {
            // APIにPOSTリクエストを送る
            fetch(url + "api/chs/menu/mypage/changePass", {
                method: "POST",
                headers: {
                    'Content-Type':'application/json',
                },
                body: JSON.stringify({
                    "userId": mypage.userId,
                    "password": mypage.password,
                    "passNew": mypage.passNew
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
                
                    if(content != '0'){
                        alert("パスワードを変更しました。");
                        mypage.password = '';
                        mypage.passNew = '';
                        mypage.passNewAgain = '';
                    } else {
                        alert("登録済みのパスワードが違います。");
                    }
                })
                .catch(function(err) {
                    // レスポンスがエラーで返ってきたときの処理はここに記述する
                    console.log("エラーが返ってきたよ");
                });
            }
        },//submit終了

        logout: function() {
            localStorage.setItem('userId', '');
            localStorage.setItem('userPassword', '');
            localStorage.setItem('userIcon', '');
            localStorage.setItem('groupId', '');
            location.href=url + "chs";
        }



    },

});
