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
    <div class="panel-head" id="add"><strong><span class="icon-key"></span> 添加角色</strong></div>
    <div class="body-content">
        <form method="post" class="form-x" action="">
            <div class="form-group">
                <div class="label">
                    <label>角色名：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" value="" name="role_name" data-validate="required:请输入分类名"/>
                    <div class="tips"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>描述：</label>
                </div>
                <div class="field">
                    <textarea class="input" name="role_desc" style=" height:90px;"></textarea>
                    <div class="tips"></div>
                </div>
            </div>

            <?php if(is_array($role_level)): $i = 0; $__LIST__ = $role_level;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="form-group">
                    <div class="label">
                        <label><?php echo ($vo["name"]); ?>：<input value="<?php echo ($vo["title"]); ?>" style="margin-right: 10px;" onclick="chose_check(this);" type="checkbox" /></label>
                    </div>
                    <div class="field" style="padding-top:8px;">
                        <?php if(is_array($vo['child'])): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i; echo ($item["name"]); ?> <input class="level" name="levels[]" value="<?php echo ($vo["title"]); ?>/<?php echo ($item["title"]); ?>" style="margin-right: 28px;" type="checkbox" /><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>

            <div class="form-group">
                <div class="label">
                    <label></label>
                </div>
                <div class="field">
                    <button class="button bg-main icon-check-square-o" type="submit"> 添加</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function chose_check(obj){
        if($(obj).is(':checked')){
            $(obj).parent().parent().next().find('.level').prop('checked',true);
        }else{
            $(obj).parent().parent().next().find('.level').prop('checked',false);
        }
    }
</script>

</body>
</html>