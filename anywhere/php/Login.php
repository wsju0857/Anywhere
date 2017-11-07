<?php
	include "DB.php";
	session_start();	//세션 사용
	header("Content-Type: text/html; charset=UTF-8");
	$now_page = $_POST['now_page'];
    $id = $_POST['id'];
    $SearchText = $_POST['SearchText'];

	if(!empty($_POST["login_id"]) && !empty($_POST["login_pw"])){
		$memid = $_POST["login_id"];
		$mempw = $_POST["login_pw"];
		$sql = "select * from member where id = '".$memid."' AND pw = '".$mempw."'"; //아이디랑 비밀번호 대조
   		$result = mysql_query($sql);
    	$count = mysql_num_rows($result);
    	
    	if($count == 1){
    		$_SESSION['login_user'] = $memid;
            if($now_page == "http://anywhere9.dothome.co.kr/Search.html"){
                echo "<script>location.href='$now_page?SearchText=$SearchText';</script>";
            }else if($now_page == "http://anywhere9.dothome.co.kr/detail_page.html"){
                echo "<script>location.href='http://anywhere9.dothome.co.kr/php/page_move.php?id=$id';</script>";
            }else{
                echo "<script>location.href='../index.html'</script>";
            }
    	}else{
    		echo "<script>alert('아이디와 비밀번호를 확인해주세요.');location.href='../Login.html';</script>";
    	}
    }
?>