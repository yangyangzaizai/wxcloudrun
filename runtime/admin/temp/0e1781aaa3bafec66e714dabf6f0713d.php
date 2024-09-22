<?php /*a:9:{s:63:"D:\phpstudy_pro\WWW\ymyz.cn\app\admin\view\configure\index.html";i:1644803316;s:59:"D:\phpstudy_pro\WWW\ymyz.cn\app\admin\view\common\base.html";i:1644930058;s:64:"D:\phpstudy_pro\WWW\ymyz.cn\app\admin\view\configure\system.html";i:1644935461;s:65:"D:\phpstudy_pro\WWW\ymyz.cn\app\admin\view\configure\storage.html";i:1644935461;s:63:"D:\phpstudy_pro\WWW\ymyz.cn\app\admin\view\configure\email.html";i:1644935461;s:64:"D:\phpstudy_pro\WWW\ymyz.cn\app\admin\view\configure\weixin.html";i:1644935461;s:63:"D:\phpstudy_pro\WWW\ymyz.cn\app\admin\view\configure\wxapp.html";i:1644935461;s:63:"D:\phpstudy_pro\WWW\ymyz.cn\app\admin\view\configure\wxpay.html";i:1644935461;s:63:"D:\phpstudy_pro\WWW\ymyz.cn\app\admin\view\configure\token.html";i:1644803315;}*/ ?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>系统配置</title>
    <link rel="icon" href="favicon.ico" type="image/ico">
    <meta name="keywords" content="<?php echo basicConfiguration('keywords'); ?>">
    <meta name="description" content="<?php echo basicConfiguration('description'); ?>">
    <meta name="author" content="yinqi">
    <link href="/static/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/admin/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="/static/admin/css/style.min.css" rel="stylesheet">
    
<link href="/static/admin/js/jquery-confirm/jquery-confirm.min.css" rel="stylesheet">
<link href="/static/admin/css/animate.min.css" rel="stylesheet">

</head>

<body>
<!-- 正文开始 -->

<div class="container-fluid p-t-15">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <ul class="nav nav-tabs nav-fill">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#systems" aria-selected="true">网站配置</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#storages" aria-selected="false">文件存储</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#emails" aria-selected="false">邮箱配置</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#weixins" aria-selected="false">微信公众号</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#wxapps" aria-selected="false">微信小程序</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#wxpays" aria-selected="false">微信支付</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#stoken" aria-selected="false">jwttoken</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="systems" role="tabpanel">
                            <div class="tab-pane active">

    <form onsubmit="return false" action="#!" method="post" name="systemForm" class="edit-form" id="system">
        <input type="hidden" name="typename" value="system">
        <div class="form-group">
            <label for="title">网站标题</label>
            <input class="form-control" type="text" id="title" name="title" value="<?php echo htmlentities((isset($sysconf['title']) && ($sysconf['title'] !== '')?$sysconf['title']:'')); ?>" placeholder="请输入网站首页标题">
