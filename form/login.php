<?php
    session_start();
    require_once __DIR__ . '/functions.php';

    // ログアウトしたらセッションを削除
    if(isset($_POST["logout"])){
        unset( $_SESSION["id"] );
    }

    // ログインしていればcart.phpに遷移
    require_unlogined_session();

    $errorMessage = "";

    if(isset($_POST["login"])){


        $host = 'localhost';
        $dbname = 'cartapp';
        $dbuser = 'root';
        $dbpassword = 'root';
        // post内容を$post_insert_dataに代入
        $post_insert_data = $_POST;

        // エラーチェック
        if(empty($_POST["mail"])){
            $errorMessage = "メールアドレスが未入力です。";
        } elseif(empty($_POST["password"])){
            $errorMessage = "パスワードが未入力です。";
        }

        // メール、パスワードの入力チェック
        if(!empty($_POST["mail"]) && !empty($_POST["password"])) {

            $mail = $_POST["mail"];

            try{
                // db接続
                $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$dbuser, $dbpassword);


                // sql実行(select)
                $stmt = $pdo->prepare('SELECT * FROM users WHERE mail = ?');
                $stmt->execute(array($mail));

                // 入力したパスワードを取得
                $password = $_POST["password"];

                // 結果セットにDB内で一致した内容をセット
                if($result_data = $stmt->fetch(PDO::FETCH_ASSOC)){

                    // ハッシュ化したパスワードとマッチするかどうか
                    if(password_verify($password,$result_data["password"])){
                        //session_regenerate_id(true);

                        $id = $result_data["id"];
                        $sql = "SELECT * FROM users WHERE id = $id";

                        $stmt = $pdo->query($sql);
                        foreach ($stmt as $row) {
                            $row['id'];
                        }
                        $_SESSION["id"] = $row['id'];

                        header("Location: cart.php");  // メイン画面へ遷移
                        exit();

                    } else {
                        // 認証失敗
                        $errorMessage = "ユーザーIDあるいはパスワードに誤りがあります。";
                    }
                } else {
                    // 該当なし
                    $errorMessage = "ユーザーIDあるいはパスワードに誤りがあります。";
                }
            } catch (PDOException $e){
                var_dump($e -> getMessage());
                die();
            }
        }
    } else {
        if(!empty($_POST["login"])){
            require_once("insert.php");
        }
    }

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
            <h1 class="login">ログイン</h1>
            <div>
                <font color="#ff0000">
                    <?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?>
                </font>
            </div>
        </header>
        <div class="form">
            <form action="" method="post">
                <div class="form-name form-item">
                    <input type="text" id="mail" name="mail" autocomplete="mail" class="form-control" placeholder="メールアドレス" />
                </div>
                <div class="form-tel form-item">
                    <input type="text" id="password" name="password" autocomplete="password" class="form-control" placeholder="パスワード" />
                </div>
                <input id="try" type="submit" id="login" name="login" value="ログイン" class="btn">
            </form>
        </div>
    </body>
</html>
