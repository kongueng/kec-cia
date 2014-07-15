<!DOCTYPE html>
<html>
<head>
	<title>KEC-CIA &mdash; An ERP Management tool for KEC Students</title><meta charset="UTF-8"><link rel="stylesheet" href="/css/main.css" type="text/css"><link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'><script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<?php if($_SERVER["REQUEST_URI"] == "/timetable.php?edit_mode=true" ||$_SERVER["REQUEST_URI"] == "/timetable.php" ): ?><script type="text/javascript">
function allowDrop(e){e.preventDefault()}function drag(e){e.dataTransfer.setData("Text",e.target.id)}function drop(e){e.preventDefault();var t=e.dataTransfer.getData("Text"),n=document.getElementById(t).className;switch(n){case"theory":case"misc":if(e.target.innerHTML==""){e.target.innerHTML='<span class="tt '+n+'">'+$("#"+t).html()+"</span>"}else{removal=e.target;parent=removal.parentNode;if(removal.nodeName=="SPAN"){$(removal).hide();$(parent).html('<span class="tt '+n+'">'+$("#"+t).html()+"</span>")}else{e.target.innerHTML='<span class="tt '+n+'">'+$("#"+t).html()+"</span>"}}break;case"practical":id=e.target.id;var r=parseInt(id.charAt(3));targetClass=e.target.className;switch(r){case 2:case 3:case 4:id2=$("#"+targetClass+"2").attr("colspan","3").html('<span class="tt '+n+'">'+$("#"+t).html()+"</span>");id3=$("#"+targetClass+"3").hide();id4=$("#"+targetClass+"4").hide();break;case 5:case 6:case 7:id5=$("#"+targetClass+"5").attr("colspan","3").html('<span class="tt '+n+'">'+$("#"+t).html()+"</span>");id6=$("#"+targetClass+"6").hide();id7=$("#"+targetClass+"7").hide();break}break}}
</script><?php endif; ?>
	<script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');ga('create', 'UA-31570065-3', 'kec-cia.com');ga('send', 'pageview');</script>
</head>
<body>
	<div id="topbar">
		<div class="inner clearfix">
			<div id="logo"><a href="/" title="Go to Dashboard">KEC-CIA</a></div>
			<ul id="navbar">
				<?php
					//logged users
					if( $logged_in ):
				?>
					<li <?php if($_SERVER["REQUEST_URI"] == "/attendance.php") echo 'class="active"'; ?>><a href="/attendance.php" title="Enter your attendance" class="linkers">Enter the attendance</a></li>
					<li <?php if($_SERVER["REQUEST_URI"] == "/timetable.php") echo 'class="active"'; ?>><a href="/timetable.php" title="View Timetable" class="linkers">View timetable</a></li>
					<li <?php if($_SERVER["REQUEST_URI"] == "/internal.php") echo 'class="active"'; ?>><a href="/internal.php" title="Enter your internal marks" class="linkers">Enter Internal Marks</a></li>
					<li <?php if($_SERVER["REQUEST_URI"] == "/reports.php") echo 'class="active"'; ?>><a href="/reports.php" title="View your reports" class="linkers">View Reports</a></li>
					<li <?php if($_SERVER["REQUEST_URI"] == "/contact.php") echo 'class="active"'; ?>><a href="/contact.php" title="Report a bug on this site" class="linkers">Report Bug</a></li>
					<li <?php if($_SERVER["REQUEST_URI"] == "/settings.php") echo 'class="active"'; ?>><a href="/settings.php" title="Change Settings" class="linkers">Settings</a></li>
					<li id="logout"><a href="/logout.php" title="Logout!">Logout</a></li>
				<?php else: ?>
					<li><a href="/login.php" title="Login">Login</a></li><li><a href="/register.php" title="Register">Register</a></li>
				<?php endif; ?>
			</ul>
		</div>
	</div>