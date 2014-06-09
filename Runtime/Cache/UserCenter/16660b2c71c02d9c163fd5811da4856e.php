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
<body>
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

<div id="main-container" class="container">
    <table style="width: 100%; table-layout: fixed;">
        <tbody>
        <tr>
            <td style="width: 20%; vertical-align: top; background-color: #ededed;">
                <?php $sideBarUser = query_user(array('username', 'uid', 'title', 'score', 'avatar128'), $uid); $call = $call ? $call : '我'; ?>

<div class="row">
    <div class="col-xs-12">
        <div>
            <p>&nbsp;</p>
            <!--头像-->
            <p class="text-center">
                <?php if($uid == is_login()): ?><a href="<?php echo U('UserCenter/Index/changeAvatar');?>">
                        <img style="width: 55%;" class="avatar-img" src="<?php echo ($sideBarUser["avatar128"]); ?>"/>
                    </a>
                    <?php else: ?>
                    <img style="width: 55%;" class="avatar-img" src="<?php echo ($sideBarUser["avatar128"]); ?>"/><?php endif; ?>
            </p>

            <!--用户名-->
            <p class="text-center">
                <?php echo (htmlspecialchars($sideBarUser["username"])); ?>
                &nbsp;
            </p>

            <!--积分 等级-->
            <p class="text-center text-muted">
                积分：<?php echo ($sideBarUser["score"]); ?>
                &nbsp;&nbsp;&nbsp;&nbsp;
                等级：<?php echo ($sideBarUser["title"]); ?>
            </p>

            <!--关注按钮，在登录状态-->
            <?php if(is_login() && $uid != get_uid()): $sideBarUser['is_following'] = D('Follow')->where(array('who_follow'=>get_uid(),'follow_who'=>$uid))->find(); ?>
                <p class="text-center">
                    <a class="btn btn-primary" onclick="ufollow(this,<?php echo ($uid); ?>)">
                        <?php if($sideBarUser['is_following']): ?>已关注
                            <?php else: ?>
                            关注<?php endif; ?>
                    </a>
                </p><?php endif; ?>

            <p>&nbsp;</p>

            <!--导航栏-->
            <?php  if($uid==is_login()) { $oneuser_navbar_items = array( array('个人资料'), array('基本资料','list-alt',U('UserCenter/Index/index'),'index'), array('修改头像','user',U('UserCenter/Index/changeavatar'),'change-avatar'), array('修改邮箱','envelope',U('UserCenter/Index/changeemail'),'change-email'), array('修改个性签名','edit',U('UserCenter/Index/changesignature'),'change-signature'), array('系统相关'), array('我的会话','send',U('UserCenter/Message/session'),'session'), array('消息中心','bullhorn',U('UserCenter/Message/message'),'message'), array('修改密码','lock',U('UserCenter/Index/changepassword'),'change-password'), array('讨论区'), array('我的主题','book',U('UserCenter/Forum/myTopic'),'my-topic'), array('我的参与','comment',U('UserCenter/Forum/myTakePartIn'),'my-take-part-in'), array('我的收藏','bookmark',U('UserCenter/Forum/myBookmark'),'my-bookmark'), ); } else { $oneuser_navbar_items = array( array('个人资料'), array('基本资料','list-alt',U('UserCenter/Index/index',array('uid'=>$uid)),'index'), array('讨论区'), array($call.'的主题','book',U('UserCenter/Forum/myTopic',array('uid'=>$uid)),'my-topic'), array($call.'的参与','comment',U('/UserCenter/Forum/myTakePartIn',array('uid'=>$uid)),'my-take-part-in'), ); } ?>
            <ul class="nav nav-pills nav-stacked">
                <?php if(is_array($oneuser_navbar_items)): $i = 0; $__LIST__ = $oneuser_navbar_items;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i; if(!$item[2]): ?><li class="nav-title">
                            <a><?php echo ($item[0]); ?></a>
                        </li>
                        <?php else: ?>
                        <?php $activeClass = $tabHash == $item[3] ? 'active' : ''; ?>
                        <li class="<?php echo ($activeClass); ?>">
                            <a href="<?php echo ($item[2]); ?>">
                                <?php echo ($item[0]); ?>
                                <span class="glyphicon glyphicon-<?php echo ($item[1]); ?> pull-right"></span>
                            </a>
                        </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
</div>
            </td>
            <td style="width: 80%; background-color: #fff; vertical-align: top; padding-left: 50px; padding-right: 50px;">
                <div class="container-fluid">
                    
    <div class="row">
        <div class="col-xs-12">
            <p>&nbsp;</p>
            <h4>基本资料</h4>
            <hr class="oneuser-title-hr"/>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6 text-muted">
            <p><span class="text-muted">用户名：</span> <?php echo (htmlspecialchars($user["username"])); ?></p>

            <p><span class="text-muted">邮箱：</span> <?php echo (htmlspecialchars($user["email"])); ?></p>
            <?php if($uid==is_login()): ?><p><span class="text-muted">最近登录：</span> <?php echo (time_format($user["last_login_time"])); ?></p>

                <p><span class="text-muted">最近登录IP：</span> <?php echo (long2ip($user["last_login_ip"])); ?></p>

                <p><span class="text-muted">注册时间：</span> <?php echo (time_format($user["reg_time"])); ?></p>

                <p><span class="text-muted">手机：</span> <?php echo (htmlspecialchars($user["mobile"])); ?>
                    <?php if($user['mobile']): ?><a href="<?php echo U('UserCenter/Index/unbindMobile');?>">解除绑定</a>
                        <?php else: ?>
                        <a href="<?php echo U('UserCenter/Index/bindMobile');?>">立即绑定</a><?php endif; ?>
                </p><?php endif; ?>
            <p><span class="text-muted">积分：</span> <?php echo ($user["score"]); ?></p>

            <p><span class="text-muted">等级：</span> <?php echo (htmlspecialchars($user["title"])); ?></p>

        </div>
        <div class="col-xs-4">
            <img class="avatar-img" src="<?php echo ($user["avatar256"]); ?>"/>
        </div>

        <div class="col-xs-2">
            &nbsp;
        </div>
    </div>
    <div>

        <p><span class="text-muted">头衔：</span>
            <?php if($user['rank_link']): ?><table class="tb_rank">
                    <thead>
                    <tr>
                        <th>图标</th>
                        <th>头衔名称</th>
                        <th>颁发理由</th>
                        <th>是否显示</th>
                        <th>颁发时间</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($user['rank_link'])): $i = 0; $__LIST__ = $user['rank_link'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vl): $mod = ($i % 2 );++$i;?><tr>
                            <td><img src="<?php echo ($vl["logo_url"]); ?>" title="<?php echo ($vl["title"]); ?>"
                                     alt="<?php echo ($vl["title"]); ?>"
                                     style="width: 18px;height: 18px;vertical-align: middle;margin-left: 2px;"/></td>
                            <td><?php echo ($vl["title"]); ?></td>
                            <td><?php echo ($vl["reason"]); ?></td>
                            <td>
                                <?php if(($vl["is_show"]) == "1"): ?>显示
                                    <?php else: ?>
                                    不显示<?php endif; ?>
                            </td>
                            <td><?php echo (friendlydate($vl["create_time"])); ?></td>

                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>

                    </tbody>
                </table>


                <?php else: ?>
                暂无头衔，努力为社区做点贡献吧！O(∩_∩)O~<?php endif; ?>
        </p>
    </div>

                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $(function(){
        $(window).resize(function(){
            $("#main-container").css("min-height", $(window).height() - 343);
        }).resize();
    })
</script>

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