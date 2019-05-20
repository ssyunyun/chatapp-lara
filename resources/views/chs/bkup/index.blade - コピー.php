<!DOCTYPE HTML>
<html lang="ja">
    <head>
<!--        <link rel="stylesheet" href="{{ asset('css/style.css')}}">  -->
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.js"></script>
<!--        <script src="{{ asset('js/index.js') }}"></script>  -->
        <meta name="csrf-token" content="{{ csrf_token()}}">
<!--        <link rel="stylesheet" href="https://cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.css">  -->
        


        
        <meta name="viewport" content="width=device-width">
        <meta charset="utf-8">

        <title>ChatApp</title>
    </head>

    <body>

    <!--
        <div id="app">
            @{{ submitText }}
            <p v-text="submitText"></p>
        </div>  



        <div class="ui main container" id="app">
            <form v-on:submit.prevent="submit">
                <input type="text" placeholder="Name" v-mode="user.userName" required>
                <input type="password" placeholder="Password" v-model="user.pass" required>
                <input type="password" placeholder="Password again" v-model="user.passAgain" required>

                <button type="submit">
                    <p v-text="submitText"></p>
                </button> 

                <button v-on:click="toggleMode">
                     @{{ toggleText }}
                </button>
            </form> 
        </div>

-->
        <script src="{{ asset('js/app.js') }}"></script>

  
    </body>
</html>