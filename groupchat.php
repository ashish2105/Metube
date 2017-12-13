<?php
session_start();
$uname=$_SESSION['username'];
$z=1;
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

<script type="text/javascript">
  function jsfunction(){
    window.open("groupmessage.php","aioring","width=550,height=570,top=270,left=270,status=0,");

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
 .styled option.service {
    font-size: 14px;
    padding: 5px;
    background: #5c5c5c;
}
</style> 


</head>
<body>
<?php
include "mysqlClass.inc.php";

$query3="SELECT user_own, user_contact FROM contacts WHERE user_own = '$uname' AND friends =1";
                  $result3 = mysql_query( $query3 );
                  if (!$result3){
                    die ("user_exist_check() failed. Could not query the database: <br />". mysql_error());
                  } 
                  else{
             
                  $user_contact= [];
                  
                  $i=1;
                  while($row1 = mysql_fetch_array($result3))
              
                  {
               $user_contact[$i]=$row1['user_contact'];
              // echo $user_contact[$i];
                      $i++;
                 }
              }
                  


$query1="SELECT count(DISTINCT(group_name)) AS total FROM groupmsg where group_own='$uname'";
                  $result1 = mysql_query($query1);
                   $row = mysql_fetch_assoc($result1);
                     $count=$row['total'];

    $query2="SELECT group_name,group_mems FROM groupmsg WHERE group_own = '$uname'";
    $result2 = mysql_query($query2);
     if (!$result2){
                    die ("user_exist_check() failed. Could not query the database: <br />". mysql_error());
                  } 
                  else{
                    $group_name= [];
                  $group_mems= [];
                  
          
                    $w=1;
                  while($row1 = mysql_fetch_array($result2))
              
                  {
                    
                    $group_name[$w]=$row1['group_name'];
                    $group_mems[$w]=$row1['group_mems'];
                   
                    $w++;
                  
                }
              }
                  
                  



?>

<div class="container">
      <div class="navbar-header">
      <br> <b><h2>Group Conversations</b></h2>
</div><br><br><br>
<div align =left>
      <form class="form-signin" method="post" action="">
        <br><h2 class="form-signin-heading">Create a new Group</h2>
        <br>
        <div class="form-group">
                   Group Name: <input type="text" name="groupname" id="groupname" tabindex="1" class="form-control" value="">
                  </div>
          <div class="styled">
                   Add Friends:(Hold shift to add more than one person) <select name='members[]' multiple="multiple">
                      <?php for($y=1;$y<=$i-1;$y++){?>
              <option class="service" value="<?php echo $user_contact[$y]?>"><?php echo $user_contact[$y]?></option>
              <?php } ?>
          </select>
          </div>

                  <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit" value="submit">Submit</button>
                      </div>


                  </div>
                  
             <?php     if(isset($_POST["submit"])){
       $test=$_POST['members'];
        $groupname=$_POST['groupname'];


      $group= [];
      $group1=[];
       $i=1;
  if ($test){
   foreach ($test as $t)
    {

      $group[$i]=$t;
    //  echo $group[$i];
      $group1[$i]=$t;
      $i++;


    }
    $groupmems=implode(",",$group);

  }


  //for($y=1;$y<=$i-1;$y++){
      $query5="insert into groupmsg (group_name, group_own,group_mems)values('$groupname','$uname','$groupmems')";
      //echo $query2;
        $insert = mysql_query($query5);
          if($insert){
        //echo "successful";
            header('Location:groupchat.php');
      }
      else{
        die ("Could not insert into the table groups: <br />". mysql_error()); 
       }

       for($y=1;$y<=$i-1;$y++){
        $query6="insert into groups(group_name,group_own,group_mems) values('$groupname','$uname','$group1[$y]')";
        $insert1 = mysql_query($query6);
      
      }
        
     }
      if($count!=0){ ?>
 <br> <b><h4>Groups Owned by <?php echo "$uname";?></h4></b><br><br>
<table class="table" cellpadding="0" cellspacing="0">
    <thead class="thead-inverse">
    <tr>
    <th> Group Name</th>
    <th>Members</th>
    <th>Message</th>
    </tr>
    </thead>
    <tbody>
    <?php 
     for($z=1;$z<=$w-1;$z++){?>
      <tr>
      <td><?php echo $group_name[$z]?></td>
      
      <td><?php echo $group_mems[$z]?></td>
     
     <td> <button class="btn btn-success" name=" 'message'<?php echo$z;?>" type="submit" value="message">Message</button></td>
     </tr>
      <?php  }}?>
    
       <?php
//echo "hey";
for ($a=1;$a<=$z;$a++){
 // echo "heyaa";
if(isset($_POST["'message'$a"]))
{
  $group_name=$group_name[$a];
  $_SESSION['group_name']=$group_name;

  echo '<script type="text/javascript">',
     'jsfunction();',
     '</script>'
;
 
// header('Location: typemessage.php');
}
}
   

       ?>

       </tbody>
  </table>
<?php 
$query8="SELECT group_name, group_mems,group_own FROM groups WHERE group_own !=  '$uname' AND group_mems =  '$uname'";
$result8= mysql_query($query8) or die('SQL Error :: '.mysql_error());
                 
                  if (!$result8){
                    die ("user_exist_check() failed. Could not query the database: <br />". mysql_error());
                  } 
                  else{
                    $group_mems= [];
                    $group_name=[];
                    $group_own=[];
                 
          
                    $c=1;
                  while($row1 = mysql_fetch_array($result8))
              
                  {
                    
                    $group_name[$c]=$row1['group_name'];
                    $group_mems[$c]=$row1['group_mems'];
                    $group_own[$c]=$row1['group_own'];
                  
                    $c++;
                  
                }
              }

?>
<br> <b><h4>Groups <?php echo "$uname";?> is a Member of</h4></b><br><br>
<table class="table" cellpadding="0" cellspacing="0">
    <thead class="thead-inverse">
    <tr>
    <th> Group Name</th>
    <th>Members</th>
    <th>Owner</th>
    <th>Message</th>
    </tr>
    </thead>
    <tbody>
    <?php for($b=1;$b<=$c-1;$b++){?>
  <tr>
      <td><?php echo $group_name[$b]?></td>
      
      <td><?php echo $group_mems[$b]?></td>
       <td><?php echo $group_own[$b]?></td>
     
     <td> <button class="btn btn-success" name=" 'messg'<?php echo$b;?>" type="submit" value="message">Message</button></td>
     </tr>
      <?php  } ?>

      
       <?php

for ($d=1;$d<=$b;$d++){
if(isset($_POST["'messg'$d"]))
{
  $group_name=$group_name[$d];
  $_SESSION['group_name']=$group_name;

  echo '<script type="text/javascript">',
     'jsfunction();',
     '</script>'
;
 
// header('Location: typemessage.php');
}
}
   

       ?>

       </tbody>
  </table>




  </form>
  </div>
  </b>
  </div>
  </div>
  </body>
  </html>


 