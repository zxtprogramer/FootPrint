<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
require_once("dbase/dbFunction.php");
if($_POST['ifsubmit']=="1"){
    
    if ((($_FILES["file"]["type"] == "image/gif")
    || ($_FILES["file"]["type"] == "image/jpeg")
    || ($_FILES["file"]["type"] == "image/png")
    || ($_FILES["file"]["type"] == "image/bmp")
    || ($_FILES["file"]["type"] == "image/pjpeg"))){
    
        session_start();
        $username=$_SESSION['name'];
        $filename=$_FILES["file"]["name"];
        $tmpfile=$_FILES["file"]["tmp_name"];
        $userid=getUserID($username);
        
        $path="data/FP_V0_PHOTO_" . $userid . "/" . $filename;
        move_uploaded_file($tmpfile, $path);
        
        
        $absPath="/var/www/html/" . $path;
        $absSnapPath=$absPath . "_snap.jpg";
        $cmd="convert -resize 100x100 " . $absPath . " " . $absSnapPath;
        system($cmd);
        $md5=md5_file($absPath);
        
        $picTag=$_POST['picTag'];
        $picPos=$_POST['picPos'];

        $longitude=split(",", $picPos)[0];
        $latitude=split(",", $picPos)[1];
        
        addPhoto($userid,1,1,$filename,$path,$longitude,$latitude,time(),"address",$md5,$picTag);

        system("echo " . $absPath . ">>a.txt");
        header("Location: upload.php");
    
    }
}

?>

<html  xmlns="http://www.w3.org/1999/xhtml" lang="en">
  <head>

   <script type="text/javascript" src="js/jquery.min.js"></script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">

    <link href="css/upload.css" rel='stylesheet' type='text/css' />
    <title>upload</title>

</head>

<body>

<form class="elegant-aero" action="upload.php" method="post" enctype="multipart/form-data">
<h1>上传</h1>
<label><span>文件:</span></label>
<input type="file" name="file" id="file" class="button"/><br /><br />

<label><span>位置:</span></label>
<input type="text" name="picPos" id="picPos" />

<label><span>备注:</span></label>
<textarea  name="picTag" id="picTag" rows="10" cols="30"></textarea> <br /><br /><br />

<input type="submit" value="确定" class="button"/>
<input type="hidden" name="ifsubmit" value="1" />
</form>

</body>



<script type="text/javascript" src="js/picview.js"></script>
<script type="text/javascript" src="js/globalvar.js"></script>
<script type="text/javascript" src="js/navbar.js"></script>
<script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=605574e6236d5b46cff5ddfe4ac9f437"></script>
<script type="text/javascript" src="js/picmap.js"></script>


</html>
