<?php
//this file is responsible for internal marks.
@session_start();
if(isset($_SESSION["uemailh"])) :
	$logged_in = true;
	require_once $_SERVER["DOCUMENT_ROOT"].'/db/db.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/includes/header.php';
?>
<div id="outer_container" class="clearfix">
	<div id="container" class="container95">
		<h1 class="notice cen">Under Construction :(</h1>
		<h2 class="tagline cen">We will get it done in a week!</h2>
	</div>
</div>
<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/includes/footer.php';
else:
	//for non-loggedin users
	header("Location: /login.php?redirect_to=".$_SERVER['PHP_SELF']);
endif;
?>