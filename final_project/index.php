<!DOCTYPE html>
<html>
    <head>
      <!--<link rel="shortcut icon" href="assets/icon.png" type="image/png" />-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">
        <!--<link rel="stylesheet" href="css/background.css">-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <title> </title>
        
    </head>
    <body>
      <div id="fullscreen_bg" class="fullscreen_bg"/>
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand">GameOn</a>
            </div>
            <ul class="nav navbar-nav pull-right">
              <li class="active"><a href="index.php">Home</a></li>
              <li><a href="login.php">Log In</a></li>
              <li><a href="#"></a></li>
            </ul>
          </div>
        </nav>
        <div class="container-fluid">
          <div class="filter">
            <span><a href="https://docs.google.com/a/csumb.edu/document/d/1FfHy3Kd_9pFE4PpF4Jase1CSdiYVTY4NzL_kzhBX9mI/edit?usp=sharing" target="_blank"> User Story and Database Schema</a></span>
          </div>
          <div class="filter">
            Please Filter by Console, Genre or Price
          </div>
          <div class="row">
            <form  action="" method="POST">
              <div class="col-sm-4" style="background-color:lavender;">
                  <h5>Filter Console</h5>
                    <input type="checkbox" value="PS3" name="console[]"> PlayStation 3 <br>
                    <input type="checkbox" value="PS4" name="console[]"> PlayStation 4 <br>
                    <input type="checkbox" value="Xbox" name="console[]"> Xbox <br>
                    <input type="checkbox" value="Windows" name="console[]"> Windows <br>
                    <input type="checkbox" value="Wii" name="console[]"> Wii <br>
                    <input type="checkbox" value="WiiU" name="console[]"> Wii U <br>
                    <input type="checkbox" value="3DS" name="console[]"> 3DS <br>
                    <button name="submit" class="btn btn-md btn-primary btn-block" type="submit"> Submit </button>
              </div> 
              

              <div class="col-sm-4" style="background-color:lavender;">
                  <h5>Filter Genre</h5>
                    <input type="checkbox" value="Action Adventure" name="genre[]"> Action Adventure <br>
                    <input type="checkbox" value="Horror" name="genre[]"> Horror <br>
                    <input type="checkbox" value="Platform" name="genre[]"> Platform <br>
                    <input type="checkbox" value="Fighting" name="genre[]"> Fighting <br>
                    <input type="checkbox" value="Survival" name="genre[]"> Survival<br>
                    <input type="checkbox" value="Action Role Playing" name="genre[]"> RolePlaying<br>
                    <input type="checkbox" value="FPS" name="genre[]"> First Person Shooter <br>
                    <button name="submit" class="btn btn-md btn-primary btn-block" type="submit"> Submit </button>
              </div>
              <div class="col-sm-4" style="background-color:lavender;">
                  <h5>Filter Price</h5>
                    <input type="radio" value="5" name="price"> Less $5 <br>
                    <input type="radio" value="10" name="price"> Less $10 <br>
                    <input type="radio" value="20" name="price"> Less $20 <br>
                    <input type="radio" value="30" name="price"> Less $30 <br>
                    <input type="radio" value="40" name="price"> Less $40 <br>
                    <input type="radio" value="50" name="price"> Less $50 <br>
                    <input type="radio" value="60" name="price"> Less $60 <br>
                    <button name="submit" class="btn btn-md btn-primary btn-block" type="submit"> Submit </button>
              </div>
            </form>
            </br>
            </br>
          </div>    
        </div>
        <?php
          //session_start(); //start or resume an existing session 
          include 'database/database.php'; 
          $connection = getDatabaseConnection(); 

          
          if(isset($_POST['console'])){
            
            //sets commas for all items selected
            $place_holders = implode(',', array_fill(0, count($_POST['console']), '?'));
              
            $sql = "SELECT * FROM games WHERE console IN ($place_holders)";  
            $statement = $connection->prepare($sql);  
            $statement->execute($_POST['console']); 
            echo '</br>';
            echo '<table class="table table-hover">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Title</th>';
            echo '<th>Summary</th>';
            echo '<th>Price</th>';
            echo "</thread>";
            echo '</tbody>';
            while ($row = $statement -> fetch()){
              echo '<tr>';
                echo '<td>';
                echo $row['title'];
                echo '</td>';
                
                echo '<td>';
                echo $row['summary'];
                echo '</td>';
                
                echo '<td>';
                echo '$' .$row['price'];
                echo '</td>';
              echo '</tr>';
              
            }
          echo '</tbody>';
          echo '</table>';

          }
          else if(isset($_POST['genre'])){
            //sets commas for all items selected
            $place_holders = implode(',', array_fill(0, count($_POST['genre']), '?'));
              
            $sql = "SELECT * FROM games WHERE genre IN ($place_holders)";  
            $statement = $connection->prepare($sql);  
            $statement->execute($_POST['genre']); 
            echo '</br>';
            echo '<table class="table table-hover">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Title</th>';
            echo '<th>Summary</th>';
            echo '<th>Console</th>';
            echo '<th>Price</th>';
            echo "</thread>";
            echo '</tbody>';
            while ($row = $statement -> fetch()){
              echo '<tr>';
                echo '<td>';
                echo $row['title'];
                echo '</td>';
                
                echo '<td>';
                echo $row['summary'];
                echo '</td>';
                
                echo '<td>';
                echo $row['console'];
                echo '</td>';
                
                echo '<td>';
                echo '$' . $row['price'];
                echo '</td>';
              echo '</tr>';
              
            }
          echo '</tbody>';
          echo '</table>';
          }
          else if(isset($_POST['price'])){
            
            $price = $_POST['price'];
              
            $sql = "SELECT * FROM games WHERE price <:price ORDER BY price DESC";  
            
            $nameParameter = array(":price" => $price);
            $statement = $connection->prepare($sql);  
            $statement->execute($nameParameter); 
            
            echo '</br>'; 
            echo '<table class="table table-hover">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Title</th>';
            echo '<th>Summary</th>';
            echo '<th>Price</th>';
            echo "</thread>";
            echo '</tbody>';
            while ($row = $statement -> fetch()){
              echo '<tr>';
                echo '<td>';
                echo $row['title'];
                echo '</td>';
                
                echo '<td>';
                echo $row['summary'];
                echo '</td>';
                
                echo '<td>';
                echo "$" . $row['price'];
                echo '</td>';
              echo '</tr>';
              
            }
          echo '</tbody>';
          echo '</table>';
          }
            
        ?>

    </body>
</html>
<?php

?>