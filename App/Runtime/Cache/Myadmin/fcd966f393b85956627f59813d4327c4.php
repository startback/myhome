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
    <div class="panel-head" id="add"><strong><span class="icon-picture-o"></span> 修改相片</strong></div>
    <div class="body-content">
        <form method="post" class="form-x" action="" enctype="multipart/form-data">
            <input type="hidden" name="album_id" value="<?php echo ($album["album_id"]); ?>" />

            <div class="form-group">
                <div class="label">
                    <label>名字：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" value="<?php echo ($album["album_name"]); ?>" name="album_name" data-validate="required:请输入相片名"/>
                    <div class="tips"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>类别：</label>
                </div>
                <div class="field">
                    <select name="type_id" class="input w50" data-validate="required:请选择类别">
                        <option value="">请选择类别</option>
                        <?php if(is_array($types)): $i = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option <?php if($album['type_id'] == $vo['type_id']): ?>selected='selected'<?php endif; ?> value="<?php echo ($vo["type_id"]); ?>"><?php echo ($vo["type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <div class="tips"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>描述：</label>
                </div>
                <div class="field">
                    <textarea class="input" name="album_desc" style=" height:90px;"><?php echo ($album["album_desc"]); ?></textarea>
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>原图：</label>
                </div>
                <div class="field">
                    <img src="/myhome<?php echo ($album["album_origin_url"]); ?>" style="max-width: 90%;" />
                    <div class="tips"></div>
                </div>
            </div>

            <div class="clear"></div>
            <div class="form-group">
                <div class="label">
                    <label>标签：</label>
                </div>
                <div class="field">
                    <input type="text" class="input" name="album_tag" value="<?php echo ($album["album_tag"]); ?>"/>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>展示：</label>
                </div>
                <div class="field" style="padding-top:8px;">
                    否 <input name="is_show" <?php if($album['is_show'] == 0): ?>checked<?php endif; ?> value="0" type="radio"/>
                    是 <input name="is_show" <?php if($album['is_show'] == 1): ?>checked<?php endif; ?> value="1" type="radio"/>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>置顶：</label>
                </div>
                <div class="field" style="padding-top:8px;">
                    否 <input name="is_top" <?php if($album['is_top'] == 0): ?>checked<?php endif; ?> value="0" type="radio"/>
                    是 <input name="is_top" <?php if($album['is_top'] == 1): ?>checked<?php endif; ?> value="1" type="radio"/>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>热门：</label>
                </div>
                <div class="field" style="padding-top:8px;">
                    否 <input name="is_hot" <?php if($album['is_hot'] == 0): ?>checked<?php endif; ?> value="0" type="radio"/>
                    是 <input name="is_hot" <?php if($album['is_hot'] == 1): ?>checked<?php endif; ?> value="1" type="radio"/>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>推荐：</label>
                </div>
                <div class="field" style="padding-top:8px;">
                    否 <input name="is_recommend" <?php if($album['is_recommend'] == 0): ?>checked<?php endif; ?> value="0" type="radio"/>
                    是 <input name="is_recommend" <?php if($album['is_recommend'] == 1): ?>checked<?php endif; ?> value="1" type="radio"/>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>排序：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" name="top_order" value="<?php echo ($album['top_order']); ?>" data-validate="number:排序必须为数字"/>
                    <div class="tips"></div>
                </div>
            </div>


            <div class="form-group">
                <div class="label">
                    <label></label>
                </div>
                <div class="field">
                    <button class="button bg-main icon-check-square-o"  type="submit"> 修改</button>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>