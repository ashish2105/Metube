<?php
session_start();
$uname=$_SESSION['username'];
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
ob_start();
                $submit="submit";
                include "mysqlClass.inc.php";
                $query2="SELECT username,fname,lname,email FROM User WHERE User.username NOT IN (SELECT user_contact FROM contacts WHERE user_own ='$uname') AND username !='$uname'";
                  $result2 = mysql_query( $query2 );
                  if (!$result2){
                    die ("user_exist_check() failed. Could not query the database: <br />". mysql_error());
                  } 
                  else{
                    $Username= [];
                  $Emailid= [];
                  $Firstname= [];
                  $Lastname= [];
                  $i=1;
                  while($row1 = mysql_fetch_array($result2))
              
                  {
                    
                    $Username[$i]=$row1['username'];
                    $Emailid[$i]=$row1['email'];
                    $Firstname[$i]=$row1['fname'];
                    $Lastname[$i]=$row1['lname'];
                    $i++;
                  
                }
              }
                  
                  ?>

                  <div align = "center">
    <div class="container-fluid">
      <div class="navbar-header">
      <br> <b><h2>Add contacts</b></h2>
    </div>
    
   
  <table class="table" cellpadding="0" cellspacing="0">
    <thead class="thead-inverse">
    <tr>
      <th>Username</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email Address</th>
      <th>#</th>
      <th>#</th>
       </tr>
  </thead>
  <tbody>
  <?php  for($y=1;$y<=$i-1;$y++){?>
 <tr>

      <td><?php echo $Username[$y];?></td>
      <td><?php echo $Firstname[$y];?></td>
      <td><?php echo $Lastname[$y];?></td>
      <td><?php echo $Emailid[$y];?></td>
      <td>
      
      <form method='post' action="addcontacts.php?username=<?php $u=$Username[$y];echo $u;?>">
       <button class="btn btn-success" name=" 'submit'<?php echo$y;?>" id="submit" type="submit" value="submit" onsubmit="this.elements[' "submit"<?php echo$y;?>'].disabled=true;">Add Contact</button>
       </form>
       </td>
     </tr>
<?php  }
for ($z=1;$z<=$y;$z++){
if(isset($_POST["'submit'$z"]))
{
  
  $update = "INSERT INTO contacts VALUES ('$uname','$Username[$z]',0,0,1,0,0)";
  $update1 = "INSERT INTO contacts VALUES ('$Username[$z]','$uname',0,0,1,0,0)";
 
 // echo $update;
  $output = mysql_query( $update);
   $output1 = mysql_query( $update1);

if($output && $output1)
{
  //echo "updated successfully";
   header('Location: addcontacts.php?username=$Username[$z]');
  
  }
      else{
        die ("Could not update into the database: <br />". mysql_error());    
      }

      
}

}
ob_end_flush();
 ?>
</div>
  </div>
</tbody>
</table>
<button class="btn btn-success" onclick="window.opener.location.reload();window.close()">Exit</button>
</div>
</div>
</div>
</body>
</html>
