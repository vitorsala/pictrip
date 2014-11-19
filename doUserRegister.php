<?php
	require_once "function/business/Register.php";
	require_once "function/business/FileManager.php";
	include 'header.php';
	header ('Content-type: text/html; charset=UTF-8');

	if(session_status() !== FALSE)	session_start();
	foreach ( $_SESSION as $key => $value ) {
		if(!is_array($value)){
			${$key} = $value;
			//echo "$key => $value<br/>";
		}
	}
	$avatar = $_FILES['avatar'];
	
	$regUser = new Register();
	$regUser->registerNewUser($nome, $sobrenome, $email, $dia, $mes, $ano, $senha, $sexo, $avatar);
	session_destroy();
	header("location:success.php");
?>