<!--            <small class="help-block">调用方式：<code>config('web_site_title')</code></small>-->
        </div>
        <div class="form-group">
            <label for="webname">网站名称</label>
            <input class="form-control" type="text" id="webname" name="webname" value="<?php echo htmlentities((isset($sysconf['webname']) && ($sysconf['webname'] !== '')?$sysconf['webname']:'')); ?>" placeholder="请输入网站名称">
        </div>
        <div class="form-group">
            <label for="domain">网站域名</label>
            <input class="form-control" type="text" id="domain" name="domain" value="<?php echo htmlentities((isset($sysconf['domain']) && ($sysconf['domain'] !== '')?$sysconf['domain']:'')); ?>" placeholder="请输入网站域名">
        </div>
        <div class="form-group file-group">
            <label for="logo">LOGO图片</label>
            <div class="input-group">
                <input type="text" class="form-control file-value" name="logo" value="<?php echo htmlentities((isset($sysconf['logo']) && ($sysconf['logo'] !== '')?$sysconf['logo']:'')); ?>" placeholder="LOGO图片地址" />
                <input type="file" accaccept=".png,.jpg,.jpeg,.bmp,.gif" class="d-none" />
                <div class="input-group-append">
                    <button class="btn btn-default file-browser" type="button">上传图片</button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="keywords">站点关键词</label>
            <input class="form-control" type="text" id="keywords" name="keywords" value="<?php echo htmlentities((isset($sysconf['keywords']) && ($sysconf['keywords'] !== '')?$sysconf['keywords']:'')); ?>" placeholder="多个关键词用英文状态 , 号分割">
            <small class="help-block">网站搜索引擎关键字</small>
        </div>
        <div class="form-group">
            <label for="description">站点描述</label>
            <textarea class="form-control" id="description" rows="5" name="description" placeholder="请输入站点描述"><?php echo htmlentities((isset($sysconf['description']) && ($sysconf['description'] !== '')?$sysconf['description']:'')); ?></textarea>
            <small class="help-block">网站描述，有利于搜索引擎抓取相关信息</small>
        </div>
        <div class="form-group">
            <label for="copyright">版权信息</label>
            <input class="form-control" type="text" id="copyright" name="copyright" value="<?php echo htmlentities((isset($sysconf['copyright']) && ($sysconf['copyright'] !== '')?$sysconf['copyright']:'')); ?>" placeholder="请输入版权信息">
        </div>
        <div class="form-group">
            <label for="miitbeian">备案信息</label>
            <input class="form-control" type="text" id="miitbeian" name="miitbeian" value="<?php echo htmlentities((isset($sysconf['miitbeian']) && ($sysconf['miitbeian'] !== '')?$sysconf['miitbeian']:'')); ?>" placeholder="请输入备案信息">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary m-r-5" onclick="post_submit('system')">确 定</button>
        </div>
    </form>

</div>
                        </div>
                        <div class="tab-pane fade" id="storages" role="tabpanel">
                            <div class="tab-pane active">

    <form onsubmit="return false" action="#!" method="post" name="storageForm" class="edit-form" id="storage">
        <input type="hidden" name="typename" value="storage">
        <div class="form-group">
            <label for="engine">存储引擎</label>
            <div class="clearfix">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="statusTwo" name="engine" class="custom-control-input" value="1" <?php if(isset($storage['engine'])): if($storage['engine'] == '1'): ?>checked<?php endif; ?><?php endif; ?>>
                    <label class="custom-control-label" for="statusTwo">本地(不推荐)</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="statusOne" name="engine" class="custom-control-input" value="2" <?php if(isset($storage['engine'])): if($storage['engine'] == '2'): ?>checked<?php endif; ?><?php endif; ?>>
                    <label class="custom-control-label" for="statusOne">七牛云</label>
                </div>
            </div>
        </div>
        <div id="qiniu" style="display:none">
            <div class="form-group">
                <label for="accesskey">AccessKey</label>
                <input class="form-control" type="text" id="accesskey" name="accesskey" value="<?php echo htmlentities((isset($storage['accesskey']) && ($storage['accesskey'] !== '')?$storage['accesskey']:'')); ?>" placeholder="请输入AccessKey">
            </div>
            <div class="form-group">
                <label for="secretkey">SecretKey</label>
                <input class="form-control" type="password" id="secretkey" name="secretkey" value="<?php echo htmlentities((isset($storage['secretkey']) && ($storage['secretkey'] !== '')?$storage['secretkey']:'')); ?>" placeholder="请输入SecretKey">
            </div>
            <div class="form-group">
                <label for="secretkey">空间bucket</label>
                <input class="form-control" type="text" id="bucket" name="bucket" value="<?php echo htmlentities((isset($storage['bucket']) && ($storage['bucket'] !== '')?$storage['bucket']:'')); ?>" placeholder="请输入空间bucket">
            </div>
            <div class="form-group">
                <label for="domain">空间域名</label>
                <input class="form-control" type="text" id="domain" name="domain" value="<?php echo htmlentities((isset($storage['domain']) && ($storage['domain'] !== '')?$storage['domain']:'')); ?>" placeholder="请输入空间域名">
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary m-r-5" onclick="post_submit('storage')">确 定</button>
        </div>
    </form>

