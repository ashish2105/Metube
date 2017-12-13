<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
  session_start();
    $uname=$_SESSION['username'];
      $namemedia=$_SESSION['namemedia'];
       //$namemedia=$_SESSION['namemedia'];
   //  echo $namemedia;
  include_once "function.php";
   ob_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Media browse</title>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  

 
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

function showDetails(txt) {
   document.getElementById('namemedia').value = txt;
   //alert(txt);
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
        <a class="dropdown-item"  href="browse_list.php">Browse by category</a><br>
        <a class="dropdown-item"  href="blocklist.php">Block List</a><br>
        <a class="dropdown-item"  href="playlist.php">Playlist</a><br>
        <a class="dropdown-item"  href="most_viewed.php">Most viewed</a><br>
        <a class="dropdown-item"  href="most_recent.php">Recently uploaded</a><br>
        <a class="dropdown-item"  href="channel.php">Browse by channel</a><br>
        <a class="dropdown-item" href="favlist.php">Favlist</a><br>
         <a class="dropdown-item" href="subs.php">My Subscriptions</a><br>
        </div>
    </li>
        <li><a href="index.php" style="color:#FF9900;">Signout</a></li>
        </ul>
    </div>

    <form role="search" name="search" method=post action='' style="position:relative;left:100px"><!--search Friends-->
            <div class="form-group" >
          <input type="text" class="contentLeft" id="namemedia" name="namemedia" placeholder="Find Media" style="width:360px; height:32px; color: black;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            
      <button type="submit" name="searchs" class="btn btn-success"  style="position:relative;left:-8px;border-top-left-radius:0;border-bottom-left-radius:0;"><span class="glyphicon glyphicon-search"></span> Search</button>
           </div>
          </form>

  </div></div><br>


  <?php
$searchname=[];
$searchcount=[];
$fetch="select searchname,searchcount from wordcloud order by `searchcount` desc limit 6";
$fetchout=mysql_query($fetch);
$d=1;
if(!$fetchout)
{
  die ("Could not query the  table in the database: <br />". mysql_error());
}

else{
  while($row10 = mysql_fetch_array($fetchout)){
    $searchname[$d]=$row10['searchname'];
    $searchcount[$d]=$row10['searchcount'];
    $d++;
}

}



?>

<p>
<?php
for($e=1;$e<=$d-1;$e++)
{ 

  if($searchcount[$e] <=3 && $searchcount[$e]>0)
  {
    echo "<h4><a href= '#' onClick= showDetails('$searchname[$e]');> <font color='pink'>"; echo"#";
echo  $searchname[$e];
echo "</font></a></h4>";
//echo "\t\t\t";
}

if($searchcount[$e] <=6 && $searchcount[$e]>4)
  {
    echo "<h3><a href= '#' onClick= showDetails('$searchname[$e]');><font color='orange'> ";echo"#";
echo  $searchname[$e];
echo "</font></a></h3>";
//echo "\t\t\t";
}

if($searchcount[$e] <=10 && $searchcount[$e]>7)
  {
    echo "<h2><a href= '#' onClick= showDetails('$searchname[$e]');><font color='red'>";echo"#";
echo  $searchname[$e];
echo "</font></a></h2>";
//echo "\t\t\t";
}

if($searchcount[$e] > 10)
  {
    echo "<h1><a href= '#' onClick= showDetails('$searchname[$e]');>";echo"#";
echo  $searchname[$e];
echo "</a></h1>";
//echo "\t\t\t";
}
}
?>
</p>

<form action='' method=post>
  <div class="container">
   <div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"> Filters
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li class="dropdown-header">Category</li>
      <li id="1" value="music"><button class="btn btn-success" type="submit" name="Music">Music</button></li>
      <li id="2" value="sports"><button class="btn btn-success" type="submit" name="sports">Sports</button></li>
      <li id="3" value="gamming"><button class="btn btn-success" type="submit" name="gamming">Gamming</button></li>
      <li id="4" value="films" ><button class="btn btn-success" type="submit" name="films">Films</button></li>
      <li id="5" value="tvshows"><button class="btn btn-success" type="submit" name="TVshows">TV shows</button></li>
      <li id="6" value="news"> <button class="btn btn-success" type="submit" name="News">News</button></li>
      <li id="7" value="others"><button class="btn btn-success" type="submit" name="others">Others</button></li>

      
      
      <li class="dropdown-header" id="10" value="type"><a href="#">Type</button></a></li>
      <li id="11" value="type"><button class="btn btn-success" type="submit" name="mp4">mp4</button></li>
      <li id="12" value=""><button class="btn btn-success" type="submit" name="png">png</button></li>
      <li id="13" value=""><button class="btn btn-success" type="submit" name="mp3">mp3</button></li>
      <li id="14" value=""><button class="btn btn-success" type="submit" name="gif">gif</button></li>
      
      <li class="divider"></li>

      
    </ul>
  </div>
</div>
</form>





<?php
$search=""; 
if(isset($_POST['Music']))
{
  $search="music";
}

if(isset($_POST['sports']))
{
  $search="sports";
}
if(isset($_POST['gamming']))
{
  $search="gamming";
}
if(isset($_POST['films']))
{
  $search="films";
}
if(isset($_POST['TVshows']))
{
  $search="tvshow";
}
if(isset($_POST['News']))
{
  $search="news";
}
if(isset($_POST['others']))
{
  $search="others";
}

if(isset($_POST['mp4']))
{
  $search="video/mp4";
}
if(isset($_POST['png']))
{
  $search="image/png";
}
if(isset($_POST['mp3']))
{
  $search="audio/mp3";
}
if(isset($_POST['gif']))
{
  $search="image/gif";
}

?>




 



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
//echo $search;
if($search!=""){

    $query = "SELECT *  FROM  `media` WHERE category LIKE '%$search%' or type LIKE '%$search%'"; 
  $result = mysql_query( $query );
  if (!$result){
     die ("Could not query the media table in the database: <br />". mysql_error());
  }
}
else{
 // echo "hi";
   $query = "SELECT *  FROM  media,keywords where keywords.keywords = '$namemedia' AND media.mediaid = keywords.mediaid"; 
 //  echo $query;
  $result = mysql_query( $query );
  if (!$result){
     die ("Could not query the media table in the database: <br />". mysql_error());
  }

}
?>
  
  <table width="50%" cellpadding="0" cellspacing="0" align="right">
        <tr valign="top" >
      <th>Search Media</th>
      </tr>
    <?php
    $i=1;
      while ($result_row = mysql_fetch_row($result)) //filename, username, type, mediaid, path
      { 
        $mediaid[$i] = $result_row[3];
        //echo "$mediaid[$i]";
        $filename [$i]= $result_row[0];
       // echo $filename [$i];
        $filenpath [$i]= $result_row[4];
        $ufname [$i]= $result_row [5];
        $desc [$i]= $result_row[7];
        $username [$i]= $result_row[1];
        $category[$i]= $result_row[6];
        $count[$i]=$result_row[9];
				$path[$i]=$result_row[2];
				$comment[$i]=$result_row[11];
				$rat[$i]=$result_row[12];
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
	    $ubs="select block from contacts where user_own='$username[$y]' and user_contact='$uname'";
	    $out = mysql_query($ubs);
		$u1 = mysql_fetch_assoc($out);
		$ulist=$u1['block'];


		$friendname=[];
		$query7="select * from shared where mid='$mediaid[$y]'";
		$oi=mysql_query($query7);
		$m=1;
	    $shared=0;
		while($rw=mysql_fetch_row($oi))
		{
			$mid[$m]=$rw[0];
			$friendname[$m] = $rw[1];
			//echo $friendname[$m];
			//echo $mid[$m];
			if($mid[$m]==$mediaid[$y])
			{
			$shared=1;

			if($friendname[$m]==$uname)
			{
				$shared=0;
				break;
				//echo "shared inside if".$shared;
			}
		}
			$m++;

		}
    
  
  
  if ($mediaid[$y]==$blist||$ulist==1){  ?>

                <?php

                } 
              else {?>
    
           <tr >  
                        <td>

                          <a href="<?php echo $filenpath[$y];?>" download><?php echo $ufname[$y];?> </a> 
                        </td>
          <form method='get' action=''>
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
if(isset($_POST["searchs"]))
{
  if($_POST['namemedia'] == "") {
      $login_error = "Enter search criteria";
    }
    else{
//echo "inside else";
  $_SESSION['namemedia']=$_POST['namemedia']; //Set the $_SESSION['username']
//echo $namemedia;
$namemedia=$_POST['namemedia'];
$_SESSION['namemedia']=$namemedia;
$check="select searchcount from wordcloud where searchname='$namemedia'";
  $res = mysql_query($check);

  if(mysql_num_rows($res) > 0)
  {
    while($row9 = mysql_fetch_array($res))
              
                  {
                    $count=$row9['searchcount'];
                  }
                  $count=$count+1;
               $upcloud="update wordcloud set searchcount='$count' where searchname='$namemedia'";
               $outclou= mysql_query ($upcloud);
    
  }

  else{
  //  echo "inside second else";
     $insertc = "INSERT INTO wordcloud(searchname,searchcount) VALUES ('$namemedia',1)";
    $out = mysql_query( $insertc);}


       //header('Location: Searchmedia.php');
    
 header('Location: Searchmedia.php'); }
  }
  if(isset($login_error))
   {  echo "<div id='passwd_result'><span><font color='red'>".$login_error."</font></span></div>";}

?>





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
        $insert1 = "insert into block(mediaid, username)".
                "values('$mediaid[$z]','$uname')";
      $output2 = mysql_query( $insert1);
      $delete1="delete from playlist where mediaid='$mediaid[$z]' and username='$uname'";
      $delete2="delete from favlist where mediaid='$mediaid[$z]' and username='$uname'";
      $out= mysql_query($delete1);
      $out1= mysql_query($delete2);
      if($out && $out1)
      {
        
        header('Location: Searchmedia.php');
        }
            else{
              die ("Could not update into the database: <br />". mysql_error());    
            }
      }
      }
      for ($w=1;$w<=$y;$w++){
      if(isset($_GET["'Playlist'$w"]))
      {
      
        $insert2 = "insert into playlist(mediaid, username)".
                "values('$mediaid[$w]','$uname')";
      $output3 = mysql_query( $insert2);
      if($output3)
      {
        
        header('Location: Searchmedia.php');
        }
            else{
              die ("Could not update into the database: <br />". mysql_error());    
            }

      }
      if(isset($_GET["'favlist'$w"]))
      {
        $insert3 = "insert into favlist(mediaid, username)".
                "values('$mediaid[$w]','$uname')";
      $output4 = mysql_query( $insert3);

      if($output4)
      {
        
        header('Location: Searchmedia.php');
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