<?php /*a:2:{s:61:"D:\phpstudy_pro\WWW\ymyz.cn\app\admin\view\role\authlist.html";i:1644803322;s:59:"D:\phpstudy_pro\WWW\ymyz.cn\app\admin\view\common\base.html";i:1644930058;}*/ ?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>设置权限</title>
    <link rel="icon" href="favicon.ico" type="image/ico">
    <meta name="keywords" content="<?php echo basicConfiguration('keywords'); ?>">
    <meta name="description" content="<?php echo basicConfiguration('description'); ?>">
    <meta name="author" content="yinqi">
    <link href="/static/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/admin/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="/static/admin/css/style.min.css" rel="stylesheet">
    
<link href="/static/admin/js/jquery-confirm/jquery-confirm.min.css" rel="stylesheet">

</head>

<body>
<!-- 正文开始 -->

<div class="container-fluid p-t-15">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <header class="card-header"><div class="card-title">设置权限</div></header>
                <div class="card-body">

                    <form onsubmit="return false" action="#!" method="post" id="form1">
                        <input type="hidden" name="id" value="<?php echo htmlentities($id); ?>" />
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="check-all">
                                            <label class="custom-control-label" for="check-all">全选</label>
                                        </div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="rules[]" class="custom-control-input checkbox-parent" id="roleid-<?php echo htmlentities($vo['id']); ?>" dataid="id-<?php echo htmlentities($vo['id']); ?>" value="<?php echo htmlentities($vo['id']); ?>" <?php if($vo['checked'] == 'true'): ?>checked<?php endif; ?>>
                                            <label class="custom-control-label" for="roleid-<?php echo htmlentities($vo['id']); ?>"><?php echo htmlentities($vo['title']); ?></label>
                                        </div>
                                    </td>
                                </tr>
                                <?php if(!(empty($vo['children']) || (($vo['children'] instanceof \think\Collection || $vo['children'] instanceof \think\Paginator ) && $vo['children']->isEmpty()))): if(is_array($vo['children']) || $vo['children'] instanceof \think\Collection || $vo['children'] instanceof \think\Paginator): $k = 0; $__LIST__ = $vo['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($k % 2 );++$k;?>
                                <tr>
                                    <td class="p-l-20">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="rules[]" class="custom-control-input checkbox-parent checkbox-child" id="roleid-<?php echo htmlentities($vo['id']); ?>-<?php echo htmlentities($voo['id']); ?>" dataid="id-<?php echo htmlentities($vo['id']); ?>-<?php echo htmlentities($voo['id']); ?>" value="<?php echo htmlentities($voo['id']); ?>" <?php if($voo['checked'] == 'true'): ?>checked<?php endif; ?>>
                                            <label class="custom-control-label" for="roleid-<?php echo htmlentities($vo['id']); ?>-<?php echo htmlentities($voo['id']); ?>"><?php echo htmlentities($voo['title']); ?></label>
                                        </div>
                                    </td>
                                </tr>
                                <?php if(!(empty($voo['children']) || (($voo['children'] instanceof \think\Collection || $voo['children'] instanceof \think\Paginator ) && $voo['children']->isEmpty()))): ?>
                                <tr>
                                    <td class="p-l-40">
                                        <?php if(is_array($voo['children']) || $voo['children'] instanceof \think\Collection || $voo['children'] instanceof \think\Paginator): $i = 0; $__LIST__ = $voo['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vooo): $mod = ($i % 2 );++$i;?>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" name="rules[]" class="custom-control-input checkbox-child" id="roleid-<?php echo htmlentities($vo['id']); ?>-<?php echo htmlentities($voo['id']); ?>-<?php echo htmlentities($vooo['id']); ?>" dataid="id-<?php echo htmlentities($vo['id']); ?>-<?php echo htmlentities($voo['id']); ?>-<?php echo htmlentities($vooo['id']); ?>" value="<?php echo htmlentities($vooo['id']); ?>" <?php if($vooo['checked'] == 'true'): ?>checked<?php endif; ?>>
                                            <label class="custom-control-label" for="roleid-<?php echo htmlentities($vo['id']); ?>-<?php echo htmlentities($voo['id']); ?>-<?php echo htmlentities($vooo['id']); ?>"><?php echo htmlentities($vooo['title']); ?></label>
                                        </div>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                <?php endif; ?>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <button class="btn btn-label btn-primary" onclick="data()"><label><i class="mdi mdi-checkbox-marked-circle-outline"></i></label> 确认提交</button>
                    </form>

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



<script>
    $(function(){
        //动态选择框，上下级选中状态变化
        $('input.checkbox-parent').on('change', function(){
            var dataid = $(this).attr("dataid");
            $('input[dataid^=' + dataid + '-]').prop('checked', $(this).is(':checked'));
        });
        $('input.checkbox-child').on('change', function(){
            var dataid = $(this).attr("dataid");
            dataid = dataid.substring(0, dataid.lastIndexOf("-"));
            var parent = $('input[dataid=' + dataid + ']');
            if($(this).is(':checked')){
                parent.prop('checked', true);
                //循环到顶级
                while(dataid.lastIndexOf("-") != 2){
                    dataid = dataid.substring(0, dataid.lastIndexOf("-"));
                    parent = $('input[dataid=' + dataid + ']');
                    parent.prop('checked', true);
                }
            }else{
                //父级
                if($('input[dataid^=' + dataid + '-]:checked').length == 0){
                    parent.prop('checked', false);
                    //循环到顶级
                    while(dataid.lastIndexOf("-") != 2){
                        dataid = dataid.substring(0, dataid.lastIndexOf("-"));
                        parent = $('input[dataid=' + dataid + ']');
                        if($('input[dataid^=' + dataid + '-]:checked').length == 0){
                            parent.prop('checked', false);
                        }
                    }
                }
            }
        });
    });
    function data() {
        $.ajax({
            //几个参数需要注意一下
            type: "POST",//方法类型
            dataType: "json",//预期服务器返回的数据类型
            url: "/admin/role/auth_submit" ,//url
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
                                    location.reload();
                                }
                            }
                        }
                    });
                    // setTimeout(function() {
                    //     //	parent.document.location.reload();
                    //     parent.document.location.href="<?php echo url('/admin/index'); ?>";
                    // }, 1500);
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
</script>

</body>
</html>