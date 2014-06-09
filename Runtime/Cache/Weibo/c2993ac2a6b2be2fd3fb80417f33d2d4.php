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
    <div class="row">
        


        
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-9 weibo_main">
                <div class="row">
                    <div class="col-xs-12">
                        <br/>

                        <p>记录，就是一种态度！</p>

                        <p><textarea class="form-control" id="weibo_content" style="height: 6em;"
                                     placeholder="写点什么吧～～"></textarea></p>
                        <a href="javascript:" onclick="insertFace($(this))"><img src="/onethink/Public/static/image/bq.png"/></a>

                        <p class="pull-right"><input type="submit" value="发表 Ctrl+Enter" id="send_weibo_button"
                                                     class="btn btn-primary" data-url="<?php echo U('doSend');?>"/></p>
                    </div>
                </div>
                <div id="emot_content" class="emot_content"></div>

                <script>

                </script>
                <div class="row">
                    <div class="col-xs-12">
                        <p>
                            <img src="/onethink/Public/Weibo/images/ad.png" style="width: 100%;"/>
                        </p>
                    </div>
                </div>

                <div class="row" style="padding-top: 10px">
                    <div class="col-xs-12">

                        <ul class="nav nav-pills ucenter-tab">
                            <li  <?php if(($tab) == "all"): ?>class="active"<?php endif; ?> >
                            	<a href="<?php echo U('Weibo/Index/index');?>">全站动态</a>
                            </li>
                            <?php if(is_login()): ?><li <?php if(($tab) == "concerned"): ?>class="active"<?php endif; ?>>
                                	<a href="<?php echo U('Weibo/Index/myconcerned');?>">我关注的</a>
                                </li><?php endif; ?>
                        </ul>

                    </div>
                </div>
                <hr/>
                <div id="weibo_list">
                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$weibo): $mod = ($i % 2 );++$i;?><div class="row" style="position: relative">
        <?php if(($weibo["is_top"]) == "1"): ?><div class="ribbion-green">
                <a>置顶</a>
            </div><?php endif; ?>
    </div>

    <div class="row" id="weibo_<?php echo ($weibo["id"]); ?>">
        <div class="col-xs-12">
            <div class="pull-left">
                <a href="<?php echo ($weibo["user"]["space_url"]); ?>" ucard="<?php echo ($weibo["user"]["uid"]); ?>">
                    <img src="<?php echo ($weibo["user"]["avatar64"]); ?>"
                         class="avatar-img"
                         style="width: 64px;"/>
                </a>
            </div>

            <div style="padding-left: 16px; width: 92%;float: left">
                <p>
                    <a ucard="<?php echo ($weibo["user"]["uid"]); ?>"
                       href="<?php echo ($weibo["user"]["space_url"]); ?>"><?php echo (htmlspecialchars($weibo["user"]["username"])); ?>
                    </a>
                    <?php echo ($weibo["user"]["icons_html"]); ?>
                    <?php if(is_array($weibo['user']['rank_link'])): $i = 0; $__LIST__ = $weibo['user']['rank_link'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vl): $mod = ($i % 2 );++$i; if($vl['is_show']): ?><img src="<?php echo ($vl["logo_url"]); ?>" title="<?php echo ($vl["title"]); ?>" alt="<?php echo ($vl["title"]); ?>"
                                 class="rank_html"/><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </p>

                <p class="word-wrap"><?php echo (parse_weibo_content($weibo["content"])); ?></p>

                <p>
                    <!--"<?php echo U('bboard/Index/tmldetail',array('topic_id'=>$vo['topic_id']));?>"-->
                    <span class="text-primary"><a href="<?php echo U('Weibo/Index/weiboDetail',array('id'=>$weibo['id']));?>"><?php echo (friendlydate($weibo["create_time"])); ?></a> </span>
                    <a class="pull-right text-primary weibo-comment-link" href="#" data-weibo-id="<?php echo ($weibo["id"]); ?>">
                        <?php $weiboCommentTotalCount = $weibo['comment_count']; ?>
                        <?php if($weibo['can_delete']): ?><span class="text-primary weibo-comment-del cpointer" data-weibo-id="<?php echo ($weibo["id"]); ?>">
        删除
    </span><?php endif; ?>

&nbsp;&nbsp;&nbsp;

<span class="text-primary weibo-comment-link cpointer" data-weibo-id="<?php echo ($weibo["id"]); ?>">
    评论
    <?php if($weiboCommentTotalCount): ?>（<?php echo ($weiboCommentTotalCount); ?> )<?php endif; ?>
</span>
                    </a>
                </p>
                <div class="row weibo-comment-list" style="display: none;" data-weibo-id="<?php echo ($weibo["id"]); ?>">
                    <div class="col-xs-12">
                        <div class="light-jumbotron" style="padding: 1em 2em;">
                            <div class="weibo-comment-container">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr/><?php endforeach; endif; else: echo "" ;endif; ?>

<script>
    ucard();
