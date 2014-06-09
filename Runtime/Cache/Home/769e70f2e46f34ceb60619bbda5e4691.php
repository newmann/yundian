<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8"/>
<?php $oneplus_seo_meta = get_seo_meta($vars); ?>

<?php if($oneplus_seo_meta['title']): ?><title><?php echo ($oneplus_seo_meta['title']); ?></title>
    <?php else: ?>
    <title><?php echo C('WEB_SITE_TITLE');?></title><?php endif; ?>
<?php if($oneplus_seo_meta['keywords']): ?><meta name="keywords" content="<?php echo ($oneplus_seo_meta['keywords']); ?>"/><?php endif; ?>
<?php if($oneplus_seo_meta['description']): ?><meta name="description" content="<?php echo ($oneplus_seo_meta['description']); ?>"/><?php endif; ?>

<!-- 为了让html5shiv生效，请将所有的CSS都添加到此处 -->
<link href="/onethink/Public/static/bootstrap/css/bootstrap.css" rel="stylesheet"/>
<link type="text/css" rel="stylesheet" href="/onethink/Public/static/qtip/jquery.qtip.css"/>
<link type="text/css" rel="stylesheet" href="/onethink/Public/static/oneplus/js/ext/toastr/toastr.min.css"/>
<link href="/onethink/Public/static/oneplus/css/oneplus.css" rel="stylesheet"/>


<!-- 增强IE兼容性 -->
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]><!-->
<script src="/onethink/Public/static/bootstrap/js/html5shiv.js"></script>
<script src="/onethink/Public/static/bootstrap/js/respond.js"></script>
<!--<!--[endif]-->

<!-- jQuery库 -->
<!--[if lt IE 9]><!-->
<script type="text/javascript" src="/onethink/Public/static/jquery-1.10.2.min.js"></script>
<!--<!--[endif]-->
<!--[if gte IE 9]><!-->
<script type="text/javascript" src="/onethink/Public/static/jquery-2.0.3.min.js"></script>
<!--<![endif]-->

<!-- Bootstrap库 -->
<script type="text/javascript" src="/onethink/Public/static/bootstrap/js/bootstrap.min.js"></script>

<!-- 其他库 -->
<script src="/onethink/Public/static/qtip/jquery.qtip.js"></script>
<script type="text/javascript" src="/onethink/Public/static/oneplus/js/ext/toastr/toastr.min.js"></script>
<script type="text/javascript" src="/onethink/Public/static/oneplus/js/ext/slimscroll/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="/onethink/Public/static/jquery.iframe-transport.js"></script>

<!-- 自定义js -->
<script type="text/javascript" src="/onethink/Public/static/oneplus/js/core.js"></script>

<script>
    //全局内容的定义
    var _ROOT_ = "/onethink";
    var MID = "<?php echo is_login();?>";
</script>

<audio id="music" src="" autoplay="autoplay"></audio>

<!-- 页面header钩子，一般用于加载插件CSS文件和代码 -->
<?php echo hook('pageHeader');?>
</head>
<body style="background-color: #fff;">
<!-- 头部 -->
<?php D('Home/Member')->need_login(); ?>
<div class="navbar navbar-default" role="navigation">
<div class="container">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse"
            data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-logo" href="<?php echo U('Home/Index/index');?>">
        <img src="/onethink/Public/Home/images/oneplus/oneplus-logo.png" style="width: 150px;"/>
    </a>
</div>

<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<ul class="nav navbar-nav" style="font-size: 18px">

    <!--导航栏菜单项-->
    <?php $__NAV__ = M('Channel')->field(true)->where("status=1")->order("sort")->select(); if(is_array($__NAV__)): $i = 0; $__LIST__ = $__NAV__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i; if(($nav["pid"]) == "0"): ?><li>
                <a href="<?php echo (get_nav_url($nav["url"])); ?>"
                   target="<?php if(($nav["target"]) == "1"): ?>_blank<?php else: ?>_self<?php endif; ?>"><?php echo ($nav["title"]); ?></a>
            </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
