<?php
    // セッションスタート
    session_start();

    // ログインしていなければlogin.phpに遷移
    require_once __DIR__ . '/functions.php';
    require_once __DIR__ . '/datas.php';

    if(!isset($_GET["user"])){
        header("Location: login.php");
        exit();
    } else{
        $users_id = $_GET["user"];
    }
    require_logined_session();
    $datas = Connection_info();

    try{
        // db接続
        $pdo = new PDO("mysql:host={$datas["host"]};dbname={$datas["dbname"]};charset=utf8",$datas["dbuser"], $datas["dbpassword"]);

        $sql = "SELECT * FROM users WHERE id = $users_id";
        $stmt = $pdo->query($sql);

        foreach ($stmt as $users_info) {
            $_SESSION["user_id"] = $users_info["id"];
            echo $_SESSION["user_id"];
        }

    }catch(PDOException $e){
        var_dump($e -> getMessage());
        die();
    }

?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>カテゴリ一覧</title>
        <link rel="stylesheet" href="/cart_app/css/cart.css">
        <link rel="stylesheet" href="/cart_app/css/base.css">
    </head>
    <body>
        <header>
            <h1 class="login">カテゴリ一覧</h1>
            <h2 class="sub">カテゴリを選択してください</h2>
        </header>
        <div class="main">
            <div class="list">
            	<a href="list.php?type_id=1">食品</a>
            </div>
            <div class="list">
            	<a href="list.php?type_id=2">日用品</a>
            </div>
            <form action="login.php" method="POST">
                <div class="form-name form-item">
                    <input id="try" type="submit" name="logout" value="ログアウト" class="btn">
                </div>
            </form>
        </div>
    </body>
</html>