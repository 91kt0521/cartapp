<?php
    //セッションを開始
    session_start();

    // セッションのセット判定
    if(!isset($_SESSION["product"])){
        //セッション変数が未定義の場合
        echo "現在カートは空です<br>";
    } else {
        echo "現在のカートの状況<br>";
        //セッション変数のデータを読み込み
        //商品名データを配列に代入
 
        // カートidを文字列の配列にする
        // $sessionId = explode(",", $_SESSION["product"]);
        echo $_SESSION["product"];
    }
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>カート</title>
        <link rel="stylesheet" href="/cart_app/css/cart.css">
        <link rel="stylesheet" href="/cart_app/css/base.css">
    </head>
    <body>
        <header>
            <h1 class="cart_in">ショッピングカート</h1>
            <h2 class="sub">一覧</h2>
        </header>
        <div class="main">
         
        </div>
    </body>
</html>