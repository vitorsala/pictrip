<?php
require_once 'function/logging/Log.php';
require_once 'function/persistence/connection/DataBase.php';
require_once 'function/persistence/entity/Entity.php';

class UserDAO {
	private $db;
	private $suffix = "user_";

	private static $dao;
	
	private function __construct() {
		$this->db = DataBase::getInstance ();
	}
	public function __destruct() {
		unset ( $db );
		unset ( $dao );
	}
	public static function getInstance() {
		if (! isset ( self::$dao )) {
			self::$dao = new UserDAO ();
		}
		return self::$dao;
	}
	
	public function getUserByMail($userMail) {
		$user = new User();
		$query = "SELECT * FROM user WHERE user_mail = '$userMail';";
		try {
			$result = $this->db->query ($query);
			if($result->num_rows <= 0)	return FALSE;
			
			while ( $result && $row = mysqli_fetch_array ( $result ) ) {
				if ($row ['user_mail'] == $userMail) {
					
					foreach($row as $key => $value){
						if(!is_numeric($key)){
							$var = str_replace($this->suffix, "", $key);
							$user->{$var} = $value;
						}
					}
					
					return $user;
					
				}
			}
			return FALSE;
		} catch ( DataBaseException $e ) {
			Log::newLogEntry ( $e->getMessage (), logType::ERROR );
			throw $e;
		}
		return FALSE;
	}
	
	public function getAllUsers() {
		$i = 0;
		$query = "SELECT * FROM user ORDER BY user_name;";
		try {
			$result = $this->db->query ($query);
			if($result->num_rows <= 0)	return FALSE;
			while ( $result && $row = mysqli_fetch_array ( $result ) ) {
				$user[$i] = new User();
				foreach($row as $key => $value){
					if(!is_numeric($key)){
						$var = str_replace($this->suffix, "", $key);
						$user[$i]->{$var} = $value;
					}
				}
				$i++;
			}
			return $user;
		} catch ( DataBaseException $e ) {
			Log::newLogEntry ( $e->getMessage (), logType::ERROR );
			throw $e;
		}
		return FALSE;
	}
	
	/**
	 * 
	 * @param unknown $userMail
	 * @throws DataBaseException
	 * @return boolean
	 */
	function checkIfUserExist($userMail) {
		$query = "SELECT user_mail FROM user WHERE user_mail = '$userMail';";
		try {
			$result = $this->db->query($query);
			if($result->num_rows <= 0)	return FALSE;
			
			while ($result && $row = mysqli_fetch_array ( $result ) ) {
				if ($row ['user_mail'] == $userMail) {
					return TRUE;
				}
			}
			return FALSE;
		} catch ( DataBaseException $e ) {
			Log::newLogEntry ( $e->getMessage (), logType::ERROR );
			throw $e;
		}
		return FALSE;
	}
	
	function getUserAvatar($userMail){
		return null;
	}
	
	function registerNewUser($name, $surName, $mail, $birthday, $pass, $sex, $avatar){
		$name = $this->db->realEscape($name);
		$surName = $this->db->realEscape($surName);
		$mail = $this->db->realEscape($mail);
		$avatar = $this->db->realEscape($avatar);
		//$pass = password_hash($pass, PASSWORD_DEFAULT);
		
		$query = "INSERT INTO user (user_name, user_surname, user_mail, user_password, user_sex, user_birthday, user_avatar)
				VALUES ('$name', '$surName', '$mail', '$pass', '$sex', '$birthday', '$avatar')";
		echo $query."<br/><br/>";
		try {
			if($this->checkIfUserExist($mail))	return FALSE;
			
			$result = $this->db->query($query);
				
			return $result;
		} catch ( DataBaseException $e ) {
			Log::newLogEntry ( $e->getMessage (), logType::ERROR );
			throw $e;
		}
		return FALSE;
	}
}
?>