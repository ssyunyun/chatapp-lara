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

    <title>My page</title>
  </head>

  <body>
    <div class="ui main container" id="mypage">
      <div class="ui text container">
      <a href="#" class="ui green button" onclick="javascript:window.history.back(-1);return false;">戻る</a>
        <button class="ui green button" v-on:click="logout">ログアウト</button>
        
        <h1 class="ui dividing header">My page</h1><br>

        <div class="ui center aligned grid">
          <h1 class="ui header">@{{ userName }} ( ID : @{{ userId }} )</h1>
        </div>

        <div class="ui segment">
          <div class="field"><label>パスワード変更はこちら↓</label></div>
            <form class="ui large form" v-on:submit.prevent="submit">
                <div class="field">
                  <div class="ui input">
                    <input type="password" placeholder="現在のパスワード" v-model="password" required>
                  </div>
                </div>
                <div class="field">
                  <div class="ui input">
                    <input type="password" placeholder="新しいパスワード" v-model="passNew" required>
                  </div>
                </div>
                <div class="field">
                  <div class="ui input">
                    <input type="password" placeholder="新しいパスワード (確認)" v-model="passNewAgain" required>
                  </div>
                </div>
                <button class="ui huge grey fluid button" type="submit">パスワード変更</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script src="{{ secure_asset(('js/mypage.js') }}"></script>

  </body>
        
</html>