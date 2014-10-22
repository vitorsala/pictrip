<?php
require_once 'function/persistence/entity/Entity.php';
require_once 'function/persistence/dao/UserDAO.php';

/**
 * Classe de autenticação de usuário
 * @author Vitor Kawai Sala
 * @todo testes
 */
class Auth {
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
		try{
			$user = $this->dao->getUserByMail($userMail);
			if(password_verify($password, $user->password)){
				session_start();
				$_SESSION['name'] = $user->name;
				$_SESSION['surname'] = $user->surname;
				$_SESSION['mail'] = $user->mail;
				$_SESSION['logged'] = TRUE;
				return TRUE;
			}
			else	return FALSE;
		}catch (DataBaseException $e){
			throw $e;
		}
	}
	
	public function logout(){
		session_destroy();
	}
	
}

?>