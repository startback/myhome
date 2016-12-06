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



<script charset="utf-8" src="/myhome/Public/Ueditor/ueditor.config.js"></script>
<script charset="utf-8" src="/myhome/Public/Ueditor/ueditor.all.min.js"></script>
<script charset="utf-8" src="/myhome/Public/Ueditor/lang/zh-cn/zh-cn.js"></script>

<body>
<div class="panel admin-panel">
    <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span> 发表文章</strong></div>
    <div class="body-content">
        <form method="post" class="form-x" action="" enctype="multipart/form-data">
            <div class="form-group">
                <div class="label">
                    <label>标题：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" value="" name="article_title" data-validate="required:请输入标题"/>
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
                        <?php if(is_array($types)): $i = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["type_id"]); ?>"><?php echo ($vo["type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <div class="tips"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>图片：</label>
                </div>
                <div class="field">
                    <div style="width:90px;height: 90px;margin-right: 35px;float: left;position: relative;">
                        <img src="/myhome/Public/Myadmin/images/add.png" style="width: 100%;height: 100%;" />
                        <input type="file" onchange="change_img(this)" style="width:90px;height: 90px;opacity: 0;position: absolute;top:0;left: 0;" name="image[]">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>描述：</label>
                </div>
                <div class="field">
                    <textarea class="input" name="article_desc" style=" height:90px;"></textarea>
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>内容：</label>
                </div>
                <div class="field">
                    <input name="article_content" id="article_content" type="hidden" value=""/>
                    <script id="editor" type="text/plain" style="height:450px;width:100%;"></script>
                    <div class="tips"></div>
                </div>
            </div>

            <div class="clear"></div>
            <div class="form-group">
                <div class="label">
                    <label>标签：</label>
                </div>
                <div class="field">
                    <input type="text" class="input" name="article_tag" value=""/>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>展示：</label>
                </div>
                <div class="field" style="padding-top:8px;">
                    否 <input name="is_show" value="0" type="radio"/>
                    是 <input name="is_show" checked value="1" type="radio"/>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>置顶：</label>
                </div>
                <div class="field" style="padding-top:8px;">
                    否 <input name="is_top" checked value="0" type="radio"/>
                    是 <input name="is_top" value="1" type="radio"/>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>热门：</label>
                </div>
                <div class="field" style="padding-top:8px;">
                    否 <input name="is_hot" checked value="0" type="radio"/>
                    是 <input name="is_hot" value="1" type="radio"/>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>推荐：</label>
                </div>
                <div class="field" style="padding-top:8px;">
                    否 <input name="is_recommend" checked value="0" type="radio"/>
                    是 <input name="is_recommend" value="1" type="radio"/>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>排序：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" name="top_order" value="0" data-validate="number:排序必须为数字"/>
                    <div class="tips"></div>
                </div>
            </div>


            <div class="form-group">
                <div class="label">
                    <label></label>
                </div>
                <div class="field">
                    <button class="button bg-main icon-check-square-o" onclick="return set_article_content();" type="submit"> 发布</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    var ue = UE.getEditor('editor');

    function set_article_content(){
        var html_str = UE.getEditor('editor').getContent();
        $('#article_content').val(html_str);

        return true;
    }


    function change_img(obj){
        var files = obj.files;
        if (!files.length || !window.FileReader) return;
        if (/^image/.test( files[0].type)){
            var reader = new FileReader();
            reader.readAsDataURL(files[0]);
            reader.onloadend = function(){
                $(obj).siblings('img').attr('src',this.result);
            }
        }
    }

</script>

</body>
</html>