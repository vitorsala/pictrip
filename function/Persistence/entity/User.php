<?php
	require_once 'function/Persistence/entity/Entity.php';
	
	class User extends Entity{
		public $city;
		public $mail;
		public $name;
		public $nasc;
		public $pass;
		public $sex;
		public $roles;
		
		public function __construct($name, $mail, $nasc, $pass, $sex, $roles, City $city){
			$this->name = $name;
			$this->mail = $mail;
			$this->nasc = $nasc;
			$this->pass = $pass;
			$this->sex = $sex;
			$this->roles = $roles;
			$this->city = $city;
		}
		
	}
?>