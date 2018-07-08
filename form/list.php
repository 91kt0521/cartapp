<?php
	//require_once __DIR__ . '/functions.php';
	//products_list();

// セッションスタート
session_start();

// 商品ナンバーがセットされていたら
if(isset($_GET["product_num"])){
var_dump($_GET["product_num"]);
	// idが0の場合はセッション変数を破棄
	if($_GET["product_num"] == 0){
		unset($_SESSION["product"]);
	} else {
		$cart = "";
		// セッション変数がセットしていたら変数にセット
		if(!isset($_SESSION["product"])){
		} else {
			$cart = $_SESSION["product"];
		}

		//$cart .= (strlen($cart) == 0 ? "" : ",") . $_GET["id"];
		if(strlen($cart) == 0){
			$_SESSION["product"] = "$cart".$_GET["product_num"];
		}else {
			$_SESSION["product"] = "$cart,".$_GET["product_num"];
		}

		//echo "今回カートに入れた商品IDは" . $_GET["product_num"] . "<br><br>";

		$host = 'localhost';
		$dbname = 'cartapp';
		$dbuser = 'root';
		$dbpassword = 'root';
		// post内容を$post_insert_dataに代入
		$product_id = $_GET["type_id"];

		try{
			// db接続
			$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$dbuser, $dbpassword);

			$sql = "SELECT * FROM products WHERE product_id = $product_id";
			$stmt = $pdo->query($sql);

		}catch(PDOException $e){
			var_dump($e -> getMessage());
			die();
		}
	}
}

$host = 'localhost';
    $dbname = 'cartapp';
    $dbuser = 'root';
    $dbpassword = 'root';
    // post内容を$post_insert_dataに代入
    $product_id = $_GET["type_id"];

    try{
        // db接続
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$dbuser, $dbpassword);

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
				<td colspan="3" align="center"><a href="cart.php">カートの中味を見る</a></td>
			</tr>
		</table>
	</div>
</body>
</html>