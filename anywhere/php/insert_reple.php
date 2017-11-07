<?php

	include "DB.php";
	session_start();

	$name = $_POST['name'];
	$user = $_SESSION['login_user'];
	$grade = $_POST['grade'];
	$reple = $_POST['reple'];
	
	$date = date("Y-m-d");

	$insert_query = mysql_query("insert into reple(name,id,grade,reple,date) values('$name','$user','$grade','$reple','$date')");
	echo "<script>location.href='http://anywhere9.dothome.co.kr/php/page_move.php?id=$name'</script>";

?>