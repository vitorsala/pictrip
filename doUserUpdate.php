<?php
require_once 'head.php';
require_once 'function/business/Register.php';

if(session_status() !== FALSE)	session_start();
header ('Content-type: text/html; charset=UTF-8');
echo "POST<br/>";
foreach ( $_POST as $key => $value ) {
	${$key} = $value;
	if(${$key} == "")	${$key} = null;
	echo "$key => ".($value == null ? "null" : $value)."<br/>";
}
if(!isset($sexo))	$sexo = null;
echo "<br/>SESSION<br/>";
foreach($_SESSION as $k => $v){
	echo "$k => $v<br/>";
}
$avatar = (isset($_FILES['avatar']) ? $_FILES['avatar'] : null);

$regUser = new Register();
$regUser->changeUserInfo($_SESSION['id'], $nome, $sobrenome, $email, $dia, $mes, $ano, $senha, $sexo, $avatar);

//header("location:user.php");
?>