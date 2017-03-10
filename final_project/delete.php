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
            <div class="form-group">
             <span id="result"></span> </br>
              <label for="sel1"><h2>Select a Game to Delete:</h2></label>
              <form role="form" method="post" href="delete.php">
              
              <select class="form-control" id="sel1">
              
                <?php
                    session_start(); //start or resume an existing session 
                    include 'database/database.php'; 
                    $connection = getDatabaseConnection();
                    
                    $sql = "SELECT * FROM games";
                    
                    $statement = $connection->prepare($sql);  
                    $statement->execute(); 
                    //$record = $statement->fetch(); 
                    
                    while ($row = $statement -> fetch()){
                        echo "<option>";
                        echo $row['title'];
                        echo "</option>";
                    }
                    
                ?>
                </select>
                <button name="loginForm" id="submit" class="btn btn-lg btn-info btn-block btn-space" type="submit"> Submit </button>
              </form>
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
<script>
    $(document).ready(function() {
        $('#submit').click(function(e) {
        e.preventDefault();
        
        // console.log('Inside ready');
        var title = $("#sel1 option:selected" ).text();

        var data = {
            "title" : title,
        }
        
        
        var callUrl = "http://cst336-internet-programming-karentafolla.c9users.io/final_project/processDelete.php";
        $.ajax({ url: callUrl, 
                  dataType: 'json', 
                  type:'POST',
                  //contentType: 'application/json',
                  data: data,
                  success: function(data) {
                    
                     console.log('successful');
                  }, 
                  error: function(xhr) {
                  },
                  complete: function() {
                     $('#result').html('You have successfully deleted ' + $("#sel1 option:selected" ).text());
                     console.log('done');
                  }
          });
     
         });
    });   

</script>