<?php
	session_start();

	if(!empty($_POST["FB_name"])){
		$SFB_N = $_POST["FB_name"];	//���̽��� �̸�
		$SFB_S = $_POST["FB_status"]; //���̽��� ���ӻ��� Ȯ�ο�
		$_SESSION['login_user'] = $SFB_N;
		$_SESSION['login_status'] = $SFB_S;
    	echo "<script>location.href(../index.html);</script>";
    }else{
    	echo "���̵�� ��й�ȣ�� Ȯ�����ּ���.";
    }
?>
