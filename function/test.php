<?php
    require_once "user/register.php";
    require_once "user/auth.php";
    //Testes
    try{
        /*
        $uname = "test user";
        $utest = "lalala@user.com";
        $ptest = "teste";
        $nasctest = "1990-04-03";
        $sextest = "M";
        $cityTest = 1;
        
        */
        $uname = "test user 2";
        $utest = "lololo@user.com";
        $ptest = "teste";
        $nasctest = "1995-12-01";
        $sextest = "F";
        $cityTest = 2;
        
        $a = registerNewUser($uname, $utest, $ptest, $nasctest, $sextest, $cityTest);
        
        echo ($a > 0 ? "REG!" : "NOPE!")."<br/><hr/><br/>";
        
        $a = auth($utest,$ptest);
        
        if(!$a) echo "NAY!";
        else{
            foreach($a as $i => $out){
                echo "$i: $out<br/>";   
            }  
        }
    }catch (Exception $e){
        echo "aconteceu um erro!<br/><br/>";   
        echo $e->getMessage();
    }

?>