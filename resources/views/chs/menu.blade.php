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

    <title>Main Menu</title>
  </head>

  <body>
    <div class="ui text container" id = "menu">
      <button class="ui green button" v-on:click="selectMypage">マイページ</button>
      <button class="ui green button" v-on:click="selectSetting">設定</button>

      <h1 class="ui dividing header">Main Menu</h1><br>
      <form class="ui form">
        <div class="field"><br>
          <h2>グループ検索</h2>
          <div class="field">
            <input type="text" name="group-name" placeholder="検索...">
          </div>
        </div>
      </form>

      <h2>グループ一覧</h2>

      <div class="ui list" v-for="(list, i) in groups">
        <button class="ui large fluid button" v-on:click="selectGroup(i)">
        @{{ list }}
        </button>
      </div>
    </div>

  <!--<script src="{{ secure_asset(('js/menu.js')}}"></script>-->
  </body>
        
</html>
