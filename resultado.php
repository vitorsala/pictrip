<?php
	require_once "function/business/Register.php";
	include 'header.php';
	header ('Content-type: text/html; charset=UTF-8');
	foreach ( $_POST as $key => $value ) {
		if(!is_array($value)){
			${$key} = $value;
			echo "$key => $value<br/>";
		}
	}
	$avatar = "";
	$regUser = new Register();
	$regUser->registerNewUser($nome, $sobrenome, $email, $dia, $mes, $ano, $senha, $sexo, $avatar);	
?>
