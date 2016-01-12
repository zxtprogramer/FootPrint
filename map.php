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

<div id="TopBarDiv" tabindex="0">
    <div id="NavDiv">
        <ul id="nav"> 
            <li><a href="javascript:nav_all_fun();">全部</a></li> 
            <li><a href="javascript:nav_my_fun();">我的</a></li> 
            <li><a href="">工具</a></li> 
            <li><a href="">好友</a></li> 
            <li><a href="">资料</a></li> 


            <li><a id="Logout" href="javascript:nav_logout_fun();">注销</a></li> 
        </ul>
        <form id="logoutForm" method="POST" action="index.php"><input type="hidden" name="cmd" value="logout"></form>
    </div>


 </div>

<div id="container" tabindex="0"></div>
<div id="PicView">


    <div id="PicViewImgDiv">
        <img id="PicViewImg" src=""/>
    </div>

    <div id="PicViewControlDiv">
    </div>
</div>

</body>



<script type="text/javascript" src="js/picview.js"></script>
<script type="text/javascript" src="js/controlvar.js"></script>
<script type="text/javascript" src="js/navBar.js"></script>
<script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=605574e6236d5b46cff5ddfe4ac9f437"></script>
<script type="text/javascript" src="js/picmap.js"></script>


</html>
