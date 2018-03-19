<?php
session_start();  //session开启
header("Content-type:image/png");
$im = imagecreate(100, 30);
imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 150, 125, 133);  //声明了一个颜色
$text  = "";
$arr_a = ["1","2","3","4","5","6","7","8","9","a","b","c","d","e","f","g","h","i","g","k","l","m","n","p","q","r","s","t","u","v","w","x","y","z"];
for($i=0;$i<4;$i++){
    $rnd = rand(0, 33);
    $text.=$arr_a[$rnd];
}
$_SESSION["code"] = $text ;
$fontfile = './PartybyTom.TTF';
imagettftext($im, 20, 0, 10, 25, $black, $fontfile, $text);

for($i=0;$i<7;$i++){
    $color = imagecolorallocate($im, rand(100,255),  rand(10,100),  rand(200,240));  
    imageline($im, rand(0,95), rand(0,25), rand(0,95), rand(0,25), $color);
}
imagepng($im);
imagedestroy($im);
