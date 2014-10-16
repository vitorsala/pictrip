<?php
	foreach(glob("function/Persistence/entity/*.php") as $filePath){
		require_once $filePath;
	}

	abstract class Entity{
		private $id;
		
		public function getId(){
			return $id;
		}
		
		private function setId($id){
			$this->id = $id;
		}
	}
?>