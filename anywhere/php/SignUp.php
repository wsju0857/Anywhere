<?php
	include "DB.php";
	header("Content-Type: text/html; charset=UTF-8");
	
	$signid = $_POST['Sign_id'];
	$signpw = $_POST['Sign_pw'];
	$signname = $_POST['Sign_name'];
	$signemail = $_POST['Sign_email'];
	
	$idchk = mysql_query("select id from member where id='$signid'");
	$emailchk = mysql_query("select email from member where email='$signemail'");
	
	$idcount = mysql_num_rows($idchk);
	$emailcount = mysql_num_rows($emailchk);
	
	if($idcount == 1){
		echo "<script>alert('이미 사용중인 아이디입니다.');</script>";
		echo "<script>history.back();</script>";
		$dquery = mysql_query("delete from member where id=''");
	}else if($emailcount == 1){
		echo "<script>alert('이미 사용중인 이메일입니다.');</script>";
		echo "<script>history.back();</script>";
		$dquery = mysql_query("delete from member where id=''");
	}else{
		echo '<script>alert(" ※ 환영합니다. 성공적으로 가입되었습니다.^^\n ※ 일부기능이 제한될 수 있으니 이메일 인증을 해주세요.");</script>';
		$query = mysql_query("insert into member(id,pw,name,email)
				values('$signid','$signpw','$signname','$signemail')");
		echo "<script>location.href='../index.html';</script>";
	}
	mysql_close($connect);
?>
<html>
<head>
</head>
<body>
<div id="loading-animation">&nbsp;</div>
</body>
</html>