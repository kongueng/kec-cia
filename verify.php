<?php
/*
 * this file is used to verify the registered user and redirect them to the timetable entry.
 * input: hash and user
 * output: 1,2-db query error
 */
if(!isset($_GET["hash"]) && !isset($_GET["user"])) {
	require_once $_SERVER["DOCUMENT_ROOT"].'/includes/redirector.php';
} else {
	//legal
	require_once $_SERVER["DOCUMENT_ROOT"].'/db/db.php';
	$hash = mysqli_real_escape_string($con,$_GET["hash"]);
	$user = mysqli_real_escape_string($con,$_GET["user"]);
	$res = mysqli_query($con,"SELECT * FROM verification WHERE hashcode='$hash' AND uname='$user'");
	if(!$res) { die('Error code:1'); }
	$count = mysqli_num_rows($res);
	if($count===1){
		$rt = mysqli_fetch_array($res);
		$vid = $rt["vid"];
		$q = "DELETE FROM verification WHERE vid=$vid";
		setcookie("verified","",time()-1000);
		$r = mysqli_query($con, $q);
		if(!$r) { die('Error code:2');}
		$message = "Thanks for confirming your email. You're now a registered user. Please <a href='login.php?redirect_to=%2Ftimetable.php'>login</a> to enter your timetable.";
	} else {
		//query fail
		$message = "You're not in our database or else you're already verified. Please <a href='/register.php'>register</a> if you're a new user.";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>KEC Continuous Internal Assessment</title><link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body><div id="form_wrapper" style="width: 80%;"><div class="inner-wrap"><p><?php echo $message; ?></p></div></div></body></html>