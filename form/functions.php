<?php

/**
 * ログインしていればcart.phpに遷移
 */
function require_unlogined_session()
{
    // セッション開始
    //@session_start();

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

?>