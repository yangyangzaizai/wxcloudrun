<?php /*a:2:{s:63:"D:\phpstudy_pro\WWW\ymyz.cn\app\admin\view\isoftware\index.html";i:1644995942;s:59:"D:\phpstudy_pro\WWW\ymyz.cn\app\admin\view\common\base.html";i:1644930058;}*/ ?>
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
                                        <input type="hidden" name="id" value="0">
                                        <div class="form-group">
                                            <label for="pid">软件分类</label>
                                            <select name="pid" class="form-control selectpicker" id="pid">
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="title" class="col-form-label">软件名称</label>
                                            <input type="text" class="form-control" id="title" name="title" placeholder="请输入软件名称">
                                        </div>
                                        <div class="form-group">
                                            <label for="title" class="col-form-label">版本号</label>
                                            <input type="text" class="form-control" id="versions" name="versions" placeholder="请输入版本号">
                                        </div>
                                        <div class="form-group">
                                            <label for="title" class="col-form-label">公告</label>
                                            <textarea class="form-control" id="notice" name="notice" placeholder="请输入公告"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="title" class="col-form-label">登录方式</label>
                                            <div class="clearfix">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="loginwayOne" name="loginway" class="custom-control-input" value="1" checked>
                                                    <label class="custom-control-label" for="loginwayOne">账号密码</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="loginwayTwo" name="loginway" class="custom-control-input" value="2">
                                                    <label class="custom-control-label" for="loginwayTwo">卡密登录</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="title" class="col-form-label">更新方式</label>
                                            <div class="clearfix">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="updatestatOne" name="updatestat" class="custom-control-input" value="1" checked onclick="divrodio()">
                                                    <label class="custom-control-label" for="updatestatOne">本地MD5更新</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="updatestatTwo" name="updatestat" class="custom-control-input" value="2" onclick="divrodio()">
                                                    <label class="custom-control-label" for="updatestatTwo">远程压缩包更新</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="gxfs" style="display: none;">
                                            <label for="title" class="col-form-label">远程更新url</label>
                                            <input type="text" class="form-control" id="loRangeurl" name="loRangeurl" placeholder="请输入远程更新url">
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

                    <div class="modal fade" id="exampleModalChanges" tabindex="-1" role="dialog" aria-labelledby="exampleModalChangeLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalChangeTitles">发送消息</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body serpsm">
                                    <form onsubmit="return false" action="#!" method="post" id="form2">
                                        <input type="hidden" name="id" value="0">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="thebuckle">解绑扣时</label>
                                                <input type="text" class="form-control" id="thebuckle" name="thebuckle" placeholder="请输入解绑扣时">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="time_mod">扣时模式</label>
                                                <select name="time_mod" class="form-control selectpicker" id="time_mod">
                                                    <option value="1">小时</option>
                                                    <option value="2">周</option>
                                                    <option value="3">月</option>
                                                    <option value="4">年</option>
                                                </select>
                                            </div>
                                            <label for="ryptedPass" class="col-form-label">加密密码</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control w-50" id="ryptedPass" name="ryptedPass" placeholder="请输入加密密码">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button" onclick="ss()">生成</button>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6 m-t-10">
                                                <label for="moremachine">是否开启多机器码</label>
                                                <div class="clearfix m-t-10">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="moremachine1" name="moremachine" class="custom-control-input" value="1" checked>
                                                        <label class="custom-control-label" for="moremachine1">开启</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="moremachine2" name="moremachine" class="custom-control-input" value="2" >
                                                        <label class="custom-control-label" for="moremachine2">不开启</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6 m-t-10">
                                                <label for="setNumber">允许台数</label>
                                                <input type="text" class="form-control" id="setNumber" name="setNumber" placeholder="请输入允许台数">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                                    <button type="button" class="btn btn-primary" onclick="set_submit()">保存</button>
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
<script type="text/javascript" src="/static/admin/js/bootstrap-table/extensions/treegrid/bootstrap-table-treegrid.min.js"></script>
<script type="text/javascript" src="/static/admin/js/zTree_v3/js/jquery.ztree.all.min.js"></script>
<script type="text/javascript" src="/static/admin/js/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="/static/admin/js/bootstrap-select/i18n/defaults-zh_CN.min.js"></script>
<script type="text/javascript" src="/static/admin/js/tong/isoftware.js"></script>


<script>
function divrodio() {
    var show = $("input[name=updatestat]:checked").val();
    if(show == 1){
        document.getElementById("gxfs").style.display="none";//隐藏
    }else if(show == 2) {
        document.getElementById("gxfs").style.display="";//显示
    }
}
function ss() {
    $.ajax({
        url: '/admin/isoftware/sryptedPass',
        type: 'POST',
        dataType: 'json'
    }).done(function(response) {
        $('#ryptedPass').val(response.data);
    });
}
</script>

</body>
</html>