<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>个人博客</title>
    <meta name="Keywords" content="个人博客,个人站点,个人私事"/>
    <meta name="description" content=""/>
    <link type="text/css" rel="stylesheet" href="/Public/Home/css/public.css"/>
    <link type="text/css" rel="stylesheet" href="/Public/Home/css/index.css"/>
</head>
<link type="text/css" rel="stylesheet" href="/Public/Home/css/article_list.css"/>

<body>


<!--top start-->
<div class="top">
    <div class="top_con">
        <div class="top_con_left"><a href="#"><img src="/Public/Home/images/logo.jpg" width="300" height="150"
                                                   alt="博客" title="个人博客"></a></div>
        <div class="top_con_right">
            <p class="pinf">生命有限，梦想无限</p>
            <p class="jiaz">因为有梦，生命不熄，精彩不止</p>
            <p class="bulang">针锋</p>
            <b><img src="/Public/Home/images/top.gif" height="130" alt="刘亦菲相册" title="刘亦菲相册"/></b>
        </div>
    </div>
</div>
<!--top end-->

<!--con start-->
<div class="con">

    
    <!--nav start-->
    <div class="nav">
        <div class="nav_t"></div>
        <div class="nav_c">
            <ul>
                <li><a href="" <?php if($article_type == 'index'): ?>class="on"<?php endif; ?> >首页</a></li>
                <?php if(is_array($article_nav)): $i = 0; $__LIST__ = $article_nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a <?php if($article_type == $vo['type_id']): ?>class="on"<?php endif; ?> href="/article/article_list/type/<?php echo ($vo["type_id"]); ?>"><?php echo ($vo["type_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                <li><a href="/index/time">追踪时光</a></li>
            </ul>
        </div>
    </div>
    <!--nav end-->

    <!--articla start-->
    <div class="article_left">
        <div class="article_tuiJ">
            <h3><a href="#">首页</a>&gt;&gt;<a href="#"><?php echo ($cur_type["type_name"]); ?></a></h3>
            <p><?php echo ($cur_type["type_desc"]); ?></p>
        </div>

        <?php if($article_list): if(is_array($article_list)): $i = 0; $__LIST__ = $article_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="article_tit">
                    <div class="article_tit_pic"><a href="#"><img <?php if($vo['article_img']): ?>src="<?php echo ($vo["article_img"]); ?>"<?php else: ?> src="/Public/Home/images/01.jpg"<?php endif; ?> /></a></div>
                    <div class="article_tit_txt">
                        <h4><a href="#"><?php echo ($vo["article_title"]); ?></a></h4>
                        <p><a href="javascript:voide(0)" class="writer"><?php echo ($vo["admin_account"]); ?></a><a href="#" class="Clas"><?php echo ($types[$vo['type_id']]['type_name']); ?></a><a
                                href="javascript:voide(0)" class="time"><?php echo ($vo["article_time"]); ?></a><a href="javascript:voide(0)"
                                                                                                 class="opine">评论（<?php echo ($vo["comment_num"]); ?>）</a><a
                                href="javascript:voide(0)" class="look">浏览（<?php echo ($vo["read_num"]); ?>）</a></p>
                        <p class="article_con">
                            <?php echo ($vo["article_desc"]); ?>
                        </p>
                        <a href="/article/article_detail/article_id/<?php echo ($vo["article_id"]); ?>/type/<?php echo ($cur_type["type_id"]); ?>" class="readAll">阅读全文</a>
                    </div>
                    <div style="clear:both;"></div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
            <div class="Index">
                <ul>
                    <?php echo ($page_info); ?>
                </ul>
            </div>
            <?php else: ?>
            <div class="article_tit" style="text-align: center;">
                没有数据
            </div><?php endif; ?>


    </div>
    <!--article end-->

    <div class="article_right">
    <div class="three_news">
        <p><span class="mous_on">点击排行</span><span class="new_arc">最新文章</span><span>作者推荐</span></p>
        <div class="news_tit">
            <ul>
                <?php if(is_array($right_list["read"])): $i = 0; $__LIST__ = $right_list["read"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><i></i><a href="/article/article_detail/article_id/<?php echo ($vo["article_id"]); ?>"><?php echo ($vo["article_title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <ul>
                <?php if(is_array($right_list["new"])): $i = 0; $__LIST__ = $right_list["new"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><i></i><a href="/article/article_detail/article_id/<?php echo ($vo["article_id"]); ?>"><?php echo ($vo["article_title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <ul>
                <?php if(is_array($right_list["top"])): $i = 0; $__LIST__ = $right_list["top"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><i></i><a href="/article/article_detail/article_id/<?php echo ($vo["article_id"]); ?>"><?php echo ($vo["article_title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
</div>

    <div style="clear:both;"></div>
</div>
<div class="return_top"><a href="javascript:void(0)"></a></div>


<div class="footer">
    <a href="#">个人博客</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://www.miitbeian.gov.cn/" target="_blank" >粤ICP备16030697号-1</a>&nbsp;&nbsp;|&nbsp;&nbsp;网站开发者：针锋
</div>


<!--con end-->


<script type="text/javascript" src="/Public/Home/js/jquery.js"></script>
<script type="text/javascript" src="/Public/Home/js/my.js"></script>
<script type="text/javascript" src="/Public/Home/js/bg.js"></script>

</body>
</html>