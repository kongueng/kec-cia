<?php
/*
* This file renders the li elements and also the data-attributes.
* Changes: Change db con before main deployment, prevent direct access
* codes:
* 1 = db connection failed
* 2 = query failed
* 3 = query success
*/
@session_start();
class render {
	var $starting_day,$total_days;
	function __construct($date,$month,$year) {
		require_once $_SERVER["DOCUMENT_ROOT"].'/db/db.php';
		$month = mysqli_real_escape_string($con,$month);
		$year = mysqli_real_escape_string($con,$year);
		$_SESSION["month"] = $month;
		$total_days = $this->getTotalDays($month,$year);
		$starting_day = $this->getDayCode($date,$month,$year);
		$empt_total = 42 - $total_days;
		$html=  '<ul id="calendar-month" class="clearfix"><li class="header">SUN</li><li class="header">MON</li><li class="header">TUE</li><li class="header">WED</li><li class="header">THU</li><li class="header">FRI</li><li class="header">SAT</li>';
		while($empt_total!=0 && $starting_day!=0) {
			$html = $html.'<li class="empty"></li>';
			$empt_total--;
			$starting_day--;
		}
		//here get the data.
		$uid = mysqli_real_escape_string($con,$_SESSION['uid']);
		$query = "SELECT date,ttorder FROM attendance WHERE uid='$uid' and month='$month' and year='$year'";
		$res = mysqli_query($con, $query);
		$count = mysqli_num_rows($res);
		if(!$res) { die("1"); } else {
			$data = array();
			for($i=0;$i<$count;$i++) {
				$row = mysqli_fetch_assoc($res);
				$date = $row["date"];
				$ttorder = $row["ttorder"];
				$data += array($date=>$ttorder);
			}
			for($i=1; $i <= $total_days; $i++){
				if(empty($data[$i])) {
					$html = $html."<li id='$i' class='dateli' data-abs-set='0'>$i</li>";
				} else {
					$html = $html."<li id='$i' class='dateli' data-abs-set='$data[$i]'>$i</li>";
				}
			}
			$empt_total %= 7;
			while($empt_total!=0) {
				$html = $html.'<li class="empty"></li>';
				$empt_total--;
			}
			$html = $html.'</ul>';
			echo $html;
		}
		mysqli_close($con);
	}
	function getTotalDays($month,$year) {
		if($month==4||$month==6||$month==9||$month==11) {
			return 30;
		} elseif($month==2) {
			if($year%4==0) {
				return 29;
			} else {
				return 28;
			}
		} else {
			return 31;
		}
	}
	function getDayCode($date,$month,$year) {
		$year_code = 6;
		$month_code_array = array(0,3,3,6,1,4,6,2,5,0,3,5);
		$a = $month -1;
		$month_code = $month_code_array[$a];
		$year_two_digit = $year - 2000;
		//calc the quotient of the year/4
		$cal1 = $year_two_digit/4;
		settype($cal1,'integer'); //changes the float double to integer.
		//add date and last two digit of the year
		$cal2 = $year_two_digit + $date;
		//add both cal1 and cal2
		$cal3 = $cal1 + $cal2;
		//adding month code and year code
		$cal4 = $cal3 + $month_code + $year_code;
		//dividing by 7 to get the day code
		$day_code = $cal4 % 7;
		return $day_code;
	}
}
if( isset($_POST["change"]) ) {
	$month = $_POST["month"];
	$year = $_POST["year"];
	$obj = new render(1,$month,$year);
} else {
	//default rendering;
	$month = date('n');
	$year = date('Y');
	$obj = new render(1,$month,$year);
}
?>
