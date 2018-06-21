<?php

    if(isset($_POST["login"])){

        $host = 'localhost';
        $dbname = 'cartapp';
        $dbuser = 'root';
        $dbpassword = 'root';
        // post内容を$post_insert_dataに代入
        $post_insert_data = $_POST;

        // ログインボタンが押されたとき
        if(empty($_POST["mail"])){
            $errorMessage = "メールアドレスが未入力です。";
            echo $errorMessage;
        } elseif(empty($_POST["password"])){
            $errorMessage = "パスワードが未入力です。";
            echo $errorMessage;
        }

        // メール、パスワードの入力チェック
        if(!empty($_POST["mail"]) && !empty($_POST["password"])) {
            echo "ログイン成功";

            try{
                // db接続
                $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$dbuser, $dbpassword);
                echo "SUCCESS<br>";

                $sql = "SELECT * FROM users";
                $statement = $pdo -> query($sql);
                foreach( $statement as $value ) {
                   echo "メール"."$value[mail]<br>";
                   echo "PW"."$value[password]<br>";
                }
                var_dump($statement);

            } catch (PDOException $e){
                var_dump($e -> getMessage());
                die();
            }
        }
    } else {
        if(!empty($_POST)){
            require_once("insert.php");
        }
    }

?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>カートapi</title>
        <link rel="stylesheet" href="/cart_api/css/form.css">
        <link rel="stylesheet" href="/cart_api/css/base.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <script>
        </script>
    </head>
    <body>
        <header>
            <h1 class="login">ログイン</h1>
        </header>
        <div class="form">
            <form action="" method="post">
                <div class="form-name form-item">
                    <input type="text" id="mail" name="mail" autocomplete="mail" class="form-control" placeholder="メールアドレス" />
                </div>
                <div class="form-tel form-item">
                    <input type="text" id="password" name="password" autocomplete="password" class="form-control" placeholder="パスワード" />
                </div>
                <input id="try" type="submit" id="login" name="login" value="ログイン" class="btn">
            </form>
        </div>
    </body>
</html>
