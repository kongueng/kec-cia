<!DOCTYPE html>
<html>
<head>
<?php
	function headAppender($str){
		$headDefault = '<title>KEC Tracker</title><meta charset="UTF-8"><link rel="stylesheet" href="/css/main.css" type="text/css"><script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>';
		$render = $headDefault.$str;
		echo $render;
	}
?>
</head>
<body>
	<div id="topbar">
		<div class="inner clearfix">
			<div id="logo">
				<a href="/" title="KEC Tracker Home">KEC Tracker</a>
			</div>
			<ul id="navbar">
				<?php
					//logged users
					if( $logged_in ):
				?>
					<li class="hoverer"><a href="/attendance.php" title="Enter your attendance" class="linkers">Enter the attendance</a></li>
					<li class="hoverer"><a href="/timetable.php" title="Enter your Timetable!" class="linkers">Enter the timetable</a></li>
					<li class="hoverer"><a href="/internal.php" title="Enter your internal marks" class="linkers">Enter Internal Marks</a></li>
					<li class="hoverer"><a href="/reports.php" title="View your reports" class="linkers">View Reports</a></li>
					<li class="hoverer"><a href="/contact.php" title="Report a bug on this site" class="linkers">Report Bug</a></li>
					<li class="hoverer"><a href="/settings.php" title="Change Settings">Settings</a></li>
					<li id="logout" class="hoverer"><a href="/logout.php" title="Logout!">Logout</a></li>
				<?php else: ?>
					<li id="lione" class="hoverer"><a href="/login.php" title="Login">Login</a></li>
					<li id="litwo" class="hoverer"><a href="/register.php" title="Register">Register</a></li>
				<?php endif; ?>
			</ul>
		</div>
	</div>