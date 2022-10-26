<?php
require_once(dirname(__FILE__).'/validation/validation.php');
require_once (dirname(__FILE__).'/data/getData.php');

if($_POST["title"] && $_POST["date"] && $_POST["stock"]){
    $result = validation($_POST);
    if(!$result["error"]){
        $getData = new data\getData();
        $res = $getData->postBooksData($result);
        if(!$res["db"]){
            header("Location: main.php");
            exit;
        } else {
            return $res;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>本登録画面</h1>
    <form action="productRegist.php" method="post">
        <input type="text" name="title" value="" placeholder="タイトル"><br>
        <input type="text" name="date" value="" placeholder="発売日"><br>
        <input type="hidden" name="first">
        <label for="stock_volume">在庫数:</label>
        <select name="stock"  id="stock_volume">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
        </select>
        <input type="submit" value="登録">
    </form>
    <div>
        <?php if($result["error"] || $res["db"]){ ?>
            <?php echo $result["error"]; ?>
        <?php } ?>
    </div>
</body>
</html>