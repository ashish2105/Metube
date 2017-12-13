<?php
session_start();

include_once "function.php";

if(isset($_POST['submit'])) {

	if($_POST['username']== ""  ||$_POST['emailid']== ""  ||$_POST['password1']== ""  || $_POST['password2']== ""  ||$_POST['fname']== ""  ||$_POST['lname']== ""  || $_POST['answer']== "" ){
    $register_error= "one or more fields are missing";
    if($_POST['password1'] != $_POST['password2']) {
    $register_error = "Passwords don't match. Try again?";
  }

}
	else {
		$check = user_exist_check($_POST['username'], $_POST['password1'], $_POST['emailid'],$_POST['fname'],$_POST['lname'],$_POST['answer']);	
		if($check == 1){
			$_SESSION['username']=$_POST['username'];
			header('Location: browse.php');
		}
		else if($check == 2){
			$register_error = "Username already exists";
		}
	}
}

?>

<html>
<head>
  <title>Register</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <style>
  .container {
    width: 400px;
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
      <form class="form-signin" method="post" action="register.php">
        <h2 class="form-signin-heading">Register</h2>
          <div class="collapse navbar-collapse" id="myNavbar"><br>
      <ul class="nav navbar-nav navbar-right">
    <li><a href='index.php'  style="color:#FF9900;">Homepage</a></li>
      <li><a href="login.php" style="color:#FF9900;">Login</a></li>
      </ul></div><br><br>
        
          <div class="form-group">
                    <input type="text" name="fname" id="fname" tabindex="1" class="form-control" placeholder="First Name" value="">
                  </div>
                  <div class="form-group">
                    <input type="text" name="lname" id="lname" tabindex="1" class="form-control" placeholder="Second Name" value="">
                  </div>
          <div class="form-group">
                    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                  </div>
                  <div class="form-group">
                    <input type="email" name="emailid" id="emailid" tabindex="1" class="form-control" placeholder="Email Address" value="">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password1" id="password" tabindex="2" class="form-control" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password2" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
                  </div>
                   <div class="form-group">
                    <input type="text" name="question" id="question" tabindex="2" class="form-control" placeholder="Name of your first school " disabled>
                  </div>
                  <div class="form-group">
                    <input type="text" name="answer" id="answer" tabindex="2" class="form-control" placeholder="Enter your Answer">
                  </div>
                  
                  <div class="form-group">
                     <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit" value="Submit">Register</button>
                      </div>
      </form>
    </div>
<?php
  if(isset($register_error))
   {  echo "<div id='passwd_result'> register_error:".$register_error."</div>";}
?>

</body>
</html>
