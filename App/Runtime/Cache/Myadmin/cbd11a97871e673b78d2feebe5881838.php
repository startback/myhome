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
        <div class="panel-head"><strong class="icon-reorder"> 管理员列表</strong></div>
        <div class="padding border-bottom">
            <ul class="search" style="padding-left:10px;">
                <li><a class="button border-main icon-plus-square-o" href="/myhome/Myadmin/admin/admin_add"> 添加管理员</a>
                </li>
            </ul>
        </div>
        <table class="table table-hover text-center">
            <tr>
                <th width="100" style="text-align:left; padding-left:20px;">#</th>
                <th>帐号</th>
                <th>角色</th>
                <th>别名</th>
                <th>电话</th>
                <th>性别</th>
                <th>注册时间</th>
                <th width="310">操作</th>
            </tr>

            <?php if($admin): if(is_array($admin)): $i = 0; $__LIST__ = $admin;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td style="text-align:left; padding-left:20px;"><input type="checkbox" name="id[]" value="<?php echo ($vo["admin_id"]); ?>"/></td>
                        <td><?php echo ($vo["admin_account"]); ?></td>
                        <td><?php echo ($roles[$vo['admin_role_id']]); ?></td>
                        <td><?php echo ($vo["admin_name"]); ?></td>
                        <td><?php echo ($vo["admin_phone"]); ?></td>
                        <td><?php echo ($sex_state[$vo['admin_sex']]); ?></td>
                        <td><?php echo ($vo["admin_register_time"]); ?></td>
                        <td>
                            <div class="button-group">
                                <a class="button border-main" href="/myhome/Myadmin/admin/admin_edit/id/<?php echo ($vo["admin_id"]); ?>"><span class="icon-edit"></span> 修改</a>
                                <a class="button border-red" href="javascript:void(0)" onclick="del(<?php echo ($vo["admin_id"]); ?>)">
                                    <span class="icon-trash-o"></span> 删除
                                </a>
                            </div>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                <tr>
                    <td style="text-align:left; padding:19px 0;padding-left:20px;">
                        <input type="checkbox" id="checkall"/>全选/反选
                    </td>
                    <td colspan="7" style="text-align:left;padding-left:20px;">
                        <a href="javascript:void(0)" class="button border-red icon-trash-o" style="padding:5px 15px;" onclick="DelSelect()"> 删除</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="8">
                        <div class="pagelist"><?php echo ($page); ?></div>
                    </td>
                </tr>

                <?php else: ?>
                <tr>
                    <td colspan="8" style="height: 80px;line-height: 80px;font-size: 20px;">
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
                url: '/myhome/Myadmin/admin/admin_del',
                data: {ids: id},
                dataType: 'text',
                success: function(data){
                    if(data == 1){
                        alert('删除成功');
                        location.reload();
                    }else if(data == 2){
                        alert('无权删除超级管理员');
                    }else{
                        alert('删除失败');
                    }
                }
            });
        }
    }

    //反选
    $("#checkall").click(function () {
        $("input[name='id[]']").each(function () {
            if (this.checked) {
                this.checked = false;
            }
            else {
                this.checked = true;
            }
        });
    })

    //批量删除
    function DelSelect() {
        var Checkbox = false;
        var ids = '';
        $("input[name='id[]']").each(function () {
            if (this.checked == true) {
                Checkbox = true;
                if(ids){
                    ids += ','+this.value;
                }else{
                    ids = this.value;
                }
            }
        });
        if (Checkbox) {
            var t = confirm("您确认要删除选中的内容吗？");
            if (t == false) return false;

            $.ajax({
                type: 'post',
                url: '/myhome/Myadmin/admin/admin_del',
                data: {ids: ids},
                dataType: 'text',
                success: function(data){
                    if(data == 1){
                        alert('删除成功');
                        location.reload();
                    }else if(data == 2){
                        alert('无权删除超级管理员');
                    }else{
                        alert('删除失败');
                    }
                }
            });
        } else {
            alert("请选择您要删除的内容!");
            return false;
        }
    }

</script>
</body>
</html>