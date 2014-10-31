<?php
	include 'header.php';
	require_once 'function/business/Auth.php';
	
	$auth = new Auth();
	$auth->logout();
	header("location:index.php");
?>