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
    <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span> 增加文章分类</strong></div>
    <div class="body-content">
        <form method="post" class="form-x" action="">
            <div class="form-group">
                <div class="label">
                    <label>分类名：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" value="" name="type_name" data-validate="required:请输入分类名"/>
                    <div class="tips"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>分类描述：</label>
                </div>
                <div class="field">
                    <textarea class="input" name="type_desc" style=" height:90px;"></textarea>
                    <div class="tips"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>是否展示：</label>
                </div>
                <div class="field" style="padding-top:8px;">
                    是 <input  name="is_show" value="1" checked type="radio"/>
                    否 <input  name="is_show" value="0" type="radio"/>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label></label>
                </div>
                <div class="field">
                    <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>