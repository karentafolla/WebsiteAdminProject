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
        <div class="container">
          <h2>Generate Report: </h2>
          <form  method="POST" action="reports.php">
            <label class="radio-inline">
              <input type="radio" name="optradio" value="price" id="price">  Average Price of all games Games
              
            </label>
            <label class="radio-inline" >
              <input type="radio" name="optradio" class="maxtickets_enable_cb" id="console"> Count Games from specific Console
              <span id="consoleInput" style="display: none">
                </br>
                Console Name:
                <input type="text" name="consoleName" />
              </span>
    
            </label>
            <!--<label class="radio-inline">-->
            <!--  <input type="radio" name="optradio">Option 3-->
            <!--</label>-->
            </br>
            <button type="submit" name="loginForm" id="submit" class="btn btn-lg btn-info center-"> Submit </button>
        
          </form>
          <?php
                $checkBox = $_POST['optradio'];
                
                //echo $checkBox;
                if($checkBox == "price"){
                    getAveragePrice();
                }
                else if(isset($_POST['consoleName'])){
                    
                    getData();
                }
                
                
            ?>
        </div>
    </div>

    </body>
</html>

<?php
    session_start();
    
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
    
    function getAveragePrice(){
        
        $connection = getDatabaseConnection();
        $sql = "SELECT AVG(price) as priceAverage FROM games";
        $statement = $connection->prepare($sql); 
        $statement->execute();
        
        while ($row = $statement-> fetch()){
            $count = $row['priceAverage'];   
        }
        echo "</br>";
        echo "<h4> Average price of all the games is $" . number_format((float)$count, 2, '.', '') . "</h4>";
    }
    
    function getData(){
        
        //global $connection;
        $connection = getDatabaseConnection();
        $sql = "SELECT COUNT(*) as totalNumber FROM games where console=:console";
        $namedParameters = array(); 
        $namedParameters[':console'] = $_POST['consoleName'];
        $statement = $connection->prepare($sql);  
        $statement->execute($namedParameters);
        while ($row = $statement-> fetch()){
            $count = $row['totalNumber'];   
        }
        echo "</br>";
        echo "<h4>You have " . $count . " " . $_POST['consoleName'] . " games!</h4>";

    }
    
?>

<script type="text/javascript">
    $(function () {
        $("input[name='optradio']").click(function () {
            if ($("#console").is(":checked")) {
                $("#consoleInput").show();
            } else {
                $("#consoleInput").hide();
            }
        });
    });
</script>
<script type="text/javascript">
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
});
    
</script>