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
                $submit="submit";
                include "mysqlClass.inc.php";
                 $query1 = "SELECT COUNT(seenid) as total,user_own FROM messages WHERE seenid=0 AND user_contact ='$uname'";
                 $result1 = mysql_query($query1) or die('SQL Error :: '.mysql_error());
                   $row = mysql_fetch_assoc($result1);
                     $count=$row['total'];
                    



               $query2="SELECT user_own,user_contact,message,messageid,messagedate,seenid FROM messages WHERE user_contact ='$uname' group by messagedate order by seenid";
                  $result2 = mysql_query( $query2 );
                  if (!$result2){
                    die ("user_exist_check() failed. Could not query the database: <br />". mysql_error());
                  } 
                  else{
                    $user_own= [];
                  $user_contact= [];
                  $message= [];
                  $messageid= [];
                  $messagedate=[];
                  $seenid=[];
                  $i=1;
                  while($row1 = mysql_fetch_array($result2))
              
                  {
                    
                    $user_own[$i]=$row1['user_own'];
                    $user_contact[$i]=$row1['user_contact'];
                    $message[$i]=$row1['message'];
                    $messageid[$i]=$row1['messageid'];
                    $messagedate[$i]=$row1['messagedate'];
                    $seenid[$i]=$row1['seenid'];
                    $i++;
                  
                }
              }

   $query3="SELECT groupmsg.group_name, groupmsg.sentby, groupmsg.msg FROM groupmsg, groups WHERE groupmsg.group_name = groups.group_name AND (groups.group_own =  '$uname'
OR groups.group_mems =  '$uname') and groupmsg.sentby!='$uname'";
$result3=mysql_query($query3);
  if (!$result3){
                    die ("user_exist_check() failed. Could not query the database: <br />". mysql_error());
                  }

                  else{
                    $group_name= [];
                  $sentby= [];
                  $msg=[];
                 
                  $m=1;
                  while($row2 = mysql_fetch_array($result3))
              
                  {
                    
                    $group_name[$m]=$row2['group_name'];
                   // echo $group_name[m];
                    $sentby[$m]=$row2['sentby'];
                    $msg[$m]=$row2['msg'];
                    
                    $m++;
                  
                }
              }


                  
                  ?>



  <div align = "center">
    <div class="container-fluid">
      <div class="navbar-header">
      <br> <b><h2>My Messages</b></h2>
    </div>
    <br> <b></b><br><br>
     <?php for($y=1;$y<=$i-1;$y++){
     				if($seenid[$y]==0){ ?>
    			<p align=left><font color="red">
    			<?php }else{ ?>
    				<p align=left><font color="white">
    			<? } ?>
				<i>Message By: &nbsp;<?php echo $user_own[$y];?></i><br>
				<i>Sent On: &nbsp;<?php echo $messagedate[$y];?></i><br>
				<i>Messsage:</i> &nbsp;<?php echo $message[$y];?><br>	
        
		</font>	</p>
			<?php  if($seenid[$y]==0){
  $update = "UPDATE messages SET seenid = 1  WHERE user_contact = '$uname'";
  $output = mysql_query( $update);
  }}




?>


  <br> <b><h2>Your Group Messages</b></h2>
    </div>
    
     <?php for($n=1;$n<=$m-1;$n++){ ?>
            <p align=left>
        
        <i>Message From: &nbsp;<?php echo $group_name[$n];?></i><br>
        <i>Sent By: &nbsp;<?php echo $sentby[$n];?></i><br>
        <i>Messsage:</i> &nbsp;<?php echo $msg[$n];?><br> 
        
      </p>
    <?php }?>

</div>
</b>

<button class="btn btn-success" onclick="window.opener.location.reload();window.close()">Exit</button>
</div>
</div>
</div>
</body>
</html>