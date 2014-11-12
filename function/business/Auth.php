<?php
require_once 'function/persistence/entity/Entity.php';
require_once 'function/persistence/dao/UserDAO.php';

/**
 * Classe de autenticação de usuário
 * @author Vitor Kawai Sala
 * @todo testes
 */
class Auth {

	/** @var Expressão regular para validação de emails */
	private $mailRegex = "/^[a-zA-z].*@[a-zA-Z].*\.com?(\.[a-zA-Z]*)*$/";
	
	/** @var Expressão regular para validação de senhas */
	private $passRegex = "/^(\w|!|\?|@|#|\$|%|&|\*){5,}$/";
	
	/**
	 * @var UserDAO - DAO do usuário.
	 */
	private $dao;
	
	/** Construtor */
	public function __construct(){
		$this->dao = UserDAO::getInstance();
	}
	
	/**
	 * Login de usuário.
	 * @param string $userMail
	 * @param string $password
	 * @throws DataBaseException
	 * @return boolean
	 * 
	 * @todo Testar sessão.
	 */
	public function login($userMail, $password){
		// Validação de dados
		if (preg_match ( $this->mailRegex, $userMail ) == 0)
			return false;
		
		if (strlen ( $password ) < 5 || preg_match ( $this->passRegex, $password ) == 0)
			return false;
		
		try{
			$user = $this->dao->getUserByMail($userMail);
			if($user == false)	return false;
			$password = md5($password);
			if($password == $user->password){
				if(session_status() !== FALSE)	session_start();
				$_SESSION['id'] = $user->id;
				$_SESSION['name'] = $user->name;
				$_SESSION['surname'] = $user->surname;
				$_SESSION['mail'] = $user->mail;
				$_SESSION['gender'] = $user->gender;
				$_SESSION['avatar'] = $user->avatar;
				$_SESSION['logged'] = TRUE;
				return TRUE;
			}
			else	return FALSE;
		}catch (DataBaseException $e){
			throw $e;
		}
	}
	
	public function logout(){
		session_start();
		session_destroy();
	}
	
	public function getUserId($userMail){
	}
}
?>