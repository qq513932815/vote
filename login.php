<?php
header("Content-type: text/html; charset=utf-8");
$name = $_POST["name"];
$password = $_POST["password"];
$password = md5($password);
//用户不存在   
//用户或者密码不对  
require_once 'mysql.php';
$select = "SELECT * FROM login WHERE username = '$name' AND password = '$password' LIMIT 1";
$result = mysqli_query($con, $select);  //查询结果集
$arr = mysqli_fetch_row($result);  //索引数组
mysqli_close($con);
if ($arr) {
    setcookie("id", $arr[0]);
    setcookie("name", $name);
    $time = date("Ymd", $arr[4]);
    $new_time = date("Ymd",time());
    $ret = ["code"=>"10001","id"=>$arr[0],"name"=>$name,"niname"=>$arr[3],"time"=>$time,"new_time"=>$new_time] ;  //关联数组  
    //如何把一个数组转换成字符串  
    echo json_encode($ret) ; //登录成功
} else {
    echo "10002"; //登录失败
}



