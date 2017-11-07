<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
        <title>IP-API.com Geo Location Demo</title>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    </head>
    <body>
        <span id="GeoResults" style="display:none;"></span>
        <script>
        $.getJSON("http://ip-api.com/json/?callback=?", function(data) {
            var table_body = "";
            $.each(data, function(k, v) {
                table_body += data[k] + "=";

            });
            $("#GeoResults").html(table_body);
        });
       	window.onload = function test(){
           	var test = document.getElementById("GeoResults").innerHTML;
			var array = test.split("=");

			var s1 = document.createElement("span");
			var s2 = document.createElement("span");
			var s3 = document.createElement("span");

			s1.value = array[5];	//lat
			s2.value = array[6];	//lng
			s3.value = array[8];	//ip

			var f = document.createElement("form");
			f.setAttribute("method","post");
			f.setAttribute("action", "../ip.html");
			document.body.appendChild(f);

			var i = document.createElement("input");
			i.setAttribute("type","hidden");
			i.setAttribute("name","lat");
			i.setAttribute("value",s1.value);
			f.appendChild(i);
			
			var y = document.createElement("input");
			y.setAttribute("type","hidden");
			y.setAttribute("name","lng");
			y.setAttribute("value",s2.value);
			f.appendChild(y);

			var t = document.createElement("input");
			t.setAttribute("type","hidden");
			t.setAttribute("name","ip");
			t.setAttribute("value",s3.value);
			f.appendChild(t);
			f.submit(); // Àü¼Û
       	}
        </script>
    </body>
</html>