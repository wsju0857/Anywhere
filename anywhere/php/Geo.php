<script type="text/javascript">
function MyPosition(position) {
	var lat = position.coords.latitude; 
	var lng = position.coords.longitude; 
	//alert("���� : " + lat + " �浵 : " + lng );

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

	f.submit(); // ����
}
function error(){
	var er = document.createElement("span");
	er.innerHTML = "Version Error";
}
window.onload = function() { 
	//���������� �� ���������̼� ���� ���� �Ǵ�
	if (navigator.geolocation) { 
		navigator.geolocation.getCurrentPosition(MyPosition, error);
	} else {
		alert('�������� �ʴ� ����Դϴ�.');
	}
}
</script>