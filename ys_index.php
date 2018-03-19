<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>流动异彩的html5表单登录框</title>
        <link rel="stylesheet" href="./css/ys_login.css" type="text/css">
        <script type="text/javascript" src="./js/jquery-3.2.1.min.js"></script>
        <link rel="stylesheet" href="./css/ys_style.css" type="text/css">
        <script type="text/javascript" src="./js/ys_login.js"></script>
        <script type="text/javascript" src="./js/jscookie.js"></script>
        <script type="text/javascript" src="css/layer/layer.js"></script>
    </head>
    <body>
        <div class="rain">
            
            <div class="border">
                <!--登录-->
                <div id="deng">
                    <p>学号</p>
                    <input id="input_name" type="text" placeholder="请输入账号"/>
                    <p>密码</p>
                    <input id="input_password" type="password" placeholder="请输入密码"/><br/>
                    <input class="deng"type="button" value="登录"/>
                    <input class="zhu" type="button" value="注册"/>
                </div>
                <!--注册-->
                <div id="zhu">
                    <div class="y_p1">学号:<input type="text"class="studynumber"/></div>
                    <div class="y_p2">密码:<input type="password"class="password"/></div>
                    <div class="y_p3">确认密码:<input type="password"class="fist_possword"/></div>
                    <div class="y_p4">请输入验证码:<input type="text"class="code"/>
                        <img id="y_img" title="点击刷新"src="./verification.php" alt="">
                    </div>
                    <input type="button"class="go_top" value="立即注册"/>
                    <input type="button"class="go_deng" value="< 返回登录"/>
                </div>
                <!--登录状态-->
                <div id="today">
                    <div class="admin"><p>用户名：</p></div>
                    <div class="state"><p>投票权：</p></div>
                    <div class="logout"><p>退出登录</p></div>
                </div>
            </div>
        </div>
    </body>
</html>
