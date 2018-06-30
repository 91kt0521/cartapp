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
        <title>カートapi</title>
        <link rel="stylesheet" href="/cart_app/css/form.css">
        <link rel="stylesheet" href="/cart_app/css/base.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <script>
        </script>
    </head>
    <body>
        <header>
            <h1 class="login">カテゴリ一覧</h1>
        </header>
        <div>
        	<a href="list.php?id=1">食品</a>
        </div>
        <div>
        	<a href="list.php?id=2">日用品</a>
        </div>
        <form action="login.php" method="post">
            <div class="form-name form-item">

                <input id="try" type="submit" name="logout" value="ログアウト" class="btn">
            </div>
        </form>
    </body>
</html>