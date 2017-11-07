<?php
   include 'DB.php';
  header("Content-Type: text/html; charset=UTF-8");
 mysql_set_charset("utf8" , $connect);  


 
$res = mysql_query("select * from data_pic order by name  desc");  
$cul = mysql_num_rows($res);

$result = array();  
   
while($row = mysql_fetch_array($res)){  
  array_push($result,  
    array('name'=>$row[0],'viewcount'=>$row[1],'pic1'=>$row[2],'pic2'=>$row[3]
    ,'pic3'=>$row[4],'pic4'=>$row[5],'pic5'=>$row[6] ,'pic6'=>$row[7]  ,'pic7'=>$row[8]  
    ));  
}  
   
 
$json = json_encode(array("result"=>$result));
echo $json;
echo $cul;
   
mysql_close($connect);  
   
?>