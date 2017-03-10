<?php
    function getDatabaseConnection(){
        
        $username="karentafolla";
        $password="";
        $hostname = "localhost";
        $dbname="videogame";
        $dbPort = "127.0.0.1";
    
        $dbConn = new PDO("mysql:host=$hostname;port=$dbPort;dbname=$dbname", $username, $password);
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        return $dbConn;
    }
    
?>
