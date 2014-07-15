<?php
//this file is responsible for internal marks.
@session_start();
if(isset($_SESSION["uemailh"])) :
	$logged_in = true;
	require_once $_SERVER["DOCUMENT_ROOT"].'/db/db.php';
	if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["message"])) {
		$name = mysqli_real_escape_string($con, $_POST["name"]);
		$email = mysqli_real_escape_string($con, $_POST["email"]);
		$message = mysqli_real_escape_string($con, $_POST["message"]);
		echo ($q = mysqli_query($con, "INSERT INTO feedback(name,email,message) VALUES('$name','$email','$message')"))?'1':'0';
		die();
	} else {
		require_once $_SERVER["DOCUMENT_ROOT"].'/includes/header.php';
?>
<div id="outer_container" class="clearfix">
	<div id="container" class="container95">
		<div id="contact-area">
 			<form method="post" action="javascript:sub()" onsubmit="return validate()">
				<label for="name">Name:</label>
				<input type="text" name="Name" id="name" />
				<label for="email">Email:</label>
				<input type="text" name="Email" id="email" />
				<label for="message">Message:</label><br />
				<textarea name="Message" rows="20" cols="20" id="message"></textarea>
				<input type="submit" name="submit" value="Submit" class="submit-button" />
			</form>
		</div>
 	</div>
</div>
<script type="text/javascript">function validate(){if($("#name").val()==""||$("#email").val()==""||$("#message").val()==""){alert("You've missed something!...");return false;}else{return true;}}function sub() {n=$("#name").val();e=$("#email").val();m=$("#message").val();$.ajax({url:"/contact.php",method:"post",data:{name:n,email:e,message:m},success:function(r){if(r=='1'){alert("Thanks! Your feeback received...");location.href="/";}else alert("Oops! Something went wrong...")},error: function(){alert("Oops! Something went wrong...")}});}
</script>
<?php
}
require_once $_SERVER["DOCUMENT_ROOT"].'/includes/footer.php';
else:
	header("Location: /login.php?redirect_to=".$_SERVER['PHP_SELF']);
endif;
?>