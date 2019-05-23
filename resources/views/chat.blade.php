<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.css">
    <link rel="stylesheet" href="{{ asset('css/vue.css')}}">
    <title>Chat</title>
  </head>

  <body>
    <div class="ui text container" id="chat">
      <a href="#" class="ui green button" onclick="javascript:window.history.back(-1);return false;">戻る</a> 
      <div class="ui comments">
        <h1 class="ui dividing header">Chat</h1>
        <div class="ui header" v-cloak>
          (グループ名 【 @{{ groupName }} 】 ,　 グループID 【 @{{ groupId }} 】)
        </div>
        <div v-for="(c, i) in comments" v-cloak>
          @{{changeAlign(i)}}
          <div v-bind:align="myAlign">
            <div class="ui compact message">
              <div class="comment">
                <div class="content" v-cloak>
                  <a class="author">@{{c.username}}</a>
                  <div class="metadata">
                    <span class="date">@{{c.created_at}}</span>
                  </div>
                  <div class="text">
                    @{{c.comment}}
                  </div>
                </div>
              </div>
            </div><br>
          </div>
        </div>
        <form class="ui reply form">
          <div class="field" >
            <textarea v-model="comment" v-cloak></textarea>
          </div>
					<div v-cloak>
						<div class="ui blue labeled submit icon button" v-on:click="send">
							<i class="icon edit"></i> Submit
						</div>
					</div>
        </form>
      </div>
    </div>
    @if(app('env')=='local')
           <script type="text/javascript">
               const url = "http://127.0.0.1:8000/";
           </script>
           <script src="{{asset('js/chat.js')}}" ></script>
       @endif
       @if(app('env')=='production')
           <script type="text/javascript">
               const url = "https://chatapp-lara.herokuapp.com/";
           </script>
           <script src="{{secure_asset('js/chat.js')}}" ></script>
       @endif
  </body>  
</html>