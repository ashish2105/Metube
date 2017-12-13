<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Media Upload</title>
	  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/~schatra/metube_template_2017/css/bootstrap.min.css">
   <link rel="stylesheet" href="/~schatra/metube_template_2017/css/default.css" >
     <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <style>
body {background-color: #2d2d30;
color:white;
}
</style>
<script type="text/javascript" src="js/jquery-latest.pack.js"></script>
<script type="text/javascript">
</script>
</head>

<body>

<form method="post" action="media_upload_process.php" enctype="multipart/form-data" >
 
  <p style="margin:0; padding:0">
  <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
   Add a Media: <label><em> (Each file limit 10M)</em></label><br/>
   <input  name="file" type="file" size="50" />
	 Filename:<br>
  <input type="text" name="filename"><br>
   Keywords:<br>
   (please enter keywords with ,)<br>
 <textarea name="keywords" rows="1" cols="60" style="color:black"></textarea>
	  <p> Select a category</p>
	  <input type="radio" name="category" value="music" checked> Music<br>
  	  <input type="radio" name="category" value="sports"> Sports<br>
      <input type="radio" name="category" value="gaming"> Gaming<br>
      <input type="radio" name="category" value="films"> Films<br>
      <input type="radio" name="category" value="tvshow"> Tvshows<br>
      <input type="radio" name="category" value="news"> News<br>
      <input type="radio" name="category" value="others"> others
	  <br><br>

    <p>  Commenting</p>
    <input type="radio" name="Commenting" value='0' checked > Allow
    <input type="radio" name="Commenting" value='1' > DisAllow<br>
      <br>


    <p> Disable Rating</p>
     <input type="radio" name="rating" value='0' checked > Allow
    <input type="radio" name="rating" value='1' > DisAllow<br>
      <br>

	Description:<br><textarea name="message" rows="4" cols="60" style="color:black">
</textarea>
	<br><br>
	 <button class="btn btn-success" value="Upload" name="submit" type="submit" />Upload</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <button class="btn btn-success" name="back" type="submit" value="back">Back</button>
  </p>
 
                
 </form>
	<?php

if(isset($_POST['back']))
{
  header('Location: browse.php');

} ?>
</body>
</html>