</ul>
<ul class="nav navbar-nav navbar-right">
    <!--登录注册-->
    <?php $unreadMessage=D('Common/Message')->getHaventReadMeassageAndToasted(is_login()); $currentSession=D('Common/Talk')->getCurrentSessions(); ?>
    <?php if(is_login()): ?><li class="dropdown op_nav_ico ">
            <ul class="dropdown-menu extended notification">
                <li style="padding-left: 15px;padding-right: 15px;">
                    <div class="row nav_info_center">
                        <div class="col-xs-9 nav_align_left"><span><?php echo count($currentSession);?></span> 个进行中的会话
                        </div>
                        <div class="col-xs-3"></div>
                    </div>
                </li>
                <li>
                    <div style="position: relative;width: auto;overflow: hidden;max-height: 250px ">
                        <ul id="nav_session" class="dropdown-menu-list scroller "
                            style=" width: auto;">
                            <?php if(count($currentSession) == 0): ?><div style="font-size: 18px;color: #ccc;font-weight: normal;text-align: center;line-height: 150px">
                                    暂无会话!
                                </div>
                                <?php else: ?>
                                <?php if(is_array($currentSession)): $i = 0; $__LIST__ = $currentSession;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$session): $mod = ($i % 2 );++$i;?><li>
                                        <a href="<?php echo U('UserCenter/Message/talk',array('talk_id'=>$session['id']));?>">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <img class="avatar-img session_head"
                                                         src="<?php echo ($session["first_user"]["avatar32"]); ?>">
                                                </div>
                                                <div class="col-xs-9">
                                                    <div class="title text-more" title=" <?php echo ($session["title"]); ?>">
                                                        <?php echo (op_t($session["title"])); ?>
                                                    </div>
                                                    <div class="content text-more"
                                                         title="<?php echo (op_t($session["last_message"]["content"])); ?>">
                                                        <?php if($session['last_message'] != null): echo ($session["last_message"]["user"]["username"]); ?>:<?php echo (mb_substr(op_t($session["last_message"]["content"]),0,10,'utf-8')); ?>
                                                            <?php else: ?>
                                                            暂无内容。<?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                            <style>
                                #nav_session .session_head {
                                    width: 3em
                                }

                                #nav_session .title {
                                    font-size: 1.2em;
                                    width: 100%;
                                }

                                #nav_session .content {
                                    color: grey;
                                    font-size: 0.8em;
                                    line-height: 1.2em;
                                    height: 1.2em;
                                    width: 90%;
                                }
                            </style>
                        </ul>
                    </div>
                </li>
                <li class="external">
                    <a href="<?php echo U('UserCenter/Message/session');?>">
                        查看全部 <i class="glyphicon glyphicon-circle-arrow-right"
                                style="background: none;color: rgb(72,184,122)"></i>
                    </a>
                </li>
            </ul>
            <script>
                $(function () {
                    $('.scroller').slimScroll({
                        height: '150px'
                    });
                });
            </script>
            <a class="dropdown-toggle" data-toggle="dropdown"><i
                    class="glyphicon glyphicon-send"></i>
                &nbsp;
            </a>
        </li>


        <li class="dropdown op_nav_ico ">
            <ul class="dropdown-menu extended notification">
                <li style="padding-left: 15px;padding-right: 15px;">
                    <div class="row nav_info_center">
                        <div class="col-xs-9 nav_align_left"><span
                                id="nav_hint_count"><?php echo count($unreadMessage);?></span> 条未读
                        </div>
                        <div class="col-xs-3"><i onclick="setAllReaded()"
                                                 class="set_read glyphicon glyphicon-ok" title="全部标为已读"></i></div>
                    </div>
                </li>
                <li>
                    <div style="position: relative;width: auto;overflow: hidden;max-height: 250px ">
                        <ul id="nav_message" class="dropdown-menu-list scroller "
                            style=" width: auto;">
                            <?php if(count($unreadMessage) == 0): ?><div style="font-size: 18px;color: #ccc;font-weight: normal;text-align: center;line-height: 150px">
                                    暂无任何消息!
                                </div>
                                <?php else: ?>
                                <?php if(is_array($unreadMessage)): $i = 0; $__LIST__ = $unreadMessage;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$message): $mod = ($i % 2 );++$i;?><li>
                                        <a data-url="<?php echo ($message["url"]); ?>" onclick="readMessage(this,<?php echo ($message["id"]); ?>)">
                                            <i class="glyphicon glyphicon-bell"></i>
                                            <?php echo ($message["title"]); ?>
                                            <span class="time">
                                            <?php echo ($message["ctime"]); ?>
                                            </span>
                                        </a>
                                    </li><?php endforeach; endif; else: echo "" ;endif; endif; ?>

                        </ul>
                    </div>

                </li>
                <li class="external">
                    <a href="<?php echo U('UserCenter/Message/message');?>">
                        查看全部 <i class="glyphicon glyphicon-circle-arrow-right"
                                style="background: none;color: rgb(72,184,122)"></i>
                    </a>
                </li>
            </ul>
            <script>
                $(function () {
                    $('.scroller').slimScroll({
                        height: '150px'
                    });
                });
            </script>
            <a id="nav_info dropdown-toggle " data-toggle="dropdown"><i
                    class="glyphicon glyphicon-bullhorn"></i>
                <span id="nav_bandage_count"
                <?php if(count($unreadMessage) == 0): ?>style="display: none"<?php endif; ?>
                class="badge pull-right"><?php echo count($unreadMessage);?></span>
                &nbsp;
            </a>
        </li>


        <li class="dropdown">
            <?php $common_header_user = query_user(array('avatar64')); ?>
            <a role="button" class="dropdown-toggle dropdown-toggle-avatar" data-toggle="dropdown">
                <img src="<?php echo ($common_header_user['avatar64']); ?>" class="navbar-avatar-img"/>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo U('UserCenter/Index/index');?>"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;个人中心</a>
                </li>
                <li><a href="<?php echo U('UserCenter/Message/session');?>"><span
                        class="glyphicon glyphicon-send"></span>&nbsp;&nbsp;我的会话</a></li>
                <li><a href="<?php echo U('UserCenter/Forum/myTopic');?>"><span
                        class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;我的主题</a></li>
                <li><a href="<?php echo U('UserCenter/Forum/myTakePartIn');?>"><span
                        class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;我的参与</a></li>
                <li><a href="<?php echo U('UserCenter/Forum/myBookmark');?>"><span
                        class="glyphicon glyphicon-bookmark"></span>&nbsp;&nbsp;我的收藏</a></li>
                <?php if(is_administrator()): ?><li><a href="<?php echo U('Admin/Index/index');?>" target="_blank"><span
                            class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp;管理后台</a></li><?php endif; ?>
                <li><a event-node="logout"><span class="glyphicon glyphicon-off"></span>&nbsp;&nbsp;注销</a>
                </li>
            </ul>
        </li>
        <?php else: ?>
        <li>
            <?php $url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']; ?>
            <a href="<?php echo U('Home/User/login',array('back'=>urlencode($url)));?>">登录</a>
        </li>
        <li>
            <a href="<?php echo U('Home/User/register');?>">注册</a>
        </li><?php endif; ?>
