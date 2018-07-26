<?php

    // セッションを開始
    session_start();
    require_once __DIR__ . '/functions.php';
    require_once __DIR__ . '/datas.php';

    // セッション変数が未定義の場合
    if(!isset($_SESSION["product"])){

        $cart_empty_text = "現在カートは空です";
        // type_id判定
        $type_id = $_GET["type_id"];

        // 関数の呼び出し引数セット
        type_id_judge($type_id);

        // 返り値取得
        $total = type_id_judge($type_id);

    } else {
        // カートidを文字列の配列にする
        $products_id = explode(",", $_SESSION["product"]);

        // DB接続情報取得
        $datas = Connection_info();

        // type_id判定
        $type_id = $_GET["type_id"];

        // 関数の呼び出し引数セット
        type_id_judge($type_id);

        // 返り値取得
        $total = type_id_judge($type_id);


        try{
            // db接続
            //$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$dbuser, $dbpassword);
            $pdo = new PDO("mysql:host={$datas["host"]};dbname={$datas["dbname"]};charset=utf8",$datas["dbuser"], $datas["dbpassword"]);
        }catch(PDOException $e){
            var_dump($e -> getMessage());
            die();
        }
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
            <h2 class="sub">カート一覧</h2>
            <h2 class="sub1">現在のカートの状況</h2>
        </header>
        <div class="main">
            <form action="complete.php" method="post" class="cart_in_list">
                <div class="aaa">
                <table border="1">
                    <?php
                        if(isset($products_id)):
                        foreach ($products_id as $value):
                    ?>
                    <tr>
                        <th><?php 
                                $sql = "SELECT * FROM products WHERE id = $value";
                                $stmt = $pdo->query($sql);
                                foreach ($stmt as $products_value):
                                echo $products_value["product_name"] . " " . $products_value["product_price"]."</br>";
                            ?>
                        </th>
                    </tr>
                    <?php
                        $total += $products_value["product_price"];
                        endforeach;
                        endforeach;
                        endif;
                    ?>
                    <br>
                </table>
                <br>
                <?php
                    if($total == 0){
                        echo $cart_empty_text;
                    } else {
                        echo "合計". $total ."円";
                    }
                ?>
                <br>
                <a href="list.php?type_id=<?php echo $type_id; ?>">戻る</a>
                <input type="hidden" name="total" value="<?php echo $total; ?>">
                <?php
                    if(!$total == 0){
                        echo '<input type="submit" value="購入"/>';
                    }
                ?>
                
            </div>
            </form>
        </div>
    </body>
</html>