<?php
if(isset($_GET["hash"]) && isset($_GET["email"])) {
	require_once $_SERVER["DOCUMENT_ROOT"].'/db/db.php';
	$email = mysqli_real_escape_string($con,$_GET["email"]);
	$hash = mysqli_real_escape_string($con,$_GET["hash"]);
	$q = mysqli_query($con,"SELECT id FROM forgot WHERE uemail='$email' AND hashcode='$hash'");
	$cnt=mysqli_num_rows($q);
	mysqli_close($con);
	if($cnt==1){
		//allow reset
?>
<!DOCTYPE html>
<html>
<head>
	<title>Password Reset &mdash; KEC-CIA</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
	<style>
	body,div,section{display:block;text-align:center}body{color:#3d3d3d;font-family:Lato,Arial,Verdana,sans-serif;font-size:14px;position:absolute;width:100%;height:100%;margin:0;padding:0}#outer_container{width:335px;margin:15% auto;box-shadow:0px 0px 10px gray}#container{padding:1em}#container label{float:left;line-height: 2.2em;}#submit{font-family:Lato;margin:15px 0;padding:3px 15px;border-radius:3px;border-style:solid;border-color:gray;background-color:#525252;color:#fff}#submit:hover{background-color:#EE4752}#submit:focus{border-color:#cd202c}#inputter1,#inputter2{font-family:Lato;margin-left:10px;padding: 3px;width:175px;float:right}#response{display:none;padding: 0;margin: 0;color: #cd202c}#response a{color:inherit}.cf:after{display: block;visibility: hidden;content: ".";height: 0;line-height: 0;clear: both}.cf{display: inline-block}</style>
</head>
<body>
<div id="outer_container">
<div id="container" class="clearfix"><p>Password reset for <?php echo $_GET["email"];?></p><label for="inputter1">Password</label><input type="password" id="inputter1" autofocus><label for="inputter2">Repeat Password</label><input type="password" id="inputter2"><button id="submit">Change Password</button><p id="response"></p></div></div><script type="text/javascript">function helper(str){$("#response").html(str).fadeIn();setTimeout(function(){$("#response").html("").fadeOut()},3e3);}$(document).ready(function(){$("#submit").on("click",function(){i1=$("#inputter1").val();i2=$("#inputter2").val();if(i1==""||i2==""){helper("Please fill all the fields");}else if(i1!=i2){helper("Passwords doesn't match.");$("#inputter1").focus();}else{helper("Please wait...");$.ajax({type:'post',url:"/password_reset.php",data:{p:i1,e:'<?php echo $_GET["email"];?>'},success:function(r){if(r=='0'){helper("Password has been successfully changed.You can now <a href='/login.php' title='Login'>login</a>.");}else{helper("Something went wrong: "+r);}}});}});});</script>
</body></html>
<?php
	}
} else if(isset($_POST["p"]) && isset($_POST["e"])){
	require_once $_SERVER["DOCUMENT_ROOT"].'/db/db.php';
	//change password
	$p = sha1(trim(mysqli_real_escape_string($con,$_POST["p"])));
	$e = trim(mysqli_real_escape_string($con,$_POST["e"]));
	$q = mysqli_query($con,"UPDATE users SET upassword='$p' WHERE uemail='$e'");
	if($q){$q1=mysqli_query($con,"DELETE FROM forgot WHERE uemail='$e'");die('0');}else{die('failed to update');}
} else {
	die("No Mr.Black hat. Read books.");
}
?>