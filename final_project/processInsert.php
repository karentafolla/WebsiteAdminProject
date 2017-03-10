<?php
    session_start(); //start or resume an existing session 
    include 'database/database.php';
    $connection = getDatabaseConnection(); 

    $sql = "INSERT INTO games (title, summary, genre, price, console, rating) VALUES (:title, :summary, :genre, :price, :console, :rating)";
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