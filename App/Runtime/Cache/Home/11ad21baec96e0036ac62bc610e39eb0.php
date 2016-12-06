<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>博客首页</title>
    <meta name="Keywords" content="个人博客,个人站点,个人私事"/>
    <meta name="description" content=""/>
    <link type="text/css" rel="stylesheet" href="/myhome/Public/Home/css/public.css"/>
    <link type="text/css" rel="stylesheet" href="/myhome/Public/Home/css/index.css"/>
</head>
<link type="text/css" rel="stylesheet" href="/myhome/Public/Home/css/about.css"/>

<body>


<!--top start-->
<div class="top">
    <div class="top_con">
        <div class="top_con_left"><a href="#"><img src="/myhome/Public/Home/images/logo.jpg" width="300" height="150"
                                                   alt="博客" title="个人博客"></a></div>
        <div class="top_con_right">
            <p class="pinf">生亦有限，学亦有限</p>
            <p class="jiaz">在有限的时间里学有限的东西</p>
            <p class="bulang">----Write:真风</p>
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
                <li><a href="<?php echo U('Index/index');?>" class="on">首页</a></li>
                <li><a href="<?php echo U('Index/article_list');?>">学海无涯</a></li>
                <li><a href="<?php echo U('Index/time');?>">追踪时光</a></li>
                <li><a href="<?php echo U('Index/message');?>">留言版</a></li>
            </ul>
        </div>
    </div>
    <!--nav end-->

    <div class="des">
        <p class="about_tit"><a href="#">首页</a>&nbsp;&nbsp;<b>&gt;&gt;</b>&nbsp;&nbsp;<a href="#">给我留言Massages</a><span>给我留言</span>
        </p>
        <div class="ds-thread" data-thread-key="www.bulang123.cn" data-title="seo" data-url="www.bulang123.cn"></div>
        <!-- 多说评论框 end -->
        <!-- 多说公共JS代码 start (一个网页只需插入一次) -->
        <script type="text/javascript">
            var duoshuoQuery = {short_name: "bulang123"};
            (function () {
                var ds = document.createElement('script');
                ds.type = 'text/javascript';
                ds.async = true;
                ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
                ds.charset = 'UTF-8';
                (document.getElementsByTagName('head')[0]
                || document.getElementsByTagName('body')[0]).appendChild(ds);
            })();
        </script>
    </div>
    <!--banner start-->
    <div class="banner_right">
        <div class="tonZ">
            <h3 class="zn_tonZ">站内通知<img src="/myhome/Public/Home/images/tonZ.gif" width="20" height="20"/></h3>
            <p class="tonZ_con">
                <span>热烈祝贺：</span>步浪个人博客1.0版正式上线，欢迎大家来吐槽，<a href="#">留言</a>你们的建议，浪哥在此拜谢！！
            </p>
        </div>
    </div>
    <!--banner end-->
    <!--about me start-->
    <div class="about">
        <h3>关于我</h3>
        <p>
            网名(小名)：步浪<br/>
            姓名：刘旺旺<br/>
            QQ：1107842278<br/>
            Tel:18335908001<br/>
            现居：山西运城<br/>
            籍贯：山西临汾洪洞县<br/>
            职业：web前端开发<br/>
            爱好：玩双节棍、玩电脑、旅游<br/>
            座右铭：落后就要挨打
        </p>
    </div>
    <!--about me end-->
    <!--article start-->
    <div class="article_right">
        <div class="weixin">
            <h3>微信关注我</h3>
            <img src="/myhome/Public/Home/images/wx.png" width="250" alt="微信关注我" title="微信关注我"/>
        </div>
    </div>
    <div style="clear:both;"></div>
    <!--article end-->

</div>
<div class="return_top"><a href="javascript:void(0)"></a></div>

<!--con end-->


<script>window._bd_share_config = {
    "common": {
        "bdSnsKey": {},
        "bdText": "",
        "bdMini": "2",
        "bdMiniList": false,
        "bdPic": "",
        "bdStyle": "0",
        "bdSize": "16"
    },
    "slide": {"type": "slide", "bdImg": "3", "bdPos": "left", "bdTop": "250"},
    "selectShare": {"bdContainerClass": null, "bdSelectMiniList": ["qzone", "tsina", "tqq", "renren", "weixin"]}
};
with (document)0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];</script>

<script type="text/javascript" src="/myhome/Public/Home/js/jquery.js"></script>
<script type="text/javascript" src="/myhome/Public/Home/js/my.js"></script>

</body>
</html>