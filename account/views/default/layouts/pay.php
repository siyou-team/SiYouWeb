<?php if (!defined('ROOT_PATH')) exit('No Permission');?><!DOCTYPE html>
<html lang="zh-CN" dropEffect="none" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <!-- 移动设备 viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0,maximum-scale=1.0,user-scalable=no,minimal-ui">
    <meta name="author" content="43390.com">
    <meta name="description" content="<?=Base_ConfigModel::getConfig('pay_site_name')?>" />

    <!-- 360浏览器默认使用Webkit内核 -->
    <meta name="renderer" content="webkit" />
    <meta name="renderer" content="webkit|ie-stand|ie-comp">

    <!-- 禁止百度SiteAPP转码 -->
    <meta http-equiv="Cache-Control" content="no-siteapp">

    <!-- Chrome浏览器添加桌面快捷方式（安卓） -->
    <link rel="icon" type="image/png" href="<?=$this->img('favicon.png')?>">
    <link rel="shortcut icon" href="<?=$this->img('favicon.ico')?>" type="image/x-icon" />

    <meta name="mobile-web-app-capable" content="yes">
    <!-- Safari浏览器添加到主屏幕（IOS） -->
    <link rel="icon" sizes="192x192" href="<?=$this->img('apple-touch-icon.png')?>">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="<?=Base_ConfigModel::getConfig('pay_site_name')?>">

    <!-- Win8标题栏及ICON图标 -->
    <link rel="apple-touch-icon-precomposed" href="<?=$this->img('apple-touch-icon.png')?>">
    <meta name="msapplication-TileImage" content="<?=$this->img('app-icon72x72@2x.png')?>">
    <meta name="msapplication-TileColor" content="#62a8ea">


    <title><?=Base_ConfigModel::getConfig('pay_site_name')?></title>

    <link href="<?=$this->font('fontawesome/css/font-awesome.min', 'true')?>" rel="stylesheet">

    <link rel="stylesheet" href="<?=$this->css('bootstrap.min', true)?>">
    <link rel="stylesheet" href="<?=$this->css('qianyi-core.min', true)?>">
    <link rel="stylesheet" href="<?=$this->css('qianyi-forms.min', true)?>">
    <link rel="stylesheet" href="<?=$this->css('qianyi-components.min', true)?>">
    <link rel="stylesheet" href="<?=$this->css('qianyi-skins.min', true)?>">
    <link rel="stylesheet" href="<?=$this->css('default.min')?>">
    <?php if (method_exists($this, 'getPreLoadCss')):?>
        <?php foreach ($this->getPreLoadCss() as $url):?>
            <link rel="stylesheet" type="text/css" href="<?=$url?>" />
        <?php endforeach;?>
    <?php endif;?>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript">

        window.SYS = {};
        SYS.VER = '<?=VER?>';
        SYS.DEBUG = <?=intval(DEBUG)?>;
        SYS.CONFIG = {
            account_url: '<?=Zero_Registry::get('base_url')?>/account.php',
            base_url: '<?=Zero_Registry::get('base_url')?>',
            index_url: "<?=Zero_Registry::get('url')?>",
            index_page: '<?=Zero_Registry::get('index_page')?>',
            static_url: '<?=Zero_Registry::get('static_url')?>'
        };
    </script>


    <style>

        .page-header {
            padding-bottom: 10px;
            margin: 44px 0 22px;
            border-bottom: 1px solid transparent
        }

        .pager {
            padding-left: 0;
            margin: 22px 0;
            text-align: center;
            list-style: none
        }

        .pager li {
            display: inline
        }

        .pager li>a,.pager li>span {
            display: inline-block;
            padding: 5px 14px;
            background-color: transparent;
            border: 1px solid #e4eaec;
            border-radius: 3px
        }

        .pager li>a:focus,.pager li>a:hover {
            text-decoration: none;
            background-color: #fff
        }

        .pager .next>a,.pager .next>span {
            float: right
        }

        .pager .previous>a,.pager .previous>span {
            float: left
        }

        .pager .disabled>a,.pager .disabled>a:focus,.pager .disabled>a:hover,.pager .disabled>span {
            color: #ccd5db;
            pointer-events: none;
            cursor: not-allowed;
            background-color: transparent
        }


        .pager li>a:focus,.pager li>a:hover {
            color: #62a8ea
        }

        .pager li .icon {
            margin-top: -1px
        }

        .pager li>a:focus,.pager li>a:hover {
            border-color: #62a8ea
        }

        .pager li:first-child {
            margin-right: 5px
        }

        .pager .disabled>a,.pager .disabled>a:focus,.pager .disabled>a:hover,.pager .disabled>span {
            border-color: #e4eaec
        }

        .pager-round li>a,.pager-round li>span {
            border-radius: 1000px
        }


        .page-alert .alert-wrap {
            max-height: 0;
            padding: 0;
            margin: 0;
            overflow: hidden;
            -webkit-transition: max-height .7s linear 0s;
            -o-transition: max-height .7s linear 0s;
            transition: max-height .7s linear 0s
        }

        .page-alert .alert-wrap.in {
            max-height: 500px;
            -webkit-transition: max-height 1s linear 0s;
            -o-transition: max-height 1s linear 0s;
            transition: max-height 1s linear 0s
        }

        .page-alert .alert-wrap .alert {
            margin: 0;
            text-align: left;
            border-radius: 0
        }



        .page-dark.layout-full {
            color: #fff
        }

        .page-dark.layout-full:before {
            position: fixed;
            top: 0;
            left: 0;
            z-index: -1;
            width: 100%;
            height: 100%;
            content: "";
            background-position: center top;
            -webkit-background-size: cover;
            background-size: cover
        }

        .page-dark.layout-full:after {
            position: fixed;
            top: 0;
            left: 0;
            z-index: -1;
            width: 100%;
            height: 100%;
            content: "";
            background-color: rgba(38,50,56,.6)
        }

        .page-dark.layout-full .brand {
            margin-bottom: 22px
        }

        .page-dark.layout-full .brand-text {
            font-size: 18px;
            color: #fff;
            text-transform: uppercase
        }

        .page-nav-tabs {
            padding: 0 20px
        }

        .page-content {
            padding: 20px 20px
        }

        .page-content>:not(script):last-child {
            margin-bottom: 0!important
        }

        .page-content-actions {
            padding: 0 20px 20px
        }

        .page-content-actions .dropdown {
            display: inline-block
        }

        .page-content-actions:after,.page-content-actions:before {
            display: table;
            content: " "
        }

        .page-content-actions:after {
            clear: both
        }

        .page-content-actions:after,.page-content-actions:before {
            display: table;
            content: " "
        }

        .page-content-actions:after {
            clear: both
        }

        .page-copyright {
            margin-top: 60px;
            font-size: 12px;
            color: #37474f;
            letter-spacing: 1px
        }

        .page-copyright .social a {
            margin: 0 10px;
            text-decoration: none
        }

        .page-copyright .social .icon {
            font-size: 16px;
            color: rgba(55,71,79,.6)
        }

        .page-copyright .social .icon:focus,.page-copyright .social .icon:hover {
            color: rgba(55,71,79,.8)
        }

        .page-copyright .social .icon.active,.page-copyright .social .icon:active {
            color: #37474f
        }

        .page-copyright-inverse .social .icon {
            color: #fff
        }

        .page-copyright-inverse .social .icon:active,.page-copyright-inverse .social .icon:hover {
            color: rgba(255,255,255,.8)
        }

        .page-header+.page-content {
            padding-top: 0
        }

        .page-title {
            margin-top: 0;
            margin-bottom: 0;
            font-size: 18px
        }

        .page-title>.icon {
            margin-right: .3em
        }

        .page-description {
            margin-top: 6px;
            color: #a3afb7
        }

        .page-header {
            position: relative;
            padding: 20px 20px;
            margin-top: 0;
            margin-bottom: 0;
            background: 0 0;
            border-bottom: none
        }

        .page-header-actions {
            position: absolute;
            top: 50%;
            right: 20px;
            z-index: 1;
            margin: auto;
            -webkit-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            -o-transform: translateY(-50%);
            transform: translateY(-50%)
        }

        .page-header-actions .btn-icon {
            margin-left: 6px
        }

        .page-header-actions>* {
            margin-bottom: 0
        }

        .page-header .breadcrumb {
            padding: 0;
            margin: 6px 0 0
        }

        .page-header-bordered {
            padding-top: 20px;
            padding-bottom: 20px;
            margin-bottom: 20px;
            background-color: #fff;
            border-bottom: 1px solid transparent
        }

        .page-header-tabs {
            padding-bottom: 0
        }

        .page-header-tabs .nav-tabs-line {
            margin-top: 5px;
            border-bottom-color: transparent
        }

        .page-header-tabs .nav-tabs-line>li>a {
            padding: 5px 20px
        }



    </style>
    <style>
        .widget {
            position: relative;
            margin-bottom: 24px;
            background-color: #fff
        }

        .widget .cover {
            width: 100%
        }

        [class*=blocks-]>li>.widget {
            margin-bottom: 0
        }

        .widget-shadow {
            -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
            box-shadow: 0 1px 1px rgba(0,0,0,.05)
        }

        .widget {
            border-radius: 3px
        }

        .widget .widget-header {
            border-radius: 3px 3px 0 0
        }

        .widget .widget-header:last-child {
            border-radius: inherit
        }

        .widget .widget-body:last-child {
            border-radius: 0 0 3px 3px
        }

        .widget .widget-body:last-child .widget-body-footer {
            border-radius: 0 0 3px 3px
        }

        .widget .widget-footer {
            border-radius: 0 0 3px 3px
        }

        .widget .widget-footer:first-child {
            border-radiu: inherit
        }

        .widget-body {
            position: relative;
            padding: 30px 25px
        }

        .widget-body-footer {
            margin-top: 30px
        }

        .widget-body-footer:after,.widget-body-footer:before {
            display: table;
            content: " "
        }

        .widget-body-footer:after {
            clear: both
        }

        .widget-body-footer:after,.widget-body-footer:before {
            display: table;
            content: " "
        }

        .widget-body-footer:after {
            clear: both
        }

        .widget-content ul {
            padding: 0;
            margin: 0
        }

        .widget-content li {
            list-style: none
        }

        .widget-title {
            margin-top: 0;
            color: #37474f;
            text-transform: capitalize
        }

        div.widget-title {
            font-size: 22px
        }

        .overlay-panel .widget-title {
            color: #fff
        }

        .widget>.widget-title {
            padding: 12px 20px
        }

        .widget-metas {
            font-size: 12px;
            color: #a3afb7
        }

        .widget-metas.type-link>a {
            position: relative;
            display: inline-block;
            padding: 3px 5px;
            color: #a3afb7
        }

        .widget-metas.type-link>a:first-child {
            padding-left: 0
        }

        .widget-metas.type-link>a:hover {
            color: #ccd5db
        }

        .widget-metas.type-link>a+a:before {
            position: absolute;
            top: 10px;
            left: -2px;
            width: 3px;
            height: 3px;
            content: "";
            background-color: #a3afb7;
            border-radius: 50%
        }

        .overlay-background .widget-time {
            color: #fff;
            opacity: .8
        }

        .widget-category {
            font-size: 16px
        }

        .widget-actions {
            margin-top: 10px;
            text-align: right
        }

        .widget-actions a {
            display: inline-block;
            margin-right: 10px;
            color: #a3afb7;
            vertical-align: middle
        }

        .widget-actions a .icon,.widget-actions a.icon {
            text-decoration: none
        }

        .widget-actions a .icon+span,.widget-actions a.icon+span {
            margin-left: 2px
        }

        .widget-actions a.active,.widget-actions a:focus,.widget-actions a:hover {
            color: #ccd5db;
            text-decoration: none
        }

        .widget-actions a:last-child {
            margin-right: 0
        }

        .widget-actions-sidebar {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 60px
        }

        .widget-actions-sidebar a {
            display: inline-block;
            width: 100%;
            height: 60px;
            margin-right: 0;
            text-align: center;
            border-right: 1px solid #e4eaec
        }

        .widget-actions-sidebar a:before {
            display: inline-block;
            height: 100%;
            vertical-align: middle;
            content: ""
        }

        .widget-actions-sidebar a+a {
            border-top: 1px solid #e4eaec
        }

        .widget-actions-sidebar+.widget-content {
            margin-left: 80px
        }

        .widget-watermark {
            position: absolute;
            right: 0;
            bottom: 0;
            line-height: 1;
            opacity: .1
        }

        .widget-watermark.darker {
            color: #000
        }

        .widget-watermark.lighter {
            color: #fff
        }

        .widget-divider:after {
            display: block;
            width: 20px;
            height: 2px;
            margin: 15px auto;
            content: "";
            background-color: #fff
        }

        .widget-left {
            position: absolute;
            top: 0;
            left: 0;
            width: 40%;
            height: 100%
        }

        .widget-left+.widget-body {
            width: 60%;
            margin-left: 40%
        }

        @media (max-width: 767px) {
            .widget-left {
                position:relative;
                width: 100%;
                height: 320px
            }

            .widget-left+.widget-body {
                width: 100%;
                margin-left: 0
            }
        }

    </style>

