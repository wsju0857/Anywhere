<script>
  	function statusChangeCallback(response) {
    	if (response.status === 'connected') {
      		testAPI();
    	} else {
      		
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

  		FB.getLoginStatus(function(response) {
    		statusChangeCallback(response);	//응답을 처리하는 함수
  		});

		FB.Event.subscribe('auth.login', function(response) {
		    document.location.reload();
		});

		FB.Event.subscribe('auth.logout', function(response) {
		    document.location.reload();
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
        	/*
    		var FBform = document.createElement("form");
    		FBform.setAttribute("method","post");
    		FBform.setAttribute("action","php/FBLogin.php");
    		document.body.appendChild(FBform);

    		var FB_name = document.createElement("input");  
    		FB_name.setAttribute("type", "hidden");                 
    		FB_name.setAttribute("name", "FB_name");                        
    		FB_name.setAttribute("value", response.name);                          
    		FBform.appendChild(FB_name);

    		FBform.submit();
    		*/
    	});
  	}
	</script>