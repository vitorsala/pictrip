<?php
include 'header.php';
require_once 'function/business/Auth.php';

$userMail = $_POST['mail'];
$password = $_POST['pass'];

$auth = new Auth();
$login = $auth->login($userMail, $password);
if($login){
	header("location:home.php");
}
else		header("location:index.php");;
?>