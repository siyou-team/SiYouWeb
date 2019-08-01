<?php if (!defined('ROOT_PATH')) exit('No Permission');?>
<style>
	#language img{border-radius:15px;}
</style>
<div id="wrapper"> 
	<div class="open-left">
        <img src="<?=$this->img?>/left-menu.png">
    </div>
    <div class="topbar">
		<!-- LOGO -->
        <div class="topbar-left dw">
            <div class="m-l-10">
                <a href="" class="logo client">
                    <img id="dlogo" src="<?=$this->img?>/index-logo.png" height="60" class="m-r-10 m-t-5" /></a>
                <div class="banb" id="visionVal"></div>
            </div>
        </div>
		
		<div class="navbar navbar-default" role="navigation">
            <div class="container">
				<div>
					<ul class="nav navbar-nav navbar-right pull-right" id="ul_Toplist" >
						<li class="dropdown" id="language">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="line-height: 70px;">
                                <img src="<?=$this->img?>/<?=$this->registry('language')?>.png" id="img_UserImg" alt="user-img" class="" width="40" height="" style="border:2px solid #edf0f0;">
                            </a>
                            <ul class="dropdown-menu" style="width: 200px;" id="ul_UserInfo" onmouseover="" onmouseleave="">
                                <li class="lin32 m-l-20" style="padding: 5px">
                                    <img src="<?=$this->img?>/zh-CN.png" style="width: 30px">
                                    <a href="<?=Zero_Registry::get('url').'?lang=zh-CN'?>" style="display: inline-block;"><?=__('中文')?></a>                                   
                                </li>
                                <li class="lin32 m-l-20" style="padding: 5px">
                                    <img src="<?=$this->img?>/it.png" style="width: 30px">
                                    <a href="<?=Zero_Registry::get('url').'?lang=it'?>" style="display: inline-block;"><?=__('意大利文')?></a>                                     
                                </li>
                            </ul>
                        </li>
					
						<li class="dropdown" id="a_UserInfo">
                            <a href="#" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true" style="line-height: 70px;">
                                <img src="<?=$this->img?>/user-logo.png" id="img_UserImg" alt="user-img" class="img-circle" width="36" height="36">
                            </a>
                            <ul class="dropdown-menu" style="width: 350px;" id="ul_UserInfo" onmouseover="" onmouseleave="">
                                <li class="notifi-title list-group-item m-b-5" style="border: none; border-bottom: 1px solid #ededed;">
                                    <div id="edt_userNames"></div>
                                </li>
                                <li class="lin32 m-l-20">
									<p><?=__('当前账号')?>：<span><?=($data['user_row']['user_account'])?></span></p> 
                                    <p><?=__('店铺名称')?>：<span><?=(isset($data['chain']['chain_name']) ? $data['chain']['chain_name'] : (isset($data['store']['store_name']) ? $data['store']['store_name'] : self::$data['user']['user_nickname']))?></span></p>                                    
                                </li>
                                <li class="clear m-t-20 m-l-20 m-b-30">
                                    <button class="btn  tjqx" id="btnExit"><?=__('退出系统')?></button>
                                </li>
                            </ul>
                        </li>
						
					</ul>
				</div>
			</div>
		</div>
	</div>

    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
        <div class="sidebar-inner slimscrollleft">
            <div id="sidebar-menu">
				<?php
					//  将数据使用HTML再次展现 见图3
					function tree2html($tree, $prefix='menu_', $root=false)
					{
						echo $root ? '<ul>' : '<ul class="list-unstyled">';
						/* echo $root ?"<li><a target='iframe-right' href='".Zero_Registry::get('index_page').'?ctl=Index&met=dashboard&typ=e'."' class='waves-effect waves-light bgbj client'><i class='fa fa-home'></i><span>".__('主页')."</span></a></li>" :''; */
						foreach ($tree as $k=>$leaf)
						{
							if($leaf['menu_id'] == 1)
							{
								echo "<li onclick='addStyle(this)'><a target='iframe-right' href='".Zero_Registry::get('index_page').'?ctl=Index&met=dashboard&typ=e'."' class='waves-effect waves-light bgbj client'><i class='fa fa-home'></i><span>".__('主页')."</span></a></li>";
							}else{
								if (!empty($leaf['children']))
								{
									echo "<li class='has_sub' onclick='addStyle(this)' onmouseleave='hideMenu()' onmouseover='showMenu(this)'> <a class='waves-effect waves-light'><i class=\"fa " . $leaf[$prefix . 'icon']. "\"></i><span>" .__($leaf[$prefix . 'name']). " </span><em>+</em></a>";
								}else{
									if($leaf['menu_url_ctl'] == 'Cashier_Goods')
									{
										$class="open-menu";
									}else{
										$class="";
									}
									$url = sprintf('%s?mdu=%s&ctl=%s&met=%s&typ=e', Zero_Registry::get('url'), $leaf['menu_url_mdu'], $leaf['menu_url_ctl'], $leaf['menu_url_met']);
									echo "<li onclick='addClass(this)'><a href='".$url."' target='iframe-right' class='".$class."'>● " .__($leaf[$prefix . 'name']). "</a></li>";
								}
							}
							
							if (!empty($leaf['children']))
							{
								tree2html($leaf['children'], $prefix, false);
							}
							
							echo "</li>";
						}

						echo '</ul>';
					}

					tree2html($data['menu_rows'], 'menu_', true);
				?>
			</div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- ========== Left Sidebar End ========== -->
	
	<div class="content-page">
		<div class="content ">
            <iframe src="<?php echo Zero_Registry::get('index_page').'?ctl=Index&met=dashboard&typ=e';?>" id="iframe-right" name="iframe-right" marginwidth="0" marginheight="0" frameborder="0" scrolling="auto" style="width: 100%;"></iframe>
        </div>
    </div>
</div>
<script src="<?=$this->js('plugins/cookie')?>"></script>
<script src="<?=$this->js('plugins/base64')?>"></script>
<script src="<?=$this->js('index/base')?>" charset="utf-8"></script>
<script type="text/javascript">
	$("#btnExit").click(function(){
		window.location.href = '<?=url('Login', 'logout')?>';
	});
</script>