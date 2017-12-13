<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_start();
    $uname=$_SESSION['username'];
	include_once "function.php";
	ob_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Playlist</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/bootstrap.min.css" rel="stylesheet">
   
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <style>
body {background-color: #2d2d30;
color:white;
}
</style>
<script type="text/javascript" src="js/jquery-latest.pack.js"></script>
<script type="text/javascript">

function saveDownload(id)
{
	$.post("media_download_process.php",
	{
       id: id,
	},
	function(message) 
    { }
 	);
} 
</script>
</head>


<body>


	<!--<div align = "center">
         <div align = "center">

            <div><br/><b><h2>Welcome <?php echo $_SESSION['username'];?></h2></b>
            <div align="right"> 
            <ul class="nav navbar-nav navbar-right">
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
        </ul></div>
            </div> <br><br>-->
           
           <div align = "center">
         <div align = "center">
		<div class="container-fluid">
    	<div class="navbar-header">
      <br> <b><h2>Welcome <?php echo $_SESSION['username'];?></h2></b>
    </div>
   <div class="collapse navbar-collapse" id="myNavbar"><br>
      <ul class="nav navbar-nav navbar-right">
		<li><a href='media_upload.php'  style="color:#FF9900;">Upload File</a></li>
		  <li><a href="browse.php" style="color:#FF9900;">Home</a></li>
        <li><a href="update.php" style="color:#FF9900;">Profile</a></li>
        <li><a href="allmedia.php" style="color:#FF9900;">All media</a></li>		  
        <li><a href="contacts.php"  style="color:#FF9900;">Contacts</a></li>		  
        <li><a href="mychannel.php" style="color:#FF9900;">My channel</a></li>
		  <li class="nav-item dropdown">
		 <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          MORE
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <a class="dropdown-item"  href="browse_list.php">Browse by Category</a><br>
        <a class="dropdown-item"  href="blocklist.php">Block List</a><br>
        <a class="dropdown-item"  href="most_viewed.php">Media Recommendation</a><br>
        <a class="dropdown-item"  href="most_recent.php">Recently uploaded</a><br>
        <a class="dropdown-item"  href="channel.php">Browse by channel</a><br>
        <a class="dropdown-item" href="favlist.php">Favlist</a><br>
         <a class="dropdown-item" href="subs.php">My Subscriptions</a><br>
        </div>
		</li>
        <li><a href="index.php" style="color:#FF9900;">Signout</a></li>
        </ul>
    </div>
  </div></div>

<!--<a href='media_upload.php'  style="color:#FF9900;">Upload File</a>-->
<div id='upload_result'>
<?php 
	if(isset($_REQUEST['result']) && $_REQUEST['result']!=0)
	{		
		echo upload_error($_REQUEST['result']);
	}
?>
</div>
<br/><br/>
			   
<?php

	$query = "SELECT * from media"; 
	$result = mysql_query( $query );
	if (!$result){
	   die ("Could not query the media table in the database: <br />". mysql_error());
	}
