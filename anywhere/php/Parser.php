<?php
include "DB.php";

$client_id = "MOHKzcoj8pF1LgEIeTC5";
$client_secret = "QLzZaFZxSZ";
$encText = urlencode ("한림대학교 스포츠센터");
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
	<form action="../test1.html" method="post" id="s_form">
<?php
	for($i=0;$i<4;$i++){
?>
		<input type="hidden" name="title<?= $i; ?>" value="<?= $blog_result['items'][$i]['title']; ?>">
		<input type="hidden" name="link<?= $i; ?>" value="<?= $blog_result['items'][$i]['link']; ?>">
		<input type="hidden" name="description<?= $i; ?>" value="<?= $blog_result['items'][$i]['description']; ?>">
		<input type="hidden" name="bloggername<?= $i; ?>" value="<?= $blog_result['items'][$i]['bloggername']; ?>">
		<input type="hidden" name="bloggerlink<?= $i; ?>" value="<?= $blog_result['items'][$i]['bloggerlink']; ?>">
		<input type="hidden" name="postdate<?= $i; ?>" value="<?= $blog_result['items'][$i]['postdate']; ?>">
<?php	
	}
?>
	</form>
	<script>
		window.onload = function(){
			document.getElementById('s_form').submit();
		}
	</script>
<?php
} else {
	echo "Error 내용:" . $response;
}
?>