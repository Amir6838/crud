<?php

class DataBase
{
    public $DbHoste = 'localhost';
    public $DbName = 'crud';
    public $DbUserName = 'root';
    public $DbPassWord = '';

    public $conn;

    public function __construct()
    {
        $this->conn = new PDO("mysql:host=$this->DbHoste;dbname=$this->DbName;charset=UTF8", $this->DbUserName, $this->DbPassWord);
    }

    function save($username, $email, $password)
    {
        $password = md5($password);
        $this->conn->exec("INSERT INTO `user` (`username`, `email`, `password`) VALUES ('$username','$email','$password')");
        echo 'ok';
    }

    function search($username = '', $email = '', $password = ''){
        $password = md5($password);
        //echo "SELECT * FROM `user` WHERE `username` = '$username' OR `email` = '$email' OR `password` = '$password'";
        $search = $this->conn->query("SELECT * FROM `user` WHERE `username` = '$username' OR `email` = '$email' OR `password` = '$password'");
        $search->execute();
        if ($search->rowCount() == 0)
            return false;
        else
        return $search->fetch();
    }

}

?>