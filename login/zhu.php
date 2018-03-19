<?php
session_start();
$name = $_POST["name"];
$password = $_POST["password"];
$code = $_POST["code"];   //验证码
if ($_SESSION["code"] != $code) {
    echo 10086;   //验证码不一致
} else if (!preg_match('/^[0-9]{9}$/', $name)) {   //你在前台JS  部分可以用正则表达式进行  
    echo 10002;   //用户名格式不对
} else if (!preg_match('/^[a-zA-Z]{1}[a-zA-Z\d_]{5,}$/', $password)) {   //你在前台JS  部分可以用正则表达式进行  
    echo 10003;   //密码格式不对
} else {
   $con = mysqli_connect("localhost", "root", "zhang");
  if (!$con) {
    echo mysqli_error($con);
}
    mysqli_set_charset($con, "utf8");
    mysqli_select_db($con, "dianming");  //选择数据库
    //插入对像
    $password = md5($password);
    $xian = "SELECT username FROM login WHERE username = '" . $name . "'";
    $c_name="SELECT niname FROM q_name where username='$name';";
    $c_res = mysqli_query($con, $c_name);
    $c_arr= mysqli_fetch_row($c_res);
    $str = "INSERT INTO login (username,password,niname) VALUES('$name','$password','$c_arr[0]')";
    $res = mysqli_query($con, $xian);
    if (count(mysqli_fetch_row($res)) != 0) {
            echo 10004;
        }else if($c_arr[0]==""){
            echo 10005;//不是本班学生
        }  else {
            //执行了一条INSERT插入
            $result = mysqli_query($con, $str);
            mysqli_close($con);
            //判断是否插入
            if ($result) {
                echo 10001; //插入成功
            } else {
                echo 10006; //插入失败
            }
        }
    }







