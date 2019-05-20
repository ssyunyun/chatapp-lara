<!DOCTYPE HTML>
<html lang="ja">
  <head>
    <!--<link rel="stylesheet" href="{{ asset('css/style.css')}}">--> 
    <!--<script src ="js/jquery.min.js"></script>-->
    <script src="https://unpkg.com/vue/dist/vue.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.css">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width">
    <meta charset="utf-8">

    <title>Setting</title>
  </head>

  <body>
    <div class="ui text container">
    <a href="#" class="ui green button" onclick="javascript:window.history.back(-1);return false;">戻る</a>
    
    <h1 class="ui dividing header">Setting</h1><br>

      <div class="ui main container" id="setting">
        
        <div class="ui large buttons">
          <button class="ui grey button" v-on:click="select1">新規作成</button>
          <div class="or"></div>
          <button class="ui grey button" v-on:click="select2">招待</button>
        </div>

        <!-- *グループ作成* -->
        <div class="field" v-if="mode=='create'">
          <div class="ui segment">
            <div class="field">
              <h2>新規グループ作成</h2>
            </div> <br>
            <form class="ui large form" v-on:submit.prevent="newGroup">
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
        <div class="field" v-if="mode=='invite'">
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
    <script src="{{ secure_asset(('js/setting.js')}}"></script>
  </body>
        
</html>