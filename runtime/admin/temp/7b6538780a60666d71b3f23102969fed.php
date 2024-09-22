<?php /*a:2:{s:62:"D:\phpstudy_pro\WWW\ymyz.cn\app\admin\view\camilovo\index.html";i:1644939064;s:59:"D:\phpstudy_pro\WWW\ymyz.cn\app\admin\view\common\base.html";i:1644930058;}*/ ?>
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
                                        <input type="hidden" name="id" id="id" value="0">
                                        <div class="form-group">
                                            <label for="pid">所属软件</label>
                                            <select name="pid" class="form-control selectpicker" onchange="selectApar()" id="pid">
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="pid">所属卡类</label>
                                            <select name="card_id" class="form-control selectpicker" id="card_id">
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="dop" class="col-form-label">卡头</label>
                                            <input type="text" class="form-control" id="dop" name="dop" placeholder="请输入卡头">
                                        </div>
                                        <div class="form-group">
                                            <label for="duration" class="col-form-label">时长</label>
                                            <input type="text" class="form-control" id="duration" name="duration" placeholder="请输入时长">
                                            <small class="help-block">方式：<code>如：输入1，选择了小时卡，那么生成的卡即为一小时！</code></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="number" class="col-form-label">生成个数</label>
                                            <input type="text" class="form-control" id="number" name="number" placeholder="请输入生成个数">
                                        </div>
                                        <div class="form-group">
                                            <label for="changdus" class="col-form-label">卡密长度</label>
                                            <input type="text" class="form-control" id="changdus" name="changdus" placeholder="请输入卡密长度">
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

<script type="text/javascript" src="/static/admin/js/bootstrap-table/extensions/export/bootstrap-table-export.min.js"></script>
<script type="text/javascript" src="/static/admin/js/bootstrap-table/extensions/export/tableExport.js"></script>
<script type="text/javascript" src="/static/admin/js/tong/download.js"></script>
<script type="text/javascript" src="/static/admin/js/tong/camilovo.js"></script>


<script>
    function selectApar() {
        var mm = $("#id").val();
        var sex = $("#pid").val();
        console.log(mm)
        $.ajax({
            //timeout: 3000,
            //async: false,
            type: "POST",
            url: "/admin/camilovo/cardtware",
            data : {
                "pid" : sex
            },
            dataType: "json",
        }).done(function(datas) {
            var datas = datas.data;
            var shuju = '';
            for (var i = 0; i < datas.length; i++) {
                shuju += '<option value="'+ datas[i].id +'">'+ datas[i].title +'</option>'
                //$('#pid').append('<option value="'+ datas[i].id +'">'+ datas[i].title +'</option>');
            }
            $("#card_id").html(shuju);//添加
            $("#card_id").selectpicker('refresh');//刷新
        });
    }
</script>

</body>
</html>