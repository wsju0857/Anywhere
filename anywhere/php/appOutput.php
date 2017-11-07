<?php
   include 'DB.php';
  header("Content-Type: text/html; charset=UTF-8");
 mysql_set_charset("utf8" , $connect);  


 
$res = mysql_query("select * from data order by  name DESC");  
$cul = mysql_num_rows($res);

$result = array();  
   
while($row = mysql_fetch_array($res)){  
  array_push($result,  
    array('name'=>$row[0],'address'=>$row[1],'telnum'=>$row[2],'viewcount'=>$row[3]
    ,'latitude'=>$row[4],'lognitude'=>$row[5],'altitude'=>$row[6] , 'logo' =>$row[7] 
    ));  
}  
   
 
$json = json_encode(array("result"=>$result));
echo $json;
echo $cul;
   
mysql_close($connect);  
   
?>