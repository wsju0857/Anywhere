<?php
	session_start();

	if(!empty($_POST["FB_name"])){
		$SFB_N = $_POST["FB_name"];	//페이스북 이름
		$SFB_S = $_POST["FB_status"]; //페이스북 접속상태 확인용
		$_SESSION['login_user'] = $SFB_N;
		$_SESSION['login_status'] = $SFB_S;
    	echo "<script>location.href(../index.html);</script>";
    }else{
    	echo "아이디와 비밀번호를 확인해주세요.";
    }
?>
