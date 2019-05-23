<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.css">
    <!--本番環境と開発環境で設定を変える-->
    @if(app('env')=='local')
      <link rel="stylesheet" href="{{ asset('css/vue.css')}}">
    @endif
    @if(app('env')=='production')
      <link rel="stylesheet" href="{{ secure_asset('css/vue.css')}}">
    @endif
    <title>Setting</title>
  </head>

  <body>
    <div class="ui text container">
    @if(app('env')=='local')
      <a href="http://127.0.0.1:8000/menu" class="ui green button">戻る</a> 
    @endif
    @if(app('env')=='production')
       <a href="https://chatapp-lara.herokuapp.com/menu" class="ui green button">戻る</a> 
    @endif
    <h1 class="ui dividing header">Setting</h1><br>
      <div class="ui main container" id="setting">
        <div class="ui large buttons">
          <button class="ui grey button" v-on:click="select1">新規作成</button>
          <div class="or"></div>
          <button class="ui grey button" v-on:click="select2">招待</button>
        </div>
        <!-- *グループ作成* -->
        <div class="field" v-if="mode=='create'" v-cloak>
          <div class="ui segment">
            <div class="field">
              <h2>新規グループ作成</h2>
            </div> <br>
            <form class="ui large form" v-on:submit.prevent="createGroup">
              <div class="field">
                <div class="ui input">
                  <input type="text" placeholder="グループ名を入力して下さい" v-model="groupName" required>
                </div>
              </div>
              <div class="field">
                <div class="ui input">
                  <input type="text" placeholder="加入するユーザのIDを入力して下さい (複数人の場合は「,」で区切る)" v-model="invitedUserId" required>
                </div>
              </div>
              <div class="field">
                <div class="ui input">
                  <textarea rows="5" placeholder="説明文を入力して下さい" v-model="groupComment" required></textarea>
                </div>
              </div>
              <button class="ui huge fluid button" type="submit">作成</button>
            </form>
          </div>
        </div>
        <!-- *グループ招待* -->
        <div class="field" v-if="mode=='invite'" v-cloak>
          <div class="ui segment">
            <div class="field">
              <h2>グループ招待</h2>
            </div> <br>
            <form class="ui large form" v-on:submit.prevent="inviteGroup">
              <div class="field">
                <div class="ui input">
                  <input type="text" placeholder="グループIdを入力してください" v-model="invitedGroupId" required>
                </div>
              </div>
              <div class="field">
                <div class="ui input">
                  <input type="text" placeholder="招待するユーザのIDを入力してください (複数人の場合は「,」で区切る)" v-model="invitedUserId" required>
                </div>
              </div>
              <button class="ui huge fluid button" type="submit">招待</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--本番環境と開発環境で設定を変える-->
    @if(app('env')=='local')
      <script type="text/javascript">
        const url = "http://127.0.0.1:8000/";
      </script>
      <script src="{{asset('js/setting.js')}}" ></script>
    @endif
    @if(app('env')=='production')
      <script type="text/javascript">
        const url = "https://chatapp-lara.herokuapp.com/";
      </script>
      <script src="{{secure_asset('js/setting.js')}}" ></script>
    @endif
  </body>       
</html>