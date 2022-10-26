<?php
namespace pdo;
class Pdo {

    private $db;
    private $pdo;
    public $error = [];
    private $sql;

    public function __constructor()
    {
        $this->db['db_database'] = 'sample_db';
        $this->db['db_username'] = 'user';
        $this->db['db_password'] = 'password';
        $this->db['db_host'] = 'db';
        $this->db['pdo_dsn'] = 'mysql:host=db;charset=utf8;dbname='.$this->db['db_database'];
        $this->connection();
    }

    // 接続
    private function connection()
    {
        try {
            $this->pdo = new PDO($this->db["pdo_dsn"], $this->db['db_username'], $this->db['db_password']);
        } catch(Exception $e) {
            $this->error["db"] = $e->getMessage();
            error_log('pdoのコネクションでエラー発生');
        }
    }

    public function set_sql($query)
    {
        $this->sql = $query;
    }

    public function register($name, $password)
    {
        try {
        $stmt = $this->pdo->prepare($this->sql);
        $stmt->bindParam("name", $name);
        $stmt->bindParam("password", $password);
        $stmt->execute();
        $result = $stmt->fetch();
        if($result){
            return $result;
        } else {
            $error['db'] = 'パスワードか名前を間違えていませんか？';
        }
        } catch(Exception $e) {
            $this->error["db"] = $e->getMessage();
        }
    }

}
?>