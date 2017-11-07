<script type="text/javascript">
function MyPosition(position) {
	var lat = position.coords.latitude; 
	var lng = position.coords.longitude; 
	//alert("위도 : " + lat + " 경도 : " + lng );

	var f = document.createElement("form");
	f.setAttribute("method","post");
	f.setAttribute("action","../Geo.html");
	document.body.appendChild(f);

	var i = document.createElement("input");
	i.setAttribute("type","hidden");
	i.setAttribute("name","lat");
	i.setAttribute("value",lat);
	f.appendChild(i);
	
	var y = document.createElement("input");
	y.setAttribute("type","hidden");
	y.setAttribute("name","lng");
	y.setAttribute("value",lng);
	f.appendChild(y);

	f.submit(); // 전송
}
function error(){
	var er = document.createElement("span");
	er.innerHTML = "Version Error";
}
window.onload = function() { 
	//브라우저에서 웹 지오로케이션 지원 여부 판단
	if (navigator.geolocation) { 
		navigator.geolocation.getCurrentPosition(MyPosition, error);
	} else {
		alert('지원하지 않는 기기입니다.');
	}
}
</script>