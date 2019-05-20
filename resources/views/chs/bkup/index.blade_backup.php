<!DOCTYPE HTML>
<html lang="ja">
<head>
    <link rel="stylesheet" href="{{ asset('css/style.css')}}"> 
    <meta charset="utf-8">
    <title>ChatApp</title>
</head>

<body>
<script>
    var txt1 = "* ログイン *";
    var txt2 = "* 新規登録 *";
    
    function ChangeTxt(txt) {
        document.getElementById("text").innerHTML=txt;
    }
</script>

<div class="StartButton">
    <input type="button" value="ログイン" onclick="ChangeTxt(txt1);"/>
    <input type="button" value="新規登録" onclick="ChangeTxt(txt2);"/>
    <br />
    <br />
    <h2><div id="text" style="margin-left : 100px" ></div></h2>
</div>

<!-- エラーメッセージエリア -->
@if ($errors->any())
    <h2>エラーメッセージ</h2>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif



<!-- フォームエリア -->
<script>
if(1){
    </script>
        <form action="/chs" method="POST">
        <ul>
            <li>
                <label> User name: </label>
                <input name="name" >
            </li>
            <br>
            <li>
                <label> password: </label>
                <input type="Password"> </li>
            <br>
        </ul>
            {{ csrf_field() }}
            <button class="CheckButton"> 送信 </button>
        </form>
        <script>
}
</script>

</body>
</html>