<?php /*a:2:{s:58:"D:\phpstudy_pro\WWW\ymyz.cn\app\admin\view\auth\index.html";i:1644803315;s:59:"D:\phpstudy_pro\WWW\ymyz.cn\app\admin\view\common\base.html";i:1644930058;}*/ ?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>权限管理</title>
    <link rel="icon" href="favicon.ico" type="image/ico">
    <meta name="keywords" content="<?php echo basicConfiguration('keywords'); ?>">
    <meta name="description" content="<?php echo basicConfiguration('description'); ?>">
    <meta name="author" content="yinqi">
    <link href="/static/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/admin/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="/static/admin/css/style.min.css" rel="stylesheet">
    
<link href="/static/admin/js/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
<link href="/static/admin/js/jquery-confirm/jquery-confirm.min.css" rel="stylesheet">
<link href="/static/admin/js/fontIconPicker/css/jquery.fonticonpicker.min.css" rel="stylesheet">
<link href="/static/admin/js/fontIconPicker/themes/bootstrap-theme/jquery.fonticonpicker.bootstrap.min.css" rel="stylesheet" />

</head>

<body>
<!-- 正文开始 -->

<div class="container-fluid p-t-15">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <div id="toolbar2" class="toolbar-btn-action">
                        <button type="button" class="btn btn-primary m-r-5" data-toggle="modal" data-target="#exampleModalChange" data-whatever="0" data-zijie="0">新增</button>
                        <button type="button" class="btn btn-primary m-r-5" onclick="test()">删除</button>
                    </div>

                    <table class="tree-table"></table>

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
                                            <label for="pid">上级规则</label>
                                            <select name="pid" class="form-control" id="pid">
                                                <option value="0">作为顶级规则</option>
                                                <?php $_result=set_recursion(getMenuData());if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                                <option value="<?php echo htmlentities($v['id']); ?>"><?php echo htmlentities($v['title']); ?> </option>
                                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="title" class="col-form-label">规则名称</label>
                                            <input type="text" class="form-control" id="title" name="title" placeholder="请输入规则名称">
                                        </div>
                                        <div class="form-group">
                                            <label for="title" class="col-form-label">规则类型</label>
                                            <div class="clearfix">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="statusTwo" name="ismenu" class="custom-control-input" value="0" checked>
                                                    <label class="custom-control-label" for="statusTwo">链接</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="statusOne" name="ismenu" class="custom-control-input" value="1">
                                                    <label class="custom-control-label" for="statusOne">按钮</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="title" class="col-form-label">规则URL</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="请输入规则URL">
                                        </div>
                                        <div class="form-group">
                                            <label for="title" class="col-form-label">菜单图标</label>
                                            <div class="clearfix">
                                                <input type="text" id="icon-example" name="icon" />
                                                <span id="show-mdi"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="title" class="col-form-label">排序权重</label>
                                            <input type="number" class="form-control" id="weight" name="weight" placeholder="请输入排序权重">
                                        </div>
                                        <div class="form-group">
                                            <label for="title" class="col-form-label">导航菜单</label>
                                            <div class="clearfix">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="isnavTwo" name="isnav" class="custom-control-input" value="1">
                                                    <label class="custom-control-label" for="isnavTwo">是</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="isnavOne" name="isnav" class="custom-control-input" value="0" checked>
                                                    <label class="custom-control-label" for="isnavOne">否</label>
                                                </div>
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

<script type="text/javascript" src="/static/admin/js/fontIconPicker/jquery.fonticonpicker.min.js"></script>
<script type="text/javascript" src="/static/admin/js/tong/auth.js"></script>


<script>
    jQuery(document).ready(function($) {
        var font_element = $('#icon-example').fontIconPicker({
            theme: 'fip-bootstrap'
        });

        $.ajax({
            url: '/static/admin/js/fontIconPicker/fontjson/materialdesignicons_v4.json',
            type: 'GET',
            dataType: 'json'
        }).done(function(response) {

            var fontello_json_icons = [];

            $.each(response.glyphs, function(i, v) {
                fontello_json_icons.push( v.css );
            });

            font_element.setIcons(fontello_json_icons);
        }).fail(function() {
            console.error('字体图标配置加载失败');
        });

        $(document).on('change', '#icon-example', function(){
            //$('#show-mdi').html($(this).val());
        });

    });
</script>

</body>
</html>