require('./bootstrap');
window.Vue = require('vue');
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

url = "http://127.0.0.1:8000/";

//自分のIDを取得
var userId = localStorage.getItem("userId");
var userName = localStorage.getItem("userName");
//選択したグループのIdを取得
var groupId = localStorage.getItem("groupId");
var groupName = localStorage.getItem("groupName");

console.log("groupId = " + groupId);


const chat = new Vue({
    el: '#chat',
    data: {
      groupName: groupName,
      groupId: groupId,
      comment: '',
      comments: [],
      myAlign: '',
    },

    methods: {
      send: function() {

        fetch(url + "api/chs/menu/chat_db", {
          method: "POST",
          headers: {
              'Content-Type':'application/json'
          },
          body: JSON.stringify({
              "comment": chat.comment,
              "groupId": groupId,
              "userId": userId,
              "userName": userName
          })
        })
          .then(function(response) {
              console.log("response受け取ったあささｓわよ");
              console.log(response);
              chat.comment = '';
        });

        console.log("send処理終了");
     },

      getComments(groupId) {

        //console.log(groupId);

        fetch(url + "chs/menu/chatInfo?Id="+groupId, {
          method: "GET",         
          
        })
          .then(function(response) {
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
          chat.comments = json;
          console.log(chat.comments);
        })

        .catch(function(err) {
          // レスポンスがエラーで返ってきたときの処理はここに記述する
          console.log("レスポンスエラー");

        });

      },

      //自分のメッセージは右寄せに表示するためAlignを変更する
      changeAlign(index) {

        if (userId == chat.comments[index].userid)
        {
          chat.myAlign = 'right';
        } else {
          chat.myAlign = 'left';
        }

      }


   },//method終わり

   mounted() {

    this.getComments(groupId);

    //pusher処理
    Pusher.logToConsole = true;

    var pusher = new Pusher('949c78785793b76bf205', {
      cluster: 'ap1',
      forceTLS: true
    });

    var channel = pusher.subscribe(groupId);
    var self = this;
    channel.bind('chat', function() {
      self.getComments(groupId);
    });

  }

   
});
