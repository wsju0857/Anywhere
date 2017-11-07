<?php
	include "DB.php";

	session_start();
	
	$postcode = $_POST['chk_code'];
	$id = $_SESSION['login_user'];
	
	$chkdb_code = mysql_query("select code from member where id='$id'");
	$chkdb_code_result = mysql_fetch_array($chkdb_code);
	
	if($chkdb_code_result[0] != $postcode){
		echo "<script>alert('※ 인증코드가 일치하지 않습니다. 인증코드를 확인해주세요.');</script>";
		echo "<script>history.back();</script>";
	}else{
		$update_db = mysql_query("update member set Chkmail='정회원' where id='$id'");
		echo "<script>location.href='../index.html';</script>";
	}
?>