<?php
/*
 * code 0: success
 * code 1: failed
 */
@session_start();
if( isset($_SESSION['uemailh'] ) && isset($_POST["entry"]) ) {
	//db connection
//        require_once $_SERVER["DOCUMENT_ROOT"].'/db/db.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/db/dbp.php';
        
	//entry of data into db	
//	$entry = mysqli_real_escape_string($con,$_POST['entry']);
//	$uid = mysqli_real_escape_string($con,$_SESSION['uid']);
//      $date = mysqli_real_escape_string($con,$_POST["date"]);
//	$month = mysqli_real_escape_string($con,$_SESSION["month"]);
//	$year = mysqli_real_escape_string($con,$_POST["year"]);
//	$data = mysqli_real_escape_string($con,$_POST["data"]);
        $entry = $_POST['entry'];
	$uid = $_SESSION['uid'];
        $date = $_POST["date"];
	$month = $_SESSION["month"];
	$year = $_POST["year"];
	$data = $_POST["data"];
//	$after = json_decode(mysqli_real_escape_string($con,$_POST["order"]),true);
	$after = json_decode($_POST["order"], true);
	//check for empty fields
	if(empty($data)&&empty($date)&&empty($month)&&empty($year)) {die('2');}
	if($entry==0) {
		//new use insert
            $stmt = $mysqli->prepare("INSERT INTO attendance(uid,date,month,year,ttorder) VALUES(?,?,?,?,?)");
            $stmt->bind_param("iiiis", $uid, $date, $month, $year, $data);
            $stmt->execute() ? : die('11');
            $stmt->close();
	} elseif($entry==1) {
		//exisiting use update
		if($_POST["data"] == "0") {
			//delete the entry from the table.
                    $stmt = $mysqli->prepare("DELETE FROM attendance WHERE uid=? and date=? and month=? and year=?");
                    $stmt->bind_param("iiii", $uid, $date, $month, $year);
                    $stmt->execute() ? : die('12');
                    $stmt->close();
		} else {
                    $stmt = $mysqli->prepare("UPDATE attendance SET ttorder=? where uid=? and date=? and month=? and year=?");
                    $stmt->bind_param("siiii", $data, $uid, $date, $month, $year);
                    $stmt->execute() ? : die('13');
                    $stmt->close();
		}
	}
        //below code calculates overall attendance count and updates in the database.
        $stmt = $mysqli->prepare("SELECT absencecount FROM users WHERE uid=?");
        $stmt->bind_param("i", $uid);
        $stmt->execute();
        $res = $stmt->get_result();
        $r = $res->fetch_array(MYSQLI_ASSOC);
        $stmt->close();
	$prev = unserialize($r["absencecount"]);
	for($i=0; $i<10; $i++) {
            $new[$i] = $prev[$i] + $after[$i];
	}
	$_SESSION["total_abs"] = $new[9];
	$serial = serialize($new);
        $stmt = $mysqli->prepare("UPDATE users SET absencecount=? WHERE uid=?");
        $stmt->bind_param("ss", $serial, $uid);
        if($stmt->execute()) {
            $stmt->close();
            die('0');
        }
} else {
	//No direct access
	die('<h2 style="text-align:center;font-family:Arial,sans-serif;margin-top:3em;font-size: 4em;">Whoa! No direct access kid</h2>');
}
?>