</script>
                </div>

                <div id="load_more" class="text-center text-muted">
                    <p id="load_more_text">载入更多</p>
                </div>
            </div>
            <div class="col-xs-3">
                <?php if(is_login()): ?><div class="hot_post" style="margin-top: 0;padding-bottom: 10px">
                        <div class="row">
                            <div class="col-xs-5">
                                <a href="<?php echo U('UserCenter/Index/changeavatar');?>"><img src="<?php echo ($self["avatar128"]); ?>"
                                                                                     class="avatar-img"/></a>
                            </div>
                            <div class="col-xs-7">
                                <a style="font-size: 1.2em;width: 100%" title="<?php echo ($self["username"]); ?>" class="text-more"
                                   href="<?php echo ($self["space_url"]); ?>"><?php echo ($self["username"]); ?></a>&nbsp;<?php echo ($self["icons_html"]); ?>
                                <br/>头衔：
                                <?php if($self['rank_link'][0]['num']): if(is_array($self['rank_link'])): $i = 0; $__LIST__ = $self['rank_link'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vl): $mod = ($i % 2 );++$i; if($vl['is_show']): ?><img src="<?php echo ($vl["logo_url"]); ?>" title="<?php echo ($vl["title"]); ?>"
                                                                            alt="<?php echo ($vl["title"]); ?>"
                                                                            style="width: 18px;height: 18px;vertical-align: middle;margin-left: 2px;"/><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                    <?php else: ?>
                                    无<?php endif; ?>
                                <br/>积分：<?php echo ($self["score"]); ?>
                                <br/>等级：<?php echo ($self["title"]); ?>
                            </div>
                        </div>

                        <div class="row" style="margin: 10px;text-align: center">
                            <div class="col-xs-4">
                                微博<br/><?php echo ($self["weibocount"]); ?>
                            </div>
                            <div class="col-xs-4">
                                粉丝<br/><a href="<?php echo U('Usercenter/Index/fans');?>"><?php echo ($self["fans"]); ?></a>
                            </div>
                            <div class="col-xs-4">
                                关注<br/><a href="<?php echo U('Usercenter/Index/following');?>"><?php echo ($self["following"]); ?></a>
                            </div>
                        </div>
                    </div><?php endif; ?>
                <div>
                    <?php echo hook('checkin');?>

                    <?php echo hook('Rank');?>

                    <?php echo W('UserList/lists',array('forum_id'=>$forum_id));?>
                </div>
            </div>

        </div>
    </div>

    </div>
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

    <script type="text/javascript" src="/onethink/Public/static/oneplus/js/ext/atwho/atwho.js"></script>
    <link type="text/css" rel="stylesheet" href="/onethink/Public/static/oneplus/js/ext/atwho//atwho.css"/>
    <script src="/onethink/Public/Weibo/js/weibo.js"></script>
    <script src="/onethink/Public/Weibo/js/insertFace.js"></script>
    <script>
        $(function () {

            var $inputor = $('#weibo_content').atwho(atwho_config);
            var noMoreNextPage = false;
            var isLoadingWeibo = false;
            var currentPage = 1;

            $('#weibo_content').keypress(function (e) {
                if (e.ctrlKey && e.which == 13 || e.which == 10) {
                    $("#send_weibo_button").click();
                }
            });


            //点击发表微博按钮之后
            $('#send_weibo_button').click(function () {
                //获取参数
                var url = $(this).attr('data-url');
                var content = $('#weibo_content').val();
                var button = $(this);
                var originalButtonText = button.val();

                //发送到服务器
                $.post(url, {content: content}, function (a) {
                    handleAjax(a);
                    if (a.status) {
                        button.attr('class', 'btn btn-primary');
                        button.val(originalButtonText);
                        reloadWeiboList();
                        clearWeibo();
                        $('.XT_face').remove();
                    }
                });
            });

            //当屏幕滚动到底部时
            $(window).on('scroll', function () {
                if (noMoreNextPage) {
                    return;
                }
                if (isLoadingWeibo) {
                    return;
                }
                if (isLoadMoreVisible()) {
                    loadNextPage();
                }
            });
            $(window).trigger('scroll');

            function isLoadMoreVisible() {
                var visibleHeight = $(window.top).height();
                var loadMoreOffset = $('#load_more').offset();
                return visibleHeight + $(window).scrollTop() > loadMoreOffset.top;
            }

            function loadNextPage() {
                currentPage = currentPage + 1;
                loadWeiboList(currentPage);
            }

            function reloadWeiboList() {
                loadWeiboList(1, function () {
                    clearWeiboList();
                    currentPage = 1;
                });
            }

            function clearWeibo() {
                $('#weibo_content').val('');
            }

            function loadWeiboList(page, onBeforePrepend) {
                //默认载入第1页
                if (page == undefined) {
                    page = 1;
                }

                //通过服务器载入微博列表
                var url = "<?php echo ($loadMoreUrl); ?>";
                isLoadingWeibo = true;
                $('#load_more_text').text('正在载入...');
                $.post(url, {page: page}, function (a) {
                    if (a.status == 0) {
                        noMoreNextPage = true;
                        $('#load_more_text').text('没有了');
                    }
                    if (onBeforePrepend != undefined) {
                        onBeforePrepend();
                    }
                    $('#weibo_list').append(a);
                    isLoadingWeibo = false;
                });
            }

            function clearWeiboList() {
                currentPage = 0;
                $('#weibo_list').html('');
            }
        })
    </script>
 <!-- 用于加载js代码 -->


<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>
<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
    
</div>

	<!-- /底部 -->
</body>
</html>