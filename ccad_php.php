<?php
header("Content-type: text/html; charset=utf-8");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$ccad_id = $_POST['ccad_id'];      //   组的id
$ccad_uid = $_COOKIE['id'];                  //   个人的 id
$ccad_cook = $_COOKIE['name'];

 require_once 'mysql.php';
 $ccad_se = "select id from login where username = '$ccad_cook'";
 $ccad_qu = mysqli_query($con, $ccad_se);
 $fetc = mysqli_fetch_assoc($ccad_qu);
 if($fetc['id'] != $ccad_uid){
     echo '1003';
     mysqli_close($con);
     return;
 }

if($ccad_uid == ""){
    echo "1001";
    mysqli_close($con);
    return;
}else{
    
    $ccad_set = "SELECT time FROM `login` where id='$ccad_uid'";        //查找语句
    $ccad_quer = mysqli_query($con, $ccad_set);                        //运行
    $ccad_fetch = mysqli_fetch_assoc($ccad_quer);                     //转成数组
    // 已经有的时间戳转换成年月日   ps: 如果你在1号投的票 然后一个月没投  到2月1号，1会=1 所以要换成Ymd
    $ccad_olddata = date("Ymd",$ccad_fetch["time"]);                    
    $ccad_newtime = time();           //  新的时间戳
    $ccad_newdata = date("Ymd", $ccad_newtime);           // 新时间戳转换成年月日
    if($ccad_olddata == $ccad_newdata){                 // 判断是否是同一天
        echo "1002";
        mysqli_close($con);
        return;
    }  else {
//        $ccad_c = "UPDATE `zuming` SET ztime='$ccad_newtime' WHERE `id`='1'";          //插入组的时间戳
//        mysqli_query($ccad_con, $ccad_c);
        $ccad_seta = "UPDATE `zuming` SET `ps`=`ps`+1 WHERE (`id`='$ccad_id')";               // 投票数+1
        mysqli_query($con, $ccad_seta);
        $ccad_update = "UPDATE `login` SET `time`='$ccad_newtime' WHERE (`id`='$ccad_uid')";    // 插入用户的投票时间
        mysqli_query($con, $ccad_update);
        $ccad_updat = "UPDATE `login` SET `look`='$ccad_id' WHERE (`id`='$ccad_uid')";             // 罪恶的开始
        mysqli_query($con, $ccad_updat);
        
        
        
        echo "1000";
    }
    
// $ccad_seta = "UPDATE `zuming` SET `ps`=`ps`+1 WHERE (`id`='$ccad_id')";
// mysqli_query($ccad_con, $ccad_seta);
// echo "1000";

}

mysqli_close($con);