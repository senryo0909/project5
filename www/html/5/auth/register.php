<?php
namespace auth;

require_once (dirname(__FILE__).'/../pdofunc.php');

class Register 
{
    public $name;
    public $password;
    public $error;

    public function __construct($name, $password){
        $this->name = $name;
        $this->password = $password;
    }

    public function sanitize()
    {
        $this->name = htmlspecialchars($this->name, ENT_QUOTES);
        $this->password = htmlspecialchars($this->name, ENT_QUOTES);
    }

    private function encryption()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }

    public function register()
    {
        try {
            $pdo = connection();
            $this->encryption();
            $stmt = $pdo->prepare("insert into users (name, password) VALUES (:name, :password)");
            $stmt->bindParam("name", $this->name);
            $stmt->bindParam("password", $this->password);
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
};

?>