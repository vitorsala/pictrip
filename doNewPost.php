<?php
require_once 'function/business/PostOperation.php';
$po = new PostOperation();

$content = $_POST['content'];
$r = $po->insertNewPost($content);
if($r)	header("location:home.php");
else{
	echo "Erro ao inserir post";
}
?>