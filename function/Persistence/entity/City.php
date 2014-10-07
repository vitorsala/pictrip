<?php
	require_once 'function/Persistence/entity/Entity.php';
	
	class City extends Entity{
		public $name;
		public $country;
		
		public function __construct($name, Country $country){
			$this->name = $name;
			$this->country = $country;
		}
	}
?>