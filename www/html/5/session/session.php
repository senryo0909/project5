<?php
namespace session;

class Session {

    public function __construct(){}

    function check_user_logged_in() {
        // セッション開始
        if($_SESSION['id'])
        session_start();
        // セッションにuser_nameの値がなければlogin.phpにリダイレクト
        if (!empty($_SESSION["user_name"])) {

            header("Location: main.php");
            exit;
        }
    }
}

?>