<?php
    require_once 'function/logging/LogType.php';
	/**
	 * Classe estática para LOG do sistema.
	 * @author Vitor Kawai Sala
	 */
    class Log{
    	private function __construct(){}
    	/**
    	 * 
    	 * @param String $message
    	 * @param LogType $type
    	 */
	    public static function newLogEntry($message, $type = LogType::LOG){
	    	if(!DEBUG_MODE && $type == LogType::DEBUG)	die();
	    	date_default_timezone_set('America/Sao_Paulo');
	    	$filePrefix = "pictrip_log_".date('Y-m-d').".log";
	    	
	        $msg = date('Y-m-d h:i:s e').' - ';
	        
	        switch($type){
	            case logType::ERROR:
	                $msg .= "ERROR:\t";
	                break;
	            case logType::WARNING:
	                $msg .= "WARNING:\t";
	                break;
	            case logType::DEBUG:
	                $msg .= "DEBUG:\t";
	                break;
	            default:
	                $msg .= "LOG:\t";
	                break;
	        }
	        
	        $msg .= "$message\n";
	        file_put_contents("$filePrefix", $msg, FILE_APPEND);
	    }
    }

?>