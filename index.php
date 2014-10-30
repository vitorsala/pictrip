<?php
if(isset($_SESSION['logged']) && $_SESSION['logged']){
	include 'home.php';
}
else{
	include 'login.php';
}

?>