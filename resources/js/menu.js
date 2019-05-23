require('./bootstrap');
window.Vue = require('vue');
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

url = "http://127.0.0.1:8000/";

var key = localStorage.getItem("userId");
console.log("id = " + key);

const menu = new Vue({
    el: "#menu",
    data: {
        userId: key,
        groups: [],
        groupIds: [],
        noGroupFlag: 0
    },
    methods: {
        window:onload = function() {
            /* ============ データベースからグループ情報を取得する ============ */
            fetch(url + "getInfo?Id="+menu.userId, {
                method: "GET"
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
                var group_name = json[0]['groupname'];
                var group_id = json[0]['groupid'];
                
                if(group_id != null){
                    //連結した文字列をセパレートする
                    group_name_split = separateString(group_name);
                    group_id_split = separateString(group_id);

                    menu.groups = group_name_split;
                    menu.groupIds = group_id_split;
                    noGroupFlag = 0;
                } else {
                    //グループに所属していなかったらメッセージを表示させる
                    menu.noGroupFlag = 1;
                }

            })
            .catch(function(err) {
                // レスポンスがエラーで返ってきたときの処理はここに記述する
                console.log("Error...");
            });
        },
        selectGroup: function(id) {
            //グループ選択したときの処理を書く
 
            var groupId = menu.groupIds[id];//配列の番号に対応するグループIDを取得
            var groupName = menu.groups[id];//配列の番号に対応するグループ名を取得
            
            console.log(groupName);
            localStorage.setItem('groupId', groupId);
            localStorage.setItem('groupName', groupName);
            location.href=url + "chat";
        },

        selectMypage: function() {
            console.log("selectMypage処理");
            location.href=url + "mypage";
        },

        selectSetting: function() {
            //設定を選択したときの処理を書く
            location.href=url + "setting";
        },
    },
});

function separateString(contents) {
    contents_split = contents.split(",");
    return contents_split;
  }