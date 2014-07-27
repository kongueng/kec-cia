<!DOCTYPE html>
<html>
<head>
	<title>KEC Continuous Internal Assessment Tracker</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="/css/main.css" type="text/css">
	<style type="text/css">
	#form_wrapper {width: 35%;}
	</style>
</head>
<body onload="timer()">
	<div id="form_wrapper">
		<div class="inner-wrap">
			<p>Oh ho! That's something weird! You'll be redirected in <span id="seconds"></span></p>
		</div>
	</div>
	<script type="text/javascript">
	var elmt = document.getElementById("seconds");
	var content = elmt.innerHTML;
	var initial = 3;
	function timer() {
		elmt.innerHTML = initial;
		initial -= 1;
		if(initial > 0)
			setTimeout("timer()", 1000);
		else
			location.href = "/";
	}
	</script>
</body>
</html>