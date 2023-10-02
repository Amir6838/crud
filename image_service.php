<?php
if (isset($_FILES) and $_FILES['size'] > 0){
    move_uploaded_file($_FILES['profileimg']['tmp_name'], '/public/img');
}
?>