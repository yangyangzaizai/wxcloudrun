<?php /*a:2:{s:59:"D:\phpstudy_pro\WWW\ymyz.cn\app\admin\view\carlb\index.html";i:1644802971;s:59:"D:\phpstudy_pro\WWW\ymyz.cn\app\admin\view\common\base.html";i:1644930058;}*/ ?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>角色管理</title>
    <link rel="icon" href="favicon.ico" type="image/ico">
    <meta name="keywords" content="<?php echo basicConfiguration('keywords'); ?>">
    <meta name="description" content="<?php echo basicConfiguration('description'); ?>">
    <meta name="author" content="yinqi">
    <link href="/static/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/admin/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="/static/admin/css/style.min.css" rel="stylesheet">
    
<link href="/static/admin/js/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
<link href="/static/admin/js/jquery-confirm/jquery-confirm.min.css" rel="stylesheet">
<link href="/static/admin/js/zTree_v3/css/materialDesignStyle/materialdesign.css" rel="stylesheet">
<link href="/static/admin/js/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
<link href="/static/admin/js/jquery-toolbar/jquery-toolbar.min.css" rel="stylesheet">

</head>

<body>
<!-- 正文开始 -->

<div class="container-fluid p-t-15">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <div id="toolbar2" class="toolbar-btn-action">
                        <button type="button" class="btn btn-primary m-r-5" data-toggle="modal" data-target="#exampleModalChange" data-whatever="0">新增</button>
                        <button type="button" class="btn btn-primary m-r-5" onclick="test()">删除</button>
                    </div>

                    <table id="tb_departments"></table>

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
                                    <form onsubmit="return false" action="#!" method="post" id="form1">
                                        <input type="hidden" name="id" value="0">
                                        <div class="form-group">
                                            <label for="pid">所属软件</label>
                                            <select name="pid" class="form-control selectpicker" id="pid">
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="title" class="col-form-label">卡类</label>
                                            <div class="clearfix">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="cardtypeOne" name="cardtype" class="custom-control-input" value="1" checked>
                                                    <label class="custom-control-label" for="cardtypeOne">小时卡</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="cardtypeTwo" name="cardtype" class="custom-control-input" value="2">
                                                    <label class="custom-control-label" for="cardtypeTwo">周卡</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="cardtypethree" name="cardtype" class="custom-control-input" value="3">
                                                    <label class="custom-control-label" for="cardtypethree">月卡</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="cardtypefour" name="cardtype" class="custom-control-input" value="4">
                                                    <label class="custom-control-label" for="cardtypefour">年卡</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="cardtypefive" name="cardtype" class="custom-control-input" value="5">
                                                    <label class="custom-control-label" for="cardtypefive">终身卡</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="price" class="col-form-label">价格</label>
                                            <input type="text" class="form-control" id="price" name="price" placeholder="请输入价格">
                                        </div>
                                        <div class="form-group">
                                            <label for="comment" class="col-form-label">备注</label>
                                            <textarea class="form-control" id="comment" name="comment" placeholder="请输入备注"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                                    <button type="button" class="btn btn-primary" onclick="post_submit()">保存</button>
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
<script type="text/javascript" src="/static/admin/js/bootstrap-table/extensions/treegrid/bootstrap-table-treegrid.min.js"></script>
<script type="text/javascript" src="/static/admin/js/zTree_v3/js/jquery.ztree.all.min.js"></script>
<script type="text/javascript" src="/static/admin/js/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="/static/admin/js/bootstrap-select/i18n/defaults-zh_CN.min.js"></script>
<script type="text/javascript" src="/static/admin/js/jquery-toolbar/jquery.toolbar.min.js"></script>
<script type="text/javascript" src="/static/admin/js/tong/carlb.js"></script>


<script>
    $(document).ready(function(){
        $('#top-toolbar').toolbar({
            content: '#toolbar-options',
            position: 'top',
            style: 'default'
        });
        $('#left-toolbar').toolbar({
            content: '#toolbar-options',
            position: 'left',
            style: 'primary'
        });
        $('#bottom-toolbar').toolbar({
            content: '#toolbar-options',
            position: 'bottom',
            style: 'danger'
        });
        $('#right-toolbar').toolbar({
            content: '#toolbar-options',
            position: 'right',
            style: 'warning'
        });
        $('#click-toolbar').toolbar({
            content: '#toolbar-options',
            style: 'info',
            event: 'click'
        });
        $('#flip-toolbar').toolbar({
            content: '#toolbar-options',
            style: 'success',
            animation: 'flip',
        });
        $('#grow-toolbar').toolbar({
            content: '#toolbar-options',
            style: 'purple',
            animation: 'grow',
        });
        $('#flyin-toolbar').toolbar({
            content: '#toolbar-options',
            style: 'secondary',
            animation: 'flyin',
        });
        $('#bounce-toolbar').toolbar({
            content: '#toolbar-options',
            style: 'dark',
            animation: 'bounce',
        });
    });
</script>

</body>
</html>