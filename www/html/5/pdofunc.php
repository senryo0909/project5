<?php
define('DB_DATABASE','sample_db');
define('DB_USERNAME','user');
define('DB_PASSWORD','password');
define('DB_HOST','db');
define('PDO_DSN','mysql:host=db;charset=utf8;dbname='.DB_DATABASE);

$error_msg = [];

function connection()
    {
        try {
             $pdo = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
             return $pdo;
        } catch(Exception $e) {
            $error["db"] = $e->getMessage();
            error_log('pdoのコネクションでエラー発生');
        }
    }
?>