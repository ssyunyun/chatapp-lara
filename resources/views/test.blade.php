<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
<script type='text/javascript'>
function test_click() {
    const url = 'http://127.0.0.1:8000/chs/create';
    const data = {
        method: 'POST',
        name: "suzuki",
        pass: "abc",
        //_token: '{{ csrf_token() }}'
    }
    
    
    fetch(url, data).then(function(response) {
        if(response.ok){
            alert("response is ok");
            return response.text();
        } else {
            alert("response is not ok");
            throw new Error();
        }
    }).then(function(text) {
        var result = document.querySelector('#result');
        result.innerHTML = text;
    })
    .catch((error) => console.log(error));


};
</script>
</head>
<body>
<!-- 直前投稿エリア -->
    @isset($name, $pass)
    <h2>@{{ $name }}さんの直前の投稿</h2>
    @{{ $pass }}
    <br><hr>
    @endisset

    <h3>fetchテスト</h3>
    <input type="button" id="test" value="テスト" onclick="test_click()">
    <div id="result">
</body>
</html>

