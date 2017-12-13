<?php
//ini_set('session.save_path', 'metube_template_2017');

session_start();

include_once "function.php";

if(isset($_POST['submit'])) {
		if($_POST['username'] == "" || $_POST['password'] == "") {
			$login_error = "One or more fields are missing.";
		}
		else {
			$check = user_pass_check($_POST['username'],$_POST['password']); // Call functions from function.php
			if($check == 1) {
				$login_error = "User ".$_POST['username']." not found.";
			}
			elseif($check==2) {
				$login_error = "Incorrect password.";
			}
			else if($check==0){
				$_SESSION['username']=$_POST['username']; //Set the $_SESSION['username']
        $un=$_SESSION['username'];
				header('Location: browse.php');
			}		
		}
}


 
?>

<html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <SCRIPT type='text/javascript'>
window.history.forward();
    function noBack() {window.history.forward(); }
window.onload='noBack()';
window.onpageshow=function(evt){if(evt.persisted)noBack()}
window.onunload=function(){void(0)}
 
</SCRIPT>

<style>
@media (min-width: 1200px) {
  .container {
    width: 400px;
  }
}
body {background-color: #2d2d30;
color:white;
}
input[type=submit] {

  color:black;
    }
   input[type=reset] {

  color:black;
    }
input[type=text] {

  color:black;
    }
    input[type=password] {

  color:black;
    }
</style>  
</head>

<body>

	<div class="container">
      <form class="form-signin" method="post" action="login.php">
        <h2 class="form-signin-heading">Log In</h2>
        
        <div class="collapse navbar-collapse" id="myNavbar"><br>
      <ul class="nav navbar-nav navbar-right">
    <li><a href='index.php'  style="color:#FF9900;">Homepage</a></li>
      <li><a href="register.php" style="color:#FF9900;">Register</a></li>
      </ul></div><br><br>

        
          
                  <div class="form-group">
                   
                    <input type="text" name="username" id="password" tabindex="1" class="form-control" placeholder="Username" value="">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                  </div>
                  
                  <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit" value="Login">Sign in</button>
                      </div>
      
      
                        <button class="btn btn-lg btn-primary btn-block" name="forgot" type="submit" value="Forgot Password">Forgot Password</button>
                      </div>
      </form>
    </div>

    <?php
          if(isset($_POST['forgot']))
      {
        $un=$_SESSION['username'];
        header('Location: reset.php');
      }

    ?>


				  <?php
  if(isset($login_error))
   {  echo "<div id='passwd_result'>".$login_error."</div>";}
?>
         </div>
			
      </div>




</body>
</html>