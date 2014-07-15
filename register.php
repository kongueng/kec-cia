<?php
	@session_start();
	if( isset($_SESSION['uemailh']) ) :
		require_once __DIR__.'/includes/redirector.php';
	/*
	 * code 1 = email match
	 * code 2 = username match
	 * code 3 = rollno
	 * code 4 = ins fail
	 * code 6 = hash ins fail
	 * code 7 = verification query error
	 * code 8 = success
	 */
	elseif(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['classcode']) && isset($_POST['regno'])) :
		//db_connection
		if(isset($_POST['spa'])) {
			die("You're a bot!");
		}
		require_once __DIR__.'/db/db.php';
		$username = mysqli_real_escape_string($con, trim($_POST["username"]));
		$password = mysqli_real_escape_string($con, trim($_POST["password"]));
		$email = mysqli_real_escape_string($con, trim($_POST["email"]));
		$class = mysqli_real_escape_string($con, trim($_POST["classcode"]));
		$regno = mysqli_real_escape_string($con, strtolower(trim($_POST["regno"])));
		{
			if( !empty($username) && !empty($password) && !empty($email) ) {
				// register into the db
				$password = sha1($password);
				$uemailh = sha1($email);				
				//checks where the email is already present in the system
				$r1 = mysqli_query($con,"SELECT * FROM users where uemail = '$email'");
				if(!$r1) {	echo("CQ1 Failed");die(); }
				$cnt1 = mysqli_num_rows($r1);
				if($cnt1 === 1) {die('1');}								
				//check for username
				$r2 = mysqli_query($con, "SELECT * FROM users where uname = '$username'");
				if(!$r2) {	echo("CQ2 Failed");die(); }
				$cnt2 = mysqli_num_rows($r2);
				if($cnt2 === 1) {die('2');}
				//check for rollno
				$r3 = mysqli_query($con, "SELECT * FROM users where regno = '$regno'");
				if(!$r3) {	echo("CQ3 Failed");die(); }
				$cnt3 = mysqli_num_rows($r3);
				if($cnt3 === 1) {die('3');}
				$res = mysqli_query($con, "INSERT INTO users (uemail, upassword, uname, uemailh, uclass, regno) VALUES('$email','$password','$username','$uemailh','$class','$regno')");
				if(!$res) { die('4'); }
				$hashcode = sha1("register".$username.$email);
				$q = mysqli_query($con, "INSERT INTO verification (hashcode, uname) VALUES('$hashcode','$username')");
				if(!$q) {die('7');}
				$url="http://gowtham.heliohost.org/mail.php";
				$post_data = "username=".$username."&password=".$password."&regno=".$regno."&email=".$email."&classcode=".$class."&options=1";
				$ch = curl_init();
				curl_setopt($ch,CURLOPT_URL,$url);
				curl_setopt($ch,CURLOPT_POST,1);
				curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				//execute post
				$so = curl_exec($ch);
				if($so=='1') {echo('8');}else{echo($so);}
				curl_close($ch);
			}
		}
	else:
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register &mdash; CIA-KEC</title><meta charset="UTF-8"><script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script><link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'><style type="text/css">html{font-size:100%}article,aside,div,footer,header,hgroup,nav,section{display:block;background:0 0}body{border:0;font-family:Lato,Arial,Helvetica,sans-serif;font-size:14px}body,html{margin:0;padding:0}p{margin:10px 0}ol,ul{padding:0;margin:0}a:link,a:visited{color:#1979F3;text-decoration:underline}a:hover{color:#E74343}ul{list-style:none}.form_inner{padding:10px 0;overflow:hidden}#form_wrapper{box-shadow:0 0 25px gray;max-width:475px;min-width: 320px;margin:0 auto;text-align:center}.inner-wrap{padding:1em 1em 0}.labels{display:inline-block;width:35%;text-align:left}input[type=email],input[type=password],input[type=text]{font-family:Lato;border-radius:3px;border:2px solid gray;height:25px;padding:0 10px;width:180px}input:focus{outline:0;border-color:#DD626A}#submitBtn{font-family: Lato;margin-top:15px;padding:3px 15px;border-radius:3px;border-style:solid;border-color:gray;background-color:#525252;color:#fff}#submitBtn:hover{background-color:#EE4752}#submitBtn:focus{border-color:#cd202c}select{border:2px solid gray;border-radius:3px}select:focus{outline:0;border:2px solid #cd202c}#captcha{display:inline-block}#response{font-size:12px;font-weight:700;color:#FF6F6F}#bottom-area{text-align:center;background:#282828;color:#fff}#bottom-area ul li{list-style:none;list-style-image:none;display:inline-block;height:40px;line-height:40px}#bottom-area ul li>a{padding:.3125em;text-decoration:none;font-size:92.857%;color:#868686}#bottom-area ul li>a:hover{color:#fff}#returner{color:#AA131F;font-size:92.857%;margin:10px 0}#beta_img{text-align:center}</style>
	<script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');ga('create', 'UA-31570065-3', 'kec-cia.com');ga('send', 'pageview');</script>
