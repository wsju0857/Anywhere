<?php
	include "DB.php";  
    $file_path = "../UserImageFolder/";
     
    $file_path = $file_path.basename( $_FILES['uploaded_file']['name']);

    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
        echo "success";
    } else{
        echo "fail";
    }
 ?>


