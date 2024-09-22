<?php
$step = $_GET['step'] ?? 1;
$nextStep = $step + 1;
$siteName = "梦亚网络验证";
if($step == 1 or $step == 2){
    if (file_exists('../../config/install.lock')) {
        $msg = "当前已经安装{$siteName}，如果需要重新安装，请手动移除config/install.lock文件";
    }
}
if (version_compare(PHP_VERSION, '7.1.0', '<')) {
    $msg = "当前版本(" . PHP_VERSION . ")过低，请使用PHP7.1.0以上版本";
}
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>梦亚网络验证安装程序</title>
    <link rel="icon" href="favicon.ico" type="image/ico">
    <meta name="author" content="yinqi">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/materialdesignicons.min.css" rel="stylesheet">
    <link href="css/style.min.css" rel="stylesheet">
    <style>
        .success-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 392px;
            /*border: 1px solid #E5E5E5;*/
        }
        .error-page {
            height: 100%;
            position: fixed;
            width: 100%;
        }
        .error-body {
            padding-top: 5%;
        }
        .error-body h1 {
            font-size: 210px;
            font-weight: 700;
            text-shadow: 4px 4px 0 #f5f6fa, 6px 6px 0 #868e96;
            line-height: 210px;
            color: #868e96;
        }
    </style>
</head>

<body>
<div class="container-fluid p-t-15">

    <div class="row">

        <?php if($msg != ''){ ?>
        <section class="error-page">
            <div class="error-box">
                <div class="error-body text-center">
                    <h1>提示</h1>
                    <h5 class="mb-5 mt-3 text-gray"><?php echo $msg; ?></h5>
                    <a href="/index" class="btn btn-primary">返回首页</a>
                </div>
            </div>
        </section>
        <?php }else{ ?>
        <div class="col-lg-12">
            <div class="card">
                <header class="card-header"><div class="card-title">梦亚网络验证安装</div></header>
                <div class="card-body">
                    <form method="post" <?php if($step=='2'){ ?> action="?step=3" <?php }else{ ?>action="#"<?php }?> name="main_form">
                        <ul class="nav nav-step nav-fill">
                            <li class="nav-item">
                                <span>说明</span>
                                <a class="nav-link <?php if(in_array($step, ['1', "2", "3"])){ ?> active <?php }?>" href="#"></a>
                            </li>

                            <li class="nav-item">
                                <span>配置</span>
                                <a class="nav-link <?php if(in_array($step, [ "2", "3"])){ ?> active <?php }?>" href="#"></a>
                            </li>

                            <li class="nav-item">
                                <span>安装</span>
                                <a class="nav-link <?php if($step == "3"){ ?> active <?php }?>" href="#"></a>
                            </li>

                            <li class="nav-item">
                                <span>完成</span>
                                <a class="nav-link <?php if($step == "4"){ ?> active <?php }?>" href="#"></a>
                            </li>

                        </ul>

                        <?php if($step == '1'){ ?>
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <div class="card-title">
                                        <a data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" href="#!" id="titles">3.0.2更新内容</a>
                                    </div>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body" id="neirong">
                                        1.增加解绑功能。
                                        2.修复本地MD5检测功能
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } elseif ($step == '2') { ?>

                            <div class="form-group">
                                <label for="host">数据库IP：</label>
                                <input class="form-control" type="text" id="host" name="host" value="127.0.0.1" placeholder="请输入数据库IP">
                            </div>
                            <div class="form-group">
                                <label for="port">数据库端口：</label>
                                <input class="form-control" type="text" id="port" name="port" value="3306" placeholder="请输入数据库端口">
                            </div>
                            <div class="form-group">
                                <label for="user">用户名：</label>
                                <input class="form-control" type="text" id="user" name="user" value="" placeholder="请输入数据库用户名">
                            </div>
                            <div class="form-group">
                                <label for="password">密码：</label>
                                <input class="form-control" type="password" id="password" name="password" value="" placeholder="请输入密码">
                            </div>
                            <div class="form-group">
                                <label for="name">数据库名：</label>
                                <input class="form-control" type="text" id="name" name="name" value="" placeholder="请输入数据库名">
                            </div>
                        <?php }elseif ($step == "3"){?>
                            <div class="success-content">
                                <div style="width: 48px;height: 48px;">
                                    <img src="http://www.bixiaguangnian.com/home/images/loader.gif"/>
                                </div>
                                <div class="mt16 result">安装中...请稍后</div>
<!--                                <div style="margin-top: 5px;font-size:14px;">版本号：3.0.2</div>-->
<!--                                <div class="tips">-->
<!--                                    为了您站点的安全，更新完成后即可将“update”文件夹删除。-->
<!--                                </div>-->
<!--                                <div class="btn-group" style="margin-top:20px;">-->
<!--                                    <a class="btn btn-w-md btn-round btn-primary" href="/admin">安装完成</a>-->
<!--                                </div>-->
                            </div>
                        <?php } elseif ($step == "4") { ?>
                            <div class="success-content">
                                <div style="width: 48px;height: 48px;">
                                    <img src="./images/icon_mountSuccess.png"/>
                                </div>
                                <div class="mt16 result">更新完成，进入管理后台</div>
                                <div style="margin-top: 5px;font-size:14px;">版本号：3.0.2</div>
                                <div class="tips">
                                    为了您站点的安全，更新完成后即可将“update”文件夹删除。
                                </div>
                                <div class="btn-group" style="margin-top:20px;">
                                    <a class="btn btn-w-md btn-round btn-primary" href="/admin">安装完成</a>
                                </div>
                            </div>
                        <?php }?>
                    <div class="row" style="margin-top:20px;">
                        <?php if ($step == '1') { ?>
                            <div class="col-auto mr-auto"></div>
                            <div class="col-auto"><button class="btn btn-w-md btn-round btn-primary" onclick="goStep(<?php echo $nextStep ?>)">已知晓</button></div>
                        <?php } elseif ($step == '2') { ?>
                        <div class="col-auto mr-auto"><button class="btn btn-w-md btn-round btn-warning" onclick="cancel()">上一步</button></div>
                        <div class="col-auto"><button class="btn btn-w-md btn-round btn-primary">安装</button></div>
                        <?php }?>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php } ?>

    </div>

</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/main.min.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript">
    function goStep(step) {

        document.main_form.action = "?step=" + step;
        document.main_form.submit();

        // form.action = "?step=" + step;
        // window.location.href = "?step=" + step;
    }
    function cancel() {
        window.history.go(-1);
    }
    function tj() {
        var data = {
            host:'<?php echo $_POST['host'];?>',
            user:'<?php echo $_POST['user'];?>',
            password:'<?php echo $_POST['password'];?>',
            name:'<?php echo $_POST['name'];?>'
        }
        //$.post('ajax.php', data);
        $.ajax({
            url: 'ajax.php',
            data:data,
            type: 'POST',
            dataType: 'json'
        }).done(function(response) {
            console.log(response)
            if(response.code == 0){
                document.main_form.action = "?step=4";
                document.main_form.submit();
            }
        }).fail(function() {
            console.error('数据错误');
        });
    }
</script>
<?php if($step == '3'){ echo '<script type="text/javascript">tj();</script>';} ?>
</body>
</html>