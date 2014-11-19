<?php
require_once 'head.php';
require_once 'function/business/PostOperation.php';
$po = new PostOperation();

$content = $_POST['content'];
$postId = $_POST['postId'];
$r = $po->updatePost($postId, $content);
header("location:home.php");
?>