</ul>
</div>
</div>
</div>
<a id="goTopBtn"></a>

<!-- /头部 -->

<!-- 主体 -->
<!--顶部Banner-->
<div class="jumbotron" style="margin-top: -20px;">
    <div class="container">
        <p>&nbsp;</p>
        <div class="row">
            <div class="col-xs-1">&nbsp;</div>
            <div class="col-xs-4">
                <p>&nbsp;</p>
                <h2>ThinkOX是一种精神</h2>
                <p class="text-muted" style="font-size: 18px; line-height: 1.75em;">基于OneThink，同步更新，<br/>让Web开发更快速！</p>
                <p>
                    <a class="btn btn-primary btn-lg" style="font-size: 1.5em;" target="_blank" href="/ThinkOXRC.zip">
                        <span class="glyphicon glyphicon-download" style="top: 5px;"></span>
                        下载RC

                    </a>

                </p>
                <p>
                    <a class="btn btn-primary btn-lg" style="font-size: 1.5em;" target="_blank" href="http://url.cn/Mk090o">
                        <span class="glyphicon glyphicon-user" style="top: 5px;"></span>
                        加入讨论群

                    </a>
                </p>
                <p style="font-size: 14px;">最新版本v0.1 RC</p>
            </div>
            <div class="col-xs-6">
                <img src="/onethink/Public/Home/images/oneplus/index-computer.png" style="width: 100%;"/>
            </div>
            <div class="col-xs-1">&nbsp;</div>
        </div>

        <p>&nbsp;</p>
    </div>
</div>

<!--特性介绍-->
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <p>&nbsp;</p>
            <h1 class="text-center">什么是ThinkOX？</h1>
            <p>&nbsp;</p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-4">
            <div class="text-center">
                <div class="index-feature-div">
                    <img src="/onethink/Public/Home/images/oneplus/index-icon-hand.png"/>
                </div>
            </div>
            <h3 class="index-feature-title">强化的用户中心</h3>
            <h4 class="index-feature-text">
                基于OneThink的强力扩展，<br/>
                不断丰富的用户中心，<br/>
                同步合并，紧跟OT脚步。
            </h4>
        </div>
        <div class="col-xs-4">
            <div class="text-center">
                <div class="index-feature-div">
                    <img src="/onethink/Public/Home/images/oneplus/index-icon-cloud.png"/>
                </div>
            </div>
            <h3 class="index-feature-title">云端部署</h3>
            <h4 class="index-feature-text">
                通过驱动的方式可以轻松支持云<br/>
                平台的部署，让你的网站无缝迁移，
                内置已经支持SAE。
            </h4>
        </div>
        <div class="col-xs-4">
            <div class="text-center">
                <div class="index-feature-div">
                    <img src="/onethink/Public/Home/images/oneplus/index-icon-shield.png"/>
                </div>
            </div>
            <h3 class="index-feature-title">安全可靠</h3>
            <h4 class="index-feature-text">
                提供的稳健的安全策略，包括备份恢复，容错，防止恶意攻击登陆，网页防篡改等多项安全管理功能，保证系统安全，可靠，稳定的运行。
            </h4>
        </div>
    </div>
