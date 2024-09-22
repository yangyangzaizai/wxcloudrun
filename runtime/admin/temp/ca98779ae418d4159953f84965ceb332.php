<?php /*a:2:{s:59:"D:\phpstudy_pro\WWW\ymyz.cn\app\admin\view\admin\index.html";i:1644803319;s:59:"D:\phpstudy_pro\WWW\ymyz.cn\app\admin\view\common\base.html";i:1644930058;}*/ ?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>用户管理</title>
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
<link href="/static/admin/js/bootstrap-select/bootstrap-select.css" rel="stylesheet">

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
                                            <label for="username" class="col-form-label">登录账号</label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="请输入登录账号">
                                        </div>
                                        <div class="form-group">
                                            <label for="nickname" class="col-form-label">账号昵称</label>
                                            <input type="text" class="form-control" id="nickname" name="nickname" placeholder="请输入账号昵称">
                                        </div>
                                        <div class="form-group">
                                            <label for="newpassword" class="col-form-label">新 密 码</label>
                                            <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="请输入新密码">
                                        </div>
                                        <div class="form-group">
                                            <label for="repassword" class="col-form-label">确认密码</label>
                                            <input type="password" class="form-control" id="repassword" name="repassword" placeholder="请再次输入新密码">
                                        </div>
                                        <div class="form-group">
                                            <label for="comments" class="col-form-label">所属角色</label>
                                            <div class="clearfix">
                                                <select class="form-control selectpicker" name="userEditRoleSel[]" id="userrole" multiple>
                                                    <?php if(is_array($rolelist) || $rolelist instanceof \think\Collection || $rolelist instanceof \think\Paginator): if( count($rolelist)==0 ) : echo "" ;else: foreach($rolelist as $key=>$a): ?>
                                                    <option value="<?php echo htmlentities($a['id']); ?>" ><?php echo htmlentities($a['title']); ?></option>
                                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                                </select>
                                            </div>
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

<script type="text/javascript" src="/static/admin/js/tong/admin.js"></script>


<script>
    // $('#customCheckboxInline2').prop('checked', true)
    // $('#customCheckboxInline1').prop('checked', true)
</script>

</body>
</html>