<?php
	
	require_once 'function/Persistence/entity/Entity.php';
	
	class Country extends Entity{
		public $name;
		
		public function __construct($name){
			$this->name = $name;
		}
	}
	
?>