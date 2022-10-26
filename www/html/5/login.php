<?php
require_once (dirname(__FILE__).'/auth/login.php');
require_once (dirname(__FILE__).'/session/session.php');

$result = '';
$error = array();

if(!empty($_POST["name"]) && !empty($_POST["password"])) {
    $login = new auth\Login($_POST['name'], $_POST["password"]);
    $login->sanitize();
    $result = $login->identify();
    if(!empty($result)){
        
        $session = new session\Session;
        $session->check_user_logged_in();

        $_SESSION['user_id'] = $result['id'];
        $_SESSION['user_name'] = $result['name'];
        header("Location: main.php");
        exit;
    }
} else if (empty($_POST["name"]) || empty($_POST["password"])) {
    $error["form"] = '名前とパスワードを入力してください';
}


?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>
        .main{
            width: 1200px;
            height: 800px;
            margin: 0 auto;
            text-align: center;
        }
        .btn {
            width:150px;
            height:50px;
            border-radius: 10px;
            background-color: #449999;
            display: inline-block;
        }
        h1 {
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="main">
    <h1>ログイン画面</h1>
    <div class="btn"><a href="register.php" style="color:white;">新規ユーザー登録</a></div>
    <form method="POST" action="main.php">
        <input type="text" name="name" id="name" placeholder="ユーザー名">
        <br>
        <input type="password" name="password" id="password" placeholder="パスワード"><br>
        <input type="submit" value="ログイン" id="signUp" name="signUp">
    </form>
    <?php if(!empty($error)) { ?>
        <?php foreach($error as $msg) { ?>
            <?php echo $msg; ?>
        <?php } ?>
    <?php } ?>
    </div>
</body>
</html>