</head>
<body>
	<p id="beta_img"><img src="/images/beta.gif" /></p>
	<div id="form_wrapper">
		<div class="inner-wrap">
			<p>Currently, this application is in beta state and hence limited to IT department only.</p>
			<form action="javascript:sub()" onsubmit="return validater()">
				<div class="form_inner">
					<span class="labels">Email</span><input type="email" class="inputter" data-fieldname="Email" id="email" autofocus /><br /><br/>
					<span class="labels">Username</span><input type="text" class="inputter" data-fieldname="Username" id="username" /><br/><br/>
					<span class="labels">Password</span><input type="password" class="inputter" data-fieldname="Passwords" id="password" /><br/><br/>
					<span class="labels">Repeat Password</span><input type="password" class="inputter" data-fieldname="Passwords" id="passwordRepeat" /><br/><br/>
					<span class="labels">Register Number</span><input type="text" class="inputter" data-fieldname="Register Number" id="regno" /><br/><br/>
					<span class="labels" style="width:10%;text-align: right">Year</span>
					<select id="year"><option value="1">1st</option><option value="2">2nd</option><option value="3">3rd</option><option value="4">4th</option></select>
					<span class="labels" style="width:10%;text-align: right">Dept.</span>
					<select id="dept"><option value="it">IT</option></select>
					<span class="labels" style="width:10%;text-align: right">Sec.</span>
					<select id="section"><option value="a">A</option><option value="b">B</option><option value="c">C</option></select><br/><br/>
					<input type="text" id="checker" name="emailChecker" style="display:none"/>
					<input type="submit" value="Sign me up!" id="submitBtn" /><br/>
					<h4 id="returner" style="display:none"></h4>
				</div>
			</form>
		</div>
		<div id="bottom-area" ><ul><li><a href="login.php" title="Login">Log In!</a></li><li><a href="/" title="Homepage" >Home</a></li></ul></div>
	</div>
	<script type="text/javascript">function helper(e){$("#returner").html(e);$("#returner").fadeIn("medium");setTimeout(function(){$("#response").fadeOut("medium");$("#returner").html("")},3e3)}function validater(){var e=$(".inputter");for(i=0;i<e.length;i++){if(e[i].value==""){helper("Please fill "+$(e[i]).data("fieldname"));return false}}return true}
	function sub(){helper("Please wait...");
		var e=$("#username").val(), t=$("#password").val(), n=$("#passwordRepeat").val(), r=$("#email").val(), i=$("#year").val(), s=$("#section").val(), o=$("#dept").val(), u=i+o+s, a=$("#regno").val(), f=$("#emailChecker").val();
		if(a.length===8&&t===n){$.ajax({type:"POST",url:"/register.php",data:{username:e,password:t,email:r,classcode:u,regno:a,spa:f}}).done(function(reply1){console.log(reply1);switch(reply1){case"1":helper("This email is already registered with with us");break;case"2":helper("Username not available");break;case"3":helper("Your Register number is already registered! Please <a href='login.php'>login!</a> if you are already a user");break;case"4":case"6":helper("Oops! Some error occured. Please try later");break;case "7":helper("Code 7:verification entry prob.");break;case "8":$("#response").html("Successfully registered! Click <a href='/login.php?redirect_to=%2Ftimetable.php' title='Login'>here<a> to login and please check your inbox for verification details!").fadeIn("medium");break;default:helper("No data returned from the server")}})}else if(t!=n){helper("Passwords do not match")}else if(a.length!=8){helper("Please enter a valid register number")}}</script>
</body>
</html>
<?php endif; ?>