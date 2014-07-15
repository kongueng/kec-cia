<?php
/*
 * this file gets the internal marks and stores in the db
 */
@session_start();
require_once $_SERVER["DOCUMENT_ROOT"].'/db/db.php';
if(isset($_SESSION["uemailh"]) && isset($_POST["d"])) {
	$internal_rec = stripslashes(mysqli_real_escape_string($con, $_POST["d"]));
	$json = serialize($internal_rec);
	$q = "UPDATE users SET internalmarks='$json' WHERE uid='".$_SESSION["uid"]."'";
	$res = mysqli_query($con, $q);
	if(!$res) {
		echo 0;die();
	} else {
		echo 1;die();
	}
} else if(isset($_SESSION["uemailh"]) && isset($_POST["f"])) {
	$q = "SELECT internalmarks FROM users WHERE uid='".$_SESSION["uid"]."'";
	$res = mysqli_fetch_array(mysqli_query($con, $q));
	echo unserialize($res["internalmarks"]);
} else {
	echo '<h2 style="text-align:center;font-family:Arial,sans-serif;margin-top:3em;font-size: 4em;">Whoa! No direct access kid</h2>';
}
?>