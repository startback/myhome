<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="renderer" content="webkit">
    <title></title>
    <link rel="stylesheet" href="/myhome/Public/Myadmin/css/pintuer.css">
    <link rel="stylesheet" href="/myhome/Public/Myadmin/css/admin.css">
    <script src="/myhome/Public/Myadmin/js/jquery.js"></script>
    <script src="/myhome/Public/Myadmin/js/pintuer.js"></script>
</head>



<body>
<form method="post" action="" id="listform">
    <div class="panel admin-panel">
        <div class="panel-head"><strong class="icon-reorder"> 角色列表</strong></div>
        <div class="padding border-bottom">
            <ul class="search" style="padding-left:10px;">
                <li><a class="button border-main icon-plus-square-o" href="/myhome/Myadmin/admin/role_add"> 增加角色</a>
                </li>
            </ul>
        </div>
        <table class="table table-hover text-center">
            <tr>
                <th>角色ID</th>
                <th>角色名字</th>
                <th>类型描述</th>
                <th width="310">操作</th>
            </tr>

            <?php if($levels): if(is_array($levels)): $i = 0; $__LIST__ = $levels;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($vo["role_id"]); ?></td>
                        <td><?php echo ($vo["role_name"]); ?></td>
                        <td><?php echo ($vo["role_desc"]); ?></td>
                        <td>
                            <div class="button-group">
                                <a class="button border-main" href="/myhome/Myadmin/admin/role_edit/id/<?php echo ($vo["role_id"]); ?>"><span class="icon-edit"></span> 修改</a>
                                <a class="button border-red" href="javascript:void(0)" onclick="del(<?php echo ($vo["role_id"]); ?>)">
                                    <span class="icon-trash-o"></span> 删除
                                </a>
                            </div>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>

                <?php else: ?>
                <tr>
                    <td colspan="4" style="height: 80px;line-height: 80px;font-size: 20px;">
                        没有数据
                    </td>
                </tr><?php endif; ?>

        </table>
    </div>
</form>
<script type="text/javascript">

    //单个删除
    function del(id) {
        if(confirm("您确定要删除吗?")) {
            $.ajax({
                type: 'post',
                url: '/myhome/Myadmin/admin/role_del',
                data: {ids: id},
                dataType: 'text',
                success: function(data){
                    if(data == 1){
                        alert('删除成功');
                        location.reload();
                    }else{
                        alert('删除失败');
                    }
                }
            });
        }
    }

</script>
</body>
</html>