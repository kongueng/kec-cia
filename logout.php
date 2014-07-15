<?php
if( isset($_COOKIE['uemailh']) || isset($_COOKIE['PHPSESSID']) ) {
	//user is in
	$cookies = explode(';',$_SERVER['HTTP_COOKIE']);
	foreach($cookies as $cookie) {
		$parts = explode('=',$cookie);
		$name = trim($parts[0]);
		setcookie($name,'',time()-1000);
		setcookie($name,'',time()-1000,'/');
	}
	session_start();
	session_destroy();
	header("Location: /");
} else {
	header("Location: /");
}
?>