<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_start();
    $uname=$_SESSION['username'];
	include_once "function.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Media browse</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/~schatra/metube_template_2017/css/bootstrap.min.css">
   <link rel="stylesheet" href="/~schatra/metube_template_2017/css/default.css" >
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
        <li><a href="contacts.php" >Contacts</a></li>
        <li><a href="update.php">Profile</a></li>
        <li><a href="browse_list.php">Browse by category</a></li>
        <li><a href="blocklist.php">Block List</a></li>
        <li><a href="playlist.php">Playlist</a></li>
        <li><a href="favlist.php">Favlist</a></li>
        <li><a href="index.php">Signout</a></li>
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

	$query = "SELECT * from media order by category"; 
	$result = mysql_query( $query );
	if (!$result){
	   die ("Could not query the media table in the database: <br />". mysql_error());
	}
?>
	
	<table width="50%" cellpadding="0" cellspacing="0" align="right">
		
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
				$category[$i]= $result_row[6];
				$i++;
		?>
			<?php
			}
		?>
		<?php for($y=1;$y<=$i-1;$y++){
		$bs="select mediaid from block where mediaid='$mediaid[$y]' and username='$uname'";
		$out= mysql_query($bs);
		$b1 = mysql_fetch_assoc($out);
		$blist=$b1['mediaid'];
		$ps="select mediaid from playlist where mediaid='$mediaid[$y]' and username='$uname'";
		$out= mysql_query($ps);
		$p1 = mysql_fetch_assoc($out);
		$plist=$p1['mediaid'];
		$fs="select mediaid from favlist where mediaid='$mediaid[$y]' and username='$uname'";
		$out= mysql_query($fs);
		$f1 = mysql_fetch_assoc($out);
		$flist=$f1['mediaid'];
		if ($y==1) {?>
			<tr valign="top" >
			<th><?php echo $category[$y];?></th>
			</tr>
		<?php }

		else if ($category[$y]!=$category[$y-1]&&$y>1)
		{
		?>

		<tr valign="top" >
			<th><?php echo $category[$y]?></th>
			</tr>
		<?php } if ($mediaid[$y]==$blist){  ?>

								<?php

								} 
							else {?>
		
        	 <tr >	
                        <td>

            	            <a target="_blank"><?php echo $ufname[$y];?> </a> 
                        </td>
				  <form method='post' action=''>
                        <td>
							
            	            <button class="btn btn-success" name=" 'submit'<?php echo$y;?>" type="submit" value="submit">VIEW</button>
                        </td>
				 		<td>
							
							<button class="btn btn-success" name=" 'block'<?php echo$y;?>" type="submit" value="submit">BLOCK</button>
							
						</td>	
					  <td>
						  <?php if ($mediaid[$y]==$plist){  ?>

								<button class="btn btn-success" name=" 'Playlist'<?php echo$y;?>" type="submit" value="submit" disabled>Added playlist</button>
								<?php

								} 
							else {?>
							<button class="btn btn-success" name=" 'Playlist'<?php echo$y;?>" type="submit" value="submit">Add playlist</button>
						  <?php } ?>
						</td>
					  <td>
						  <?php if ($mediaid[$y]==$flist){  ?>

								<button class="btn btn-success" name=" 'favlist'<?php echo$y;?>" type="submit" value="submit" disabled>Added favlist</button>
								<?php

								} 
							else {?>
							<button class="btn btn-success" name=" 'favlist'<?php echo$y;?>" type="submit" value="submit">add favlist</button>
						  <?php } ?>
						</td>
		</form></tr>
		<?php } ?>
        	<?php } ?>
		</table>
		</div>
		<?php
			for ($z=1;$z<=$y;$z++){
			if(isset($_POST["'submit'$z"]))
			{
  			$insert = "insert into view(mediaid, username)".
							  "values('$mediaid[$z]','$uname')";
			$output1 = mysql_query( $insert);
			?>
			<h3><?php echo $ufname[$z];?></h3>
			<video width="500" height="300" align="left" overflow="hidden" controls>
  			<source src="<? echo $filenpath[$z];?>" type="video/mp4">
			</video><br>
			<p> uploaded by:  <?php echo $username[$z]; ?></p><br>
			<p> description: <?php echo $desc[$z]; ?></p>
		
			
			<?php
  			}
			if(isset($_POST["'block'$z"]))
			{
  			$insert1 = "insert into block(mediaid, username)".
							  "values('$mediaid[$z]','$uname')";
			$output2 = mysql_query( $insert1);
			$delete1="delete from playlist where mediaid='$mediaid[$z]' and username='$uname'";
			$delete2="delete from favlist where mediaid='$mediaid[$z]' and username='$uname'";
			$out= mysql_query($delete1);
			$out1= mysql_query($delete2);
			}
			}
			for ($w=1;$w<=$y;$w++){
			if(isset($_POST["'Playlist'$w"]))
			{
			
  			$insert2 = "insert into playlist(mediaid, username)".
							  "values('$mediaid[$w]','$uname')";
			$output3 = mysql_query( $insert2);
			}
			if(isset($_POST["'favlist'$w"]))
			{
  			$insert3 = "insert into favlist(mediaid, username)".
							  "values('$mediaid[$w]','$uname')";
			$output4 = mysql_query( $insert3);
		}
			}
			
		?>
	
   
</body>
</html>