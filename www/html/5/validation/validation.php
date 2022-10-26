<?php

function validation($post){
    if(!$post["title"]){
        $result["error"] = 'タイトルを入力してください';
    } else if(!$post["date"]){
        $result["error"] = '発売日を入力してください';
    } else if(!$post["stock"]){
        $result["error"] = '在庫数を入力してください';
    } else {
        foreach($post as $col => $val){
            $result[$col] = $val;
        }
    }
    return $result;
}

?>