<?php
require_once 'function/persistence/exception/DataBaseException.php';
require_once 'function/logging/Log.php';

/**
 * Classe para conexão com o Banco de Dados.
 * 
 * @author Vitor Kawai Sala
 */
class DataBase {
	/**
	 * Instancia única da classe
	 * 
	 * @var $instance
	 */
	private static $instance;
	private $dbhost = "localhost"; // HOST
	private $dbuser = "root"; // DB Username
	private $dbpass = ""; // DB Password
	private $dbname = "pictrip"; // DB Name
	private $mysqli; // Classe conector
	
	// Singleton
	private function __construct() {
		$this->initDataBaseConnection ();
	} 
	
	public function __destruct() {
		$this->mysqli->close ();
	}
	
	/**
	 * Retorna a instância de <strong>DataBase</strong>
	 * 
	 * @return $instance - Instância única de <strong>DataBase</strong>
	 */
	public static function getInstance() {
		if (! isset ( self::$instance )) {
			self::$instance = new DataBase ();
		}
		return self::$instance;
	}
	
	/**
	 * Inicia uma nova conexão com o MySQL
	 * 
	 * @throws DataBaseException - Quando acontecer qualquer erro de conexão ou <strong>MySQLi</strong> lançar algum erro
	 */
	private function initDataBaseConnection() {
		if (! isset ( $this->mysqli )) {
			try {
				$this->mysqli = new mysqli ( $this->dbhost, $this->dbuser, $this->dbpass, $this->dbname );
				if ($this->mysqli->connect_errno > 0) {
					Log::newLogEntry ( $this->mysqli->error, LogType::ERROR );
					die ( 'Erro ao conectar ao banco de dados [' . $this->mysqli->error . ']' );
				}
				$this->mysqli->autocommit ( TRUE );
			} catch ( Exception $e ) {
				throw new DataBaseException ( $e->getMessage (), $e->getCode (), $e->getPrevious () );
			}
		}
	}
	
	/**
	 * Fecha conexão SQL
	 */
	private function closeConnection() {
		$check = $this->mysqli->close ();
		unset ( $this->mysqli );
	}
	
	/**
	 * Executa uma query SQL e retorna o valor.
	 * 
	 * @param String $query
	 *        	- Query SQL.
	 * @return mixed - <strong>TRUE</strong> se a query for executado com sucesso (INSERT, UPDATE, CREATE),
	 *         <strong>mixed</strong> se a query for executado com sucesso (SELECT) ou <strong>FALSE</strong> em caso de não haver
	 *         resultado ou a operação não for bem sucedido.
	 */
	public function query($query) {
		$result = $this->mysqli->query ( $query );
		if ($this->mysqli->errno > 0) {
			throw new DataBaseException ( $this->mysqli->errno.': Erro ao conectar ao banco de dados [' . $this->mysqli->error . ']' );
		}
		Log::newLogEntry ( "Query \"$query\" executado com sucesso.", LogType::DEBUG);
		return $result;
	}
	
	/**
	 * Método para manipulação de dados SQL.
	 * 
	 * @param unknown $query        	
	 */
	public function update($query) {
		$status = $this->query ( $query );
		if (! $status) {
			$this->mysqli->rollback ();
		} else
			$this->mysqli->commit ();
	}
	
	public function realEscape($string){
		return $this->mysqli->escape_string ($string);
	}
}
?>