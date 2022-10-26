<?php
namespace auth;

require_once (dirname(__FILE__).'/../pdofunc.php');

class Login 
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

    // public function validation($name, $pass)
    // {
    //     if (empty($name)) {
    //         $this->error["name"] = '名前がありません';
    //     } else if (empty($pass)){
    //         $this->error["pass"] = 'パスワードがありません';
    //     }
    // }

    public function identify()
    {
        try {
            $pdo = connection();
            $this->encryption();
            $stmt = $pdo->prepare("select * from users where name = :name and password = :password");
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