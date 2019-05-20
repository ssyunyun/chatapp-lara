<!DOCTYPE HTML>
<html lang="ja">
  <head>
    <!--<link rel="stylesheet" href="{{ asset('css/style.css')}}">--> 
    <!--<script src ="js/jquery.min.js"></script>-->
    <script src="https://unpkg.com/vue/dist/vue.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.css">

    
    <meta name="viewport" content="width=device-width">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Chat Menu</title>
  </head>

  <body>
    <div class="ui text container">
      <button class="ui green button">戻る</button>
      <button class="ui green button">グループ招待</button> 


      <div id="chat">
        <textarea v-model="comment"></textarea>
        <br>
        <button type="button" v-on:click="send">送信</button>
      </div>
    </div>


    <script>
    url = "http://127.0.0.1:8000/";
    const chat = new Vue({
            el: '#chat',
            data: {
              comment: ''
            },

            methods: {
              send: function() {

                console.log("kokodayo");

                fetch(url + "api/chs/menu/chat_db", {
                  method: "POST",
                  headers: {
                      'Content-Type':'application/json'
                  },
                  body: JSON.stringify({
                      "comment": chat.comment
                  })
                })
                  .then(function(response) {
                      console.log("response受け取ったあささｓわよ");
                      console.log(response);
                      chat.message = '';
                });

             }
           }
           
        });
    </script>


  </body>
    
    
</html>