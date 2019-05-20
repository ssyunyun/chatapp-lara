require('./bootstrap');
window.Vue = require('vue');
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

url = "http://127.0.0.1:8000/";

/*
//自分のIDを取得
var userId = localStorage.getItem("userId");
//選択したグループのIdを取得
var groupId = localStorage.getItem("groupId");
console.log("groupId = " + groupId);
*/

const setting = new Vue({
  el: "#setting", // Vue.jsを使うタグのIDを指定
  data: {
      // Vue.jsで使う変数はここに記述する
      mode: null,
      groupName: null,
      groupComment: null,
      invitedUserId: null,
      invitedGroupId: null,
      Id_split: []
  },
  methods: {
      //新規作成か招待かを切り替える
      select1: function() {
        setting.mode = "create";
      },
      select2: function() {
        setting.mode = "invite";
      },      

      //新規グループ作成
      newGroup: function() {
        console.log("新規グループ作成処理");

        //入力内容からuseridをセパレート
        Id_split = separateString(setting.invitedUserId);

        //Id_splitを整形し、ただし文字列に繋ぎなおす
        Id_seq = adjustArray(Id_split);
        if(Id_seq == 0) return 0;

        console.log("送るもの確認");
        console.log(setting.groupName);
        console.log(setting.groupComment);
        console.log(Id_split);
        console.log(Id_seq);
        console.log("送るもの確認終了");


        fetch(url + "api/chs/menu/setting/newGroup", {
          method: "POST",
          headers: {
              'Content-Type':'application/json'
          },
          body: JSON.stringify({
              "groupName": setting.groupName,
              "groupComment": setting.groupComment,
              "Id_split": Id_split,
              "Id_seq": Id_seq
          })
      })
          .then(function(response) {
              console.log("response受け取ったよ-----");
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
              console.log(content);

              if(content == '1') alert("新規グループを作成しました！");
              if(content == '0') alert("存在しないユーザー情報が含まれています");
            })
          .catch(function(err) {
              // レスポンスがエラーで返ってきたときの処理はここに記述する
              console.log("エラーだよ");
          });

    },//newGroup終了




    inviteGroup: function() {
      console.log("グループ招待処理");

      //入力内容からuseridをセパレート
      Id_split = separateString(setting.invitedUserId);

      //Id_splitを整形し、ただし文字列に繋ぎなおす
      Id_seq = adjustArray(Id_split);
      if(Id_seq == 0) return 0;

      fetch(url + "api/chs/menu/setting/invite", {
        method: "POST",
        headers: {
            'Content-Type':'application/json'
        },
        body: JSON.stringify({
            "invitedGroupId": setting.invitedGroupId,
            "Id_split": Id_split,
            "Id_seq": Id_seq
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

            if(content == '1') alert("ユーザーを追加しました！");
            if(content == '0') alert("存在しないIDが入力されています");
          })
        .catch(function(err) {
            // レスポンスがエラーで返ってきたときの処理はここに記述する
            console.log("エラーだよ");
        });

  },//newGroup終了








  },

});

function separateString(contents) {
  console.log("separateString処理");
  contents_sp = contents.split(",");
  return contents_sp;
}

function adjustArray(Id_split) {
  console.log("adjustArray処理");
  //セパレートした配列の調整(不適な場合はエラー)
  for (var i = 0; i < Id_split.length; i++) {
    if (isNaN(Id_split[i]) == true && Id_split[i] != ''){
      alert("入力内容に誤りがあります");
      return 0;
    }
    if (Id_split[i] == '') Id_split.splice(i,1);//空の要素は削除    
  }

  //調整した配列から正しい文字列に繋ぎなおす
  for (var i = 0; i < Id_split.length; i++) {
    if(i == 0) {
      Id_seq = Id_split[i];
      //console.log(Id_seq);
    }
    else Id_seq = Id_seq + ',' + Id_split[i];
  }
  return Id_seq;
}


