<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>个人博客</title>
    <meta name="Keywords" content="个人博客,个人站点,个人私事"/>
    <meta name="description" content=""/>
    <link type="text/css" rel="stylesheet" href="/myhome/Public/Home/css/public.css"/>
    <link type="text/css" rel="stylesheet" href="/myhome/Public/Home/css/index.css"/>
</head>
<link type="text/css" rel="stylesheet" href="/myhome/Public/Home/css/article_dedail.css"/>

<body>


<!--top start-->
<div class="top">
    <div class="top_con">
        <div class="top_con_left"><a href="#"><img src="/myhome/Public/Home/images/logo.jpg" width="300" height="150"
                                                   alt="博客" title="个人博客"></a></div>
        <div class="top_con_right">
            <p class="pinf">生命有限，梦想无限</p>
            <p class="jiaz">因为有梦，生命不熄，精彩不止</p>
            <p class="bulang">针锋</p>
            <b><img src="/myhome/Public/Home/images/top.gif" height="130" alt="刘亦菲相册" title="刘亦菲相册"/></b>
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
                <li><a href="/myhome" <?php if($article_type == 'index'): ?>class="on"<?php endif; ?> >首页</a></li>
                <?php if(is_array($article_nav)): $i = 0; $__LIST__ = $article_nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a <?php if($article_type == $vo['type_id']): ?>class="on"<?php endif; ?> href="/myhome/article/article_list/type/<?php echo ($vo["type_id"]); ?>"><?php echo ($vo["type_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                <li><a href="/myhome/index/time">追踪时光</a></li>
            </ul>
        </div>
    </div>
    <!--nav end-->

    <!--articla start-->
    <div class="article_con">
        <h2><?php echo ($article_detail["article_title"]); ?></h2>
        <p class="writer">发布时间：<?php echo ($article_detail["article_time"]); ?><i></i>编辑：<a href="#"><?php echo ($article_detail["admin_account"]); ?></a><i></i>阅读(<?php echo ($article_detail["read_num"]); ?>)</p>
        <p class="article_all"><?php echo ($article_detail["article_content"]); ?>
        </p>


        <!--<p class="article_two_tit">-->
            <!--上一篇：<a href="#">想要有一个自己的博客吗？</a><br/>-->
            <!--下一篇：<a href="#">我的未来不是梦</a>-->
        <!--</p>-->

    </div>
    <!--article end-->

    <div class="article_right">
    <div class="three_news">
        <p><span class="mous_on">点击排行</span><span class="new_arc">最新文章</span><span>作者推荐</span></p>
        <div class="news_tit">
            <ul>
                <?php if(is_array($right_list["read"])): $i = 0; $__LIST__ = $right_list["read"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><i></i><a href="/myhome/article/article_detail/article_id/<?php echo ($vo["article_id"]); ?>"><?php echo ($vo["article_title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <ul>
                <?php if(is_array($right_list["new"])): $i = 0; $__LIST__ = $right_list["new"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><i></i><a href="/myhome/article/article_detail/article_id/<?php echo ($vo["article_id"]); ?>"><?php echo ($vo["article_title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <ul>
                <?php if(is_array($right_list["top"])): $i = 0; $__LIST__ = $right_list["top"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><i></i><a href="/myhome/article/article_detail/article_id/<?php echo ($vo["article_id"]); ?>"><?php echo ($vo["article_title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
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


<script type="text/javascript" src="/myhome/Public/Home/js/jquery.js"></script>
<script type="text/javascript" src="/myhome/Public/Home/js/my.js"></script>
<script type="text/javascript" src="/myhome/Public/Home/js/bg.js"></script>

</body>
</html>