</head>
<body class="page-body boxed-container  skin-ss user-info-navbar-skin-ss horizontal-menu-skin-ss" style="background:url(<?=$this->img('main-background.jpg')?>) no-repeat center fixed;background-size:cover;"><!-- boxed-container-->

<!-- navbar-minimal -->
<nav class="navbar horizontal-menu"><!-- set fixed position by adding class "navbar-fixed-top" -->

    <div class="navbar-inner">

        <!-- Navbar Brand -->
        <div class="navbar-brand">
            <a href="<?=url('Index', 'index')?>" class="logo">
                <img src="<?= Base_ConfigModel::getConfig('text_site_logo', $this->img('logo@2x.png'))?>" width="80" alt="" class="hidden-xs" />
                <img src="<?= Base_ConfigModel::getConfig('text_site_logo', $this->img('logo@2x.png'))?>" width="80" alt="" class="visible-xs" />
            </a>
        </div>

        <!-- Mobile Toggles Links -->
        <div class="nav navbar-mobile">

            <!-- This will toggle the mobile menu and will be visible only on mobile devices -->
            <div class="mobile-menu-toggle">
                <!-- This will open the popup with user profile settings, you can use for any purpose, just be creative -->
                <a href="#" data-toggle="settings-pane" data-animate="true">
                    <i class="linecons-cog"></i>
                </a>

                <a href="#" data-toggle="user-info-menu-horizontal">
                    <i class="fa-bell-o"></i>
                    <span class="badge badge-success">7</span>
                </a>

                <!-- data-toggle="mobile-menu-horizontal" will show horizontal menu links only -->
                <!-- data-toggle="mobile-menu" will show sidebar menu links only -->
                <!-- data-toggle="mobile-menu-both" will show sidebar and horizontal menu links -->
                <a href="#" data-toggle="mobile-menu-horizontal">
                    <i class="fa-bars"></i>
                </a>
            </div>

        </div>

        <div class="navbar-mobile-clear"></div>



        <!-- main menu -->
        <ul class="navbar-nav">
            <li class="opened">
                <a href="<?=Base_ConfigModel::getConfig('shop_app_url')?>">
                    <i class="icon-pingtai1"></i>
                    <span class="title"><?=__('商城首页')?></span>
                </a>
                <ul class="hide">
                    <li>
                        <a href="<?=Base_ConfigModel::getConfig('shop_app_url')?>">
                            <span class="title"><?=__('订货系统')?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?=Base_ConfigModel::getConfig('shop_app_url')?>">
                            <span class="title"><?=__('微分销')?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?=url('Index', 'index')?>">
                            <span class="title"><?=__('新零售')?></span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?=urlh('account.php','User_Account', 'index')?>">
                    <i class="icon-usercenter"></i>
                    <span class="title"><?=__('用户中心')?></span>
                </a>
            </li>
            <li>
                <a href="<?=urlh('account.php','Index', 'index', 'pay')?>">
                    <i class="icon-zhifu"></i>
                    <span class="title"><?=__('支付中心')?></span>
                </a>
            </li>

            <li class="hide">
                <a href="<?=urlh('account.php','Sp', 'index', 'exchange')?>">
                    <i class="icon-zhifu"></i>
                    <span class="title"><?=__('积分中心')?></span>
                </a>
            </li>


            <?php if (Base_ConfigModel::ifSns()):?>
                <li>
                    <a href="<?=urlh('account.php','User', 'index', 'sns')?>">
                        <i class="icon-pengyouquan"></i>
                        <span class="title"><?=__('SNS中心')?></span>
                    </a>
                </li>
            <?php endif;?>
        </ul>

        <!-- notifications and other links -->
        <ul class="nav nav-userinfo navbar-right">

            <li class="search-form"><!-- You can add "always-visible" to show make the search input visible -->

                <form method="get" action="extra-search.html">
                    <input type="text" name="s" class="form-control search-field" placeholder="Type to search..." />

                    <button type="submit" class="btn btn-link">
                        <i class="linecons-search"></i>
                    </button>
                </form>

            </li>

            <?php if (self::isLogin()):?>
                <li class="dropdown xs-left">
					<a href="#" data-toggle="dropdown" class="notification-icon J_msg_menu">
                        <i class="fa-envelope-o"></i>
                        <?php if($layout_data['user_row']['new_msg_num']):?>
						<span class="badge badge-green J_new_msg_num"><?=$layout_data['user_row']['new_msg_num']?></span>
                        <?php endif;?>
                    </a>

					<ul class="dropdown-menu messages" id="menu_msg_list_box">
                        <li>

                            <ul class="dropdown-menu-list list-unstyled ps-scrollbar">

								<li :class="{ active: 0==item.message_is_read }"  v-for="item in items"><!-- "active" class means message is unread -->
									<a href="javascript:" class="fancybox" data-type="ajax" :data-src="itemUtil.getUrl(SYS.CONFIG.index_url, {ctl:'User_Message', met:'get',mdu:'sns',message_id:item.message_id})" >
										<span class="line">
											<strong> {{item.user_other_nickname}}</strong>
											<span class="light small">-  {{item.message_time}}</span>
										</span>

                                        <span class="line desc small">
											 {{item.message_content}}
										</span>
                                    </a>
                                </li>

                            </ul>

                        </li>

                        <li class="external">
							<a href="<?=urlh('account.php', 'User_Message', 'index', 'sns')?>">
                                <span>All Messages</span>
                                <i class="fa-link-ext"></i>
                            </a>
                        </li>
                    </ul>

                </li>

                    <!--
                <li class="dropdown xs-left">
                    <a href="#" data-toggle="dropdown" class="notification-icon notification-icon-messages">
                        <i class="fa-bell-o"></i>
                        <span class="badge badge-purple">7</span>
                    </a>

                    <ul class="dropdown-menu notifications">
                        <li class="top">
                            <p class="small">
                                <a href="#" class="pull-right">Mark all Read</a>
                                You have <strong>3</strong> new notifications.
                            </p>
                        </li>

                        <li>
                            <ul class="dropdown-menu-list list-unstyled ps-scrollbar">
                                <li class="active notification-success">
                                    <a href="#">
                                        <i class="fa-user"></i>

                                        <span class="line">
											<strong>New user registered</strong>
										</span>

                                        <span class="line small time">
											30 seconds ago
										</span>
                                    </a>
                                </li>

                                <li class="active notification-secondary">
                                    <a href="#">
                                        <i class="fa-lock"></i>

                                        <span class="line">
											<strong>Privacy settings have been changed</strong>
										</span>

                                        <span class="line small time">
											3 hours ago
										</span>
                                    </a>
                                </li>

                                <li class="notification-primary">
                                    <a href="#">
                                        <i class="fa-thumbs-up"></i>

                                        <span class="line">
											<strong>Someone special liked this</strong>
										</span>

                                        <span class="line small time">
											2 minutes ago
										</span>
                                    </a>
                                </li>

                                <li class="notification-danger">
                                    <a href="#">
                                        <i class="fa-calendar"></i>

                                        <span class="line">
											John cancelled the event
										</span>

                                        <span class="line small time">
											9 hours ago
										</span>
                                    </a>
                                </li>

                                <li class="notification-info">
                                    <a href="#">
                                        <i class="fa-database"></i>

                                        <span class="line">
											The server is status is stable
										</span>

                                        <span class="line small time">
											yesterday at 10:30am
										</span>
                                    </a>
                                </li>

                                <li class="notification-warning">
                                    <a href="#">
                                        <i class="fa-envelope-o"></i>

                                        <span class="line">
											New comments waiting approval
										</span>

                                        <span class="line small time">
											last week
										</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="external">
                            <a href="#">
                                <span>View all notifications</span>
                                <i class="fa-link-ext"></i>
                            </a>
                        </li>
                    </ul>
                </li>
                -->
                <li class="dropdown user-profile">
                    <a href="#" data-toggle="dropdown">
                        <img src="<?=img(@$layout_data['user_row']['user_avatar'], 160)?>" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
                        <span>
								<?=self::$data['user']['user_nickname']?>
                            <i class="fa-angle-down"></i>
							</span>
                    </a>
                    <ul class="dropdown-menu user-profile-menu list-unstyled">
                        <!--
                        <li>
							<a href="#edit-profile">
								<i class="fa-edit"></i>
								New Post
							</a>
						</li>
						<li>
							<a href="#settings">
								<i class="fa-wrench"></i>
								Settings
							</a>
						</li>-->
                        <li>
                            <a href="<?=urlh('account.php', 'User_Account', 'index')?>">
                                <i class="fa-user"></i>
                                <?=__('账号设置')?>
                            </a>
                        </li>
                        <li class="last">
                            <a href="<?=url('Login', 'logout')?>">
                                <i class="fa-lock"></i>
                                <?=__('退出')?>
                            </a>
                        </li>
                    </ul>
                </li>

            <?php else: ?>
                <a class=" btn-primary btn-sm" href="<?=url('Login', 'login') . LoginModel::callbackStr()?>"><?=__('我已注册，现在登录')?></a>  |  <a class="btn-info btn-sm"  href="<?=url('Login', 'register') . LoginModel::callbackStr()?>"><?=__('立即注册')?></a>&nbsp;&nbsp;
            <?php endif; ?>
        </ul>

    </div>

