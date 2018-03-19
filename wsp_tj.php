<?php
        ini_set('date.timezone', 'Asia/Shanghai');
//获取当前时间戳
$now=time();
$nowtime=date("Ymd",time());
require_once 'mysql.php';
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
        if(!$time_query||!$count_query){
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
$sql2= "SELECT * from zuming";
$result2 = mysqli_query($con, $sql2);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>投票系统</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/javascript" src="./js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" >
            $(function() {
                refresh();
                function refresh() {
                   $.ajax({
                       url: "server.php",
                       type: "post",
                       date: {},
                       success: function(data) {
                           var newdata = eval("(" + data + ")");
                           var i = 0;
                           $("div.jindu").each(function() {
                               $(this).css("width", (newdata[i] / 54) * 100 + "%");
                               $(this).find("span").html(newdata[i]+"票");
                               if (newdata[i] < 10) {
                                   $(this).siblings("img").attr("src", "image/biaoqing3.svg");
                               }
                               else if (newdata[i] < 20) {
                                   $(this).siblings("img").attr("src", "image/biaoqing2.svg");
                               }
                               else {
                                   $(this).siblings("img").attr("src", "image/biaoqing1.svg");
                               }
                               i++;
                           });
                       },
                       error: function() {}
                   });
                   window.setTimeout(refresh, 1000);
                }
            });
        </script>
    </head>
    <body ondragstart="return false;">

        <div id="active">
            <div class="refresh">
                <p>当前票数</p>
            </div>
            <?php while ($arr = mysqli_fetch_assoc($result2)) { ?>
                <div class="one_team">
                    <div class="team_name"><?php echo$arr["zm"] ?></div>
                    <div class="team_count">
                        <div class="jindu" style="line-height: 27px;width: <?php echo $arr["ps"] / 54 * 100 ?>%;">
                            <span class="wenzi" style=""><?php echo $arr["ps"]; ?>票</span>
                        </div>
                        <?php
                        if ($arr["ps"] < 10) {
                            echo "<img src='./image/biaoqing3.svg' />";
                        } elseif ($arr["ps"] < 30) {
                            echo "<img src='./image/biaoqing2.svg' />";
                        } else {
                            echo "<img src='./image/biaoqing1.svg' />";
                        }
                        ?>
                    </div>
                </div>
            <?php } ?>
            <div class="one_team"></div>
        </div>
    </body>
</html>