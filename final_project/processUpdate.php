<?php
    session_start(); //start or resume an existing session 
    include 'database/database.php';
    $connection = getDatabaseConnection(); 

    $sql = "UPDATE games SET summary=:summary, genre=:genre, price=:price, console=:console, rating=:rating WHERE title=:title";
    $namedParameters = array(); 
    $namedParameters[':title'] = $_POST['title'];
    $namedParameters[':summary'] = $_POST['summary'];
    $namedParameters[':genre'] = $_POST['genre'];
    $namedParameters[':price'] = $_POST['price'];
    $namedParameters[':console'] = $_POST['console'];
    $namedParameters[':rating'] = $_POST['rating'];
    $statement = $connection->prepare($sql);  
    $statement->execute($namedParameters);


?>