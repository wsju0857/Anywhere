<html>
<head>
</head>
<body>
<div id="loading-animation">&nbsp;</div>
<?php
	include "DB.php";
	session_start();
	header("Content-Type: text/html; charset=UTF-8");
	
	$name = $_SESSION['login_user'];
	
	$original = $_FILES['Screenshot']['name'];
	$screenshot = '['.$name.']'.$_FILES['Screenshot']['name']; //이미지 이름
	$target = '../UserImageFolder/'.$screenshot;	//Image를 저장 할 경로
	$screenshot_type = $_FILES['Screenshot']['type'];	//파일 타입
	$screenshot_size = $_FILES['Screenshot']['size'];	//파일 사이즈
	$tmp_name = $_FILES['Screenshot']['tmp_name'];	//임시로 이미지가 저장될 장소
	$error = $_FILES['Screenshot']['error'];	//파일 에러코드
	
	move_uploaded_file($tmp_name, $target);	//폴더로 이동
	
	$oldimg = mysql_query("select ImgName from member where id='$name'");
	$oldimgname = mysql_fetch_array($oldimg);
	
	$mpw = $_POST['modify_pw'];
	$memail = $_POST['modify_email'];
	
	if($error == 0){
		unlink("../UserImageFolder/[$name]$oldimgname[0]");	//기존 사진 삭제
		$updatequery = mysql_query("update member set ImgName='$original' where id='$name'");	//db 업데이트
		$updatequery = mysql_query("update member set Pw='$mpw' where id='$name'");
		$updatequery = mysql_query("update member set Email='$memail' where id='$name'");
		echo "<script>location.href='../index.html';</script>";
	}
	else{
		switch($_FILES['Screenshot']['error']){
			case 1:	//업로드한 파일 크기가 PHP 'upload_max_filesize' 설정값보다 클 경우
				echo '<script>alert("※ 최대 바이트를 초과했습니다.\n※ 33,459바이트 이하의 사진을 업로드 해주세요.");history.back();</script>';
				break;
			case 2:	//업로드한 파일 크기가 HTML 폼에 명시한 MAX_FILE_SIZE 값보다 클 경우
				echo '<script>alert("※ 최대 바이트를 초과했습니다.\n※ 33,459바이트 이하의 사진을 업로드 해주세요.");history.back();</script>';
				break;
			case 3:	//파일중 일부만 전송된 경우
				echo '<script>alert("※ 1업로드 중 오류가 발생했습니다. 다시 시도해주세요.");history.back();</script>';
				break;
			case 4:	//파일이 전송되지 않았을 경우
				$updatequery = mysql_query("update member set ImgName='$oldimgname[0]' where id='$name'");	//db 업데이트
				$updatequery = mysql_query("update member set Pw='$mpw' where id='$name'");
				$updatequery = mysql_query("update member set Email='$memail' where id='$name'");
				echo "<script>location.href='../index.html';</script>";
		}
	}
?>

</body>
</html>
