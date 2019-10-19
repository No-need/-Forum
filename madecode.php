<?php
 if(!isset($_SESSION)){ 
     session_start(); 
    } //檢查SESSION是否啟動
 $_SESSION['check_code'] = ''; //設置存放檢查碼的SESSION
 //設置定義為圖片
 header("Content-type: image/PNG");
$nums=4;
$width=$nums*10;
$high=20; 

$str = "23456789abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMOPQRSTUBWXYZ";
$code = '';
for ($i = 0; $i < $nums; $i++) {
$code .= $str[mt_rand(0, strlen($str)-1)];
}

$_SESSION['check_code'] = $code;

$image = imagecreate($width, $high);
//$image=imagecreatefrompng("images/bg.png"); //或是自行準備底圖

$black = imagecolorallocate($image, 0, 0, 0);
$white = imagecolorallocate($image, 255, 255, 255);

imagerectangle($image, 0, 0, $width-1, $high-1, $black);   
imagestring($image, 5, 3, 3, $code, $white);
imagepng($image);
imagedestroy($image); 
?>