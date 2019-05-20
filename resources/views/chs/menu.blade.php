<!DOCTYPE HTML>
<html>
  <head>

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
