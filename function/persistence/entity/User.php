<?php
	require_once 'function/persistence/entity/Entity.php';

	/**
	 * Entidade usuário
	 * @author Vitor Kawai Sala
	 */
	class User extends Entity{
		public $mail;
		public $name;
		public $surname;
		public $birthday;
		public $password;
		public $sex;
		public $avatar;
		public $registred;
		
		public function __construct(){}
		
	}
	
?>