<?php if (!defined('ROOT_PATH')) exit('No Permission');?><!DOCTYPE html>
<html lang="zh-CN" dropEffect="none" class="no-js">
<head>
	<meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <!-- 移动设备 viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0,maximum-scale=1.0,user-scalable=no,minimal-ui">
    <meta name="author" content="43390.com">
	<meta name="description" content="<?=Base_ConfigModel::getConfig('account_site_name')?>" />

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
    <meta name="apple-mobile-web-app-title" content="<?=Base_ConfigModel::getConfig('account_site_name')?>">

    <!-- Win8标题栏及ICON图标 -->
    <link rel="apple-touch-icon-precomposed" href="<?=$this->img('apple-touch-icon.png')?>">
    <meta name="msapplication-TileImage" content="<?=$this->img('app-icon72x72@2x.png')?>">
    <meta name="msapplication-TileColor" content="#62a8ea">


	<title><?=Base_ConfigModel::getConfig('account_site_name')?></title>

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
        var SYSTEM = SYSTEM || {};
        SYSTEM.skin = 'green';
        SYSTEM.language = "<?=$this->registry('language')?>";
    </script>

    
</head>
<body class="page-body  boxed-container skin-ss user-info-navbar-skin-ss horizontal-menu-skin-ss" style="background:url(<?=$this->img('main-background.jpg')?>) no-repeat center fixed;background-size:cover;"><!-- boxed-container-->
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
						<span class="title"><?=__('订货系统')?></span>
					</a>
                    <ul class="hide">
                        <li>
                            <a href="<?=Base_ConfigModel::getConfig('shop_app_url')?>">
                                <span class="title"><?=__('商城首页')?></span>
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
									<a href="javascript:" class="fancybox" data-type="ajax" :data-src="itemUtil.getUrl(SYS.CONFIG.index_url, {ctl:'User_Message', met:'get',mdu:'sns',message_id:item.message_id})">
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
							<a href="<?=urlh('account.php', 'Login', 'logout')?>">
								<i class="fa-lock"></i>
								<?=__('退出')?>
							</a>
						</li>
					</ul>
				</li>

                <?php else: ?>
                    <a class=" btn-primary btn-sm" href="<?=urlh('account.php', 'Login', 'login') . LoginModel::callbackStr()?>"><?=__('我已注册，现在登录')?></a>  |  <a class="btn-info btn-sm"  href="<?=url('Login', 'register') . LoginModel::callbackStr()?>"><?=__('立即注册')?></a>&nbsp;&nbsp;
                <?php endif; ?>
			</ul>

		</div>

	</nav>
	<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
        
        
        <?php include $this->getView(); ?>
	</div>
	<div class="page-loading-overlay">
		<div class="loader-2"></div>
	</div>
<script type="text/javascript" src="<?=$this->js('../../../../../shop/static/src/default/js/config')?>"></script>
<script src="<?=$this->js('libs.min', true)?>"></script>
<?php foreach ($this->getLazyLoadJs() as $url):?>
    <script type="text/javascript" src="<?=$url?>"></script>
<?php endforeach;?>
<?php foreach ($this->getLazyLoadJsString() as $str):?>
    <script type="text/javascript">
        <?=$str?>
    </script>
<?php endforeach;?>

<?php if (Base_ConfigModel::ifIm()):?>
    <script>
        $.getScript(SYS.CONFIG.base_url + '/account/static/src/default/js/modules/sns/im.js', function(){}, true);
    </script>
<?php endif;?>
</body>
</html>