</div>

<!--翻屏按钮-->
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <p style="height: 8em;">&nbsp;</p>
            <hr class="index-screen-hr"/>
            <div class="text-center">
                <div class="index-screen-button" id="turn-screen">&#x25BC;</div>
            </div>
            <p style="height: 8em;">&nbsp;</p>
        </div>
    </div>
</div>

<!--特性介绍-->
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <table style="width: 100%;" class="index-feature-table">
                <tbody>
                <tr>
                    <td rowspan="2" style="width: 33.3333333333%">
                        <ul><li>
                            <div class="index-feature-text2">
                                <span>头像插件<br/>允许用户上传自己的头像</span>
                            </div>
                            <img class="index-feature-img" src="/onethink/Public/Home/images/oneplus/index-feature-avatar.png"/>
                        </li></ul>
                    </td>
                    <td style="width: 16.666666666666%">
                        <ul><li>
                            <div class="index-feature-text2">
                                <span>升级至最新<br/>Bootstrap</span>
                            </div>
                            <img class="index-feature-img" src="/onethink/Public/Home/images/oneplus/index-feature-bootstrap.png"/>
                        </li></ul>
                    </td>
                    <td rowspan="3">
                        <ul><li>
                            <div class="index-feature-text2">
                                <span>前台个人中心</span>
                            </div>
                            <img class="index-feature-img" src="/onethink/Public/Home/images/oneplus/index-feature-oneuser.png"/>
                        </li></ul>
                    </td>
                </tr>
                <tr>
                    <td>
                        <ul><li>
                            <div class="index-feature-text2">
                                <span>讨论区</span>
                            </div>
                            <img class="index-feature-img" style="" src="/onethink/Public/Home/images/oneplus/index-feature-forum.png"/>
                        </li></ul>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <ul><li>
                            <div class="index-feature-text2">
                                <span>本地评论功能</span>
                            </div>
                            <img class="index-feature-img" src="/onethink/Public/Home/images/oneplus/index-feature-comment.png"/>
                        </li></ul>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- /主体 -->

<!-- 底部 -->

<!-- 底部
================================================== -->
<p style="height: 10em;">&nbsp;</p>
<div class="footer-jumbotron text-center">
    <div class="row">
        <div class="col-xs-4">
            <br/>
            <p>
                <a  href="http://www.ourstu.com/" class="link-reverse">想天软件</a>
            </p>
        </div>
        <div class="col-xs-4">
            <p>本站由<a  href="http://www.ourstu.com/" class="link-reverse">想天软件工作室</a>强力驱动
            </p>
            <p>@2014 xiangtian Inc. All Rights Reserved</p>
        </div>
        <div class="col-xs-4">
            <br/>
            <p>特别鸣谢：<a href="http://www.onethink.cn/" class="link-reverse">OneThink</a></p>
        </div>
    </div>
</div>

<script type="text/javascript">
(function(){
	var ThinkPHP = window.Think = {
		"ROOT"   : "/onethink", //当前网站地址
		"APP"    : "/onethink/index.php?s=", //当前项目地址
		"PUBLIC" : "/onethink/Public", //项目公共目录地址
		"DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
		"MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
		"VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
	}
})();
</script>


 <!-- 用于加载js代码 -->


<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>
<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
    
</div>

<!-- /底部 -->
</body>
</html>


    <script>
        //实现翻屏按钮
        $(function(){
            $('#turn-screen').click(function(){
                var screen = $('html,body');
                screen.animate({scrollTop: $(this).offset().top + $(this).parent().height() + 20})
            })
        })

        //鼠标移动到特性介绍图片的时候显示文字
        $('.index-feature-table ul li').mouseenter(function(){
            var image= $(this).find('img');
            var caption = $(this).find('div');

            caption.width(image.width());
            caption.height(image.height());
            caption.animate({opacity: 1});
        }).mouseleave(function(){
            var image= $(this).find('img');
            var caption = $(this).find('div');

            caption.width(image.width());
            caption.height(image.height());
            caption.animate({opacity: 0});
        });
    </script>