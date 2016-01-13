<?php

require_once("./dbase/dbFunction.php");

$cmd=$_POST['cmd'];

switch($cmd){
    case 'register':
        $name=$_POST['name'];
        $pwd=$_POST['pwd'];
        $email=$_POST['email'];
        addUser($name, $email, $pwd);
        header("Location: login.php");
  
        break;

    case 'login':
        $name=$_POST['name'];
        $pwd=$_POST['pwd'];
        echo $name,$pwd;
        if(checkPwd($name, $pwd)){
            session_start();
            $_SESSION['name']=$name;
            //header("Location: map.php");
            echo "<script type=text/javascript>window.location.href=\"map.php\";</script>";
        }
        else{
            header("Location: login.php");
        }
        break;

    case 'logout':
        session_start();
        session_destroy();
        header("Location: login.php");
        break;

    default:
        header("Location: login.php");
        break;
}
?>
