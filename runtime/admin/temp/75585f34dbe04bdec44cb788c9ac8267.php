<?php /*a:2:{s:58:"D:\phpstudy_pro\WWW\ymyz.cn\app\admin\view\index\main.html";i:1644969525;s:59:"D:\phpstudy_pro\WWW\ymyz.cn\app\admin\view\common\base.html";i:1644930058;}*/ ?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>系统首页</title>
    <link rel="icon" href="favicon.ico" type="image/ico">
    <meta name="keywords" content="<?php echo basicConfiguration('keywords'); ?>">
    <meta name="description" content="<?php echo basicConfiguration('description'); ?>">
    <meta name="author" content="yinqi">
    <link href="/static/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/admin/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="/static/admin/css/style.min.css" rel="stylesheet">
    
<link href="/static/admin/js/jquery-confirm/jquery-confirm.min.css" rel="stylesheet">

<style>
    /* 长条形的数据统计布局 */
    .card-banner {
        margin-left: 0px;
        margin-right: 0px;
        margin-bottom: 24px;
        padding: 15px 0px;
        -webkit-box-shadow: 0 2px 3px rgba(0, 0, 0, 0.035);
        box-shadow: 0 2px 3px rgba(0, 0, 0, 0.035);
    }
    .card-banner .card {
        margin-bottom: 0px;
        -webkit-box-shadow: none;
        box-shadow: none;
        background-color: transparent;
    }
    .card-banner [class*=col] .card:before {
        position: absolute;
        height: calc(100%);
        width: 1px;
        background: rgba(77, 82, 89, 0.05);
        content: '';
        right: -15px;
    }
    .card-banner:not(.bg-white) [class*=col] .card:before {
        background: rgba(255, 255, 255, 0.175);
    }
    @media screen and (max-width: 576px) {
        .card-banner [class*=col-] .card:before {
            width: calc(100% - 30px)!important;
            right: 15px!important;
            height: 1px!important;
        }
        .card-banner [class*=col-]:first-child .card:before{
            display:none!important
        }
    }
</style>

</head>

<body>
<!-- 正文开始 -->



<div class="container-fluid p-t-15">

    <div class="row">


        <div class="col-sm-6 col-sm-6 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="flex-box">
                        <span class="img-avatar img-avatar-48 bg-primary"><i class="mdi mdi-google-pages fs-22"></i></span>
                        <span class="fs-22 lh-22"><?php echo htmlentities($yxkm); ?> 条</span>
                    </div>
                    <div class="text-right">有效卡密</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-sm-6 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="flex-box">
                        <span class="img-avatar img-avatar-48 bg-success"><i class="mdi mdi-google-photos fs-22"></i></span>
                        <span class="fs-22 lh-22"><?php echo htmlentities($syrj); ?> 款</span>
                    </div>
                    <div class="text-right">所有软件</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-sm-6 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="flex-box">
                        <span class="img-avatar img-avatar-48 bg-danger"><i class="mdi mdi-account fs-22"></i></span>
                        <span class="fs-22 lh-22"><?php echo htmlentities($syyh); ?> 位</span>
                    </div>
                    <div class="text-right">所有会员</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-sm-6 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="flex-box">
                        <span class="img-avatar img-avatar-48 bg-purple"><i class="mdi mdi-comment-outline fs-22"></i></span>
                        <span class="fs-22 lh-22"><?php echo htmlentities($syzx); ?> 位</span>
                    </div>
                    <div class="text-right">所有在线</div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <table class="table">
                        <tbody>
                        <tr>
                            <th scope="row">系统版本</th>
                            <td><?php if($xzver < $versions): ?><?php echo htmlentities($xzver); ?> <span class="text-pink">最新版本：<?php echo htmlentities($versions); ?> <button class="btn btn-xs btn-primary" id="wo-up" onclick="gx()">点击我更新</button></span><?php else: ?><?php echo htmlentities($xzver); ?> 不需要更新<?php endif; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">后端框架</th>
                            <td>ThinkPHP V<?php echo htmlentities($version); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">主要特色</th>
                            <td>响应式布局 / 简约 / 易上手 / 完善的多角色权限管理</td>
                        </tr>
                        <tr>
                            <th scope="row">QQ交流群</th>
                            <td>732808689</td>
                        </tr>
                        <tr>
                            <th scope="row">获取渠道</th>
                            <td>
                                <button class="btn btn-w-sm btn-round btn-warning" data-toggle="modal" data-target="#exampleModalChange" data-whatever="@梦亚科创">意见反馈</button>
                                <button class="btn btn-w-sm btn-round btn-info" id="download">立即下载</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="modal fade" id="exampleModalChange" tabindex="-1" role="dialog" aria-labelledby="exampleModalChangeLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalChangeTitle">发送消息</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="form1">
                                        <div class="form-group">
                                            <label for="recipientname" class="col-form-label">收件人:</label>
                                            <input type="text" class="form-control" id="recipientname" name="recipientname">
                                        </div>
                                        <div class="form-group">
                                            <label for="title" class="col-form-label">标题:</label>
                                            <input type="text" class="form-control" id="title" name="title">
                                        </div>
                                        <div class="form-group">
                                            <label for="nr" class="col-form-label">内容:</label>
                                            <textarea class="form-control" id="nr" name="nr"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                                    <button type="button" class="btn btn-primary" onclick="baoc()">保存</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

</div>

<!-- 正文结束 -->

<!-- js部分 -->
<script type="text/javascript" src="/static/admin/js/jquery.min.js"></script>
<script type="text/javascript" src="/static/admin/js/popper.min.js"></script>
<script type="text/javascript" src="/static/admin/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/static/admin/js/main.min.js"></script>
<script type="text/javascript" src="/static/admin/js/jquery-confirm/jquery-confirm.min.js"></script>

<script type="text/javascript" src="/static/admin/js/lyear-loading.js"></script>


<script>
    var download=document.getElementById("download");
    download.onclick=function(){
        window.open('https://qm.qq.com/cgi-bin/qm/qr?k=sJVzbkuO5mnpqG_eVleaCGJ3Ay25UtSn&jump_from=webapi','_blank');
    };
    $('#exampleModalChange').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var recipient = button.data('whatever');
        var modal = $(this);
        modal.find('.modal-title').text('向'+recipient+'提出建议');
        modal.find('.modal-body [name=recipientname]').val(recipient);
    })
    function baoc() {
        $.ajax({
            //几个参数需要注意一下
            type: "POST",//方法类型
            dataType: "json",//预期服务器返回的数据类型
            url: "/admin/index/yijian" ,//url
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
                                    //$('[alt="captcha"]').click();
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
    function gx() {
        var l = $('body').lyearloading({
            opacity: 0.6,
            backgroundColor: '#ffffff',
            imgUrl: '/static/admin/images/loader.gif',
            spinnerText: '后台处理中，请稍后...',
            textColorClass: 'text-info'
        });
        $.ajax({
            //几个参数需要注意一下
            type: "POST",//方法类型
            dataType: "json",//预期服务器返回的数据类型
            url: "/admin/index/gx" ,//url
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
                                    l.destroy();
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
                                    l.destroy();
                                    //$('[alt="captcha"]').click();
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
                            btnClass: 'btn-blue',
                            action: function() {
                                l.destroy();
                                //$('[alt="captcha"]').click();
                            }
                        }
                    }
                });
            }
        });
    }
</script>

</body>
</html>