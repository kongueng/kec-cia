<?php
//this file is responsible for internal marks.
@session_start();
if(isset($_SESSION["uemailh"])) :
	$logged_in = true;
	require_once $_SERVER["DOCUMENT_ROOT"].'/db/dbp.php';
	if(isset($_POST["sd"]) && isset($_POST["ed"])) {
		//handle received req
		// $stmt = $mysqli->prepare("");
		echo "Successfully saved";
	} else {
	require_once $_SERVER["DOCUMENT_ROOT"].'/includes/header.php';
?>
<div id="outer_container" class="clearfix">
	<div id="container" class="container95">
		<h1 class="notice cen" style="margin-top:0">Settings</h1>
		<!-- <h2 class="tagline cen">We will get it done by tomorrow!</h2> -->
		<div>
			<fieldset class="boxer">
				<legend>Academic Details</legend>
				<label for="startingDate">Semester Starting Date</label><input type="date" id="startingDate">
				<label for="endingDate">Semester Ending Date</label><input type="date" id="endingDate">
			</fieldset>
			<fieldset class="boxer">
				<legend>Notification Preferences</legend>
				<!-- Email Frequency:<br/> -->
				<input type="radio" name="emailFreq">Weekly
				<input type="radio" name="emailFreq">Monthly
				<input type="radio" name="emailFreq" checked>Only When Needed
			</fieldset>
		</div>
		<hr/>
		<button class="button" id="submit" style="display:block;margin:0 auto">Save Options</button>
	</div>
</div>
<script type="text/javascript">
	var sub = document.getElementById("submit");
	sub.onclick = function() {
		var sD = document.getElementById("startingDate").value, eD = document.getElementById("endingDate").value;
		var xmlHttp;
		if (window.XMLHttpRequest) {
			xmlHttp = new XMLHttpRequest();
		} else {
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlHttp.onreadystatechange = function() {
			if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
				alert(xmlHttp.responseText);
			}
		}
		xmlHttp.open("POST", "/settings.php", true);
		xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xmlHttp.send("sd="+sD+"&ed="+eD);
	}
</script>
<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/includes/footer.php';
	}
else:
	//for non-loggedin users
	header("Location: /login.php?redirect_to=".$_SERVER['PHP_SELF']);
endif;
?>