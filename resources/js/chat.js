require('./bootstrap');
window.Vue = require('vue');
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

//保存した情報を取得
var userId = localStorage.getItem("userId");
var userName = localStorage.getItem("userName");
var groupId = localStorage.getItem("groupId");
var groupName = localStorage.getItem("groupName");

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
		//チャット送信処理
        send: function() {
 			fetch(url + "api/chat", {
				method: "POST",
				headers: {
					'Content-Type':'application/json',
                    'userId': localStorage.getItem('userId'),
                    'token': localStorage.getItem('token')
                },
				body: JSON.stringify({
					"comment": chat.comment,
					"groupId": groupId,
					"userId": userId,
					"userName": userName
				})
			})
			.then(function(response) {
				console.log(response);
				chat.comment = '';
			});
		},

        getComments(groupId) {

			fetch(url + "api/getComments?Id="+groupId, {
				method: "GET",
				headers: {
                    'userId': localStorage.getItem('userId'),
                    'token': localStorage.getItem('token')
                }         
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
			console.log("Error.");
			});
		},

		//自分の発言したメッセージは右寄せに表示するためAlignを変更する
		changeAlign(index) {
			if (userId == chat.comments[index].userid){
				chat.myAlign = 'right';
			} else {
				chat.myAlign = 'left';
			}
		}
    },//method閉じ

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
