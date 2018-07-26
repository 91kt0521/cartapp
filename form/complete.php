<?php
	// ログインしていなければlogin.phpに遷移
	require_once __DIR__ . '/functions.php';
	require_once __DIR__ . '/datas.php';
	require_logined_session();

	$totalPrice = $_POST["total"];
	$userId = $_SESSION["user_id"];

	$datas = Connection_info();

	try{
		// db接続
		$pdo = new PDO("mysql:host={$datas["host"]};dbname={$datas["dbname"]};charset=utf8",$datas["dbuser"], $datas["dbpassword"]);

		// sqlへinsertする
		$stmt = $pdo -> prepare("INSERT INTO products_price (
				price, users_id
			) VALUES (
				?, ?
			)"
		);

		$stmt->execute(array(
			$totalPrice,
			$userId,
		));

		//データベース接続切断
		$pdo = null;

	}catch(PDOException $e){
		var_dump($e -> getMessage());
		die();
	}

?>


<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/cart_app/css/cart.css">
        <link rel="stylesheet" href="/cart_app/css/base.css">
    </head>
    <body>
        <header>
            <h2 class="sub">お買い上げありがとうございました。</h2>
        </header>
        <div class="main">
           
        </div>
    </body>
</html>