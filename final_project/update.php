
<?php

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/adminSelect.css">
        <!--<link rel="stylesheet" href="css/background.css">-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
        <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <title> </title>
    </head>
    <body>
    <div id="wrapper" class="active">
        
       <div id="fullscreen_bg" class="fullscreen_bg" />
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
       
       <!--<div id="fullscreen_bg" class="fullscreen_bg"/>   -->
      <!-- Page content -->
    <div id="page-content-wrapper">
        <!-- Keep all page content within the page-content inset div! -->
    
    <!--<div class="page-content inset">-->
    <!--  <div class="row">-->
    <!--      <div class="col-md-12">-->
    <!--          <p class="well lead"> Welcome Back </p>-->
              <!--<p class="well lead"> Current Items in Your Database  </p> -->
    <!--      </div>-->
    <!--  </div>-->
    <!--</div>-->
     <div class="page-content inset">
       <div class="row">
         <div class="col-md-12">
            <div class="form-group">
             <span id="result"></span> </br>
              <!--<h1> Update</h1>-->
              <!--<h5> something</h5>-->
              <label for="sel1"> Select a Game: </label>
              <form role="form" method="post" href="update.php">
              
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
                
                <div class="form-group">
                   <label for="inputlg">Summary: </label>
                   <input class="form-control input-lg" id="inputlg" name="summary" type="text" placeholder="Summary"  autofocus="">
                 </div>
                  <div class="form-group">
                   <label for="inputlg">Genre: </label>
                   <input class="form-control input-lg" id="inputlg" name="genre" type="text" placeholder="Genre" autofocus="">
                 </div>
                 <div class="form-group">
                   <label for="inputlg">Price: </label>
                   <input class="form-control input-lg" id="inputlg" name="price" type="text" placeholder="Price" autofocus="">
                 </div>
                 <div class="form-group">
                   <label for="inputlg">Console: </label>
                   <input class="form-control input-lg" id="inputlg" name="console" type="text" placeholder="Console" autofocus="">
                 </div>
                 <div class="form-group">
                   <label for="inputlg">Rating: </label>
                   <input class="form-control input-lg" id="inputlg" name="rating" type="text" placeholder="Rating" autofocus="">
                 </div>
                
                <button name="loginForm" id="submit" class="btn btn-lg btn-info btn-block" type="submit"> Submit </button>
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
        var summary = $("input[name=summary]").val();
        var genre = $("input[name=genre]").val();
        var price = $("input[name=price]").val();
        var console1 = $("input[name=console]").val();
        var rating = $("input[name=rating]").val();
        
        console.log($( "#sel1 option:selected" ).text());
 
        var data = {
            "title" : title,
            "summary" : summary,
            "genre" : genre,
            "price" : price,
            "console" : console1,
            "rating" : rating
        };
        
        var callUrl = "http://cst336-internet-programming-karentafolla.c9users.io/final_project/processUpdate.php";
        $.ajax({ url: callUrl, 
                  dataType: 'json', 
                  type:'POST',
                  //contentType: 'application/json',
                  data: data,
                  success: function(data) {
                    
                     console.log('successful');
                     //console.log(data);
                    //$('.results').html(JSON.stringify(data));
                  }, 
                  error: function(xhr) {
                     //console.log('problem:');
                     //console.log(xhr.responseText);
                    // $('.results').html(xhr.responseText);
                  },
                  complete: function() {
                     $('#result').html('You have successfully updated ' + $("#sel1 option:selected" ).text());
                     console.log('done');
                     // Hide loading indicator no matter what when done
                     //$('#loading').hide();
                  }
          });
     
         });
    });
</script>
