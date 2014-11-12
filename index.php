<?php
if(session_status() !== FALSE)	session_start();
if(isset($_SESSION['logged']) && $_SESSION['logged']){
	include 'home.php';
}
else{
	include 'login.php';
}

?>