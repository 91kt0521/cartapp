<?php

/**
 * ログインしていればcart.phpに遷移
 */
function require_unlogined_session()
{
    // セッション開始
    @session_start();

    if (isset($_SESSION['id'])) {
        header('Location: cart.php');
        exit;
    }
}

/**
 * ログインしていなければlogin.phpに遷移
 */
function require_logined_session()
{
    // セッション開始
    @session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: login.php');
        exit;
    }
}

function products_list($stmt)
{
    $host = 'localhost';
    $dbname = 'cartapp';
    $dbuser = 'root';
    $dbpassword = 'root';
    // post内容を$post_insert_dataに代入
    $product_id = $_GET["id"];

    try{
        // db接続
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$dbuser, $dbpassword);

        $sql = "SELECT * FROM products WHERE product_id = $product_id";
        $stmt = $pdo->query($sql);
        return $stmt;
        
    }catch(PDOException $e){
        var_dump($e -> getMessage());
        die();
    }
}

/**
 * type_id判定
 */
function type_id_judge($a) {
    // type_id判定
    if(!isset($a) || $a == ""){
        header("Location: category.php");  // メイン画面へ遷移
        exit();
    } else {
        $total = 0;
        return $total;
    }
}

?>