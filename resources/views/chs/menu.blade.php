<!DOCTYPE html>
<html>
  <head>
    <!--<link rel="stylesheet" href="{{ asset('css/style.css')}}">--> 
    <!--<script src ="js/jquery.min.js"></script>-->
    <!--<script src="https://unpkg.com/vue/dist/vue.js"></script>-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    
    <meta name="viewport" content="width=device-width">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Main Menu</title>
  </head>

  <body>
    <div class="ui text container" id = "menu">
      <button class="ui green button" v-on:click="selectMypage">マイページ</button>
      <button class="ui green button" v-on:click="selectSetting">設定</button>

      <div class="ui list" v-for="(list, i) in groups">
        <button class="ui large fluid button" v-on:click="selectGroup(i)">
        @{{ list }}
        </button>
      </div>
    </div>

  <!--<script src="{{ secure_asset(('js/menu.js')}}"></script>-->
  </body>
        
</html>
