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
		<title>Login</title>
	</head>

	<body>
	<div class="ui text container" id="app"><br>
		<h1 class="ui dividing header" v-cloak> @{{ submitText }} </h1><br>
		<div class="ui segment" v-cloak>
			<form class="ui large form" v-on:submit.prevent="submit">
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
				<button class="ui huge blue fluid button" type="submit" v-cloak>
					@{{ submitText }}
				</button>
			</form>
		</div>
		<div v-cloak>
			<button class="ui large grey fluid button" v-on:click="toggleMode">	
				@{{ toggleText }}画面へ
			</button>
		</div>
	</div>
	<!--本番環境と開発環境で設定を変える-->
	@if(app('env')=='local')
		<script type="text/javascript">
			const url = "http://127.0.0.1:8000/";
        </script>
        <script src="{{asset('js/app.js')}}" ></script>
    @endif
    @if(app('env')=='production')
        <script type="text/javascript">
            const url = "https://chatapp-lara.herokuapp.com/";
        </script>
        <script src="{{secure_asset('js/app.js')}}" ></script>
    @endif
	</body>
</html>