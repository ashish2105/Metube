<?php
session_start();
$uname=$_SESSION['username'];
 $group_name=$_SESSION['group_name'];
// echo "$uname";
// echo "$group_name";
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
                 $query1 = "SELECT messageid FROM groupmsg WHERE group_name = '$group_name' ORDER BY messageid DESC LIMIT 1";
                 $result1 = mysql_query($query1) or die('SQL Error :: '.mysql_error());
                 if (mysql_num_rows($result1) == 0) { 
  							$mid=1;
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
         <br>  <button class="btn btn-success" name="submit" type="submit" value="submit" class="myButton">Send</button>
     </form>
     <?php
    // echo "hello";
       if(isset($_POST["submit"])){
      //  echo "hi";
       	  $message=$_POST['message'];
       	$query2="insert into groupmsg(messageid, group_name,msg,sentby) values ('$mid','$group_name','$message','$uname')";
        
      //  echo $query2;
       	$update = mysql_query($query2);
       	if($update){
				header('Location:groupmessage.php');
			}
			else{
				die ("Could not update into the table : <br />". mysql_error());	
       }
     }
       ?>

      </div>
      <button class="btn btn-success" onclick="window.close()">Exit</button>
      </b>
      </div>
      </div>
      </div>
       
      </body>
      </html>
     
