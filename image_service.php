<?php
session_start();
if (isset($_FILES) and $_FILES['size'] > 0){
    $name = $_SESSION['username'];
    move_uploaded_file($_FILES['profileimg']['tmp_name'], '/public/img/profile/' . $name . '.jpg');
}
?>