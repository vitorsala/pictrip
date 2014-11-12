<?php
require_once 'function/business/PostOperation.php';
$po = new PostOperation();

$postId = $_POST['postId'];
$r = $po->deleteSinglePost($postId);
if($r)	header("location:home.php");
else{
	echo "Erro ao inserir post";
}
?>