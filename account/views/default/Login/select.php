<?php if (!defined('ROOT_PATH')) exit('No Permission');?>
<style>

	@media screen and (max-width: 768px) {
		.signin-info ul {
			display: none
		}
	}
</style>
	<div class="login-container">

		<div class="row">


			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<!-- Add class "fade-in-effect" for login form effect -->
				<div class="login-form fade-in-effect" style="background:rgba(255,255,255,.2);border: 1px solid rgba(255,255,255,.3)">

					<div>
						<h4 class="text-center"><?=__('关联账户')?></h4>
					</div>
					<hr>
					<section class="profile-env">
								<!-- User Info Sidebar -->
								<div class="user-info-sidebar">

									<a class="user-img">
										<img src="<?=str_replace('https://', '//', str_replace('http://', '//', s('icon')))?>"   style="width: 240px;" alt="user-img" class="img-cirlce img-responsive img-thumbnail">
									</a>

									<a class="user-name">
										<?=s('nickname')?>
										<span class="user-status is-online"></span>
									</a>

									<span class="user-title">
										<?=__('您的')?><strong> <?=User_BindConnectModel::$bindTypeMap[i('bind_type')]?> </strong><?=__('尚未关联帐号')?>
									</span>
									<a class="btn btn-primary btn-block" href="<?=url('Login', 'register') . LoginModel::callbackStr()?>">
										<?=__('关联新账户')?>
									</a>
									<a class="btn btn-info btn-block" href="<?=url('Login', 'login') . LoginModel::callbackStr()?>">
										<?=__('关联已有账户')?>
									</a>
								</div>
					</section>
				</div>

			</div>

			<div class="col-sm-2"></div>
		</div>

	</div>
    <?php $this->lazyJs('login') ?>
