<?php
    session_start();
?>

<?php
    include 'database/database.php'; 
    
    $connection = getDatabaseConnection(); 

    function getUsername(){
        global $connection;
        
        $username = $_SESSION['username'];
        
        $sql = "SELECT * FROM administrator WHERE username = :username";  //Preventing SQL Injection 
             
        $namedParameters = array(); 
        $namedParameters[':username'] = $username;            
         
        $statement = $connection->prepare($sql);  
        $statement->execute($namedParameters); 
        $record = $statement->fetch(PDO::FETCH_ASSOC); 
        
        echo $record['firstname'];
    }
    
    function getAllItems(){
        global $connection;
        
        $sql = "SELECT * FROM games";
        $statement = $connection->prepare($sql);
        $statement->execute();
        
        echo '<table class="table table-hover">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Title</th>';
        echo '<th>Summary</th>';
        echo '<th>Genre</th>';
        echo '<th>Price</th>';
        echo '<th>Console</th>';
        echo '<th>Rating</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        while ($row = $statement -> fetch()){
            
            echo '<tr>';
                echo '<td>';
                echo $row['title'];
                echo '</td>';
                
                echo '<td>';
                echo $row['summary'];
                echo '</td>';
                
                echo '<td>';
                echo $row['genre'];
                echo '</td>';
                
                echo '<td>';
                echo $row['price'];
                echo '</td>';
                
                echo '<td>';
                echo $row['console'];
                echo '</td>';
                
                echo '<td>';
                echo $row['rating'];
                echo '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/adminSelect.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
        <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        
        <title> </title>
    </head>
    <body>
    <div id="wrapper" class="active">
      
      <!-- Sidebar -->
            <!-- Sidebar -->
      <div id="sidebar-wrapper">
        <ul id="sidebar_menu" class="sidebar-nav">
           <li class="sidebar-brand"><a id="menu-toggle" href="">Menu<span id="icon-home" class="glyphicon glyphicon-align-justify"></span></a></li>
        </ul>
        <ul class="sidebar-nav" id="sidebar">
          <li class=""><a href="adminSelect.php"> Database<span></span></a></li>     
          <li class=""><a href="update.php"> Update<span></span></a></li>     
          <li class=""><a href="insert.php"> Insert<span></span></a></li>
          <li class=""><a href="delete.php"> Delete<span></span></a></li>     
          <li class=""><a href="reports.php"> Reports<span></span></a></li>
          <li class=""><a href="index.php"> Log Out<span></span></a></li>
          </ul>
      </div>
          
      <!-- Page content -->
      <div id="page-content-wrapper">
        <!-- Keep all page content within the page-content inset div! -->
        <div class="page-content inset">
          <div class="row">
              <div class="col-md-12">
                  <p class="well lead"> Welcome Back <?php getUsername(); ?> </p>
                  <p class="well lead"> Current Items in Your Database <?php getAllItems(); ?> </p> 
              </div>
          </div>
        </div>
      </div>
      
    </div>

    </body>
</html>

<script type="text/javascript">
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
});
    
</script>