</div>
                        </div>
                        <div class="tab-pane fade" id="emails" role="tabpanel">
                            <div class="tab-pane active">

    <form onsubmit="return false" action="#!" method="post" name="emailForm" class="edit-form" id="email">
        <input type="hidden" name="typename" value="email">
        <div class="form-group">
            <label for="username">发送方邮箱</label>
            <input class="form-control" type="text" id="username" name="username" value="<?php echo htmlentities((isset($email['username']) && ($email['username'] !== '')?$email['username']:'')); ?>" placeholder="请输入发送方邮箱">
        </div>
        <div class="form-group">
            <label for="fullname">发送方姓名</label>
            <input class="form-control" type="text" id="fullname" name="fullname" value="<?php echo htmlentities((isset($email['fullname']) && ($email['fullname'] !== '')?$email['fullname']:'')); ?>" placeholder="请输入发送方姓名">
        </div>
        <div class="form-group">
            <label for="password">邮箱授权码</label>
            <input class="form-control" type="password" id="password" name="password" value="<?php echo htmlentities((isset($email['password']) && ($email['password'] !== '')?$email['password']:'')); ?>" placeholder="请输入邮箱授权码">
        </div>
        <div class="form-group">
            <label for="host">SMTP服务器</label>
            <input class="form-control" type="text" id="host" name="host" value="<?php echo htmlentities((isset($email['host']) && ($email['host'] !== '')?$email['host']:'')); ?>" placeholder="请输入SMTP服务器地址">
        </div>
        <div class="form-group">
            <label for="port">ssl端口号</label>
            <input class="form-control" type="text" id="port" name="port" value="<?php echo htmlentities((isset($email['port']) && ($email['port'] !== '')?$email['port']:'')); ?>" placeholder="请输入ssl协议方式端口号">
        </div>
        <div class="form-group">
            <label for="subject">验证邮件标题</label>
            <input class="form-control" type="text" id="subject" name="subject" value="<?php echo htmlentities((isset($email['subject']) && ($email['subject'] !== '')?$email['subject']:'')); ?>" placeholder="请输入邮件标题">
        </div>
        <div class="form-group">
            <label for="body">验证邮件正文</label>
            <textarea class="form-control" id="body" name="body" value="<?php echo htmlentities((isset($email['body']) && ($email['body'] !== '')?$email['body']:'')); ?>" placeholder="请输入邮件正文"><?php echo htmlentities((isset($email['body']) && ($email['body'] !== '')?$email['body']:'')); ?></textarea>
        </div>
        <div class="form-group">
            <label for="notice_email">收取邮箱地址</label>
            <input class="form-control" type="text" id="notice_email" name="notice_email" value="<?php echo htmlentities((isset($email['notice_email']) && ($email['notice_email'] !== '')?$email['notice_email']:'')); ?>" placeholder="请输入收取邮箱地址">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary m-r-5" onclick="post_submit('email')">确 定</button>
            <button type="button" class="btn btn-default" onclick="javascript:history.back(-1);return false;">测试邮箱配置</button>
        </div>
    </form>

</div>
                        </div>
                        <div class="tab-pane fade" id="weixins" role="tabpanel">
                            <div class="tab-pane active">

    <form onsubmit="return false" action="#!" method="post" name="weixinForm" class="edit-form" id="weixin">
        <input type="hidden" name="typename" value="weixin">
        <div class="form-group">
            <label for="appid">Appid</label>
            <input class="form-control" type="text" id="appid" name="appid" value="<?php echo htmlentities((isset($weixin['appid']) && ($weixin['appid'] !== '')?$weixin['appid']:'')); ?>" placeholder="请输入Appid">
        </div>
        <div class="form-group">
            <label for="appsecret">AppSecret</label>
            <input class="form-control" type="password" id="appsecret" name="appsecret" value="<?php echo htmlentities((isset($weixin['appsecret']) && ($weixin['appsecret'] !== '')?$weixin['appsecret']:'')); ?>" placeholder="请输入AppSecret">
        </div>
        <div class="form-group">
            <label for="token">Token</label>
            <input class="form-control" type="text" id="token" name="token" value="<?php echo htmlentities((isset($weixin['token']) && ($weixin['token'] !== '')?$weixin['token']:'')); ?>" placeholder="请输入Token">
        </div>
        <div class="form-group">
            <label for="AesKey">AesKey</label>
            <input class="form-control" type="password" id="AesKey" name="AesKey" value="<?php echo htmlentities((isset($weixin['AesKey']) && ($weixin['AesKey'] !== '')?$weixin['AesKey']:'')); ?>" placeholder="请输入AesKey">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary m-r-5" onclick="post_submit('weixin')">确 定</button>
        </div>
    </form>

