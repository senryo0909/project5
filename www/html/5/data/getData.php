<?php
namespace data;
require_once (dirname(__FILE__).'/../pdofunc.php');

class getData{

    public $pdo;
    public $data;
    public $error = [];

    //コンストラクタ
    function __construct()  {
    }
    
    /**
     * 記事情報の取得
     *
     * @param 
     * @return array $post_data 記事情報
     */
    public function getBooksData()
    {
        try {
            $this->pdo = connection();
            $getposts_sql = "SELECT * FROM books ORDER BY id desc";
            $post_data = $this->pdo->query($getposts_sql)->fetchAll();
            return $post_data;
        } catch(Exception $e) {
            $this->error["db"] = $e->getMessage();
            return $this->error;
        } finally{
            $this->pdo = null;
        }
    }

    public function postBooksData($result)
    {
        try {
            $this->pdo = connection();
            $posts_sql = "INSERT INTO books (title, date, stock) VALUES (:title, :date, :stock)";
            $params = array(':title' => $result["title"], ':date' => $result["date"], ':stock' => $result["stock"]);
            $stmt = $this->pdo->prepare($posts_sql);
            // 挿入件数
            $res = $stmt->execute($params);
            return $res;
        } catch(Exception $e) {
            $this->error["db"] = $e->getMessage();
            return $this->error;
        } finally{
            $this->pdo = null;
        }
    }

    public function deleteData($id)
    {
        try {
            $this->pdo = connection();
            $del_sql = "DELETE FROM books where id = :id";
            $stmt = $this->pdo->prepare($del_sql);
            $stmt->bindParam(':id', $id);
            $res = $stmt->execute();
            return $res;
        } catch(Exception $e) {
            $this->error["db"] = $e->getMessage();
            return $this->error;
        } finally{
            $this->pdo = null;
        }
    }
}