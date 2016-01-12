<?php
require("/var/www/html/dbase/dbFunction.php");

function img_create_small($big_img, $width, $height, $small_img) {//原始大图地址，缩略图宽度，高度，缩略图地址
$imgage = getimagesize($big_img); //得到原始大图片
switch ($imgage[2]) { // 图像类型判断
case 1:
$im = imagecreatefromgif($big_img);
break;
case 2:
$im = imagecreatefromjpeg($big_img);
break;
case 3:
$im = imagecreatefrompng($big_img);
break;
}
$src_W = $imgage[0]; //获取大图片宽度
$src_H = $imgage[1]; //获取大图片高度

$rW=floatval($src_W)/floatval($width);
$rH=floatval($src_H)/floatval($height);

$ratio=max($rW,$rH);

$width=intval($src_W/$ratio);
$height=intval($src_H/$ratio);

$tn = imagecreatetruecolor($width, $height); //创建缩略图
imagecopyresampled($tn, $im, 0, 0, 0, 0, $width, $height, $src_W, $src_H); //复制图像并改变大小
imagejpeg($tn, $small_img); //输出图像
}


$filenames=scandir("/var/www/html/data/FP_V0_PHOTO_2");

foreach($filenames as $name){
    if($name!='.' and $name!=".."){
        $longitude=rand(11620000,11640000)/100000.0;
        $latitude=rand(3980000,4010000)/100000.0;

        $path="data/FP_V0_PHOTO_2/" . $name;

        $absPath="/var/www/html/data/FP_V0_PHOTO_2/" . $name;
        $absSnapPath="/var/www/html/data/FP_V0_PHOTO_2/" . $name . "_snap.jpg";
        $cmd="convert -resize 100x100 " . $absPath . " " . $absSnapPath;
        system($cmd);
        $md5=md5_file($absPath);

        addPhoto("2",1,1,$name,$path,$longitude,$latitude,time(),"Beijing",$md5,"for test");
        
    }
}




?>
