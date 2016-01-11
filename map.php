<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
session_start();
if(!isset($_SESSION['name']))header("Location: login.php");
?>

<html  xmlns="http://www.w3.org/1999/xhtml" lang="en">
  <head>

   <script type="text/javascript" src="js/jquery.min.js"></script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">

    <link href="css/main.css" rel='stylesheet' type='text/css' />
    <link href="css/map.css" rel='stylesheet' type='text/css' />
    <title>PICMAP</title>

</head>

<body>

<div id="container" tabindex="0"></div>
<div id="PicView">


    <div id="PicViewImgDiv">
        <img id="PicViewImg" src=""/>
    </div>

    <div id="PicViewControlDiv">hello</div>
</div>

</body>



<script type="text/javascript" src="js/picview.js"></script>
<script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=605574e6236d5b46cff5ddfe4ac9f437"></script>
<script type="text/javascript" src="js/picmap.js"></script>


</html>
