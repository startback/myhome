<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="renderer" content="webkit">
    <title>后台管理中心</title>
    <link rel="stylesheet" href="/myhome/Public/Myadmin/css/pintuer.css">
    <link rel="stylesheet" href="/myhome/Public/Myadmin/css/admin.css">
    <script src="/myhome/Public/Myadmin/js/jquery.js"></script>
</head>
<body style="background-color:#f2f9fd;">
<div class="header bg-main">
    <div class="logo margin-big-left fadein-top">
        <h1><img src="/myhome/Public/Myadmin/images/y.jpg" class="radius-circle rotate-hover" height="50" alt=""/>后台管理中心
        </h1>
    </div>
    <div class="head-l">
        <a class="button button-little bg-green" href="/myhome" target="_blank"><span class="icon-home"></span>
        前台首页</a> &nbsp;&nbsp;
        <a href="" class="button button-little bg-blue">
            <span class="icon-wrench"></span>
        清除缓存</a> &nbsp;&nbsp;
        <a class="button button-little bg-red" href="/myhome/Myadmin/index/logout">
            <span class="icon-power-off"></span> 退出登录</a>
    </div>
    <div class="head-l" style="font-size: 18px;color:#ffffff;line-height: 32px;float: right;margin-right: 120px;">
        <span style="color:#0ae;">欢迎您：</span><?php echo ($_SESSION['admin']['info']['admin_account']); ?>
    </div>
</div>
<div class="leftnav">
    <div class="leftnav-title"><strong><span class="icon-list"></span>菜单列表</strong></div>
    <h2><span class="icon-user"></span>基本设置</h2>
    <ul style="display:block">
        <li><a href="/myhome/Myadmin/index/info" target="right"><span class="icon-caret-right"></span>网站设置</a></li>
        <li><a href="/myhome/Myadmin/index/pass" target="right"><span class="icon-caret-right"></span>修改密码</a></li>
    </ul>
    <h2><span class="icon-pencil-square-o"></span>文章管理</h2>
    <ul>
        <li><a href="/myhome/Myadmin/article/atype" target="right"><span class="icon-caret-right"></span>文章分类</a></li>
        <li><a href="/myhome/Myadmin/article/article_list" target="right"><span class="icon-caret-right"></span>文章列表</a></li>
        <li><a href="/myhome/Myadmin/article/article_add" target="right"><span class="icon-caret-right"></span>发布文章</a></li>
    </ul>
    <h2><span class="icon-picture-o"></span>相册管理</h2>
    <ul>
        <li><a href="/myhome/Myadmin/album/atype" target="right"><span class="icon-caret-right"></span>相册列表</a></li>
        <li><a href="/myhome/Myadmin/album/album_list" target="right"><span class="icon-caret-right"></span>相片列表</a></li>
        <li><a href="/myhome/Myadmin/album/album_add" target="right"><span class="icon-caret-right"></span>发布相片</a></li>
    </ul>
    <h2><span class="icon-key"></span>权限管理</h2>
    <ul>
        <li><a href="/myhome/Myadmin/admin/role_list" target="right"><span class="icon-caret-right"></span>角色权限</a></li>
        <li><a href="/myhome/Myadmin/admin/admin_list" target="right"><span class="icon-caret-right"></span>管理员列表</a></li>
    </ul>
</div>
<script type="text/javascript">
    $(function () {
        $(".leftnav h2").click(function () {
            $(this).next().slideToggle(200);
            $(this).toggleClass("on");
        })
        $(".leftnav ul li a").click(function () {
            $("#a_leader_txt").text($(this).text());
            $(".leftnav ul li a").removeClass("on");
            $(this).addClass("on");
        })
    });
</script>

<ul class="bread">
    <li><a href="/myhome/Myadmin/index/info" target="right" class="icon-home"> 首页</a></li>
    <li><a href="##" id="a_leader_txt">网站信息</a></li>
    <li><b>当前语言：</b><span style="color:red;">中文</php></span>
        <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;切换语言：<a href="##">中文</a> &nbsp;&nbsp;<a href="##">英文</a>-->
    </li>
</ul>

<div class="admin">
    <iframe scrolling="auto" rameborder="0" src="<?php echo U('Index/info');?>" name="right" width="100%" height="100%"></iframe>
</div>

<div style="text-align:center;">
    <p>你来我来大家来</p>
</div>
</body>
</html>