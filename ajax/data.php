<?php
/*
 * code 0: success
 * code 1: failed
 */
@session_start();
if( isset($_SESSION['uemailh'] ) && isset($_POST["entry"]) ) {
	//db connection
	require_once $_SERVER["DOCUMENT_ROOT"].'/db/db.php';
	//entry of data into db	
	$entry = mysqli_real_escape_string($con,$_POST['entry']);
	$uid = mysqli_real_escape_string($con,$_SESSION['uid']);
	$month = mysqli_real_escape_string($con,$_SESSION["month"]);
	$year = mysqli_real_escape_string($con,$_POST["year"]);
	$date = mysqli_real_escape_string($con,$_POST["date"]);
	$data = mysqli_real_escape_string($con,$_POST["data"]);
	$after = json_decode(mysqli_real_escape_string($con,$_POST["order"]),true);
	//check for empty fields
	if(empty($data)&&empty($date)&&empty($month)&&empty($year)) {die('2');}
	if($entry==0) {
		//new use insert
		$q1 = "INSERT INTO attendance(uid,date,month,year,ttorder) VALUES($uid,$date,$month,$year,'$data')";
		mysqli_query($con,$q1) ? : die('11');
	} elseif($entry==1) {
		//exisiting use update
		if($_POST["data"] == "0") {
			//delete the entry from the table.
			$q2 = "DELETE FROM attendance WHERE uid=$uid and date=$date and month=$month and year=$year";
			mysqli_query($con,$q2) ? : die('12');
		} else {
			$q2 = "UPDATE attendance SET ttorder='$data' where uid=$uid and date=$date and month=$month and year=$year";
			mysqli_query($con,$q2) ? : die('13');
		}
	}
	$q = "SELECT absencecount FROM users WHERE uid='".$_SESSION["uid"]."'";
	$r = mysqli_fetch_array(mysqli_query($con, $q));
	$prev = unserialize($r["absencecount"]);
	for($i=0; $i<10; $i++) {
		$new[$i] = $prev[$i] + $after[$i]; 
	}
	$_SESSION["total_abs"] = $new[9];
	$serial = serialize($new);
	$q = "UPDATE users SET absencecount='$serial' WHERE uid='".$_SESSION["uid"]."'";
	if(mysqli_query($con, $q)) {
		die('0');
	}
} else {
	//No direct access
	die('<h2 style="text-align:center;font-family:Arial,sans-serif;margin-top:3em;font-size: 4em;">Whoa! No direct access kid</h2>');
}
?>