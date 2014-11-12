<?php
require_once 'function/persistence/dao/PostDAO.php';
require_once 'function/logging/Log.php';

class PostOperation{
	private $dao;
	
	public function __construct(){
		$this->dao = PostDAO::getInstance();	
	}
	
	public function insertNewPost($content){
		if(session_status() !== FALSE)	session_start();
		return $this->dao->newPost($_SESSION['id'], $content);
	}
	
	public function getAllPosts(){
		if(session_status() !== FALSE)	session_start();
		$posts = $this->dao->getAllPosts();
		if(!$posts)	return false;
		$_SESSION['posts'] = urlencode(serialize($posts));
		return true;
	}
	
	public function getUserPosts($userId = NULL){
		if(session_status() !== FALSE)	session_start();
		if($userId == NULL)	$userId = $_SESSION['id'];
		$posts = $this->dao->getPostsFromSingleUser($userId);
		if(!$posts)	return false;
		$_SESSION['posts'] = urlencode(serialize($posts));
		return true;
	}
	
	public function deleteSinglePost($postId){
		return $this->dao->deletePost($postId);
	}
}
?>