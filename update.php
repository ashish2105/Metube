<?php
session_start();
$uname=$_SESSION['username'];
?>


<html>

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
   <div class="container">
    <?php
                include "mysqlClass.inc.php";
                $query1 = "select password from account where username='$uname'";
                 $query2 = "select * from User where username='$uname'";
                  
                  
                  $result = mysql_query( $query2 );
                  if (!$result){
                    die ("user_exist_check() failed. Could not query the database: <br />". mysql_error());
                  } 
                  else {
                    while($row = mysql_fetch_row($result)){
                    $Username=$row[0];
                    $Emailid=$row[1];
                    $Firstname=$row[2];
                    $Lastname=$row[3];
                    }
                   }
                  $result1 = mysql_query($query1) or die('SQL Error :: '.mysql_error());
                   $row = mysql_fetch_assoc($result1);
                     $Password=$row['password'];

                  ?>
      <form class="form-signin" method="post" action="update.php">
        <h2 class="form-signin-heading">Profile Update</h2>
        <br><br>
           <div class="form-group">
            <label>Username:</label>
            <input class="form-control" name="username" type="text" value="<?php echo $Username; ?>" readonly></div>
            
            <div class="form-group">
            <label>First Name:</label>
            <input class="form-control" name="fname" type="text" value="<?php echo $Firstname; ?>" ></div>

            <div class="form-group">
            <label>Last Name:</label>
            <input class="form-control" name="lname" type="text" value="<?php echo $Lastname; ?>" ></div>

            <div class="form-group">
            <label>Email ID:</label>
            <input class="form-control" name="emailid" type="text" value="<?php echo $Emailid; ?>"></div>

              <div class="form-group">
             <label>Password:</label>
            <input class="form-control" type="password" name="password1" value="<?php echo $Password; ?>"></div>

              <div class="form-group">
             <label>Confirm password:</label>
            <input class="form-control" type="password" name="password2" value="<?php echo $Password; ?>"></div>

             <div class="form-group">
             <div class="controls">
                              <button class="btn btn-success" name="submit" type="submit" value="submit">Save</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <button class="btn btn-success" name="back" type="submit" value="back">Back</button>
                            </div>
                          </div>
                        
      </form>
   
</div>


<?php
if(isset($_POST['back']))
{
  header('Location: browse.php');

}


if(isset($_POST['submit']))
{
  if( $_POST['password1'] != $_POST['password2']) {
    $update_error = "Passwords don't match. Try again?";
  }
  else{
$Username=$_POST['username'];
$Emailid = $_POST['emailid'];
$Password = $_POST['password1'];
$Fname = $_POST['fname'];
$Lname = $_POST['lname'];



$query = "UPDATE account SET password = '$Password'  WHERE username = '$Username'";

$query1 = "UPDATE User SET fname = '$Fname',lname='$Lname',email='$Emailid' WHERE username = '$Username'";

$update = mysql_query( $query);
$update1 = mysql_query( $query1);

if($update && $update1)
{
        echo "updated successfully";
      header('Location: browse.php');
      }
      else{
        die ("Could not update into the database: <br />". mysql_error());    
      }

      
    }
}
            
?>

<?php
  if(isset($update_error))
   {  echo "<div id='passwd_result'> register_error:".$update_error."</div>";}
?>
</body>
</html>

