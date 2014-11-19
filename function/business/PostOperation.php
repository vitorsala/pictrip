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
		$posts = $this->dao->getAllPosts();
		if(!$posts)	return false;
		return $posts;
	}
	
	public function getUserPosts($userId = NULL){
		if($userId == NULL){
			if(session_status() !== FALSE)	session_start();
			$userId = $_SESSION['id'];
		}
		$posts = $this->dao->getPostsFromSingleUser($userId);
		if(!$posts)	return false;
		return $posts;
	}
	
	public function deleteSinglePost($postId){
		return $this->dao->deletePost($postId);
	}
	
	public function updatePost($postId, $content){
		try{
			$post = $this->dao->getPostsById($postId);
			$post->content = $content;
			$this->dao->updatePost($post);
		}catch(DataBaseException $e){
			throw $e;
		}
	}
}
?>