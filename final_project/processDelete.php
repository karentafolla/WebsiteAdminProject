<?php
    session_start(); //start or resume an existing session 
    include 'database/database.php';
    $connection = getDatabaseConnection(); 

    $sql = "DELETE FROM games WHERE title=:title";
    $namedParameters = array(); 
    $namedParameters[':title'] = $_POST['title'];
    $statement = $connection->prepare($sql);  
    $statement->execute($namedParameters);

?>