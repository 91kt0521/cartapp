<?php
	// ログインしていなければlogin.phpに遷移
	require_once __DIR__ . '/functions.php';
	require_logined_session();
	//echo $_SESSION["id"];
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