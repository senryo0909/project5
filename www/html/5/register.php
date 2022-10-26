<?php
require_once (dirname(__FILE__).'/auth/register.php');

if(!empty($_POST["name"]) && !empty($_POST["password"])) {
    $result = '';
    $error = array();
    $register = new auth\Register($_POST['name'], $_POST["password"]);
    $register->sanitize();
    $result = $register->register();
    if(!empty($result)) {
        echo 'aa';
        header("Location: main.php");
        exit;
    } else {
        $error = $result;
    }
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
    </style>
</head>
<body>
    <div class="main">
    <h1>ユーザー登録画面</h1>
    <form method="POST" action="login.php">
        <input type="text" name="name" id="name" placeholder="ユーザー名">
        <br>
        <input type="password" name="password" id="password" placeholder="パスワード"><br>
        <input type="submit" value="新規登録" id="signUp" name="signUp">
    </form>
    <?php if(!empty($error)) { ?>
        <?php foreach($error as $msg) { ?>
            <?php echo $msg; ?>
        <?php } ?>
    <?php } ?>
    </div>
</body>
</html>
