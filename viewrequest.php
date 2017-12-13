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
				
				  $query3="SELECT COUNT(friend_req) AS total_fr FROM contacts WHERE friend_req =1 and user_own =  '$uname'";
                     $result3= mysql_query($query3) or die('SQL Error :: '.mysql_error());
                   $rows = mysql_fetch_assoc($result3);
                     $count1=$rows['total_fr'];

                $query2="SELECT user_contact, user_own, username, email, fname, lname,friends,block,friend_req,flow_req FROM User, contacts WHERE User.username = contacts.user_contact AND contacts.user_own =  '$uname' and flow_req=0";
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
                 $friend_req=[];
                 $flow_req=[];
                  $i=1;
                  while($row1 = mysql_fetch_array($result2))
              
                  {
                    
                     $Username[$i]=$row1['username'];
                    $Emailid[$i]=$row1['email'];
                    $Firstname[$i]=$row1['fname'];
                    $Lastname[$i]=$row1['lname'];
                    $friends[$i]=$row1['friends'];
                    $block[$i]=$row1['block'];
                    $friend_req[$i]=$row1['friend_req'];
                    $flow_req[$i]=$row1['flow_req'];
                    $i++;
                  
                }
              }
                  
                  ?>


  <div align = "center">
    <div class="container-fluid">
      <div class="navbar-header">
      <br> <b><h2>Friend Requests</b></h2>
    </div>
     <?php if($count1!=0){ ?>
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
      
      <form method='post' action=''>
      <td>
      <?php if($friend_req[$y]==1 && $friends[$y]==0){ ?>
      <button class="btn btn-success" name=" 'submit'<?php echo$y;?>" type="submit" value="submit">Accept request</button>
     <?php }else{ ?>
      <button class="btn btn-success" name=" 'submit'<?php echo$y;?>" type="submit" value="submit" disabled> Accept request</button>
     <?php } ?>
       </td>
       </form></tr>
       <?php }
       for ($z=1;$z<=$y;$z++){
if(isset($_POST["'submit'$z"]))
{
 
  $update = "UPDATE contacts SET friends=1,flow_req=0 WHERE user_own = '$uname' and user_contact = '$Username[$z]'";
   $update9 = "UPDATE contacts SET friends=1,flow_req=0  WHERE user_contact = '$uname' and user_own = '$Username[$z]'";
   //echo $update;
  $output = mysql_query( $update);
  $output9 = mysql_query( $update9);
  
  
 

if($output && $output9)
{
  echo "updated successfully";
  //header("Location:contacts.php");  
  header('Location: viewrequest.php');
  }
      else{
        die ("Could not update into the database: <br />". mysql_error());    
      }
}
}
ob_end_flush();
}

?>
</tbody>
</table>
<button class="btn btn-success" onclick="window.opener.location.reload();window.close()">Exit</button>
</b>
</div>
</div>
</div>
</body>
</html>
