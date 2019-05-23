require('./bootstrap');
window.Vue = require('vue');
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const setting = new Vue({
	el: "#setting", 
  	data: {
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
        createGroup: function() {
			console.log("新規グループ作成処理");

			//入力内容からuseridをセパレート
			Id_split = separateString(setting.invitedUserId);

			//Id_splitを整形し、正しい文字列に繋ぎなおす
			Id_seq = adjustArray(Id_split);
			if(Id_seq == 0) return 0;

			fetch(url + "api/createGroup", {
				method: "POST",
				headers: {
					'Content-Type':'application/json',
                    'userId': localStorage.getItem('userId'),
                    'token': localStorage.getItem('token')
                },
				body: JSON.stringify({
					"groupName": setting.groupName,
					"groupComment": setting.groupComment,
					"Id_split": Id_split,
					"Id_seq": Id_seq
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
				var content = JSON.stringify(json, null, 2);  
              	// レスポンスが200番で返ってきたときの処理はここに記述する
              	if(content == '1') alert("新規グループを作成しました！");
              	if(content == '0') alert("存在しないユーザー情報が含まれています");
            })
          	.catch(function(err) {
              	// レスポンスがエラーで返ってきたときの処理はここに記述する
              	console.log("Error.");
          	});
    	},//createGroup閉じ

    	inviteGroup: function() {
      		console.log("グループ招待処理");

			//入力内容からuseridをセパレート
			Id_split = separateString(setting.invitedUserId);

			//Id_splitを整形し、正しい文字列に繋ぎなおす
			Id_seq = adjustArray(Id_split);
            if(Id_seq == 0) return 0;

			fetch(url + "api/inviteGroup", {
				method: "POST",
				headers: {
					'Content-Type':'application/json',
                    'userId': localStorage.getItem('userId'),
                    'token': localStorage.getItem('token')
                },
				body: JSON.stringify({
					"invitedGroupId": setting.invitedGroupId,
					"Id_split": Id_split,
					"Id_seq": Id_seq
				})
			})
			.then(function(response) {
                console.log(response);

				if (response.status == 200) {
					return response.json();
				}
				// 200番以外のレスポンスはエラーを投げる
				return response.json().then(function(json) {
					console.log("Error.");
					throw new Error(json.message);
				});
			})
			.then(function(json) {
                var content = JSON.stringify(json, null, 2);  
                console.log(content);

				if(content == '1') alert("ユーザーを追加しました！");
				if(content == '0') alert("存在しないIDが入力されています");
			})
			.catch(function(err) {
				console.log("Error.");
			});
		},//inviteGroup閉じ
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


