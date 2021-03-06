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
    <title>Mypage</title>
  </head>

  <body>
    <div class="ui main container" id="mypage">
      <div class="ui text container">
        @if(app('env')=='local')
          <a href="http://127.0.0.1:8000/menu" class="ui green button">戻る</a> 
        @endif
        @if(app('env')=='production')
          <a href="https://chatapp-lara.herokuapp.com/menu" class="ui green button">戻る</a> 
        @endif
        <button class="ui green button" v-on:click="logout">ログアウト</button>
        <h1 class="ui dividing header">My page</h1><br>
        <div class="ui center aligned grid">
          <h1 class="ui header" v-cloak>@{{ userName }} ( ID : @{{ userId }} )</h1>
        </div>
        <div class="ui segment" v-cloak>
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
    <!--本番環境と開発環境で設定を変える-->
    @if(app('env')=='local')
      <script type="text/javascript">
        const url = "http://127.0.0.1:8000/";
      </script>
      <script src="{{asset('js/mypage.js')}}" ></script>
    @endif
    @if(app('env')=='production')
      <script type="text/javascript">
        const url = "https://chatapp-lara.herokuapp.com/";
      </script>
      <script src="{{secure_asset('js/mypage.js')}}" ></script>
    @endif
  </body>
</html>