<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<?php
	include "DB.php";
	header("Content-Type: text/html; charset=utf-8");
	header("Cache-Control:no-cashe");
	header("Pragma:no-cashe");
	
	$get_value =  $_GET['id'];	


	$query = mysql_query("select * from data where name='$get_value'");
	$data = mysql_fetch_array($query);
	
	$viewcount_query = mysql_query("update data set viewcount=viewcount+1 where name='$get_value'");	//조회 수 증가
	$viewcount_query2 = mysql_query("update data_pic set viewcount=viewcount+1 where name='$get_value'");
	
	$imgquery = mysql_query("select * from data_pic where name='$get_value'");
	$imgdata = mysql_fetch_array($imgquery);
	$imgcount = mysql_num_fields($imgquery);
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// 파싱 블로그 불러오기
	$client_id = "MOHKzcoj8pF1LgEIeTC5";
	$client_secret = "QLzZaFZxSZ";
	$encText = urlencode ($get_value);
	$url = "https://openapi.naver.com/v1/search/blog.json?display=4&query=" . $encText; // json 결과
	// $url = "https://openapi.naver.com/v1/search/blog.xml?query=".$encText; // xml 결과
	$is_post = false;
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_URL, $url );
	curl_setopt ( $ch, CURLOPT_POST, $is_post );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
	$headers = array ();
	$headers [] = "X-Naver-Client-Id: " . $client_id;
	$headers [] = "X-Naver-Client-Secret: " . $client_secret;
	curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
	curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
	$response = curl_exec ( $ch );
	
	$blog_result = json_decode($response, true);
	
	$status_code = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );
	curl_close ( $ch );
	if ($status_code == 200) {
		?>
		<form action="../detail_page.html" method="post" id="sform1">
	<?php
		for($i=0;$i<4;$i++){
	?>
			<input type="hidden" name="go" value="go">
 			<input type="hidden" name="title<?= $i; ?>" value="<?= $blog_result['items'][$i]['title']; ?>">
			<input type="hidden" name="link<?= $i; ?>" value="<?= $blog_result['items'][$i]['link']; ?>">
			<input type="hidden" name="description<?= $i; ?>" value="<?= $blog_result['items'][$i]['description']; ?>">
			<input type="hidden" name="bloggername<?= $i; ?>" value="<?= $blog_result['items'][$i]['bloggername']; ?>">
			<input type="hidden" name="bloggerlink<?= $i; ?>" value="<?= $blog_result['items'][$i]['bloggerlink']; ?>">
			<input type="hidden" name="postdate<?= $i; ?>" value="<?= $blog_result['items'][$i]['postdate']; ?>">	
	<?php	
		}
		for($i=0;$i<=$imgcount;$i++){
	?>
			<input type="hidden" name="img<?= $i; ?>" value="<?= $imgdata[$i]; ?>">	<!-- 이미지 -->
	<?php 
		}
	?>
			<input type="hidden" name="name" value="<?= $data[0]; ?>">		<!-- 이름 -->
			<input type="hidden" name="address" value="<?= $data[1]; ?>">	<!-- 주소 -->
			<input type="hidden" name="telnum" value="<?= $data[2]; ?>">	<!-- 전화번호 -->
			<input type="hidden" name="viewcount" value="<?= $data[3]; ?>">	<!-- 조회수 -->
			<input type="hidden" name="latitude" value="<?= $data[4]; ?>">	<!-- 위도 -->
			<input type="hidden" name="longitude" value="<?= $data[5]; ?>">	<!-- 경도 -->
			<input type="hidden" name="imgcount" value="<?= $imgcount; ?>">	<!-- 사진 수 -->
		</form>
	<?php
	} else {
		echo "Error 내용:" . $response;
	}
	?>
<body>
	<script>
		window.onload = function(){
			document.getElementById('sform1').submit();
		}
	</script>
</body>