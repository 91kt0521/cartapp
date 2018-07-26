<?php

	// セッションスタート
	session_start();

	require_once __DIR__ . '/functions.php';
	require_once __DIR__ . '/datas.php';

	// userid
	$user_id = $_SESSION["user_id"];

	// 商品type
	$type_id = $_GET["type_id"];

	// type_id判定
	type_id_judge($type_id);


	// 商品ナンバーがセットされていたら
	if(isset($_GET["product_num"])){

		$product_num = $_GET["product_num"];
		var_dump($product_num);

		// idが0の場合はセッション変数を破棄
		if($product_num == 0){
			unset($_SESSION["product"]);
		} else {
			$cart = "";
			// セッション変数がセットしていたら変数にセット
			if(!isset($_SESSION["product"])){
			} else {
				$cart = $_SESSION["product"];
			}

			if(strlen($cart) == 0){
				$_SESSION["product"] = "$cart".$product_num;
			}else {
				$_SESSION["product"] = "$cart,".$product_num;
			}
			var_dump($_SESSION["product"]);

			// DB接続情報呼び出し
			$datas = Connection_info();

			// post内容を$post_insert_dataに代入
			$product_id = $_GET["type_id"];

			try{
				// db接続
				$pdo = new PDO("mysql:host={$datas["host"]};dbname={$datas["dbname"]};charset=utf8",$datas["dbuser"], $datas["dbpassword"]);

				$sql = "SELECT * FROM products WHERE product_id = $product_id";
				$stmt = $pdo->query($sql);

			}catch(PDOException $e){
				var_dump($e -> getMessage());
				die();
			}
		}
	}

	// 商品IDがセットされていなかったら
	// post内容を$post_insert_dataに代入
	$product_id = $_GET["type_id"];
	$datas = Connection_info();

	try{
		// db接続
		$pdo = new PDO("mysql:host={$datas["host"]};dbname={$datas["dbname"]};charset=utf8",$datas["dbuser"], $datas["dbpassword"]);
		$sql = "SELECT * FROM products WHERE product_id = $product_id";
		$stmt = $pdo->query($sql);

	}catch(PDOException $e){
		var_dump($e -> getMessage());
		die();
	}
?>

<!DOCTYPE HTML>
<html lang="ja-JP">
<head>
	<meta charset="utf-8">
	<title>商品一覧</title>
	<link rel="stylesheet" href="/cart_app/css/cart.css">
	<link rel="stylesheet" href="/cart_app/css/base.css">
</head>
<body>
	<header>
		<h1 class="product_list">商品一覧</h1>
	</header>
	<div class="product_main">
		<table border="1" class="list_table">
			<tr>
				<th>商品名</th><th>金額</th><br>
			</tr>
			<?php foreach($stmt as $value): ?>
			<tr>
				<td><?php echo $value["product_name"] ?></td>
				<td><?php echo $value["product_price"]; ?> </td>

				<td><a href="list.php?product_num=<?php echo $value["id"]; ?>&type_id=<?php echo $product_id; ?>">カートに入れる</a></td>
			</tr>
			<?php endforeach;?>
			<tr>
				<td colspan="3" align="center"><a href="list.php?product_num=0&type_id=<?php echo $product_id; ?>">カートをクリア</a></td>
			</tr>
			<tr>
				<td colspan="3" align="center"><a href="cart.php?type_id=<?php echo $product_id; ?>">カートの中味を見る</a></td>
			</tr>
			<tr>
				<td colspan="3" align="center"><a href="Category.php?user=<?php echo $user_id; ?>">一覧へ戻る</a></td>
			</tr>
		</table>
	</div>
</body>
</html>