</nav>
<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

    <div class="columns-container">
        <div class="container-bak" id="columns">
            <!-- breadcrumb -->
            <div class="breadcrumb-env">

                <ol class="breadcrumb mb0">
                    <li>
                        <a href="<?=url('Index')?>"><i class="fa-home"></i><?=__('首页')?></a>
                    </li>
                    <li class="active">
                        <a><?=__('个人中心')?></a>
                    </li>
                </ol>
            </div>

            <div class="page animation-fade page-account">
                <div class="page-content profile-env">
                    <div class="row">
                        <div class="col-md-3">

                            <!-- User Info Sidebar -->
                            <div class="user-info-sidebar" style="background-color: #fff;padding-top: 20px;">

                                <a href="<?=url('User_Account', 'index', '', '', array(), 'default', 'e',  Zero_Registry::get('base_url') . '/account.php', true)?>" data-pjax-href="#account_content" class="user-img">
                                    <img src="<?=img(@$layout_data['user_row']['user_avatar'], 160)?>" alt="user-img" class="img-cirlce img-responsive img-thumbnail" />
                                </a>

                                <span class="user-name">
                                        <?=$layout_data['user_row']['user_nickname']?>
                                    <span class="user-status is-online"></span>
                                    </span>

                                <!--<span class="user-title">
                                CEO at <strong>Google</strong>
                                </span>-->

                                <hr />

                                <ul class="list-unstyled user-info-list">
                                    <li>
                                        <i class="fa fa-money"></i>
                                        <a href="<?=url('Index', 'resourceIndex', 'pay', '', array(), 'default', 'e',  Zero_Registry::get('base_url') . '/account.php', true)?>" data-pjax-href="#account_content"><?=__('余  &nbsp;&nbsp;额')?> : <span id="user_money_amount" data-value="<?=$layout_data['user_row']['user_money']?>"><?=format_money($layout_data['user_row']['user_money'])?></span></a>
                                    </li>
                                    <li>
                                        <i class="fa fa-briefcase"></i>
                                        <a href="<?=url('Card', 'index', 'pay', '', array(), 'default', 'e',  Zero_Registry::get('base_url') . '/account.php', true)?>"  data-pjax-href="#account_content"><?=__('充值卡')?> : <?=format_money($layout_data['user_row']['user_recharge_card'])?></a>
                                    </li>


                                    <?php if (Base_ConfigModel::getConfig('redpacket_enable', false)):?>
                                        <li>
                                            <i class="fa fa-credit-card"></i>
                                            <a  href="<?=url('Card', 'index', 'pay', '', array(), 'default', 'e',  Zero_Registry::get('base_url') . '/account.php', true)?>"  data-pjax-href="#account_content"><?=__('白&nbsp;&nbsp;条')?> : <?=format_money($layout_data['user_row']['user_credit'])?></a>
                                        </li>
                                    <?php endif;?>


                                    <!--<li>
                                            <i class="fa-graduation-cap"></i>
                                            <a  href="<?php /*=url('Point', 'index', 'pay', '', array(), 'default', 'e',  Zero_Registry::get('base_url') . '/account.php', true)*/?>"  data-pjax-href="#account_content">积&nbsp;&nbsp;分 : <?php/*=number_format($layout_data['user_row']['user_points'], 0)*/?></a>
                                        </li>-->

                                    <?php if (Base_ConfigModel::getConfig('credit_enable', false)):?>
                                        <li>
                                            <i class="fa-graduation-cap"></i>
                                            <a  href="<?=url('Redpacket', 'index', 'pay', '', array(), 'default', 'e',  Zero_Registry::get('base_url') . '/account.php', true)?>"  data-pjax-href="#account_content"><?=__('红&nbsp;&nbsp;包')?> : <?=number_format($layout_data['user_row']['user_points'], 0)?></a>
                                        </li>
                                    <?php endif;?>
                                </ul>
                                <hr />
                                <ul class="list-unstyled user-info-list user-pay-setting ">
                                    <li>
                                        <i class="fa fa-cog"></i>
                                        <a href="javascript:void(0)" id="set_pay_psw" class="fancybox" data-type="ajax" data-src="<?= urlh('account.php', 'Index', 'managePayPassword', 'pay', '') ?>" >
                                            <?= __('支付密码设置') ?>
                                        </a>
                                    </li>
                                </ul>

                                <hr />

                                <!--<ul class="list-unstyled user-friends-count">
                                    <li>
                                        <span>643</span>
                                        followers
                                    </li>
                                    <li>
                                        <span>108</span>
                                        following
                                    </li>
                                </ul>-->
                                <!--<div style="height: 5px;">
                                </div>-->
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="panel">
                                <div class="panel-body nav-tabs-animate">
                                    <ul class="nav nav-tabs nav-tabs-line tabList">
                                        <li class="news <?=(($this->ctl=='Index' && $this->met=='consumeTradeIndex') ? 'active' : '')?>">
                                            <a href="<?=url('Index', 'consumeTradeIndex', 'pay', '', array(), 'default', 'e',  Zero_Registry::get('base_url') . '/account.php', true)?>" data-toggle="tab" data-pjax-href="#account_content" aria-expanded="false">
                                                <i class="fa fa-bar-chart" aria-hidden="true"></i> <?=__('交易查询')?>
                                            </a>
                                        </li>
                                        <li class="news <?=(($this->ctl=='Index' && $this->met=='resourceIndex') ? 'active' : '')?>">
                                            <a href="<?=url('Index', 'resourceIndex', 'pay', '', array(), 'default', 'e',  Zero_Registry::get('base_url') . '/account.php', true)?>" data-toggle="tab" data-pjax-href="#account_content" aria-expanded="false">
                                                <i class="fa fa-money" aria-hidden="true"></i> <?=__('账户余额')?>
                                                <span class="badge badge-danger"><?=format_money($layout_data['user_row']['user_money'])?></span>
                                            </a>
                                        </li>
                                        <li class="news hide <?=(($this->ctl=='Card' && $this->met=='index') ? 'active' : '')?>">
                                            <a href="<?=url('Card', 'index', 'pay', '', array(), 'default', 'e',  Zero_Registry::get('base_url') . '/account.php', true)?>" data-toggle="tab" data-pjax-href="#account_content" aria-expanded="false">
                                                <i class="fa fa-briefcase" aria-hidden="true"></i> <?=__('我的充值卡')?>
                                            </a>
                                        </li>

                                        <?php if (Base_ConfigModel::getConfig('redpacket_enable', false)):?>
                                            <li class="news <?=(($this->ctl=='Redpacket' && $this->met=='index') ? 'active' : '')?>">
                                                <a href="<?=url('Redpacket', 'index', 'pay', '', array(), 'default', 'e',  Zero_Registry::get('base_url') . '/account.php', true)?>" data-toggle="tab" data-pjax-href="#account_content" aria-expanded="false">
                                                    <i class="fa fa-key" aria-hidden="true"></i> <?=__('我的红包')?>
                                                </a>
                                            </li>
                                        <?php endif;?>


                                        <?php if (Base_ConfigModel::getConfig('credit_enable', false)):?>
                                            <li class="news <?=(($this->ctl=='Credit' && $this->met=='index') ? 'active' : '')?>">
                                                <a href="<?=url('Credit', 'index', 'pay', '', array(), 'default', 'e',  Zero_Registry::get('base_url') . '/account.php', true)?>" data-toggle="tab" data-pjax-href="#account_content" aria-expanded="false">
                                                    <i class="fa fa-credit-card" aria-hidden="true"></i> <?=__('信用支付')?>
                                                </a>
                                            </li>
                                        <?php endif;?>
                                        <li class="news <?=(($this->ctl=='Index' && $this->met=='withdrawIndex') ? 'active' : '')?>">
                                            <a href="<?=url('Index', 'withdrawIndex', 'pay', '', array(), 'default', 'e',  Zero_Registry::get('base_url') . '/account.php', true)?>" data-toggle="tab" data-pjax-href="#account_content" aria-expanded="false">
                                                <i class="fa fa-yen" aria-hidden="true"></i> <?=__('余额提现')?>
                                            </a>
                                        </li>
                                        <li class="news <?=(($this->ctl=='Credit' && $this->met=='index') ? 'active' : '')?>">
                                            <a href="javascript:void(0)"  class="fancybox" data-type="ajax" data-src="<?=url('Index', 'rechargeManage', 'pay', '', array(), 'default', 'e',  Zero_Registry::get('base_url') . '/account.php', true)?>"><i class="fa fa-money" aria-hidden="true"></i> <?=__('点击充值')?></a>
                                        </li>
                                    </ul>
                                    <div class="tab-content  pd0 pt20">
                                        <div class="animation-slide-left tab-message active" id="account_content">
                                            <?php include $this->getView(); ?>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="page-loading-overlay">
    <div class="loader-2"></div>
</div>
<script type="text/javascript" src="<?=$this->js('../../../../../shop/static/src/default/js/config')?>"></script>
<script src="<?=$this->js('libs.min', true)?>"></script>

<script>
    $.request({
        type:'get',
        url: sprintf("%s/account.php?mdu=pay&ctl=%s&met=%s&typ=json", SYS.CONFIG.base_url, 'Index', 'getPayPasswd'),
        data:{},
        dataType:'json',
        success:function(result){
            if(result.status == 250){
                $('#set_pay_psw').html(<?=__('设置支付密码')?>);
            }else{
                $('#set_pay_psw').html(<?=__('修改支付密码')?>);
            }
        }
    });
</script>

<?php foreach ($this->getLazyLoadJs() as $url):?>
    <script type="text/javascript" src="<?=$url?>"></script>
<?php endforeach;?>
<?php foreach ($this->getLazyLoadJsString() as $str):?>
    <script type="text/javascript">
        <?=$str?>
    </script>
<?php endforeach;?>


</body>
</html>