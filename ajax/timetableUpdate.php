<?php
/*
 * function: this file is responsible for entry and update of the timetable from the user
 *
 * 2- successful insertion
 */
@session_start();
if( !isset($_POST["j"]) || !isset($_POST["sub"]) || !isset($_SESSION["uemailh"])) {
	//false advertising
	die ('<h2 style="text-align:center;font-family:Arial,sans-serif;margin-top:3em;font-size: 4em;">Whoa! No direct access kid</h2>');
} else {
	//true
	require_once "../db/db.php";
	$json_str = stripslashes(mysqli_real_escape_string($con, $_POST["j"]));
	$subjects = stripslashes(mysqli_real_escape_string($con, $_POST["sub"]));
	$sub = serialize($subjects);
	$json = json_decode($json_str,true);
	$mon = base64_encode(serialize(json_encode($json["mon"])));
	$tue = base64_encode(serialize(json_encode($json["tue"])));
	$wed = base64_encode(serialize(json_encode($json["wed"])));
	$thu = base64_encode(serialize(json_encode($json["thu"])));
	$fri = base64_encode(serialize(json_encode($json["fri"])));
	$sat = base64_encode(serialize(json_encode($json["sat"])));
	$q1 = "INSERT INTO subjects(slist,classcode) VALUES('$sub','".$_SESSION['classcode']."')";
	$r1 = mysqli_query($con, $q1);
	if(!$r1) {die("Insertion Error in Sub");}
	$q2 = "INSERT INTO timetable(classcode, mon, tue, wed, thu, fri, sat, createdby) VALUES('". $_SESSION['classcode'] ."','$mon', '$tue', '$wed', '$thu', '$fri', '$sat',".$_SESSION['uid'].")";
	$r2 = mysqli_query($con, $q2);
	if(!$r2) {die("Insertion Error in TT");}
	setcookie("tt","",time()-1000);
	echo 2;
}
?>