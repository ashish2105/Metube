<?php
session_start();
//session_start();
    $uname=$_SESSION['username'];
include_once "function.php";
$answer='';



 
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
      <form class="form-signin" method="get" action="">
        <h2 class="form-signin-heading">Reset Password</h2>
        <br><br>
        
          
                  <div class="form-group">
                   
                   <div class="form-group">
                    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value='<?php echo $uname; ?>' >
                  </div>

                  <div class="form-group">
                    <input type="text" name="answer" id="answer" tabindex="2" class="form-control" value='<?php echo $answer; ?>' placeholder="Answer the name of your first school">
                  </div>

                  <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit" value="submit">Submit</button>
                      </div>
      </form>
      
      
    

    <?php
          if(isset($_GET['submit']))
      { 
            $uname=$_GET['username'];
            $answer=$_GET['answer'];
            $query="select * from User where username='$uname' and answer='$answer'"; 
            $output=mysql_query($query);

          if (!$output){
    die ("user_exist_check() failed. Could not query the database: <br />". mysql_error());
  } 
  else {  ?>

  <form name="pass" method=post action=" ">
  <div class="form-group">
                  <input type="password" name="password1" id="password" tabindex="2" class="form-control" placeholder="Password">
                  </div>
                  <div class="form-group">
                  <input type="password" name="password2" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
                  </div>
                  <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block" name="reset" type="submit" value="reset">Reset</button>
                      </div>

  </form> 


<?php
   
   if(isset($_POST['reset']))
   {
    $pass=$_POST['password1'];
    $pass1=$_POST['password2'];
    if( $_POST['password1'] != $_POST['password2']) {
    echo("Passwords don't match. Try again?");
  }
  else{


    $query2="update account SET password = '$pass' where username='$uname'";
    echo "$query2";
    $output1 = mysql_query($query2);
  header('Location:login.php');
     // break;
    
    }

   }


  }
}

    ?>


		</div>		 
         </div>
			
      </div>




</body>
</html>