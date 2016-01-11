<!doctype html>
<?php
session_start();
if(!isset($_SESSION['name']))header("Location: login.php");
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">

    <link href="css/main.css" rel='stylesheet' type='text/css' />
    <link href="css/map.css" rel='stylesheet' type='text/css' />
    <title>PICMAP</title>

</head>

<body>

<div id="container" tabindex="0"></div>

</body>



<script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=605574e6236d5b46cff5ddfe4ac9f437"></script>
<script type="text/javascript" src="js/picmap.js"></script>


</html>
