<?php
	require_once 'function/logging/Log.php';
	require_once 'function/Persistence/connection/DataBase.php';
	
    class UserDAO{
    	private $db;
    	
    	private function __construct(){
    		$db = DataBase::getInstance();
    	}
    	
    	
    }
    
    
    
    
    
    
    
    /**
        Função para localizar usuário no banco de dados
        @param
            $user -> Nome do usuário (email).
        @return
            RESOURCE contendo as informações da tabela usuário se o usuário foi encontrado
            FALSE   caso não seja encontrado nenhum usuário
    */
    function getUserByMail($userMail){
        try{
            $con = getDBConn();
        
            $result = mysql_query("SELECT * FROM user u, city ci, country co, user_role ur, role r 
                WHERE ((u.user_mail = '$userMail') AND (u.city_id = ci.city_id) AND (ci.country_id = co.country_id) AND (u.user_id = ur.user_id) AND (ur.role_id = r.role_id))");

            while($result && $row = mysql_fetch_array($result)){
                if($row['user_mail'] == $userMail){
                    mysql_close($con);
                    return $row;
                }
            }
            mysql_close($con);
            return FALSE;
            
        }catch(Exception $e){
            newLogEntry($e->getMessage(), logType::ERROR);
            throw $e;  
        }
        return FALSE;
        
    }
    
    function checkIfUserExist($userMail){
        try{
            $con = getDBConn();
            $result = mysql_query("SELECT user_mail FROM user WHERE user_mail = '$userMail';");

            while($result && $row = mysql_fetch_array($result)){
                if($row['user_mail'] == $userMail){
                    mysql_close($con);
                    return TRUE;
                }
            }
            mysql_close($con);
            return FALSE;
        }catch(Exception $e){
            newLogEntry($e->getMessage(), logType::ERROR);
            throw $e;  
        }
        return FALSE;
    }

    function getUserId($userMail){
        try{
            $con = getDBConn();
        
            $result = mysql_query("SELECT user_id, user_mail FROM user WHERE user_mail = '$userMail';");

            while($result && $row = mysql_fetch_array($result)){
                if($row['user_mail'] == $userMail){
                    return $row['user_id'];
                }
            }
            return FALSE;
        }catch(Exception $e){
            newLogEntry($e->getMessage(), logType::ERROR);
            throw $e;  
        }
        return FALSE;
    }

    function getDefaultRoleId(){
        try{
            $con = getDBConn();
            
            $result = mysql_query("SELECT * FROM role WHERE role_name = 'default';");

            while($result && $row = mysql_fetch_array($result)){
                if($row['role_name'] == "default"){
                    return $row['role_id'];
                }
            }
            return FALSE;
        }catch(Exception $e){
            newLogEntry($e->getMessage(), logType::ERROR);
            throw $e;  
        }
        
        return FALSE;
    }

    /**
        Função para inserir usuário no banco de dados
        @param
            $user -> Nome do usuário (email).
            $pass -> Senha do usuário
        @return
    */
    function insertNewUser($userName, $userMail, $userPass, $userNasc, $userSex, $cityCod){
        try{
            $con = getDBConn();
            
            mysql_query("INSERT INTO user(user_name, user_mail, user_pass, user_nasc, user_sex, city_id)
                VALUES ('$userName', '$userMail', '$userPass', '$userNasc', '$userSex', $cityCod)");

            $userId = getUserId($userMail);
            $roleId = getDefaultRoleId();
            
            mysql_query("INSERT INTO user_role(user_id, role_id)
                VALUES ($userId, $roleId);");

            mysql_close($con);
            
        }catch(Exception $e){
            newLogEntry($e->getMessage(), logType::ERROR);
            @mysql_close($con);
            throw $e;
        }
    }
?>