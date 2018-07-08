<?php
	$host = 'localhost';
	$dbname = 'cartapp';
	$dbuser = 'root';
	$dbpassword = 'root';
	// post内容を$post_insert_dataに代入
	$post_insert_data = $_POST;

    // passwordをハッシュ化する。
    $password = $post_insert_data['password'];
    $options = array('cost' => 10);
    $password = password_hash($password, PASSWORD_DEFAULT, $options);

	try {
		// db接続
		$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$dbuser, $dbpassword);
		// echo "SUCCESS";

		// sqlへinsertする
		$stmt = $pdo -> prepare("INSERT INTO users (
				mail, password
			) VALUES (
				?, ?
			)"
		);

		// sql実行
		$stmt->execute(array(
			$post_insert_data["mail"],
			$password,
		));

		//データベース接続切断
		$pdo = null;

	}catch (PDOException $e){
		var_dump($e -> getMessage());
		die();
	}
?>