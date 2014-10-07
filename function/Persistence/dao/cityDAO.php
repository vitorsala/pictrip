<?php
    require_once "database.php";

    include_once "/logging/log.php";

    function getCityByName($cityName){
        try{
            $con = getDBConn();
        }catch(Exception $e){
            newLogEntry($e->getMessage(), logType::ERROR);
            throw $e;  
        }
        
        $result = mysql_query("SELECT * FROM ucity ci, country co 
            WHERE ((ci.city_name = '$cityName') AND ci.country_id = co.country_id)");
        
        while($result && $row = mysql_fetch_array($result)){
            if($row['city_name'] == $cityName){
                mysql_close($con);
                return $row;
            }
        }
        mysql_close($con);
        return FALSE;
    }

    function getCityByNameAndCountry($cityName, $countryName){
        try{
            $con = getDBConn();
        }catch(Exception $e){
            newLogEntry($e->getMessage(), logType::ERROR);
            throw $e;  
        }
        
        $result = mysql_query("SELECT * FROM ucity ci, country co 
            WHERE ((ci.city_name = '$cityName' AND co.country_name = '$countryName') AND ci.country_id = co.country_id)");
        
        while($result && $row = mysql_fetch_array($result)){
            if($row['city_name'] == $cityName && $row['country_name'] == $countryName){
                mysql_close($con);
                return $row;
            }
        }
        mysql_close($con);
        return FALSE;
    }
    
    function getAllCities(){
        try{
            $con = getDBConn();
        }catch(Exception $e){
            newLogEntry($e->getMessage(), logType::ERROR);
            throw $e;  
        }
        
        $result = mysql_query("SELECT * FROM ucity ci, country co 
            WHERE (ci.country_id = co.country_id)");
        
        if($result){
            mysql_close($con);
            return $result;
        }
        
        mysql_close($con);
        return FALSE;
        
    }
?>