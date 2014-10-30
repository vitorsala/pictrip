<?php
require_once 'function/persistence/entity/Entity.php';
require_once 'function/persistence/dao/UserDAO.php';
require_once 'function/business/FileManager.php';
require_once 'function/logging/Log.php';

/**
 * Classe de registro de usuários.
 * @author Vitor Kawai Sala
 *
 */
class Register{
	/**
	 * @var UserDAO - DAO do usuário.
	 */
	private $dao;
	
	/** @var Expressão regular para validação de emails */
	private $mailRegex = "/^[a-zA-z].*@[a-zA-Z].*\.com?(\.[a-zA-Z]*)*$/";
	
	/** @var Expressão regular para validação de senhas */
	private $passRegex = "/^(\w|!|\?|@|#|\$|%|&|\*){5,}$/";
	
	/** Construtor */
	public function __construct() {
		$this->dao = UserDAO::getInstance();
	}
	
	/**
	 * Registro de um novo usuário
	 * @param unknown $name
	 * @param unknown $surName
	 * @param unknown $mail
	 * @param unknown $bDay
	 * @param unknown $bMonth
	 * @param unknown $bYear
	 * @param unknown $pass
	 * @param unknown $gender
	 * @param unknown $avatar
	 * @throws Exception
	 * @return number
	 * 
	 * @todo testar condições de erro
	 */
	
	public function registerNewUser($name, $surName, $mail, $bDay, $bMonth, $bYear, $pass, $gender, $avatar) {
		
		// Validação de dados
		if (preg_match ( $this->mailRegex, $mail ) == 0)
			return -1;
		
		if (strlen ( $pass ) < 5 || preg_match ( $this->passRegex, $pass ) == 0)
			return -2;
		
		if ($gender != "M" && $gender != "F")
			return -3;
		
		if (checkdate($bMonth, $bDay, $bYear))
			$birthday = date("Y/m/d",mktime(0, 0, 0, $bMonth, $bDay, $bYear));
		else 
			return -4;
		// Verificação de unicidade do usuário
		try {
			//$pass = password_hash ( $pass, PASSWORD_DEFAULT ); // Hash da senha
			
			$fm = new FileManager();
			try{
				$path = $fm->upload(FileManager::AVATAR, $avatar, $mail);
			}catch(UploadException $e2){
				$path = "";
			}
			echo "avatar => $path<br/><img src='$path' alt='avatar'/>";
			$r = $this->dao->registerNewUser($name, $surName, $mail, $birthday, $pass, $gender, $path);
			if($r){
				Log::newLogEntry ( "Usuário '$name $surName' ($mail) cadastrado com sucesso!" );
				return 1;
			}
			else{
				Log::newLogEntry ( "Falha ao cadastrar o usuario '$name $surName' ($mail)!" );
				return -5;
			}
		} catch ( DataBase $e ) {
			throw $e;
		} 
	}
	
}

?>