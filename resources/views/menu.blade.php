<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.css">
    <link rel="stylesheet" href="{{ asset('css/vue.css')}}">
    <title>Menu</title>
  </head>

  <body>
    <div class="ui text container" id = "menu">
      <button class="ui green button" v-on:click="selectMypage">マイページ</button>
      <button class="ui green button" v-on:click="selectSetting">設定</button>
      <h1 class="ui dividing header">Main Menu</h1><br>
      <h2>グループ一覧</h2>
      <div class="ui list" v-for="(list, i) in groups" v-cloak>
        <button class="ui large fluid button" v-on:click="selectGroup(i)">
          @{{ list }}
        </button>
      </div>
      <div class="field" v-if="noGroupFlag==1">
        <div class="ui red big message" v-cloak>
          所属するグループがありません。<br>設定からグループを作成しましょう！
        </div>
      </div>
    </div>
    <script src="{{ asset('js/menu.js') }}"></script>
  </body>      
</html>
