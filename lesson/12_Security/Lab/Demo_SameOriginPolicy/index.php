<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Lab</title>
<?php require("script_css.php") ?>
</head>
<body>
	<div id="labPage" data-role="page" data-theme="d">
		<div data-role="header">
			<h3>Lab</h3>
		</div>
		
		<div data-role="content">
			<ol>
				<li>瀏覽器網址連到的是 localhost。(註: 第二個按鈕會從 127.0.0.1 查資料)
				<li>修改getTime.php，加入 Access-Control-Allow-Origin 標頭
			</ol>
			<button id="btnGetFromOrigin" onclick="btnGetFromOrigin_click()">Get Data from Origin.</button>
			<button id="btnGetFromMonster" onclick="btnGetFromMonster_click()">Get Data from 127.0.0.1</button>
			<div id="result" style="font-size: 2em"></div>
		</div>
		
	</div>
	<!-- page -->

	<script>
		function btnGetFromOrigin_click() {
			$.get("getTime.php", doDataback);
		}
		
		function btnGetFromMonster_click() {
			$.get("http://127.0.0.1/Lab/Demo_SameOriginPolicy/getTime.php", 
					doDataback);
		}
		
		function doDataback(data) {
			$("#result").text(data);
		}
		
	</script>
</body>
</html>
