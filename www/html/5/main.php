<?php
require_once (dirname(__FILE__).'/data/getData.php');
require_once (dirname(__FILE__).'/session/session.php');

$getData = new data\getData();
$books = $getData->getBooksData();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .btn {
            color: white;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <h1>在庫一覧画面</h1>
    <button class="btn"><a href="./productRegist.php">新規登録</a></button>
    <button class="btn"><a href="./login.php">ログアウト</a></button>
    <div>
    <form action="delete.php" method="post">
        <table border="1">
            <tr>
                <th>タイトル</th>
                <th>発売日</th>
                <th>在庫数</th>
                <th></th>
            </tr>
            <?php foreach($books as $rec) { ?>
                <tr>
                    <?php foreach($rec as $colum => $cel){ ?>
                        <?php if($colum === 'title') { ?>
                        <td><?php echo $cel; ?></td>
                        <?php } elseif($colum=== 'date') { ?>
                        <td><?php echo $cel; ?></td>
                        <?php }else if($colum === 'stock'){ ?>
                        <td><?php echo $cel; ?></td>
                        <?php } ?>  
                    <?php } ?>
                    <?php foreach($rec as $colum => $cel){ ?>
                        <?php if($colum === 'id') { ?>
                            <td>
                                <input type="submit" value="削除">
                                <input type="hidden" name="id" value="<?php echo $cel; ?>">
                            </td>
                        <?php } ?>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>
    </form>
    </div>
</body>
</html>