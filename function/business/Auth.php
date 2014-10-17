<?php
require_once 'function/persistence/entity/Entity.php';
require_once 'function/persistence/dao/UserDAO.php';

class Auth {
	private $dao;
	
	public function __construct(){
		$this->dao = UserDAO::getInstance();
	}
	
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