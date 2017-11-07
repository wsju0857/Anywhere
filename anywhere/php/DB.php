<?php
	header("Pragma : no-cache"); 
	header("Cache-Control : no-cache"); 

	$connect = @mysql_connect("115.68.230.30","root","roal0909!") or die("error mysql connect");
	mysql_query("set names utf8");
	mysql_query("set session character_set_connection=utf8;");
	mysql_query("set session character_set_results=utf8;");
	mysql_query("set session character_set_client=utf8;");
	mysql_select_db("anywhere",$connect);
?>