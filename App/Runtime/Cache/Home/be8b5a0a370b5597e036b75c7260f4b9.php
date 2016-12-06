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
        <h2>SEO技术的发展历程</h2>
        <p class="writer">发布时间：2015-5-15<i></i>编辑：<a href="#">步浪</a><i></i>阅读(1523)</p>
        <p class="article_all">
            SEO技术并不是简单的几个建议，而是一项需要足够耐心和细致的脑力劳动。大体上，SEO优化主要分为8小步:
            1、关键词分析（也叫关键词定位）
            这是进行SEO优化最重要的一环，关键词分析包括：关键词关注量分析、竞争对手分析、关键词与网站相关性分析、关键词布置、关键词排名预测。
            2、网站架构分析
            网站结构符合搜索引擎的爬虫喜好则有利于SEO优化。网站架构分析包括：剔除网站架构不良设计、实现树状目录结构、网站导航与链接优化。
            3、网站目录和页面优化
            SEO不止是让网站首页在搜索引擎有好的排名，更重要的是让网站的每个页面都带来流量。
            4、内容发布和链接布置
            搜索引擎喜欢有规律的网站内容更新，所以合理安排网站内容发布日程是SEO优化的重要技巧之一。链接布置则把整个网站有机地串联起来，让搜索引擎明白每个网页的重要性和关键词，实施的参考是第一点的关键词布置。友情链接战役也是这个时候展开。
            5、与搜索引擎对话
            向各大搜索引擎登陆入口提交尚未收录站点。在搜索引擎看SEO的效果，通过site:站长们的域名，知道站点的收录和更新情况。通过domain:站长们的域名或者link:站长们的域名，知道站点的反向链接情况。更好的实现与搜索引擎对话，建议采用Google网站管理员工具。
        </p>
        <p class="article_two_tit">
            上一篇：<a href="#">想要有一个自己的博客吗？</a><br/>
            下一篇：<a href="#">我的未来不是梦</a>
        </p>

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