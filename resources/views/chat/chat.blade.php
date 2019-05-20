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

    <div class="ui text container" id="chat">
      <a href="#" class="ui green button" onclick="javascript:window.history.back(-1);return false;">戻る</a>
   
      <div class="ui comments">
        <h1 class="ui dividing header">Chat</h1>
        <div class="ui header"> (グループ名 【 @{{ groupName }} 】 ,　 グループID 【 @{{ groupId }} 】)</div>

        <div v-for="(c, i) in comments" >
          @{{changeAlign(i)}}
          <div v-bind:align="myAlign">
            <div class="ui compact message">
              <div class="comment">
                <div class="content">
                  <a class="author">@{{c.username}}</a>
                  <div class="metadata">
                    <span class="date">@{{c.created_at}}</span>
                  </div>
                  <div class="text">
                    @{{c.comment}}
                  </div>
                </div>
              </div>
            </div> <br>
          </div>
        </div>




        <form class="ui reply form">
          <div class="field" >
            <textarea v-model="comment"></textarea>
          </div>
          <div class="ui blue labeled submit icon button" v-on:click="send">
            <i class="icon edit"></i> Submit
          </div>
        </form>
      </div>




    </div>

    <script src="{{ secure_asset(('js/chat.js') }}"></script>
  </body>
   
    
</html>