<?php 
session_start(); //start or resume an existing session 

include 'database/database.php'; 

$connection = getDatabaseConnection(); 

if (isset($_POST['loginForm'])) { //checks whether user submitted the form 
     
    $username = $_POST['username'];  
    $password = $_POST["password"];

    $sql = "SELECT *  
            FROM administrator 
            WHERE username = :username 
            AND password = :password";  //Preventing SQL Injection 
             
    $namedParameters = array(); 
    $namedParameters[':username'] = $username;                 
    $namedParameters[':password'] = $password;             
     
    $statement = $connection->prepare($sql);  
    $statement->execute($namedParameters); 
    $record = $statement->fetch(PDO::FETCH_ASSOC); 
     
    if (empty($record)) { //wrong username or password 
         
        $_SESSION['message'] = "Wrong username or password!"; 
         
        header("Location: login.php"); 

    } else { 
        unset($_SESSION['message']);
        $_SESSION['username'] = $record['username'];
        
        $sql = "UPDATE administrator SET lastlogin=CURRENT_TIMESTAMP WHERE username=:username"; 
                 
        $namedParameters = array(); 
        $namedParameters[':username'] = $username;            
         
        $statement = $connection->prepare($sql);  
        $statement->execute($namedParameters); 
         
        header("Location: adminSelect.php"); 
                 
    } 
} 

?>