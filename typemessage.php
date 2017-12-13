<?php
session_start();
$uname=$_SESSION['username'];
 $user_contact=$_SESSION['user_contact'];
 //echo "$uname";
 //echo "$user_contact";
?>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Update Profile</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>
@media (min-width: 1200px) {
  .container {
    width: 400px;
  }
}
body {background-color: #2d2d30;
color:white;
}
</style>  
</head>
<body>
<?php
                $submit="submit";
                include "mysqlClass.inc.php";
                 $query1 = "SELECT messageid FROM messages WHERE user_own = '$uname' AND user_contact =  '$user_contact' ORDER BY messageid DESC LIMIT 1";
                 $result1 = mysql_query($query1) or die('SQL Error :: '.mysql_error());
                 if (mysql_num_rows($result1) == 0) { 
  							$mid=0;
						}
						else{
                   $row = mysql_fetch_assoc($result1);
                     $count=$row['messageid'];
                     $mid=$count+1;
                 }
              ?>
<div align = "center">
    <div class="container-fluid">
      <div class="navbar-header">
      <br><br> <b><h2>Messages</b></h2>

  <br>
  <br>
    <div class="contentLeft">

     <form action='' method="post">
          <br><textarea name="message" rows="10" cols="60" style="color:black"></textarea><br>
          <button class="btn btn-success" name="submit" type="submit" class="myButton">Send</button>
       </form>
       <?php
     
       if(isset($_POST["submit"])){
       	  $message=$_POST['message'];
       	$query2="insert into messages(user_own, user_contact,message,messageid) values ('$uname','$user_contact','$message','$mid')";
       	$insert = mysql_query($query2);
       	if($insert){
				header('Location:typemessage.php');
			}
			else
				die ("Could not insert into the table account: <br />". mysql_error());	
       }
       ?>

      </div>
      
      <button class="btn btn-success" onclick="window.close()">Exit</button>
      </body>
      </html>
