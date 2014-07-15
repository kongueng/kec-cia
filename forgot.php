<?php
$logged_in=false;
require_once $_SERVER["DOCUMENT_ROOT"].'/db/db.php';
if(isset($_POST["f"])) {
	$f = trim(mysqli_real_escape_string($con, $_POST["f"]));
	$q = mysqli_query($con,"SELECT * FROM users WHERE uemail='$f'");
	if($q){
		$r=mysqli_num_rows($q);
		if($r==1){
			$hash=sha1($f.time());
			$r = mysqli_query($con,"INSERT INTO forgot(uemail,hashcode) VALUES('$f','$hash')");
			if($r){
				//send mail
				$url="http://gowtham.heliohost.org/mail.php";
				$post_data = "email=".$f."&options=2&hash=".$hash;
				$ch = curl_init();
				curl_setopt($ch,CURLOPT_URL,$url);
				curl_setopt($ch,CURLOPT_POST,1);
				curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				//execute post
				$server_output = curl_exec($ch);
				if($server_output=='2') {echo('0');}else{echo($server_output);}
				curl_close($ch);
			}else{
				die('1');
			}			
		}else{
			die('2');
		}
	}
} else {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Password Reset &mdash; KEC-CIA</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
	<style>
	body,div,section{display:block;text-align:center}body{color:#3d3d3d;font-family:Lato,Arial,Verdana,sans-serif;font-size:14px;position:absolute;width:100%;height:100%;margin:0;padding:0}#outer_container{width:320px;margin:15% auto;box-shadow:0px 0px 10px gray}#container{padding:1em}#submit{font-family:Lato;margin:15px 0;padding:3px 15px;border-radius:3px;border-style:solid;border-color:gray;background-color:#525252;color:#fff}#submit:hover{background-color:#EE4752}#submit:focus{border-color:#cd202c}#bottom-area{text-align:center;background:#282828;color:#fff}#bottom-area ul{padding:0;margin:0}#bottom-area ul li{list-style:none;list-style-image:none;display:inline-block;height:40px;line-height:40px}#bottom-area ul li>a{padding:.3125em;text-decoration:none;font-size:1em;color:#868686}#bottom-area ul li>a:hover{color:#fff}#inputter{font-family:Lato;margin-left:10px;padding: 3px;width:175px}#response{display:none;padding:0;margin:0;color:#cd202c}#response a{color:inherit}</style>
</head>
<body>
<div id="outer_container"><div id="container"><label for="inputter">Email</label><input type="email" id="inputter" autofocus><button id="submit">Get Password</button><p id="response"></p></div><div id="bottom-area" ><ul><li><a href="/login.php" title="Login!">Login</a></li><li><a href="/register.php" title="Register!">Register</a></li></ul></div></div>
<script type="text/javascript">
function helper(str){$("#response").html(str).fadeIn();setTimeout(function(){$("#response").html("").fadeOut()},3e3);}$(document).ready(function(){$("#submit").on("click",function(){fe=$("#inputter").val();if(fe==""){helper("Please enter your Email.");$("#inputter").focus();}else{helper("Please wait...");$.ajax({type:'post',url:"/forgot.php",data:{f:fe},success:function(r){if(r=='0'){helper("Password reset link has been sent to your mail.");}else if(r=='2'){helper("You are not a registered user. Please <a href='register.php'>register</a>");}else{helper("Something went wrong: "+r);}}});}});});</script>
</body>
</html>
<?php
}
?>