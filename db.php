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
        $this->conn->exec("INSERT INTO `user` (`username`, `email`, `password`, `profile`) VALUES ('$username','$email','$password', 'public/img/vector.jpg')");
        //echo "INSERT INTO `user` (`username`, `email`, `password`) VALUES ('$username','$email','$password', 'public/img/vector.jpg')";
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

    function update($usernameid, $username = null, $email = null, $password = null, $fname = null, $lname = null, $profile = null){
        $query = "UPDATE `user` SET ";

        if ($username != null and strcmp($username , '') != 0){
            $query .= "`username`='$username',";
        }

        if ($email != null and strcmp($email , '') != 0){
            $query .= "`email`='$email',";
        }

        if ($password != null and strcmp($password , '') != 0){
            $query .= "`password`=" . "'" . md5($password) . "'" . ",";
        }

        if ($fname != null and strcmp($fname , '') != 0){
            $query .= "`fname`='$fname',";
        }

        if ($lname != null and strcmp($lname , '') != 0){
            $query .= "`lname`='$lname',";
        }

        if ($profile != null and strcmp($profile , '') != 0){
            $query .= "`profile`='$profile',";
        }

        $query = substr($query,0,-1) . "WHERE `username` = '$usernameid'";
        //echo $query;
        $this->conn->exec($query);

    }



}

?>