<?php 
include "DB.php";
session_start();
header("Content-Type: text/html; charset=UTF-8");
require_once('../PHPMailer/PHPMailerAutoload.php');

$postname = $_POST['chk_name'];
$postmail = $_POST['chk_mail'];
$id = $_SESSION['login_user'];

$chkname_query = mysql_query("select Name from member where id='$id'");
$chkmail_query = mysql_query("select Email from member where id='$id'");
$namequery_result = mysql_fetch_array($chkname_query);
$mailquery_result = mysql_fetch_array($chkmail_query);

$alpha = implode(range('a', 'z'));
$ran_num = sprintf('%05d',mt_rand(0,99999));
$ran_code = ($alpha[mt_rand(0, strlen($alpha)-1)].$ran_num);

$content = "<div style='width:100%; background-size:70%; background-repeat:no-repeat; height:454px;
			background-image:url(https://cloud.githubusercontent.com/assets/28043495/25901641/50f5d70a-35d2-11e7-88c8-b002624ac387.png);'>
				<br><br><br><br><h1 style='text-indent:220px; color:white;'>안녕하세요 AnyWhere 입니다.</h1><br><br><br><br>
				<span style='text-indent:250px; color:white; display:inline-block; font-size:15px;'>
					회원님의 비밀번호는 <strong>$ran_code</strong> 입니다.</span><br><br><br><br>
				<span style='text-indent:230px; color:white; display:inline-block; font-size:15px;'>
					© 2017 Hallym Team KT - All Rights Reserved</span>
			</div>";

if($namequery_result[0] != $postname){
	echo "<script>alert('입력한 정보를 확인해주세요.');history.back();</script>";
}else if($mailquery_result[0] != $postmail){
	echo "<script>alert('입력한 정보를 확인해주세요.');history.back();</script>";
}else{
	$insert_ran_code = mysql_query("update member set code='$ran_code' where id='$id'");
	$mail = new PHPMailer(true);
	$mail->IsSMTP();
	try {
		$mail->CharSet = "UTF-8";
		$mail->Encoding = "base64";
		$mail->Host = "smtp.gmail.com";    // email 蹂대궪�븣 �궗�슜�븷 �꽌踰꾨�� 吏��젙
		$mail->SMTPAuth = true;              // SMTP �씤利앹쓣 �궗�슜�븿
		$mail->Port = 465;                        // email 蹂대궪�븣 �궗�슜�븷 �룷�듃瑜� 吏��젙
		$mail->SMTPSecure = "ssl";        // SSL�쓣 �궗�슜�븿
		$mail->Username   = "wsju0857@gmail.com";    // Gmail 怨꾩젙
		$mail->Password   = "skdlzl99";            // �뙣�뒪�썙�뱶
	
		$mail->SetFrom('wsju0857@gmail.com', 'AnyWhere'); // 蹂대궡�뒗 �궗�엺 email 二쇱냼�� �몴�떆�맆 �씠由� (�몴�떆�맆 �씠由꾩� �깮�왂媛��뒫)
		$mail->AddAddress($mailquery_result[0], $namequery_result[0]); // 諛쏆쓣 �궗�엺 email 二쇱냼�� �몴�떆�맆 �씠由� (�몴�떆�맆 �씠由꾩� �깮�왂媛��뒫)
		$mail->Subject = 'AnyWhere 이메일 인증입니다.';        // 硫붿씪 �젣紐�
		$mail->MsgHTML($content);    // 硫붿씪 �궡�슜 (HTML �삎�떇�룄 �릺怨� 洹몃깷 �씪諛� �뀓�뒪�듃�룄 �궗�슜 媛��뒫�븿)
	
		$mail->Send();                                // �떎�젣濡� 硫붿씪�쓣 蹂대깂
		echo "<script>alert('입력한 이메일 주소로 메일을 발송했습니다.');</script>";	//�꽦怨�
		echo "<script>location.href='../Email2.html';</script>";
	} catch (phpmailerException $e) {
		echo $e->errorMessage(); //Pretty error messages from PHPMailer
	} catch (Exception $e) {
		echo $e->getMessage(); //Boring error messages from anything else!
	}
}
?>