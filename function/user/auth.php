<?php
    require_once "/DAO/userDAO.php";
    
    /**
        Autenticação de usuário
    */
    function auth($user, $pass){
        $userRegex = "/\A[a-zA-z].*@[a-zA-Z].*\.com?(\.[a-zA-Z]*)*\z/";
        $passRegex = "/\A(\w|!|@|#|\$|%|&|\*){5,}\z/";
        if(!preg_match($userRegex, $user))   return false;
        if(!preg_match($passRegex, $pass))   return false;
        
        try{
            $result = getUserByMail($user);
        }catch (Exception $e){
            throw $e;   
        }
            
        if($result && password_verify($pass, $result['user_pass'])){
            foreach($result as $key => $out){
                if(is_numeric($key)) unset($result[$key]);   
            }  
            newLogEntry("Usuário '".$result['user_name']."' (".$result['user_mail'].") logou no sistema com sucesso!");
            return $result;
        }
        else    return false;
    }


?>