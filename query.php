<?php
session_start();

require("dbase/dbFunction.php");
$cmd=$_POST['cmd'];

switch($cmd){
    case 'checkNameExist':
        $name=$_POST['name'];
        $res=checkuser("name",$name);
        echo $res;
        break;

    case 'checkEmailExist':
        $email=$_POST['email'];
        $res=checkuser("email",$email);
        echo $res;
        break;

    case 'getUserPos':
        if(isset($_SESSION['name'])){
            $name=$_SESSION['name'];
            $res=getUserPos($name);
            echo $res;
        }
        else{ echo "0 0";}
        break;



     case 'setUserPos':
        if(isset($_SESSION['name'])){
            $name=$_SESSION['name'];
            $longitude=$_POST['longitude'];
            $latitude=$_POST['latitude'];
            $res=setUserPos($longitude, $latitude);
        }
        break;

    case 'getUserPic':
        if(isset($_SESSION['name'])){
            $name=$_SESSION['name'];
            $longMin=floatval($_POST['longMin']);
            $longMax=floatval($_POST['longMax']);
            $latMin=floatval($_POST['latMin']);
            $latMax=floatval($_POST['latMax']);
            $num=intval($_POST['num']);
            $res=getUserPic($name,$num,$longMin,$longMax,$latMin,$latMax);
            echo $res;
        }
        else{echo "";}
        break;

    case 'getAllPic':
            $longMin=floatval($_POST['longMin']);
            $longMax=floatval($_POST['longMax']);
            $latMin=floatval($_POST['latMin']);
            $latMax=floatval($_POST['latMax']);
            $num=intval($_POST['num']);
            $res=getAllPic($num,$longMin,$longMax,$latMin,$latMax);
            echo $res;
        break;

    
    default:break;
}

?>
