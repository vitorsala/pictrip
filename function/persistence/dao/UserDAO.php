<?php
require_once 'function/logging/Log.php';
require_once 'function/persistence/connection/DataBase.php';
require_once 'function/persistence/entity/Entity.php';

/**
 * DAO de usuário
 * @author Vitor Kawai Sala
 *
 */
class UserDAO {
	/** @var DataBase $db - Conector do banco de dados*/
	private $db;
	/** @var String $suffix - Sufixo dos campos do BD */
	private $suffix = "user_";

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
	 * Adiquire instância única do UserDAO.
	 * @return UserDAO - Instância do objeto
	 */
	public static function getInstance() {
		if (! isset ( self::$dao )) {
			self::$dao = new UserDAO ();
		}
		return self::$dao;
	}
	
	/**
	 * Busca as informações de um usuário através do email.
	 * @param String $userMail - Email do usuário.
	 * @throws DataBaseException
	 * @return <strong>User</strong> caso o usuário seja encontrado<br/>
	 * <strong>FALSE</strong> caso contrário.
	 */
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
	
	/**
	 * Retorna lista completa de usuários (Ordenado pelo nome)
	 * @throws DataBaseException
	 * @return <strong>array</strong> caso tenha usuário registrado no banco de dados<br/>
	 * <strong>FALSE</strong> caso contrário.
	 */
	public function getAllUsers() {
		$i = 0;
		$query = "SELECT * FROM user ORDER BY user_name, user_surname;";
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
	 * @param String $userMail
	 * @throws DataBaseException
	 * @return <strong>TRUE</strong> caso o email seja encontrado no banco de dados<br/>
	 * <strong>FALSE</strong> caso contrário.	
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
	
	/** 
	 * @todo Implementar o método. 
	*/
	function getUserAvatar($userMail){
		return null;
	}
	
	/**
	 * 
	 * @param String $name
	 * @param String $surName
	 * @param String $mail
	 * @param String $birthday
	 * @param String $pass
	 * @param String $sex
	 * @param String $avatar
	 * @throws DataBaseException
	 * @return boolean|unknown
	 */
	function registerNewUser($name, $surName, $mail, $birthday, $pass, $sex, $avatar){
		$name = $this->db->realEscape($name);
		$surName = $this->db->realEscape($surName);
		$mail = $this->db->realEscape($mail);
		$avatar = $this->db->realEscape($avatar);
		//$pass = password_hash($pass, PASSWORD_DEFAULT);
		
		$query = "INSERT INTO user (user_name, user_surname, user_mail, user_password, user_sex, user_birthday, user_avatar)
				VALUES ('$name', '$surName', '$mail', '$pass', '$sex', '$birthday', '$avatar')";
		
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