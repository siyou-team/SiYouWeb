<?php if (!defined('ROOT_PATH')) exit('No Permission');?>
<div class="container">
	<div class="login-container">
		<div class="row">
			<form method="post" role="form" id="login" class="login-form fade-in-effect">
				<div class="login-header">
					<a href="<?= Zero_Registry::get('url') ?>" class="logo">
						<img src="<?=$this->img?>/login-logo.png" height="60" class="m-r-10 m-t-5" />
					</a>
					<p class="sub-title"><?= sprintf(__('登录到').'%s', __('收银平台'))?></p>
				</div>


				<div class="form-group">					
					<input type="text" class="form-control" name="user_account" id="user_account" autocomplete="off" value="" tabindex="1" placeholder="<?=__('账号')?>" />
				</div>

				<div class="form-group">
					<input type="password" class="form-control" name="user_password" id="user_password" autocomplete="off" value="" tabindex="2" placeholder="<?=__('密码')?>" />
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary  btn-block text-left">
						<i class="fa-lock"></i>
                        <?=__('登 录')?>
					</button>
				</div>

                <div class="form-group">
                    <a href="<?=Zero_Registry::get('base_url')?>/offline.php?ctl=Login&met=login&lang=zh-CN" ><img src="//www.siyoutechnology.it/off/static/src/default/images/zh-CN.png" id="img_UserImg" alt="user-img" class="" width="30" height="" style="border-radius:10px;border: 3px solid #fff;"> <?=__('简体中文')?> </a> | <a href="<?=Zero_Registry::get('base_url')?>/offline.php?ctl=Login&met=login&lang=it"><img src="//www.siyoutechnology.it/off/static/src/default/images/it.png" id="img_UserImg" alt="user-img" class="" width="30" height="" style="border-radius:10px;border: 3px solid #fff;"> <?=__('意大利文')?> </a>
                </div>

			</form>
		</div>
	</div>
</div>
<script src="<?=$this->js('bootstrap/bootstrapValidator.min')?>"></script>
<?php $this->lazyJs('login') ?>