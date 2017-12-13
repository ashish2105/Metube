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
<script type="text/javascript">
  function jsfunction(){
    window.open("typemessage.php","Ratlllting","width=550,height=570,top=270,left=270,status=0,");

  }

</script>
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
                $query1 = "SELECT COUNT(user_own) as total FROM  contacts where user_own='$uname'";
                 $result1 = mysql_query($query1) or die('SQL Error :: '.mysql_error());
                   $row = mysql_fetch_assoc($result1);
                     $count=$row['total'];

                     $query3="SELECT COUNT(friend_req) AS total_fr FROM contacts WHERE friend_req =1 and user_own='$uname' and flow_req=0";
                     $result3= mysql_query($query3) or die('SQL Error :: '.mysql_error());
                   $rows = mysql_fetch_assoc($result3);
                     $count1=$rows['total_fr'];
                  

                  $query2="SELECT user_contact, user_own, username, email, fname, lname,friends,block,friend_req FROM User, contacts WHERE User.username = contacts.user_contact AND contacts.user_own =  '$uname'";
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
                    $i++;
                  
                }
              }
                  ?>

        <div align = "center">
    <div class="container-fluid">
      <div class="navbar-header">
      <br> <b><h2><?php echo $_SESSION['username'];?></b></h2>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar"><br>
      <ul class="nav navbar-nav navbar-right">
       <li><a href="browse.php">Home</a></li>
      <li><a href="javascript:void(0);"
 NAME="My Window Name"  title=" My title here "
 onClick=window.open("addcontacts.php","Ratting","width=550,height=570,top=270,left=270,status=0,");>Add Contacts</a></li>
        <li><a href="javascript:void(0);"
 NAME="My Window"  title=" My title "
 onClick=window.open("removecontacts.php","Rattling","width=550,height=570,top=270,left=270,status=0,");>Remove Contacts</a></li>
 <li><a href="javascript:void(0);"
 NAME="My Window"  title=" My title "
 onClick=window.open("messages.php","Rattliing","width=550,height=570,top=270,left=270,status=0,");>My Messages</a></li>
 <li><a href="javascript:void(0);"
 NAME="My Window"  title=" My title "
 onClick=window.open("viewrequest.php","Rat","width=550,height=570,top=270,left=270,status=0,");>View Request</a></li>
 <li><a href="javascript:void(0);"
 NAME="My Window"  title=" My title "
 onClick=window.open("groupchat.php","Rat","width=650,height=670,top=270,left=270,status=0,scrollbar=1,resizable=1");>Group Discussion</a></li>
  <li><a href="login.php">Sign Out</a></li>
 
        
        </ul>
    </div>
    <br> <b><h4>You have <?php echo $count;?> Contacts</h4></b><br><br>
    <?php if($count!=0){ ?>
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
      <?php if($friend_req[$y]==0 && $friends[$y]==0){?>
      <button class="btn btn-success" name=" 'submit'<?php echo$y;?>" type="submit" value="submit">Add friend</button>
      <?php } else if($friends[$y]==1 && $friend_req[$y]==1){?>
       <button class="btn btn-success" name=" 'block'<?php echo$y;?>" type="submit" value="submit" disabled > Friend</button>
       <?php } else{?>
       <button class="btn btn-success" name=" 'submit'<?php echo$y;?>" type="submit" value="submit" disabled > Friend Requested</button>
       <?php }?>
       </td>

        <td>
      <?php if($friends[$y]==1 && $block[$y]==0){?>
      <button class="btn btn-success" name=" 'block'<?php echo$y;?>" type="submit" value="block">Block </button>
       <?php } else if($friends[$y]==1 && $block[$y]==1){?>
       <button class="btn btn-success" name=" 'block'<?php echo$y;?>" type="submit" value="block" > Unblock</button>
       <?php } else{?>
       <button class="btn btn-success" name=" 'block'<?php echo$y;?>" type="submit" value="block" disabled> Block</button>
       <?php }?>
       </td>

       <td>
      <?php if($friends[$y]==1){?>
      <button class="btn btn-success" name=" 'messages'<?php echo$y;?>" type="submit" value="messages">Messages</button>
       <?php } else{?>
       <button class="btn btn-success" name=" 'messages'<?php echo$y;?>" type="submit" value="messages" disabled> Messages</button>
       <?php }?>
       </td>

      </form></tr>
<?php }
for ($z=1;$z<=$y;$z++){
if(isset($_POST["'submit'$z"]))
{
  if($friend_req[$z]==0){
  $update = "UPDATE contacts SET friend_req = 1,flow_req=1,block=0 WHERE user_own = '$uname' and user_contact = '$Username[$z]'";
  $up= "UPDATE contacts SET friend_req = 1,block=0  WHERE user_contact = '$uname' and user_own = '$Username[$z]'";
  }
  
 // echo $update;
  $output = mysql_query( $update);
  $out=mysql_query($up);

if($output && $out)
{
  //echo "updated successfully";
  //header("Location:contacts.php");  
  header('Location: contacts.php');
  }
      else{
        die ("Could not update into the database: <br />". mysql_error());    
      }
}
}

for ($w=1;$w<=$y;$w++){
if(isset($_POST["'block'$w"]))
{
  if($block[$w]==0){
  $update1 = "UPDATE contacts SET block = 1,friends=0,friend_req=0,flow_req=0  WHERE user_own = '$uname' and user_contact = '$Username[$w]'";
  $update4= "UPDATE contacts SET friends=0,friend_req=0,flow_req=0 WHERE user_contact = '$uname' and user_own = '$Username[$w]'";
  $output1 = mysql_query( $update1);
  $output4 = mysql_query( $update4);
  }
  else
  {
    
    $update5 = "UPDATE contacts SET block = 0,friends=0 WHERE user_own = '$uname' and user_contact = '$Username[$w]'";
    $output5 = mysql_query( $update5);

  }
//  echo $update1;
  
  
header('Location: contacts.php');
}
}

for ($a=1;$a<=$y;$a++){
if(isset($_POST["'messages'$a"]))
{
  $user_own=$Username[$a];
  $_SESSION['user_contact']=$user_own;

  echo '<script type="text/javascript">',
     'jsfunction();',
     '</script>'
;
 
// header('Location: typemessage.php');
}
}

ob_end_flush();
}
 ?>
</div>
  </div>
</tbody>
</table>
</div>
</div>
</div>
</body>
</html>