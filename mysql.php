<?php
ini_set('date.timezone', 'Asia/Shanghai');
$con =  mysqli_connect("localhost", "root", "lidanyang521");
if(!$con){
    echo mysqli_connect_error();
}
mysqli_set_charset($con, "utf8");
if(!mysqli_select_db($con,"ccad_k")){
    echo mysqli_error($con);
}