</div>
                        </div>
                        <div class="tab-pane fade" id="wxapps" role="tabpanel">
                            <div class="tab-pane active">

    <form onsubmit="return false" action="#!" method="post" name="wxappForm" class="edit-form" id="wxapp">
        <input type="hidden" name="typename" value="wxapp">
        <div class="form-group">
            <label for="appid">Appid</label>
            <input class="form-control" type="text" id="appid" name="appid" value="<?php echo htmlentities((isset($wxapp['appid']) && ($wxapp['appid'] !== '')?$wxapp['appid']:'')); ?>" placeholder="请输入Appid">
        </div>
        <div class="form-group">
            <label for="appsecret">AppSecret</label>
            <input class="form-control" type="password" id="appsecret" name="appsecret" value="<?php echo htmlentities((isset($wxapp['appsecret']) && ($wxapp['appsecret'] !== '')?$wxapp['appsecret']:'')); ?>" placeholder="请输入AppSecret">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary m-r-5" onclick="post_submit('wxapp')">确 定</button>
        </div>
    </form>

</div>
                        </div>
                        <div class="tab-pane fade" id="wxpays" role="tabpanel">
                            <div class="tab-pane active">

    <form onsubmit="return false" action="#!" method="post" name="wxpayForm" class="edit-form" id="wxpay">
        <input type="hidden" name="typename" value="wxpay">
        <div class="form-group">
            <label for="appid">Appid</label>
            <input class="form-control" type="text" id="appid" name="appid" value="<?php echo htmlentities((isset($wxpay['appid']) && ($wxpay['appid'] !== '')?$wxpay['appid']:'')); ?>" placeholder="请输入Appid">
        </div>
        <div class="form-group">
            <label for="mch_id">商户号</label>
            <input class="form-control" type="text" id="mch_id" name="mch_id" value="<?php echo htmlentities((isset($wxpay['mch_id']) && ($wxpay['mch_id'] !== '')?$wxpay['mch_id']:'')); ?>" placeholder="请输入商户号">
        </div>
        <div class="form-group">
            <label for="mch_key">商户密钥</label>
            <input class="form-control" type="password" id="mch_key" name="mch_key" value="<?php echo htmlentities((isset($wxpay['mch_key']) && ($wxpay['mch_key'] !== '')?$wxpay['mch_key']:'')); ?>" placeholder="请输入商户密钥">
        </div>
        <div class="form-group">
            <label for="certpem">CERT证书</label>
            <textarea class="form-control" id="certpem" name="certpem" placeholder="请粘贴CERT证书"><?php echo htmlentities((isset($wxpay['certpem']) && ($wxpay['certpem'] !== '')?$wxpay['certpem']:'')); ?></textarea>
        </div>
        <div class="form-group">
            <label for="keypem">KEY证书</label>
            <textarea class="form-control" id="keypem" name="keypem" placeholder="请粘贴KEY证书"><?php echo htmlentities((isset($wxpay['keypem']) && ($wxpay['keypem'] !== '')?$wxpay['keypem']:'')); ?></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary m-r-5" onclick="post_submit('wxpay')">确 定</button>
        </div>
    </form>

</div>
                        </div>
                        <div class="tab-pane fade" id="stoken" role="tabpanel">
                            <div class="tab-pane active">

    <form onsubmit="return false" action="#!" method="post" name="tokenForm" class="edit-form" id="jwttoken">
        <input type="hidden" name="typename" value="jwttoken">
        <div class="form-group">
            <label for="iss">Token签发组织</label>
            <input class="form-control" type="text" id="iss" name="iss" value="<?php echo htmlentities((isset($jwttoken['iss']) && ($jwttoken['iss'] !== '')?$jwttoken['iss']:'')); ?>" placeholder="请输入Token签发组织">
        </div>
        <div class="form-group">
            <label for="aud">Token签发作者</label>
            <input class="form-control" type="text" id="aud" name="aud" value="<?php echo htmlentities((isset($jwttoken['aud']) && ($jwttoken['aud'] !== '')?$jwttoken['aud']:'')); ?>" placeholder="请输入Token签发作者">
        </div>
        <div class="form-group">
            <label for="secrect">Token Secrect</label>
            <input class="form-control" type="password" id="secrect" name="secrect" value="<?php echo htmlentities((isset($jwttoken['secrect']) && ($jwttoken['secrect'] !== '')?$jwttoken['secrect']:'')); ?>" placeholder="请输入Token Secrect">
        </div>
        <div class="form-group">
            <label for="exptime">Token过期时间</label>
            <input class="form-control" type="text" id="exptime" name="exptime" value="<?php echo htmlentities((isset($jwttoken['exptime']) && ($jwttoken['exptime'] !== '')?$jwttoken['exptime']:'')); ?>" placeholder="请输入Token过期时间">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary m-r-5" onclick="post_submit('jwttoken')">确 定</button>
        </div>
    </form>

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

