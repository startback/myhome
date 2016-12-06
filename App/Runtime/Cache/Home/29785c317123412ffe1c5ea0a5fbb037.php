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
<link type="text/css" rel="stylesheet" href="/myhome/Public/Home/css/article_list.css"/>

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
    <div class="article_left">
        <div class="article_tuiJ">
            <h3><a href="#">首页</a>&gt;&gt;<a href="#">学海无涯</a></h3>
            <p>学海无涯，什么时候都不要忘了提升自己</p>
        </div>

        <div class="article_tit">
            <div class="article_tit_pic"><a href="#"><img src="/myhome/Public/Home/images/01.jpg"/></a></div>
            <div class="article_tit_txt">
                <h4><a href="#">住在手机里的朋友</a></h4>
                <p><a href="javascript:voide(0)" class="writer">步浪</a><a href="#" class="Clas">学海无涯</a><a
                        href="javascript:voide(0)" class="time">2014-02-19</a><a href="javascript:voide(0)"
                                                                                 class="opine">评论（30）</a><a
                        href="javascript:voide(0)" class="look">浏览（459）</a></p>
                <p class="article_con">
                    通信时代，无论是初次相见还是老友重逢，交换联系方式，常常是彼此交换名片，然后郑重或是出于礼貌用手机记下对方的电话号码。在快节奏的生活里，我们不知不觉中就成为住在别人手机里的朋友。又因某些意外，变成了别人手机里匆忙的过客，这种快餐式的友谊
                    ...通信时代，无论是初次相见还是老友重逢，交换联系方式，常常是彼此交换名片，然后郑重或是出于礼貌用手机记下对方的电话号码。在快节奏的生活里，我们不知不觉中就成为住在别人手机里的朋友。又因某些意外，变成了别人手机里匆忙的过客，这种快餐式的友谊
                    ...通信时代，无论是初次相见还是老友重逢，交换联系方式，常常是彼此交换名片，然后郑重或是出于礼貌用手机记下对方的电话号码。在快节奏的生活里，我们不知不觉中就成为住在别人手机里的朋友。又因某些意外，变成了别人手机里匆忙的过客，这种快餐式的友谊
                    ...</p>
                <a href="/myhome/index/article_detail" class="readAll">阅读全文</a>
            </div>
            <div style="clear:both;"></div>
        </div>

        <div class="Index">
            <ul>
                <li><a href="#" class="Index_on">首页</a></li>
                <li><a href="#">上一页</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">下一页</a></li>
                <li><a href="#">末页</a></li>
                <li><a href="javascript:void(0)">共5页40条</a></li>
            </ul>
        </div>
    </div>
    <!--article end-->

    <div class="article_right">
    <div class="three_news">
        <p><span class="mous_on">点击排行</span><span class="new_arc">最新文章</span><span>作者推荐</span></p>
        <div class="news_tit">
            <ul>
                <li><i></i><a href="#">111住在手机里的朋友</a></li>
                <li><i></i><a href="#">住在手机里的朋友</a></li>
                <li><i></i><a href="#">住在手机里的朋友</a></li>
                <li><i></i><a href="#">住在手机里的朋友</a></li>
                <li><i></i><a href="#">住在手机里的朋友</a></li>
                <li><i></i><a href="#">住在手机里的朋友</a></li>
            </ul>
            <ul>
                <li><i></i><a href="#">222住在手机里的朋友</a></li>
                <li><i></i><a href="#">住在手机里的朋友</a></li>
                <li><i></i><a href="#">住在手机里的朋友</a></li>
                <li><i></i><a href="#">住在手机里的朋友</a></li>
                <li><i></i><a href="#">住在手机里的朋友</a></li>
                <li><i></i><a href="#">住在手机里的朋友</a></li>
            </ul>
            <ul>
                <li><i></i><a href="#">333住在手机里的朋友</a></li>
                <li><i></i><a href="#">住在手机里的朋友</a></li>
                <li><i></i><a href="#">住在手机里的朋友</a></li>
                <li><i></i><a href="#">住在手机里的朋友</a></li>
                <li><i></i><a href="#">住在手机里的朋友</a></li>
                <li><i></i><a href="#">住在手机里的朋友</a></li>
            </ul>
        </div>
    </div>
</div>
<div style="clear:both;"></div>

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