<?php 
include "DB.php";
header("Content-Type: text/html; charset=UTF-8");
require_once('../PHPMailer/PHPMailerAutoload.php');

$postid = $_POST['Search_id'];
$postname = $_POST['Search_name'];
$postmail = $_POST['Search_email'];

$chk_query = mysql_query("select Name,Email,PW from member where id='$postid' and name='$postname' and Email='$postmail'");
$chkquery_result = mysql_fetch_array($chk_query);

$content = "<div style='width:100%; background-size:70%; background-repeat:no-repeat; height:454px;
			background-image:url(https://cloud.githubusercontent.com/assets/28043495/25901641/50f5d70a-35d2-11e7-88c8-b002624ac387.png);'>
				<br><br><br><br><h1 style='text-indent:220px; color:white;'>안녕하세요 AnyWhere 입니다.</h1><br><br><br><br>
				<span style='text-indent:250px; color:white; display:inline-block; font-size:15px;'>
					회원님의 비밀번호는 <strong>$chkquery_result[2]</strong> 입니다.</span><br><br><br><br>
				<span style='text-indent:230px; color:white; display:inline-block; font-size:15px;'>
					© 2017 Hallym Team KT - All Rights Reserved</span>
			</div>";

if($chkquery_result[0] == NULL){
	echo "<script>alert('입력한 정보를 확인해주세요.');history.back();</script>";
}else{
	$mail = new PHPMailer(true);
	$mail->IsSMTP();
	try {
		$mail->CharSet = "UTF-8";
		$mail->Encoding = "base64";
		$mail->Host = "smtp.gmail.com";    // email 보낼때 사용할 서버를 지정
		$mail->SMTPAuth = true;              // SMTP 인증을 사용함
		$mail->Port = 465;                        // email 보낼때 사용할 포트를 지정
		$mail->SMTPSecure = "ssl";        // SSL을 사용함
		$mail->Username   = "wsju0857@gmail.com";    // Gmail 계정
		$mail->Password   = "skdlzl99";            // 패스워드
	
		$mail->SetFrom('wsju0857@gmail.com', 'AnyWhere'); // 보내는 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
		$mail->AddAddress($chkquery_result[1], $chkquery_result[0]); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
		$mail->Subject = 'AnyWhere 비밀번호찾기입니다.';        // 메일 제목
		$mail->MsgHTML($content);    // 메일 내용 (HTML 형식도 되고 그냥 일반 텍스트도 사용 가능함)
	
		$mail->Send();                                // 실제로 메일을 보냄
		echo "<script>alert('입력한 이메일 주소로 메일을 발송했습니다.');</script>";	//성공
		echo "<script>location.href='../index.html';</script>";
	} catch (phpmailerException $e) {
		echo $e->errorMessage(); //Pretty error messages from PHPMailer
	} catch (Exception $e) {
		echo $e->getMessage(); //Boring error messages from anything else!
	}
}
?>