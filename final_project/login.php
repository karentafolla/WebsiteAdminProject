<?php
    session_start();
    $errorMessage = $_SESSION['message'];
?>
<!DOCTYPE html>
<html >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/login.css">
        <title> </title>
    </head>
    <body>
        <div id="fullscreen_bg" class="fullscreen_bg"/>
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="#">GameOn</a>
            </div>
            <ul class="nav navbar-nav pull-right">
              <li><a href="index.php">Home</a></li>
              <li class="active"><a href="login.php">Log In</a></li>
              <li><a href="#"></a></li>
            </ul>
          </div>
        </nav>
        
        <div class="container">
            
        	<form class="signin" method="POST" action="loginProcess.php">
        		<h1 class="signin-heading text-muted">Log In</h1>
        		<h5 class='signin-heading text-muted'> Username: karentafolla Password: one</h5>
        		<h5 class='signin-heading text-muted'> Username: brayanne Password: two</h5>
        		<input type="text" name="username" class="form-control" placeholder="User Name" required="" autofocus="">
        		<input type="password" name="password" class="form-control" placeholder="Password" required="">
        		</br>
        		<button name="loginForm" class="btn btn-lg btn-primary btn-block" type="submit"> Submit </button>
        	</form>
        	
        	<?php
                session_unset();
                if ($errorMessage) {
                    echo "<div class='errorMessage'>$errorMessage</div>";
                }
            ?>
        
        </div>

    </body>
</html>