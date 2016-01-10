<?php

    require("../config.php");

    function clearDB(){
        global $dbHost, $dbUser, $dbPwd, $dbName, $dbRoot, $dbRootPwd;
        $con = connectDB($dbHost, $dbRoot, $dbRootPwd);
  
        $sql = "DROP DATABASE $dbName";
        mysql_query($sql, $con);
        closeDB($con);
    }

    function createDB(){
        global $dbHost, $dbUser, $dbPwd, $dbName, $dbRoot, $dbRootPwd;
        $con = connectDB($dbHost, $dbRoot, $dbRootPwd);
  
        $sql = "CREATE DATABASE $dbName";
        if(mysql_query($sql, $con)){
           mysql_query("GRANT ALL ON $dbName TO $dbUser@'%'", $con);
           mysql_query("GRANT create routine ON $dbName TO $dbUser@'%'", $con);
        }
        else{printf("Create Database Failed\n");}
        closeDB($con);
    }

    function connectDB($host, $name, $pwd){
        $con = mysql_connect($host, $name, $pwd);
        if(!$con){
            print("connect error\n");
        }
        return $con;
    }

    function closeDB($con){
        mysql_close($con);
    }

    function createTable_USER(){
        global $dbHost, $dbUser, $dbPwd, $dbName;

        $con = connectDB($dbHost, $dbUser, $dbPwd);
        mysql_select_db($dbName, $con);

        $sql="CREATE TABLE $dbName" . "_USER " . 
             "(id int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name char(255) NOT NULL DEFAULT '',
                email char(255) NOT NULL DEFAULT '')";

        if(!mysql_query($sql, $con)){printf("Create User table failed\n");}
        closeDB($con);
    }

    function createTable_PHOTO($id){
        global $dbHost, $dbUser, $dbPwd, $dbName;

        $con = connectDB($dbHost, $dbUser, $dbPwd);
        mysql_select_db($dbName, $con);
        $sql="CREATE TABLE $dbName" . "_PHOTO_" . $id .
             " (id int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
                filename char(255) NOT NULL DEFAULT '',
                longitude char(255) NOT NULL DEFAULT 0,
                latitude char(255) NOT NULL DEFAULT 0,
                time char(255) NOT NULL DEFAULT '',
                address char(255) NOT NULL DEFAULT '',
                md5 char(255) NOT NULL DEFAULT '',
                tag varchar(1024) NOT NULL DEFAULT '')";
        mysql_query($sql, $con);
        closeDB($con);
    }

    function addUser($name, $email){
        global $dbHost, $dbUser, $dbPwd, $dbName;

        $con = connectDB($dbHost, $dbUser, $dbPwd);
        mysql_select_db($dbName, $con);
        $tabName = $dbName . "_USER";
        $sql="INSERT INTO $tabName (name, email) VALUES('$name' , '$email')";
        mysql_query($sql, $con);
        $sql="SELECT id FROM $tabName where name='$name'";
        $result=mysql_query($sql, $con);
        $row=mysql_fetch_array($result);
        $id=$row['id'];
        createTable_PHOTO($id);

        closeDB($con);
    }

    function addPhoto($userID, $filename, $longitude, $latitude, $time, $add, $md5, $tag){
        global $dbHost, $dbUser, $dbPwd, $dbName;

        $con = connectDB($dbHost, $dbUser, $dbPwd);
        mysql_select_db($dbName, $con);
        $tabName = $dbName . "_PHOTO_$userID";
        $sql="INSERT INTO $tabName (filename, longitude, latitude, time, address, md5, tag) VALUES('$filename' , '$longitude', '$latitude', '$time', '$add', '$md5', '$tag')";
        mysql_query($sql, $con);

        closeDB($con);
       
    }

    function init(){
        createDB();
        createTable_USER();
        //addUser('test1','test1@pku.edu.cn');
        //addPhoto(1,"a.jpg","11","23","2014","beijing","MD5","TAG");
    }

?>
