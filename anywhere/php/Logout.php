<?php
	include "DB.php";
	session_start();
	$now_page = $_POST['now_page'];
  $id = $_POST['id'];
  $SearchText = $_POST['SearchText'];

	if($_SESSION['login_status'] == "undefined"){
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<script>
function statusChangeCallback(response) {
    	if (response.status === 'connected') {
      		testAPI();
    	} else if(response.status === 'not_authorized'){
      		alert('권한이 없습니다');
    	} else{

    	}
  	}
  	function checkLoginState() {
    	FB.getLoginStatus(function(response) {
      		statusChangeCallback(response);
    	});
  	}
  	window.fbAsyncInit = function() {
  		FB.init({
    		appId      : '737394976437979',
    		cookie     : true,
    		xfbml      : true,
    		version    : 'v2.8'
  		});

  		FB.getLoginStatus(function(response){
    		statusChangeCallback(response);
  		});

		FB.Event.subscribe('auth.login', function(response) {
		    //document.location.reload();
		});
		FB.Event.subscribe('auth.logout', function(response) {
			location.href = "../index.html";
		});
	};

  	(function(d, s, id) {
    	var js, fjs = d.getElementsByTagName(s)[0];
    	if (d.getElementById(id)) return;
    	js = d.createElement(s); js.id = id;
    	js.src = "//connect.facebook.net/ko_KR/sdk.js#xfbml=1&version=v2.8&appId=737394976437979";
    	fjs.parentNode.insertBefore(js, fjs);
  	}(document, 'script', 'facebook-jssdk'));

  	function testAPI() {
    	FB.api('/me', function(response) {
			window.onload(DFB.click());
    	});
  	}
	</script>
<body>
	<div id="loading-animation">&nbsp;</div>
	<a href="#" id="DFB" onclick="FB.logout();" style="display:none;">로그아웃</a><br>
</body>
</html>
<?php
		session_destroy();
		mysql_close($connect);
	}else{
    session_destroy();
    mysql_close($connect);
    if($now_page == "http://anywhere9.dothome.co.kr/Search.html"){
      echo "<script>location.href='../Search.html?SearchText=$SearchText';</script>";
    }else if($now_page == "http://anywhere9.dothome.co.kr/detail_page.html"){
      echo "<script>location.href='page_move.php?id=$id';</script>";
    }else{
      echo "<script>location.href='../index.html';</script>";
    }
    
	}
	
?>