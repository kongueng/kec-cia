<?php
	$logged_in = false;
	session_start();
	if(isset($_SESSION['uemailh'])){$logged_in = true;}
	require_once($_SERVER["DOCUMENT_ROOT"].'/includes/header.php');
	if( $logged_in ) :
?>
	<div id="outer_container" class="clearfix">
		<?php
			if(isset($_COOKIE["verified"]) && ($_COOKIE["verified"] === "false"))
				echo "<div class='notify'>Your email has not been verified. Please verify as soon as possible.</div>";
		?>
		<div id="container">
			<?php if(isset($_COOKIE["tt"]) && ($_COOKIE["tt"]=="new")) echo "<p>There is not timetable present in our system for your class. Please <a href='/timetable.php' title='Enter timetable'>enter</a> a new timetable to get started!</p>";?>
			<h1 class="cen notice" id="dashboard">Dashboard</h1>
			<div class="boxer">
				<p class="notice"><?php echo $_SESSION['total_abs'];?></p>
				<p>Number of periods absent</p>
			</div>
			<div class="boxer">
				<p class="notice on">ON</p>
				<p>Email notifications</p>
			</div>
			<div class="boxer">
				<p class="notice off">OFF</p>
				<p>Moderator Status</p>
			</div>
			<br/>
			<h3 class="cen border_top">We're working on some other features. Please, stay tuned!</h3>
		</div>
	</div>
	<?php else: ?>
	<div id="container">
		<div id="outer_bot">
			<div id="target">
				<h2 class="notice cen">Hello, Welcome to KEC-CIA</h2>
				<h3 class="cen">A tool for KEC students to plan and manage your attendance.</h3>
				<h3>Here's a list of some cool features:</h3>
				<ul class="bullets">
					<li>Get notified through <b><u>Facebook</u></b> or <b><u>email</u></b> when your attendance falls below.</li>
					<li>Just enter the days in the application when you're absent.</li>
					<li>Track your full Continuous Internal Assement marks.</li>
					<li>Get notified about the total attendance percent and also single subject attendance.</li>
					<?php
					//<li><b>Stay updated when there is some possibility to go on leave!!!</b></li>
					?>
				</ul>
			</div>
		</div>
	</div>
<?php endif; 
	require_once $_SERVER["DOCUMENT_ROOT"].'/includes/footer.php';
?>
