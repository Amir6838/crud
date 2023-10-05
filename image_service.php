<?php
//session_start();

function uploadImg($name, $file){
    if ($file['size'] > 0){
        move_uploaded_file($file['tmp_name'], 'public/img/profile/' . $name . '.jpg');
    }
}

?>