?>
	
	<table width="50%" cellpadding="0" cellspacing="0" align="right">
		<tr valign="top" >
			<th>Playlist</th>
			</tr>
		<?php
		$i=1;
			while ($result_row = mysql_fetch_row($result)) //filename, username, type, mediaid, path
			{ 
				$mediaid[$i] = $result_row[3];
				//echo "$mediaid[$i]";
				$filename [$i]= $result_row[0];
				$filenpath [$i]= $result_row[4];
				$ufname [$i]= $result_row [5];
				$desc [$i]= $result_row[7];
				$username [$i]= $result_row[1];
				$path[$i]=$result_row[2];
				$comment[$i]=$result_row[11];
				$rat[$i]=$result_row[12];
				$count[$i]=$result_row[9];
				$i++;
		?>
			<?php
			}
		?>
		<?php for($y=1;$y<=$i-1;$y++){
		$ps="select mediaid from playlist where mediaid='$mediaid[$y]' and username='$uname'";
		$out= mysql_query($ps);
		$p1 = mysql_fetch_assoc($out);
		$plist=$p1['mediaid'];
		
		?>
		<?php if ($mediaid[$y]!=$plist){  ?>

								<?php

								} 
							else {?>
		
        	 <tr valign="top" >	

                        <td>

            	            
            	            <a href="<?php echo $filenpath[$y];?>" download><?php echo $ufname[$y];?> </a> 
                        </td>
				  <form method='get' action=''>
                        <td>
							
            	            <button class="btn btn-success" name=" 'submit'<?php echo$y;?>" type="submit" value="submit">VIEW</button>
                        </td>
				 		<td>
							
							<button class="btn btn-success" name=" 'block'<?php echo$y;?>" type="submit" value="submit">Remove</button>
							
						</td>
		</form></tr>
		<?php } ?>
        	<?php } ?>
		</table>
		</div>
		<?php
			for ($z=1;$z<=$y;$z++){
			if(isset($_GET["'submit'$z"]))
			{
  			$insert = "insert into view(mediaid, username)".
							  "values('$mediaid[$z]','$uname')";
			$output1 = mysql_query( $insert);
				$c=$count[$z];
				$c++;
			$update = "update media set vcount='$c' where mediaid='$mediaid[$z]'";
			$output7= mysql_query ($update);
			?>
			<h3><?php echo $ufname[$z];?></h3>
			<?php if(substr($path[$z],0,5)=="video"){ ?>
			<video width="500" height="300" align="left" overflow="hidden" controls>
  			<source src="<?php echo $filenpath[$z];?>" type="<? echo $path[$z];?>">
			</video>
			<?php }else if(substr($path[$z],0,5)=="audio"){?> 
			<audio width="500" height="300" align="left" overflow="hidden" controls>
  			<source src="<?php echo $filenpath[$z];?>" type="<? echo $path[$z];?>">
			</audio>				
			<?php }else{ ?> 
			<a href="<?php echo $filenpath[$z];?>" download>
			<img src="<?php echo $filenpath[$z];?>" alt="W3Schools" width="500" height="300" align="left">
			</a>
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			<?php } ?>
			<br>
			<p> uploaded by:  <?php echo $username[$z]; ?></p><br>
			<p> description: <?php echo $desc[$z]; ?></p>
	<?php

	$query = "SELECT * from comment where mediaid='$mediaid[$z]'"; 
	$result = mysql_query( $query );
				if (!$result){
	   die ("Could not query the media table in the database: <br />". mysql_error());
	}
	$qquery = "SELECT avg(rating) from rating where mediaid='$mediaid[$z]'"; 
	$rresult = mysql_query( $qquery );
	$dresult = mysql_fetch_row($rresult);
	$rating = $dresult[0];
	
?>
		<table width="50%" cellpadding="0" cellspacing="0" align="left">
	<?php if($rat[$z]==0){ ?>
	<form method='post' action=''>
	<tr valign="top" >
		<th> Average rating:  <?php echo"$rating"?></th>
		</tr><tr valign="top" >
			<th>Rate this : 
	  <input type="radio" name="rating" value="1" checked> 1
  	  <input type="radio" name="rating" value="d"> 2
      <input type="radio" name="rating" value="3"> 3
      <input type="radio" name="rating" value="4"> 4
      <input type="radio" name="rating" value="5"> 5
	  <button class="btn btn-success" name="'rate'<?php echo$z;?>" type="submit" value="rate" class="myButton">RATE</button>
		</th>
			</tr>
		</form>
			<?php }  if($comment[$z]==0){?>
				<tr valign="top" >
			
			<th>comments:</th>
			</tr>
		<?php
		$i=1;
			while ($result_row = mysql_fetch_row($result)) //filename, username, type, mediaid, path
			{ 
				$mediaid[$i] = $result_row[1];
				//echo "$mediaid[$i]";
				$cid [$i]= $result_row[0];
				$comment [$i]= $result_row[2];
				$ucname [$i]= $result_row [3];
				$i++;
		?>
			<?php
			}
		?>
		<?php for($y=1;$y<=$i-1;$y++){ ?>
        	 <tr >	
                        <td>
            	            <p><?php echo $ucname[$y];?> : <?php echo $comment[$y];?> </p>
                        </td>
				 <form method='post' action=''>
				 		<?php
						if($ucname[$y]==$uname){
							$com=$comment[$z];
						?>
						 <td>
							 					 
            	            <button class="btn btn-success" name="'dc'<?php echo$y;?>" type="submit" value="xyz" class="myButton">Delete</button>
                       </form>
								 </td>
				 <?php }?>
			</tr>
		<?php } //}?>
	

     	<form method='post' action=''>
			 <tr><th>Write your comment</th></tr>
			<tr><td>
          <textarea name="comment" rows="3" cols="80" style="color:black"></textarea>
			</td><td>
          <button class="btn btn-success" name="'xyz'<?php echo$z;?>" type="submit" value="xyz" class="myButton">Comment</button>
			</td></tr>
			</form>
	<?php } //}?>
			 </table>
			 
       
      
		
			
			<?php
  			
			}
			if(isset($_GET["'block'$z"]))
			{
			$delete1="delete from playlist where mediaid='$mediaid[$z]' and username='$uname'";
			$out= mysql_query($delete1);


			if($out)
{
  //echo "updated successfully";
  //header("Location:contacts.php");  
  header('Location: playlist.php');
  }
      else{
        die ("Could not update into the database: <br />". mysql_error());    
      }

			}
			}
	 for ($s=1;$s<=$z;$s++){	 
       if(isset($_POST["'xyz'$s"])){
		   //echo "hi";
       	  $comment=$_POST["comment"];
       	$query15="insert into comment(mediaid,comment,username) values ('$mediaid[$s]','$comment','$uname')";
       	$insert15 = mysql_query($query15);
       	if($insert15){
				header("Refresh:0");
			}
			else{
				die ("Could not insert into the table : <br />". mysql_error());	
       }
   }
  }
	for ($k=1;$k<=$z;$k++){	 
       if(isset($_POST["'rate'$k"])){
		   //echo "hi";
       	  $rating=$_POST["rating"];
       	$query16="insert into rating(rid,mediaid,rating) values (NULL,'$mediaid[$k]','$rating')";
       	$insert17 = mysql_query($query16);
       	if($insert17){
				header("Refresh:0");
			}
			else{
				die ("Could not insert into the table : <br />". mysql_error());	
       }
   }
		}
	for ($m=1;$m<=$y;$m++){	 
       if(isset($_POST["'dc'$m"])){
		  // echo "try";
		   //echo $com;
       	$query20="delete from comment where mediaid='$mediaid[$m]'and comment='$comment[$m]'and username='$uname'";
       	$delete20 = mysql_query($query20);
       	if($delete20){
				header("Refresh:0");
			}
			else{
				die ("Could not Delete from the table : <br />". mysql_error());	
       }
   }
		}
  ob_end_flush();
			
		?>
	
   
</body>
</html>