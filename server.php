<?php
header("Content-type: text/html; charset=utf-8");
        ini_set('date.timezone', 'Asia/Shanghai');
require_once 'mysql.php';
//获取当前时间戳
$now=time();
//获取当前时间按年月日格式
$nowtime=date("Ymd",time());
$sql="SELECT ztime from zuming where id=1";
$result=  mysqli_query($con, $sql);
if($arr=  mysqli_fetch_assoc($result)){
//    获取队伍表中的当前时间戳
    $sql_time=date("Ymd",$arr["ztime"]);
//    如果两者不同，则进行票数的清空
    if($sql_time!=$nowtime){
        $updatecount="UPDATE zuming SET ps=0";
        $count_query =mysqli_query($con, $updatecount);
        $updatetime="UPDATE zuming SET ztime='$now'";
        $time_query =mysqli_query($con, $updatetime);
        $updatetime1="UPDATE login SET look=0";
        $look_query =mysqli_query($con, $updatetime1);
        if(!$time_query||!$count_query||$look_query){
            echo mysqli_error($con);
        }
        else{
            
        }
    }
    else{
        
    }
    
}
else{
    echo mysqli_error($con);
}
//获取当前表中的各队伍的票数
$sql2 ="SELECT ps from zuming";
$result2 = mysqli_query($con, $sql2);
$list =[];
while($arr2=mysqli_fetch_assoc($result2)){
    $list[]=$arr2["ps"];
}
//$ret =["one"=>$list[0],"two"=>$list[1],"three"=>$list[2],"four"=>$list[3],"five"=>$list[4],"six"=>$list[5],"seven"=>$list[6]];
print_r(json_encode($list));

mysqli_close($con);
