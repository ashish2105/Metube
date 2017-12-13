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
                include "mysqlClass.inc.php";
                
                  

                  $query2="SELECT user_contact, user_own, username, email, fname, lname,friends,block,contact FROM User, contacts WHERE User.username = contacts.user_contact AND contacts.user_own =  '$uname'";
                  $result2 = mysql_query( $query2 );
                  if (!$result2){
                    die ("user_exist_check() failed. Could not query the database: <br />". mysql_error());
                  } 
                  else{
                    $Username= [];
                  $Emailid= [];
                  $Firstname= [];
                  $Lastname= [];
                 $friends=[];
                 $block=[];
                 $contact=[];
          
                    $i=1;
                  while($row1 = mysql_fetch_array($result2))
              
                  {
                    
                    $Username[$i]=$row1['username'];
                    $Emailid[$i]=$row1['email'];
                    $Firstname[$i]=$row1['fname'];
                    $Lastname[$i]=$row1['lname'];
                    $friends[$i]=$row1['friends'];
                    $block[$i]=$row1['block'];
                    $contact[$i]=$row1['contact'];
                    $i++;
                  
                }
              }
                  ?>

                  <div align = "center">
    <div class="container-fluid">
      <div class="navbar-header">
      <br> <b><h2>Remove contacts</b></h2>
    </div>
    
   
  <table class="table" cellpadding="0" cellspacing="0">
    <thead class="thead-inverse">
    <tr>
      <th>Username</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email Address</th>
      <th>#</th>
       </tr>
  </thead>
  <tbody>
  <?php for($y=1;$y<=$i-1;$y++){?>
 <tr>

      <td><?php echo $Username[$y]?></td>
      <td><?php echo $Firstname[$y]?></td>
      <td><?php echo $Lastname[$y]?></td>
      <td><?php echo $Emailid[$y]?></td>
      
      <form method='post' action="removecontacts.php?username=<?php $u=$Username[$y];echo $u;?>">
      <td>
      <button class="btn btn-success" name=" 'submit'<?php echo$y;?>" type="submit" value="submit">Remove</button>
       </td>
       </form></tr>
       <?php }
for ($z=1;$z<=$y;$z++){
if(isset($_POST["'submit'$z"]))
{
 
  $update = "DELETE from contacts WHERE user_own = '$uname' and user_contact = '$Username[$z]'";
  $update1="DELETE from contacts WHERE user_own = '$Username[$z]' and user_contact = '$uname'";
  // echo $update;
  $output = mysql_query( $update);
  $output1=mysql_query( $update1);
  
  
 

if($output && $output1)
{
  echo "updated successfully";
  //header("Location:contacts.php");  
  header('Location: removecontacts.php?username=$Username[$z]');
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





