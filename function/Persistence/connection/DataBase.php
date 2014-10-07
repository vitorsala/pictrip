<?php
	require_once 'function/Persistence/exception/DataBaseException.php';
	require_once 'function/logging/Log.php';
	
	/**
	 * Classe para conexão com o Banco de Dados.
	 * @author Vitor Kawai Sala
	 */
    class DataBase{
    	/**
    	 * Instancia única da classe
    	 * @var $instance
    	 */
        private static $instance;
        
        private $dbhost = "localhost";  // HOST
        private $dbuser = "user";       // DB Username
        private $dbpass = "password";   // DB Password
        private $dbname = "test";       // DB Name
        private $mysqli;				// Classe conector
        
        private function __construct(){}    // Singleton
        
        public function __destruct(){
        	$this->mysqli->close();
        }
        
        /**
         * Retorna a instância de <strong>DataBase</strong>
         * @return $instance - Instância única de <strong>DataBase</strong>
         */
        public static function getInstance(){
            if(!isset(self::$instance)){
                self::$instance = new DataBase();
            }
            return self::$instance;
        }
        
        /**
         * Inicia uma nova conexão com o MySQL
         * @throws DataBaseException - Quando acontecer qualquer erro de conexão ou <strong>MySQLi</strong> lançar algum erro
         */
        private function initDataBaseConnection(){
            if(!isset($this->mysqli)){
                try{
                    $this->mysqli = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
                    if($this->mysqli->connect_errno > 0){
                    	Log::newLogEntry($this->mysqli->error, LogType::ERROR);
                    	die('Erro ao conectar ao banco de dados ['.$this->mysqli->error.']');
                    }
                    $this->mysqli->autocommit(FALSE);
                }catch (Exception $e){ 
                	 throw new DataBaseException($e->getMessage(), $e->getCode(), $e->getPrevious());
                }
            }
        }   
             
        /**
         * Executa uma query SQL e retorna o valor.
         * @param String $query - Query SQL.
         * @return mixed - <strong>TRUE</strong> se a query for executado com sucesso (INSERT, UPDATE, CREATE),
         * <strong>mixed</strong> se a query for executado com sucesso (SELECT) ou <strong>FALSE</strong> em caso de não haver
         * resultado ou a operação não for bem sucedido.
         */
        private function query($query){
        	$this->initDataBaseConnection();
        	$query = $this->mysqli->escape_string($query);
        	$result = $this->mysqli->query($query);
        	if(!$result && $this->mysqli->errno > 0){
        		Log::newLogEntry($this->mysqli->error, LogType::ERROR);
        		die('Erro ao conectar ao banco de dados ['.$this->mysqli->error.']');
        	}
        	Log::newLogEntry("Query \"$query\" executado com sucesso.");
        	return $result;
        }
        
        /**
         * Fecha conexão SQL
         */
        private function closeConnection(){
        	$check = $this->mysqli->close();
        	unset($this->mysqli);
        }
        
        /**
         * Método para pesquisa SQL.
         * @param unknown $query
         * @return mixed
         */
        public function consult($query){
        	return $this->query($query);
        }
        
        /**
         * Método para manipulação de dados SQL.
         * @param unknown $query
         */
        public function update($query){
        	$status = $this->query($query);
        	if(!$status){
        		$this->mysqli->rollback();
        		Log::newLogEntry($this->mysqli->error, LogType::ERROR);
        	}
        	else	$this->mysqli->commit();
        }
    }
?>