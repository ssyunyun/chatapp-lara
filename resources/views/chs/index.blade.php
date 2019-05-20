<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

   <title>ログイン</title>

   <!-- load library -->
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.css">
</head>

<body>
<div class="ui text container" id="app"><br>

    <h1 class="ui dividing header"> @{{ submitText }} </h1><br>

   <div class="ui segment">
       <form class="ui large form" v-on:submit.prevent="submit">
       <!--@csrf-->
           <div class="field">
               <div class="ui left icon input">
                   <i class="user icon"></i>
                   <input type="text" placeholder="ユーザ名" v-model="user.userName" required>
               </div>
           </div>
           <div class="field">
               <div class="ui left icon input">
                   <i class="lock icon"></i>
                   <input type="password" placeholder="パスワード" v-model="user.password" required>
               </div>
           </div>
           <div class="field" v-if="mode=='signup'">
            <div class="ui left icon input">
              <i class="lock icon"></i>
              <input type="password" placeholder="パスワード (確認用)" v-model="user.passAgain" required>
            </div>
          </div>
           <button class="ui huge blue fluid button" type="submit">
               @{{ submitText }}
           </button>
       </form>
   </div>
   <button class="ui large grey fluid button" v-on:click="toggleMode">
       @{{ toggleText }}画面へ
   </button>
</div>
<script src="{{ asset('js/app.js')}}"></script>

</body>
</html>