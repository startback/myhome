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
    <div class="panel-head" id="add"><strong><span class="icon-key"></span> 修改管理员</strong></div>
    <div class="body-content">
        <form method="post" class="form-x" action="">
            <input type="hidden" name="admin_id" value="<?php echo ($admin_info["admin_id"]); ?>" />

            <div class="form-group">
                <div class="label">
                    <label>帐号：</label>
                </div>
                <div class="field">
                    <input type="text" disabled class="input w50" value="<?php echo ($admin_info["admin_account"]); ?>" name="admin_account" />
                    <div class="tips"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>别名：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" value="<?php echo ($admin_info["admin_name"]); ?>" name="admin_name" />
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>性别：</label>
                </div>
                <div class="field" style="padding-top:8px;">
                    <?php if(is_array($sex_state)): foreach($sex_state as $key=>$vo): echo ($vo); ?>&nbsp;<input name="admin_sex" <?php if($admin_info['admin_sex'] == $key): ?>checked<?php endif; ?> value="<?php echo ($key); ?>" type="radio"/>&nbsp;&nbsp;&nbsp;<?php endforeach; endif; ?>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>角色：</label>
                </div>
                <div class="field">
                    <select name="admin_role_id" class="input w50">
                        <?php if(is_array($roles)): foreach($roles as $key=>$vo): ?><option <?php if($admin_info['admin_role_id'] == $key): ?>selected<?php endif; ?> value="<?php echo ($key); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; ?>
                    </select>
                    <div class="tips"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>电话：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" value="<?php echo ($admin_info["admin_phone"]); ?>" name="admin_phone" />
                    <div class="tips"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>邮箱：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" value="<?php echo ($admin_info["admin_email"]); ?>" name="admin_email" />
                    <div class="tips"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>生日：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" value="<?php echo ($admin_info["admin_birthday"]); ?>" name="admin_birthday" />
                    <div class="tips"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>签名：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" value="<?php echo ($admin_info["admin_tag"]); ?>" name="admin_tag" />
                    <div class="tips"></div>
                </div>
            </div>



            <div class="form-group">
                <div class="label">
                    <label></label>
                </div>
                <div class="field">
                    <button class="button bg-main icon-check-square-o" type="submit"> 修改</button>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>