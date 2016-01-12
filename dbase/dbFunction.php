<?php

    $version="V0";

    $dbHost = "localhost";
    $dbUser = "zxt";
    $dbPwd = "t";
    $dbName = "FP_" . $version;

    $dbRoot = "root";
    $dbRootPwd = "1qaz2wsx";



    function clearDB(){
        global $dbHost, $dbUser, $dbPwd, $dbName, $dbRoot, $dbRootPwd;
        $con = connectDB($dbHost, $dbRoot, $dbRootPwd);
  
        $sql = "DROP DATABASE $dbName";
        mysql_query($sql, $con);
        mysql_close($con);
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
        mysql_close($con);
    }

    function connectDB($host, $name, $pwd){
        $con = mysql_connect($host, $name, $pwd);
        if(!$con){
            print("connect error\n");
        }
        return $con;
    }

    function createTable_USER(){
        global $dbHost, $dbUser, $dbPwd, $dbName;

        $sql="CREATE TABLE $dbName" . "_USER " . 
             "(id int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name char(255) NOT NULL DEFAULT '',
                email char(255) NOT NULL DEFAULT '',
                password char(255) NOT NULL DEFAULT '',
                longitude double NOT NULL DEFAULT 0,
                latitude double NOT NULL DEFAULT 0)";

        if(!exeSQL($sql)){printf("Create User table failed\n");}

        $sql="CREATE TABLE $dbName" . "_PHOTO_ALL " .
             " (id int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
                userid int unsigned NOT NULL DEFAULT 0,
                weight int unsigned NOT NULL DEFAULT 0,
                flag int unsigned NOT NULL DEFAULT 0,
                filename char(255) NOT NULL DEFAULT '',
                path char(255) NOT NULL DEFAULT '',
                longitude double NOT NULL DEFAULT 0,
                latitude double NOT NULL DEFAULT 0,
                time int unsigned NOT NULL DEFAULT 0,
                address char(255) NOT NULL DEFAULT '',
                md5 char(255) NOT NULL DEFAULT '',
                tag varchar(1024) NOT NULL DEFAULT '')";

        if(!exeSQL($sql)){printf("Create Photo all failed\n");}

    }

    function createTable_PHOTO($id){
        global $dbHost, $dbUser, $dbPwd, $dbName;

        $sql="CREATE TABLE $dbName" . "_PHOTO_" . $id .
             " (id int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
                userid int unsigned NOT NULL DEFAULT 0,
                weight int unsigned NOT NULL DEFAULT 0,
                flag int unsigned NOT NULL DEFAULT 0,
                filename char(255) NOT NULL DEFAULT '',
                path char(255) NOT NULL DEFAULT '',
                longitude double NOT NULL DEFAULT 0,
                latitude double NOT NULL DEFAULT 0,
                time int unsigned NOT NULL DEFAULT 0,
                address char(255) NOT NULL DEFAULT '',
                md5 char(255) NOT NULL DEFAULT '',
                tag varchar(1024) NOT NULL DEFAULT '')";
        if(!exeSQL($sql)){printf("Create Photo id=$id all failed\n");}
    }

    function addUser($name, $email, $password){
        global $dbHost, $dbUser, $dbPwd, $dbName;

        if(checkRepeat('name',$name)>0 || checkRepeat('email',$email)>0)return;

        $tabName = $dbName . "_USER";
        $sql="INSERT INTO $tabName (name, email, password) VALUES('$name' , '$email', '$password')";
        exeSQL($sql);
        $sql="SELECT id FROM $tabName where name='$name'";
        $result=exeSQL($sql);
        $row=mysql_fetch_array($result);
        $id=$row['id'];
        createTable_PHOTO($id);


    }

    function addPhoto($userID, $weight, $flag, $filename, $path,$longitude, $latitude, $time, $add, $md5, $tag){
        global $dbHost, $dbUser, $dbPwd, $dbName;

        $tabName = $dbName . "_PHOTO_$userID";
        $sql="INSERT INTO $tabName (userid, weight, flag, filename, path, longitude, latitude, time, address, md5, tag) VALUES('$userID', '$weight', '$flag', '$filename' , '$path', '$longitude', '$latitude', '$time', '$add', '$md5', '$tag')";
        exeSQL($sql);

        $tabName = $dbName . "_PHOTO_ALL";
        $sql="INSERT INTO $tabName (userid, weight, flag, filename, path, longitude, latitude, time, address, md5, tag) VALUES('$userID', '$weight', '$flag', '$filename' , '$path', '$longitude', '$latitude', '$time', '$add', '$md5', '$tag')";
        exeSQL($sql);
    }

    function checkRepeat($type,$data){
        global $dbHost, $dbUser, $dbPwd, $dbName;

        $tabName=$dbName . "_USER";
        $sql="SELECT id FROM $tabName WHERE $type='$data'";
        $result=exeSQL($sql);
        $row=mysql_fetch_array($result);
        if(empty($row))return 0;
        else return 1;
        
    }

    function checkPwd($name,$pwd){
        global $dbHost, $dbUser, $dbPwd, $dbName;

        $tabName=$dbName . "_USER";
        $sql="SELECT password FROM $tabName WHERE name='$name'";
        $result=exeSQL($sql);
        $row=mysql_fetch_array($result);

        if(empty($row))return 0;
        else{
           if($row[0]==$pwd) return 1;
           else return 0;
        }
    }

    function getUserPos($name){
        global $dbHost, $dbUser, $dbPwd, $dbName;

        $tabName=$dbName . "_USER";
        $sql="SELECT longitude,latitude FROM $tabName WHERE name='$name'";
        $result=exeSQL($sql);
        $row=mysql_fetch_array($result);
        return $row[0] . " " . $row[1];

    }

    function getUserID($name){
        global $dbHost, $dbUser, $dbPwd, $dbName;
        $tabName=$dbName . "_USER";
        $sql="SELECT id FROM $tabName WHERE name='$name'";
        $result=exeSQL($sql);
        $row=mysql_fetch_array($result);
        return $row[0];
 
    }

    function getAllPic($num, $longMin, $longMax, $latMin, $latMax){
        global $dbHost, $dbUser, $dbPwd, $dbName;


        $tabName=$dbName . "_PHOTO_ALL";
        $sql="SELECT path,longitude,latitude FROM $tabName WHERE longitude>$longMin and longitude<$longMax and latitude>$latMin and latitude<$latMax order by id desc";
        $result=exeSQL($sql);
        $i=0;
        $imgList="";
        while($row=mysql_fetch_array($result)){
            $item=$row[0] . "," . $row[1] . "," . $row[2] . ";";
            $imgList=$imgList . $item;
            $i=$i+1;
            if($i>=$num)break;
        }
        return $imgList;

    }


    function getUserPic($name, $num, $longMin, $longMax, $latMin, $latMax){
        global $dbHost, $dbUser, $dbPwd, $dbName;

        $id=getUserID($name);

        $tabName=$dbName . "_PHOTO_$id";
        $sql="SELECT path,longitude,latitude FROM $tabName WHERE longitude>$longMin and longitude<$longMax and latitude>$latMin and latitude<$latMax order by id desc";
        $result=exeSQL($sql);
        $i=0;
        $imgList="";
        while($row=mysql_fetch_array($result)){
            $item=$row[0] . "," . $row[1] . "," . $row[2] . ";";
            $imgList=$imgList . $item;
            $i=$i+1;
            if($i>=$num)break;
        }
        return $imgList;
    }


    function setUserPos($name, $longitude, $latitude){
        global $dbHost, $dbUser, $dbPwd, $dbName;

        $tabName=$dbName . "_USER";
        $sql="UPDATE $tabName SET longitude='$longitude', latitude='$latitude' WHERE name='$name'";
        $result=exeSQL($sql);

    }

    function exeSQL($sql){
        global $dbHost, $dbUser, $dbPwd, $dbName;
        $con=connectDB($dbHost, $dbUser, $dbPwd);
        mysql_select_db($dbName, $con);
        $result=mysql_query($sql, $con);
        mysql_close($con);
        return $result;

    }


    function init(){
        createDB();
        createTable_USER();
    }
    
    //echo checkUser("name","test1");
    //init();
    //addUser("zxt","zxt@pku.edu.cn","t");
    //addUser("zxt2","zxt2@pku.edu.cn","t2");
    //echo getUserPic("zxt",5,115.40123,117.37877,39.456,40.34);
    //addUser("zzxt","z2xt@pku.edu.cn","t2");
    //getUserPos("zxt");
    //setUserPos("zxt","116.39","39.9");

?>
