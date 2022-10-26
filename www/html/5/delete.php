<?php
require_once (dirname(__FILE__).'/data/getData.php');
$req_id = $_POST["id"];
$getData = new data\getData();
$result = $getData->deleteData($req_id);
if(!$result["db"]){
    header("Location: main.php");
    exit;
} else {
    echo "削除作業でエラーが発生しました";
}
?>