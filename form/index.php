<?php
    if(isset($_POST["mail"]) && isset($_POST["password"])){
        require_once("insert.php");
        header("Location: login.php");  // メイン画面へ遷移
        exit();
    }
?>


<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>登録</title>
        <link rel="stylesheet" href="/cart_app/css/form.css">
        <link rel="stylesheet" href="/cart_app/css/base.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <script>
        $(function(){
            $("#try").on("click", function(){
                if(document.getElementById("mail").value == "" ||
                    document.getElementById("password").value == ""){
                    alert("空の項目があります。\n入力してください。");
                    return false
                };
            });
        });
        </script>
    </head>
    <body>
        <header>
            <h1>登録</h1>
        </header>
        <div class="form">
            <form action="" method="post">
                <div class="form-name form-item">
                    <input type="text" id="mail" name="mail" autocomplete="mail" class="form-control" placeholder="メールアドレス" />
                </div>
                <div class="form-tel form-item">
                    <input type="text" id="password" name="password" autocomplete="password" class="form-control" placeholder="パスワード" />
                </div>
                <input id="try" type="submit" name="regist" value="登録" class="btn">
            </form>
        </div>
    </body>
</html>
