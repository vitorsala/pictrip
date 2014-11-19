<?php
require_once 'function/logging/Log.php';
require_once 'function/persistence/connection/DataBase.php';
require_once 'function/persistence/entity/Entity.php';

/**
 * DAO de post
 * @author Vitor Kawai Sala
 *
 */
class PostDAO {
	/** @var DataBase $db - Conector do banco de dados*/
	private $db;
	/** @var String $suffix - Sufixo dos campos do BD */
	private $suffix = "post_";
	
	/** @var UserDAO $dao - Instancia singleton */
	private static $dao;
	
	/** Construtor */
	private function __construct() {
		$this->db = DataBase::getInstance ();
	}
	
	/** Destrutor */
	public function __destruct() {
		unset ( $db );
		unset ( $dao );
	}
	
	/**
	 * Adiquire instância única do PostDAO.
	 * @return PostDAO - Instância do objeto
	 */
	public static function getInstance() {
		if (! isset ( self::$dao )) {
			self::$dao = new PostDAO ();
		}
		return self::$dao;
	}
	
	/**
	 * @param unknown $userId
	 * @throws DataBaseException
	 * @return boolean|Post
	 */
	public function getPostsFromSingleUser($userId) {
		$i = 0;
		$query = "
			SELECT post.user_id, post_id, post_content, post_likecount, post_date, user_name, user_surname, user_avatar FROM post
				INNER JOIN user ON (post.user_id = user.user_id)
				WHERE user_id = '$userId'
				ORDER BY post_date DESC
		;";
		try {
			$result = $this->db->query ($query);
			if($result->num_rows <= 0)	return FALSE;
			
			while ( $result && $row = mysqli_fetch_array ( $result ) ) {
				$post[$i] = new Post();
				foreach($row as $key => $value){
					if(!is_numeric($key)){
						$var = str_replace($this->suffix, "", $key);
						$post[$i]->{$var} = $value;
					}
				}
				$i++;
			}
			return $post;
		} catch ( DataBaseException $e ) {
			Log::newLogEntry ( $e->getMessage (), logType::ERROR );
			throw $e;
		}
		return FALSE;
	}
	
	/**
	 * @param unknown $postId
	 * @throws DataBaseException
	 * @return boolean|Post
	 */
	public function getPostsById($postId) {
		$i = 0;
		$query = "
			SELECT * FROM post
			WHERE post_id = '$postId'
		;";
		try {
			$result = $this->db->query ( $query );
			if ($result->num_rows <= 0)
				return FALSE;
			
			$post = new Post ();
			while ( $result && $row = mysqli_fetch_array ( $result ) ) {
				foreach ( $row as $key => $value ) {
					if (! is_numeric ( $key )) {
						$var = str_replace ( $this->suffix, "", $key );
						$post ->{$var} = $value;
					}
				}
				return $post;
			}
			return FALSE;
		} catch ( DataBaseException $e ) {
			Log::newLogEntry ( $e->getMessage (), logType::ERROR );
			throw $e;
		}
	}
	
	/**
	 * @throws DataBaseException
	 * @return boolean|Post
	 */
	public function getAllPosts() {
		$i = 0;
		$query = "
			SELECT post.user_id, post_id, post_content, post_likecount, post_date, user_name, user_surname, user_avatar FROM post
				INNER JOIN user ON (post.user_id = user.user_id)
				ORDER BY post_date DESC;
		";
		try {
			$result = $this->db->query ($query);
			if($result->num_rows <= 0)	return FALSE;
			while ( $result && $row = mysqli_fetch_array ( $result ) ) {
				$post[$i] = new Post();
				foreach($row as $key => $value){
					if(!is_numeric($key)){
						$var = str_replace($this->suffix, "", $key);
						$post[$i]->{$var} = $value;
					}
				}
				$i++;
			}
			return $post;
		} catch ( DataBaseException $e ) {
			Log::newLogEntry ( $e->getMessage (), logType::ERROR );
			throw $e;
		}
		return FALSE;
	}
	
	/**
	 * @param unknown $userId
	 * @param unknown $content
	 * @throws DataBaseException
	 * @return Ambiguous
	 */
	public function newPost($userId, $content){
		$content = $this->db->realEscape($content);
		
		$query = "INSERT INTO post (user_id, post_content)
				VALUES ($userId, '$content')";
		
		try {
			$result = $this->db->query($query);
			if($result == true)	return $this->db->insertId();
			else return $result;
		} catch ( DataBaseException $e ) {
			Log::newLogEntry ( $e->getMessage (), logType::ERROR );
			throw $e;
		}
	}
	
	/**
	 * @param Post $post
	 * @throws DataBaseException
	 * @return Ambiguous
	 */
	public function updatePost(Post $post){
		$query = "UPDATE post SET ";
		$s = true;
		foreach($post->getVarNames() as $key){
			if($key != "id" && isset($post->{$key})){
				if($s){
					$query .= (strpos($key, "user_") === FALSE ? $this->suffix : "" );
					$query .= "$key = '".$this->db->realEscape($post->{$key})."' ";
					$s = false;
				}
				else{
					$query .= ", ".(strpos($key, "user_") === FALSE ? $this->suffix : "" );
					$query .= "$key = '".$this->db->realEscape($post->{$key})."' ";
				}
			}
		}
		$query .= " WHERE post_id = $post->id";
		try {
			$result = $this->db->query($query);
			return $result;
		} catch ( DataBaseException $e ) {
			Log::newLogEntry ( $e->getMessage (), logType::ERROR );
			throw $e;
		}
	}
	
	/**
	 * @param unknown $postId
	 * @throws DataBaseException
	 * @return Ambiguous
	 */
	public function deletePost($postId){
		$query = "DELETE FROM post WHERE post_id = '$postId'";
		try{
			$result = $this->db->query($query);
			return $result;
		}catch (DataBaseException $e){
			Log::newLogEntry ( $e->getMessage (), logType::ERROR );
			throw $e;
		}
	}
}
?>