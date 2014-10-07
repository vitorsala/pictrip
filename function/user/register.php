<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"])."\\tecwebII\\sql\\";

    require_once "$root\\function\\DAO\\userDAO.php";

    /**
        Registro de um novo usuário
    */
    function registerNewUser($userName, $userMail, $userPass, $userNasc, $userSex, $cityCod){
        $userRegex = "/^[a-zA-z].*@[a-zA-Z].*\.com?(\.[a-zA-Z]*)*$/";
        $passRegex = "/^(\w|!|\?|@|#|\$|%|&|\*){5,}$/";
        
        // Validação de dados
        if(preg_match($userRegex, $userMail) == 0)   return -1;
        if(strlen($userPass) < 5 || preg_match($passRegex, $userPass) == 0)   return -2;
        if($userSex != "M" && $userSex != "F")  return -3;
        // Verificação de unicidade do usuário
        try{
            if(checkIfUserExist($userMail))  return -3;
            $userPass = password_hash($userPass, PASSWORD_DEFAULT); // Hash da senha
            insertNewUser($userName, $userMail, $userPass, $userNasc, $userSex, $cityCod);
            newLogEntry("Usuário '$userName' ($userMail) cadastrado com sucesso!");
            return 1;
        }catch (Exception $e){
            throw $e;   
        }
        
    }


?>