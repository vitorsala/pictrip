<?php
require_once 'function/Persistence/entity/Entity.php';
require_once 'function/Persistence/dao/UserDAO.php';

class Register{
	private $dao;
	
	private $userRegex = "/^[a-zA-z].*@[a-zA-Z].*\.com?(\.[a-zA-Z]*)*$/";
	private $passRegex = "/^(\w|!|\?|@|#|\$|%|&|\*){5,}$/";
	
	public function __construct() {
		$this->dao = UserDAO::getInstance();
	}
	
	/**
	 * Registro de um novo usuário
	 */
	public function registerNewUser($name, $surName, $mail, $bDay, $bMonth, $bYear, $pass, $sex, $avatar) {
		
		// Validação de dados
		if (preg_match ( $this->userRegex, $mail ) == 0)
			return -1;
		
		if (strlen ( $pass ) < 5 || preg_match ( $this->passRegex, $pass ) == 0)
			return -2;
		
		if ($sex != "M" && $sex != "F")
			return -3;
		
		if (checkdate($bMonth, $bDay, $bYear))
			$birthday = date("Y/m/d",mktime(0, 0, 0, $bMonth, $bDay, $bYear));
		else 
			return -4;
		// Verificação de unicidade do usuário
		try {
			if (checkIfUserExist ( $userMail ))
				return -5;
			$pass = password_hash ( $userPass, PASSWORD_DEFAULT ); // Hash da senha
			
			$r = $this->dao->registerNewUser($name, $surName, $mail, $birthday, $pass, $sex, $avatar);
			if($r){
				newLogEntry ( "Usuário '$name $surName' ($mail) cadastrado com sucesso!" );
				return 1;
			}
			else{
				newLogEntry ( "Falha ao cadastrar o usuario '$name $surName' ($mail)!" );
				return -5;
			}
		} catch ( Exception $e ) {
			throw $e;
		}
	}
	
}

?>