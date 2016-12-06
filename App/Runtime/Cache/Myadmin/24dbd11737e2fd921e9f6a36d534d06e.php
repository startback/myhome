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

<div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 相册列表</strong>
    </div>
    <div class="padding border-bottom">
        <form action="" method="get">
            <ul class="search" style="padding-left:10px;">
                <li>展示
                    <select name="is_show" class="input" style="width:60px; line-height:17px; display:inline-block">
                        <option value="-1">选择</option>
                        <option <?php if($search_state['is_show'] == 1): ?>selected='selected'<?php endif; ?> value="1">是</option>
                        <option <?php if($search_state['is_show'] == 0): ?>selected='selected'<?php endif; ?> value="0">否</option>
                    </select>
                    &nbsp;&nbsp;
                    推荐
                    <select name="is_recommend" class="input" style="width:60px; line-height:17px;display:inline-block">
                        <option value="-1">选择</option>
                        <option <?php if($search_state['is_recommend'] == 1): ?>selected='selected'<?php endif; ?> value="1">是</option>
                        <option <?php if($search_state['is_recommend'] == 0): ?>selected='selected'<?php endif; ?> value="0">否</option>
                    </select>
                    &nbsp;&nbsp;
                    置顶
                    <select name="is_top" class="input" style="width:60px; line-height:17px;display:inline-block">
                        <option value="-1">选择</option>
                        <option <?php if($search_state['is_top'] == 1): ?>selected='selected'<?php endif; ?> value="1">是</option>
                        <option <?php if($search_state['is_top'] == 0): ?>selected='selected'<?php endif; ?> value="0">否</option>
                    </select>
                    &nbsp;&nbsp;
                    热门
                    <select name="is_hot" class="input" style="width:60px; line-height:17px;display:inline-block">
                        <option value="-1">选择</option>
                        <option <?php if($search_state['is_hot'] == 1): ?>selected='selected'<?php endif; ?> value="1">是</option>
                        <option <?php if($search_state['is_hot'] == 0): ?>selected='selected'<?php endif; ?> value="0">否</option>
                    </select>
                    &nbsp;&nbsp;
                    类别
                    <select name="type_id" class="input" style="width:120px; line-height:17px;display:inline-block">
                        <option value="-1">选择</option>
                        <?php if(is_array($types)): $i = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option <?php if($search_state['type_id'] == $vo['type_id']): ?>selected='selected'<?php endif; ?> value="<?php echo ($vo["type_id"]); ?>"><?php echo ($vo["type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </li>

                <li>
                    <input type="text" placeholder="请输入标题关键字" value="<?php echo ($search_state["keywords"]); ?>" name="keywords" class="input"
                           style="width:250px; line-height:17px;display:inline-block"/>
                    <input type="submit" class="button border-main icon-search" value="搜索"/>
                </li>
            </ul>
        </form>
    </div>
    <table class="table table-hover text-center">
        <tr>
            <th width="100" style="text-align:left; padding-left:20px;">ID</th>
            <th>名字</th>
            <th>类别</th>
            <th>缩略图</th>
            <th>展示</th>
            <th>置顶</th>
            <th>热门</th>
            <th>推荐</th>
            <th>作者</th>
            <th>阅读</th>
            <th>排序</th>
            <th>时间</th>
            <th width="310">操作</th>
        </tr>

        <?php if($album_list): if(is_array($album_list)): $i = 0; $__LIST__ = $album_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td style="text-align:left; padding-left:20px;"><input type="checkbox" name="id[]" value="<?php echo ($vo["album_id"]); ?>"/><?php echo ($vo["album_id"]); ?></td>
                    <td><?php echo ($vo["album_name"]); ?></td>
                    <td><?php echo ($types[$vo['type_id']]['type_name']); ?></td>
                    <td><img src="/myhome<?php echo ($vo["album_thumb_url"]); ?>" width="35" height="35" /></td>
                    <td><?php echo ($state[$vo['is_show']]); ?></td>
                    <td><?php echo ($state[$vo['is_top']]); ?></td>
                    <td><?php echo ($state[$vo['is_hot']]); ?></td>
                    <td><?php echo ($state[$vo['is_recommend']]); ?></td>
                    <td><?php echo ($vo["admin_account"]); ?></td>
                    <td><?php echo ($vo["read_num"]); ?></td>
                    <td><?php echo ($vo["top_order"]); ?></td>
                    <td><?php echo ($vo["album_time"]); ?></td>
                    <td>
                        <div class="button-group">
                            <a class="button border-main" href="/myhome/Myadmin/album/album_edit/id/<?php echo ($vo["album_id"]); ?>"><span class="icon-edit"></span> 修改</a>
                            <a class="button border-red" href="javascript:void(0)" onclick="del(<?php echo ($vo["album_id"]); ?>)">
                                <span class="icon-trash-o"></span> 删除
                            </a>
                        </div>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            <tr>
                <td style="text-align:left; padding:19px 0;padding-left:20px;"><input type="checkbox" id="checkall"/>
                    全选
                </td>
                <td colspan="12" style="text-align:left;padding-left:20px;">
                    <a href="javascript:void(0)" class="button border-red icon-trash-o" style="padding:5px 15px;"
                       onclick="DelSelect()"> 删除</a>
                </td>
            </tr>
            <tr>
                <td colspan="13">
                    <div class="pagelist"><?php echo ($page_info); ?></div>
                </td>
            </tr>
            <?php else: ?>
            <tr>
                <td colspan="13" style="height: 80px;line-height: 80px;font-size: 20px;">
                    没有数据
                </td>
            </tr><?php endif; ?>
    </table>
</div>

<script type="text/javascript">

    //单个删除
    function del(id) {
        if(confirm("您确定要删除吗?")) {
            $.ajax({
                type: 'post',
                url: '/myhome/Myadmin/album/album_del',
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

    //全选
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
                url: '/myhome/Myadmin/album/album_del',
                data: {ids: ids},
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
        } else {
            alert("请选择您要删除的内容!");
            return false;
        }
    }

</script>
</body>
</html>