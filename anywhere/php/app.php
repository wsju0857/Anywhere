<?php
   include 'DB.php';
	header("Content-Type: text/html; charset=UTF-8");


$name = isset($_POST['name']) ? $_POST['name'] : '';  
$pw = isset($_POST['pw']) ? $_POST['pw'] : '';  
$imagepath =  isset($_POST['imagepath']) ? $_POST['imagepath'] : '';

$sql="insert into Apptest( name , pw , imagepath) values('$name','$pw' , '$imagepath')";  
$result=mysql_query($sql);  

if ($name !="" and $pw !=""  and $imagepath != ""){   
    if($result){  
       echo 'success';  
    }  
    else{  
       echo $sql;
       echo "<br />";
       echo 'failure';  
    }  
}  
  
mysql_close($connect);
?> 

<html>
   <body>
   
      <form action="<?php $_PHP_SELF ?>" method="POST">
         Name: <input type = "text" name = "name" />
         pw: <input type = "text" name = "pw" />
         img: <input type = "text" name = "imagepath" />

         <input type = "submit" />
      </form>
   
   </body>
</html>
