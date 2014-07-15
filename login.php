<?php
@session_start();
if( isset( $_SESSION['uemailh'] ) ) :
	require_once __DIR__.'/includes/redirector.php';
elseif(isset($_POST["username"]) && isset($_POST["password"])) :
	/*
	* Function: sets timetable and day cookies 
	* Errors and return codes
	* code 0: success
	* code 1: username/password error
	*/
	require_once $_SERVER["DOCUMENT_ROOT"].'/db/db.php';
	$username = mysqli_real_escape_string($con, trim($_POST["username"]));
	$password = mysqli_real_escape_string($con, trim($_POST["password"]));
	$password = sha1($password);
	$query = "SELECT * FROM users where (uemail='$username' and upassword='$password') or (uname='$username' and upassword='$password')";
	$res = mysqli_query($con, $query);
	//on_query_failure
	if(!$res) { die("Query Failed"); }
	$cnt = mysqli_num_rows($res);
	if($cnt == 1) {
		$res1 = mysqli_fetch_array($res);
		//adds the login session detail
		$_SESSION['uemailh'] = $res1['uemailh'];
		$_SESSION['classcode'] = $res1['uclass'];
		$_SESSION['uid'] = $res1['uid'];
		$uns = unserialize($res1['absencecount']);
		$_SESSION['total_abs'] = $uns[9];
		// $count = sizeof($uns);
		// unset($uns[$count-1]);
		// $_SESSION['max_sub_index'] = max(array_keys($uns));
		// $_SESSION['max_periods'] = max($uns);
		//this code sets the necessary cookies and session variables for the site
		//following checks whether the user has verified his account
		$q = mysqli_fetch_array(mysqli_query($con, "SELECT count(*) AS total FROM verification WHERE uname='$username'"));
		if($q["total"]==1) {
			//user has not verified email.
			setcookie("verified", "false");
		}
		$query = "SELECT mon, tue, wed, thu, fri, sat, reviewed FROM timetable WHERE classcode='". $_SESSION['classcode'] ."'";
		$res = mysqli_query($con, $query);
		if(!$res) { die("Query Failed"); }
		$cnt = mysqli_num_rows($res);
		if($cnt === 0) {
			setcookie("tt","new");
		} else {
			$r = mysqli_fetch_array($res);
			setcookie("mon",unserialize($r["mon"]));setcookie("tue",unserialize($r["tue"]));setcookie("wed",unserialize($r["wed"]));setcookie("thu",unserialize($r["thu"]));setcookie("fri",unserialize($r["fri"]));setcookie("sat",unserialize($r["sat"]));($r["reviewed"]==1)? setcookie("rev","1") : setcookie("rev","0");
			$q = "SELECT slist FROM subjects WHERE classcode='". $_SESSION['classcode'] ."'";
			$res = mysqli_query($con,$q);
			$r = mysqli_fetch_array($res);
			$sub = unserialize($r["slist"]);
			setcookie("sub",$sub);
		}
	} else {
		echo 1;
	}
else: ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login &mdash; CIA-KEC</title><meta charset="UTF-8"><script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script><link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'><style type="text/css">html{font-size:100%;height:100%}article,aside,div,footer,header,hgroup,nav,section{display:block;background:0 0}body{border:0;font-family:Lato,Arial,Helvetica,sans-serif;font-size:14px}body,html{margin:0;padding:0}p{margin:10px 0}ol,ul{padding:0;margin:0}a:link,a:visited{color:#1979F3;text-decoration:underline}a:hover{color:#E74343}ul{list-style:none}.form_inner{padding:10px 0;overflow:hidden}#form_wrapper{box-shadow:0 0 25px gray;max-width:475px;min-width: 320px;margin:15% auto;text-align:center}.inner-wrap{padding:1em 1em 0}.labels{display:inline-block;width:35%;text-align:left}input[type=email],input[type=password],input[type=text]{font-family:Lato;border-radius:3px;border:2px solid gray;height:25px;padding:0 10px;width:180px}input:focus{outline:0;border-color:#DD626A}#submitBtn{font-family: Lato;margin-top:15px;padding:3px 15px;border-radius:3px;border-style:solid;border-color:gray;background-color:#525252;color:#fff}#submitBtn:hover{background-color:#EE4752}#submitBtn:focus{border-color:#cd202c}#response{font-size:12px;font-weight:700;color:#FF6F6F}#bottom-area{text-align:center;background:#282828;color:#fff}#bottom-area ul li{list-style:none;list-style-image:none;display:inline-block;height:40px;line-height:40px}#bottom-area ul li>a{padding:.3125em;text-decoration:none;font-size:92.857%;color:#868686}#bottom-area ul li>a:hover{color:#fff}#returner{color:#ea0011;font-size:92.857%;margin:10px 0}</style>
	<script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');ga('create', 'UA-31570065-3', 'kec-cia.com');ga('send', 'pageview');</script>
</head>
<body>
	<div id="form_wrapper">
		<div class="inner-wrap">
			<form>
				<div class="form_inner">
					<ul id="form-container">
						<li style="margin-bottom:10px"><span style="display:inline-block;width:35%;text-align:left;">Username or Email</span><input type="text" name="username" id="username" /></li>
						<li><span style="display:inline-block;width:35%;text-align:left;">Password</span><input type="password" name="password" id="password" /></li>
					</ul>
					<input type="submit" value="Login" id="submitBtn" /><br/>
					<h4 id="returner" style="display:none"></h4>
				</div>
			</form>
		</div>
		<div id="bottom-area" >
			<ul>
				<li><a href="forgot.php" title="Forgot Password" >Forgot Password!</a></li>
				<li><a href="register.php" title="Register!" >Register for a new Account!</a></li>
			</ul>
		</div>
	</div>
	<script type="text/javascript">function helper(e){$("#returner").html(e);$("#returner").fadeIn("medium");setTimeout(function(){$("#response").fadeOut("medium");$("#returner").html("")},3e3)}$(document).ready(function(){$("form").on("submit",function(e){e.preventDefault();var t=$.trim($("#username").val());var n=$.trim($("#password").val());if(t!==""&&n!==""){$.post("login.php",{username:t,password:n},function(e){console.log(e);if(e==1){helper("Wrong Username/Password. Please try again!")}else if(e==0){helper("Successfully logged in!");
		location.href='<?php if(isset($_GET["redirect_to"])) echo $_GET["redirect_to"];else echo "/";?>';
	}})}else{helper("Please enter all the fields")}})});$(document).ajaxStart(function(){helper("Please Wait...")})</script>
</body>
</html>
<?php endif; ?>