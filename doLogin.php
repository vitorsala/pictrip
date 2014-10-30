<?php
include 'header.php';
require_once 'function/business/Auth.php';

$userMail = $_POST['mail'];
$password = $_POST['pass'];

$auth = new Auth();
$login = $auth->login($userMail, $password);
if($login){
	$nome = $_SESSION['name']." ".$_SESSION['surname'];
	echo "Bem vindo(a) $nome.";
}
else		echo "NAY!";
?>