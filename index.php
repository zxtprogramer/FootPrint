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
        if(checkPwd($name, $pwd)){
            session_start();
            $_SESSION['name']=$name;
            header("Location: main.php");
        }
        else{
            header("Location: login.php");
        }
        
 
        
        break;
    default:break;
}
?>
