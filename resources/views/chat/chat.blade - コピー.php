<!DOCTYPE HTML>
<html lang="ja">
  <head>
    <!--<link rel="stylesheet" href="{{ asset('css/style.css')}}">--> 
    <!--<script src ="js/jquery.min.js"></script>-->
    <script src="https://unpkg.com/vue/dist/vue.js"></script>
    <!--<script src="https://js.pusher.com/4.4/pusher.min.js"></script>-->
    

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.css">
    
    <meta name="viewport" content="width=device-width">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Chat Menu</title>
  </head>




  <body>
    <div class="ui text container">
    <a href="#" class="ui green button" onclick="javascript:window.history.back(-1);return false;">戻る</a>
   

      <div id="chat">
        <textarea v-model="comment"></textarea>
        <br>
        <button type="button" v-on:click="send">送信</button>

        <div v-for="c in comments">
          <!-- 登録された日時 -->
          <span v-text="c.created_at"></span>：&nbsp;
          
          <!-- メッセージ内容 -->
          <span v-text="c.comment"></span>
        </div>
      </div>

      </div>
    </div>

    <script src="{{ asset('js/chat.js') }}"></script>
  </body>
   
    
</html>