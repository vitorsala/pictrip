<?php
	require_once 'function/Persistence/entity/Entity.php';
	
	class User extends Entity{
		public $mail;
		public $name;
		public $surname;
		public $nasc;
		public $password;
		public $sex;
		public $avatar;
		public $registred;
		
		public function __construct(){}
		
	}
?>