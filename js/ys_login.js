/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){
    var panduan = false;
    //注册验证
    //点击注册打开注册界面
        $(".zhu").click(function(){
           $("#deng").hide(200);
           $("#zhu").show(200);
        });
    //刷新验证码
    $("#y_img").click(function() {
        $(this).attr("src", "verification.php?t=" + Math.random());
    });
    $(".go_top").click(function() {
        //获取用户输入
        var name = $(".studynumber").val();
        var password = $(".password").val();
        var fist_possword = $(".fist_possword").val();
        var code = $(".code").val();
        var name_z = new RegExp(/^[0-9]{9}$/);
        var password_z = new RegExp(/^[a-zA-Z]{1}[a-zA-Z\d_]{5,}$/);
        if (!name_z.test(name)) {
            layer.alert('请输入正确的学号格式 !', {
                icon: 0,
                skin: 'layer-ext-moon' 
            });
            return;
        }
        if (!password_z.test(password)) {
            layer.alert('密码首字母不为英文或长度不足6位 !', {
                icon: 0,
                skin: 'layer-ext-moon' 
            });
            return;
        }
        if(fist_possword==""){
            layer.alert('请再次确认密码！', {
                icon: 0,
                skin: 'layer-ext-moon'
            });
            return;
        }
        if(password!=fist_possword){
            layer.alert('两次输入密码不一致！', {
                icon: 0,
                skin: 'layer-ext-moon'
            });
            return;
        }
        if (code.length != 4) {
            layer.alert('验证码必须4位！', {
                icon: 0,
                skin: 'layer-ext-moon'
            });
            return;
        }


        //提交数据到后台，页面还不能刷新 ----  无刷新 技术  AJXA  
        //JS  原生态JS  复杂   JQ  
        $.ajax({
            url: "zhu.php",
            type: "post",
            data: {name: name, password: password, code: code},
            success: function(data) {
                console.log(data);
                data = Number(data);
                if (data == 10001) {
                    layer.alert('注册成功！', {
                        icon: 1,
                        skin: 'layer-ext-moon'
                    });
                $(".studynumber").val("");
                $(".password").val("");
                $(".fist_possword").val("");
                $(".code").val("");
                $("#y_img").attr("src", "verification.php?t=" + Math.random());
                }
                else if (data == "10086") {
                    layer.alert('验证码不一样！', {
                        icon: 0,
                        skin: 'layer-ext-moon'
                    });
                    $("#code").val("");
                    $("#y_img").attr("src", "verification.php?t=" + Math.random());
                }
                else if (data == "10002") {
                    layer.alert('用户名格式不对！', {
                        icon: 0,
                        skin: 'layer-ext-moon'
                    });
                    $("#y_img").attr("src", "verification.php?t=" + Math.random());
                }
                else if (data == "10003") {
                    layer.alert('密码格式不对！', {
                        icon: 2,
                        skin: 'layer-ext-moon'
                    });
                }
                else if (data == "10004") {
                    layer.alert('注册失败，用户名重复！', {
                        icon: 5,
                        skin: 'layer-ext-moon'
                    });
                    $("#y_img").attr("src", "verification.php?t=" + Math.random());
                }if (data == "10005") {
                    layer.alert('内测仅限Java1班使用！', {
                        icon: 5,
                        skin: 'layer-ext-moon'
                    });
                    $("#y_img").attr("src", "verification.php?t=" + Math.random());
                } else if (data == "10006") {
                    layer.alert('数据插入失败！', {
                        icon: 5,
                        skin: 'layer-ext-moon'
                    });
                }
            },
            error: function() {

            }
        });
    });
    //登录验证
    //注册界面点击返回登录
    $(".go_deng").click(function(){
           $("#deng").show(200);
           $("#zhu").hide(200);
        });
    $(".deng").click(function() {
        //获取用户输入的用户名和密码
        var name = $("#input_name").val();
        var password = $("#input_password").val();
        var name_z = new RegExp(/^[0-9]{9}$/);
        if (!name_z.test(name)) {
            layer.alert('请输入正确的学号 !', {
                icon: 0,
                skin: 'layer-ext-moon' 
            });
            return;
        }
        if(password==""){
            layer.alert('请输入密码 !', {
                icon: 0,
                skin: 'layer-ext-moon' 
            });
            return;
        }
        //传递到后台去
        $.ajax({
            url: "login.php",
            type: "post",
            data: {name: name, password: password},
            success: function(data) {
            var newdata = eval("("+data+")");
                if (newdata.code == "10001") {
                    layer.alert('登录成功！', {
                        icon: 6,
                        skin: 'layer-ext-moon'
                    });
                     panduan = true;
                    var state = "";
                    if(newdata["time"]!= newdata["new_time"]){     
                        state = '<span style="color:green;">你当前可投票</span>';//是一天
                    }  
                    if(newdata["time"]== newdata["new_time"]){
                        state = '<span style="color:red;">你当前不可投票</span>';// 不是一天
                    }
                    var admin='<span>'+newdata['niname']+'</span>';
                    $('.admin').find('p').eq(0).after(admin);
                    $('.state').find('p').eq(0).after(state);
                    $('#today').show();
                    $('#deng').hide();
                }
                if (data == "10002") {
                    layer.alert('学号或密码错误 !', {
                        icon: 5,
                        skin: 'layer-ext-moon'
                    });
                }
            },
            error: function() {
            }
        });
    });
    //退出登录  
   $('.logout').click(function(){
            layer.alert('退出登录！', {
                        icon: 6,
                        skin: 'layer-ext-moon'
                    });
          panduan = false;
        //切换到登录界面
        $('#today').hide();
        $('#deng').show();
        $("#input_password").val("");
        //移除span
        $('.admin').find('span').remove();
        $('.state').find('span').remove();
       //JS清除cookie  
        deleteCookie("id");
        deleteCookie("name");
        deleteCookie("niname");
        $('#today').hide();
        $('#deng').show();
   });
   
   
   
   
   
   
   
    $(".ccad_zum").click(function(){
        if(panduan==false){
            layer.alert('请登录后再投票 !', {
                        icon: 5,
                        skin: 'layer-ext-moon'
                    });
            return;
        }
        
        var ccad_id = $(this).attr('ccadps');
            $.ajax({
            url:"ccad_php.php",
            type: "post",
            data: {ccad_id:ccad_id},
            success: function(data) {
                if(data==1000){
                    layer.alert('投票成功', {
                        icon: 1,
                        skin: 'layer-ext-moon'
                    });
                    $('.state').find('span').remove();
                     state = '<span style="color:red;">你当前不可投票</span>';
                     $('.state').find('p').eq(0).after(state);
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
                        error: function() {

                        }
                    });
                }else if(data == 1001){
                    layer.alert('先登录再投票 !', {
                        icon: 5,
                        skin: 'layer-ext-moon'
                    });
                }else if(data == 1002){
                    layer.alert('今天已经投过票了 !', {
                        icon: 5,
                        skin: 'layer-ext-moon'
                    });
                }else if(data == 1003){
                    layer.alert('就你知道的多 !', {
                        icon: 3,
                        skin: 'layer-ext-moon'
                    });
                    location.reload();
                }
                
            }
    });
    
    
    
    
    
    
    
    
    
    
    
    
});

});