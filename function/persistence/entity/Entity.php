<?php
	// Mágica para importar todas as entidades
	foreach(glob("function/persistence/entity/*.php") as $filePath){
		require_once $filePath;
	}
	
	/**
	 * Classe abstrata para entidades.
	 * @author Vitor Kawai Sala
	 */
	abstract class Entity{
		/** @var id */
		private $id;
		
		public function getId(){
			return $id;
		}
		
		private function setId($id){
			$this->id = $id;
		}
	}
?>