<script type="text/javascript" src="/static/admin/js/jquery-confirm/jquery-confirm.min.js"></script>
<script type="text/javascript" src="/static/admin/js/bootstrap-table/bootstrap-table.min.js"></script>
<script type="text/javascript" src="/static/admin/js/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>
<!--以下是tree-grid的使用示例-->
<link href="/static/admin/js/jquery-treegrid/jquery.treegrid.min.css" rel="stylesheet">
<script type="text/javascript" src="/static/admin/js/jquery-treegrid/jquery.treegrid.min.js"></script>

<script type="text/javascript" src="/static/admin/js/bootstrap-notify.min.js"></script>
<script type="text/javascript" src="/static/admin/js/lyear-loading.js"></script>


<script>
    $(":radio[name='engine']").click(function(){
        var index = $(":radio[name='engine']").index($(this));
        if(index == 0){
            document.getElementById("qiniu").style.display="none";
        }else if(index == 1){
            document.getElementById("qiniu").style.display="";
        }
    });
    $(document).ready(function() {
        $(document).on('click', '.file-browser', function() {
            var $browser = $(this);
            var file = $browser.closest('.file-group').find('[type="file"]');
            file.on( 'click', function(e) {
                e.stopPropagation();
            });
            file.trigger('click');
        });

        $(document).on('change', '.file-group [type="file"]', function() {
            var $this    = $(this);
            var $input   = $(this)[0];
            var $len     = $input.files.length;
            var formFile = new FormData();

            if ($len == 0) {
                return false;
            } else {
                var fileAccaccept = $this.attr('accaccept');
                var fileType      = $input.files[0].type;
                var type          = (fileType.substr(fileType.lastIndexOf("/") + 1)).toLowerCase();

                if (!type || fileAccaccept.indexOf(type) == -1) {
                    jQuery.notify({
                            icon: '',
                            message: '您上传图片的类型不符合(.jpg|.jpeg|.gif|.png|.bmp)'
                        },
                        {
                            element: 'body',
                            type: 'danger',
                            allow_dismiss: true,
                            newest_on_top: true,
                            showProgressbar: false,
                            placement: {
                                from: 'top',
                                align: 'center'
                            },
                            offset: 20,
                            spacing: 10,
                            z_index: 10800,
                            delay: 1000,
                            animate: {
                                enter: 'animated shake',
                                exit: 'animated fadeOutDown'
                            }
                        });
                    return false;
                }
                formFile.append("file", $input.files[0]);
            }

            var data = formFile;
            var l = $('body').lyearloading({
                opacity: 0.2,
                spinnerSize: 'nm'
            });

            $.ajax({
                url: '/admin/upload/upload',
                data: data,
                type: "POST",
                dataType: "json",
                //上传文件无需缓存
                cache: false,
                //用于对data参数进行序列化处理 这里必须false
                processData: false,
                //必须
                contentType: false,
                success: function (res) {
                    l.destroy();
                    if (res.code === 1) {
                        $this.closest('.file-group').find('.file-value').val(res.data.filePath);
                    } else {
                        jQuery.notify({
                                icon: '',
                                message: res.msg
                            },
                            {
                                element: 'body',
                                type: 'danger',
                                allow_dismiss: true,
                                newest_on_top: true,
                                showProgressbar: false,
                                placement: {
                                    from: 'top',
                                    align: 'center'
                                },
                                offset: 20,
                                spacing: 10,
                                z_index: 10800,
                                delay: 3000,
                                animate: {
                                    enter: 'animated shake',
                                    exit: 'animated fadeOutDown'
                                }
                            });
                    }
                },
            });
        });
    });
    function post_submit(ss) {
        $.ajax({
            //几个参数需要注意一下
            type: "POST",//方法类型
            dataType: "json",//预期服务器返回的数据类型
            url: "/admin/configure/post_submit" ,//url
            data: $('#'+ss).serialize(),
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
        return false;
    }
</script>

</body>
</html>