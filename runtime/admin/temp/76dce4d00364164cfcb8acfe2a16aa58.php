<?php /*a:1:{s:59:"D:\phpstudy_pro\WWW\ymyz.cn\app\admin\view\login\index.html";i:1644934035;}*/ ?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>登录 - <?php echo basicConfiguration('title'); ?></title>
    <link rel="icon" href="favicon.ico" type="image/ico">
    <meta name="keywords" content="<?php echo basicConfiguration('keywords'); ?>">
    <meta name="description" content="<?php echo basicConfiguration('description'); ?>">
    <meta name="author" content="yinqi">
    <link href="/static/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/admin/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="/static/admin/css/style.min.css" rel="stylesheet">
    <link href="/static/admin/js/jquery-confirm/jquery-confirm.min.css" rel="stylesheet">
    <style>
        .login-form .has-feedback {
            position: relative;
        }
        .login-form .has-feedback .form-control {
            padding-left: 36px;
        }
        .login-form .has-feedback .mdi {
            position: absolute;
            top: 0;
            left: 0;
            right: auto;
            width: 36px;
            height: 36px;
            line-height: 36px;
            z-index: 4;
            color: #dcdcdc;
            display: block;
            text-align: center;
            pointer-events: none;
        }
        .login-form .has-feedback.row .mdi {
            left: 15px;
        }
    </style>
</head>

<body class="center-vh" style="background-image: url(/static/admin/images/login-bg-2.jpg); background-size: cover;">
<div class="card card-shadowed p-5 w-420 mb-0 mr-2 ml-2">
    <div class="text-center mb-3">
        <a href="index.html"> <img alt="light year admin" src="/static/admin/images/logo-sidebar.png"> </a>
    </div>

    <form onsubmit="return false" action="#!" method="post" class="login-form" id="form1">
        <div class="form-group has-feedback">
            <span class="mdi mdi-account" aria-hidden="true"></span>
            <input type="text" class="form-control" id="username" name="username" placeholder="用户名">
        </div>

        <div class="form-group has-feedback">
            <span class="mdi mdi-lock" aria-hidden="true"></span>
            <input type="password" class="form-control" id="password" name="password" placeholder="密码">
        </div>

        <div class="form-group has-feedback row">
            <div class="col-7">
                <span class="mdi mdi-check-all form-control-feedback" aria-hidden="true"></span>
                <input type="text" name="captcha" class="form-control" placeholder="验证码">
            </div>
            <div class="col-5 text-right">
                <img src="<?php echo url('admin/login/captcha'); ?>" class="pull-right" id="captcha" style="cursor: pointer;" onclick="this.src=this.src+'?t='+Math.random();" title="点击刷新" alt="captcha">
            </div>
        </div>

        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="rememberme">
                <label class="custom-control-label not-user-select" for="rememberme">5天内自动登录</label>
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-block btn-primary" type="submit" onclick="login()">立即登录</button>
        </div>
    </form>

    <p class="text-center text-muted mb-0">Copyright © 2022 <a href="https://gitee.com/dream-kc/myadmin-v3">梦亚科创</a>. All right reserved</p>
</div>

<script type="text/javascript" src="/static/admin/js/jquery.min.js"></script>
<script src="/static/admin/js/jquery-confirm/jquery-confirm.min.js" type="text/javascript"></script>
<script type="text/javascript">
    function login() {
        $.ajax({
            //几个参数需要注意一下
            type: "POST",//方法类型
            dataType: "json",//预期服务器返回的数据类型
            url: "/admin/login/index" ,//url
            data: $('#form1').serialize(),
            success: function (res) {
                console.log(res);//打印服务端返回的数据(调试用)
                if (res.code === 0) {
                    $.alert({
                        title: '成功',
                        icon: 'mdi mdi-alert',
                        type: 'blue',
                        content: res.msg,
                        buttons: {
                            okay: {
                                text: '确认',
                                btnClass: 'btn-blue',
                                action: function() {
                                    parent.document.location.href="<?php echo url('/admin/index'); ?>";
                                }
                            }
                        }
                    });
                }else {
                    $.alert({
                        title: '错误',
                        icon: 'mdi mdi-alert',
                        type: 'red',
                        content: res.msg,
                        buttons: {
                            okay: {
                                text: '确认',
                                btnClass: 'btn-blue',
                                action: function() {
                                    $('[alt="captcha"]').click();
                                }
                            }
                        }
                    });
                };
            },
            error : function() {
                $.alert({
                    title: '警告',
                    content: '请检查返回是否正常！',
                    icon: 'mdi mdi-access-point-network-off',
                    animation: 'scale',
                    closeAnimation: 'scale',
                    buttons: {
                        okay: {
                            text: '确认',
                            btnClass: 'btn-blue'
                        }
                    }
                });
            }
        });
    }
</script>
</body>
</html>