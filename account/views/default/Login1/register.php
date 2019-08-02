<?php if (!defined('ROOT_PATH')) exit('No Permission');?>
<link rel="stylesheet" href="<?=$this->css('plugins/citypicker/css/city-picker', true)?>">
<?php
$rand_key = rand();
?>
<style>
	@media screen and (max-width: 768px) {
		.signin-info ul {
			display: none
		}
	}
	.verify_code{
		cursor: pointer;background:url('<?=Zero_Registry::get('url')?>?ctl=VerifyCode&met=image&rand_key=<?=$rand_key?>') no-repeat center;background-size:cover;
	}
</style>
<div style=" background-color: rgb(90, 44, 28);background: url(<?=$this->img('newlogin.jpg')?>) ;background-size: 100% 525px;">
	<div class="login-container">
	<div class="row" >
    <div class="col-sm-7"></div>
		<div class="col-sm-5">
			<!-- Errors container  login-slide.png-->
			<div class="errors-container">	</div>

			<!-- Add class "fade-in-effect" for login form effect -->
			<form method="post" role="form" id="register" class="login-form fade-in-effect">

                <div class="login-header">

										<span>
												<a href="<?=url('Login', 'register') . LoginModel::callbackStr()?>" class="mobile" style="font-size: 18px">
														<i class="fa-smile-o"></i>
														<?=__('账号注册')?> </a>
													 |
												<a href="<?=url('Login', 'register_mobile') . LoginModel::callbackStr()?>" class="mobile">
														<i class="fa-mobile"></i>
														<?=__('手机注册')?>
												</a>
											</span>
                </div>

                <div class="form-group">
                    <label class="control-label" for="user_account"><?=__('账号')?></label>
                    <input type="text" class="form-control" name="user_account" id="user_account" autocomplete="off" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="user_password"><?=__('密码')?></label>
                    <input type="password" class="form-control" name="user_password" id="user_password" autocomplete="off" />
                </div>

				<div class="form-group input-group">
					<input type="text" class="form-control no-right-border" name="verify_code" id="verify_code" placeholder="<?=__('验证码')?>"  autocomplete="off"  />
							<span class="input-group-addon verify_code">
								<p style="width:100px;"></p>
								<input type="hidden" name="rand_key" id="rand_key" value="<?=$rand_key?>">
							</span>

				</div>



                <div class="form-group hide">
                    <label class="control-label" for="user_account"><?=__('所属区域')?></label>
                    <input type="text" class="form-control" data-toggle="city-picker" name="user_address" id="user_address" value=""  placeholder="<?=__('所属区域')?>" autocomplete="off" />
                    <input type="hidden" class="form-control"  name="user_province_id" id="user_province_id" value=""  />
                    <input type="hidden" class="form-control"  name="user_city_id" id="user_city_id" value=""  />
                    <input type="hidden" class="form-control"  name="user_county_id" id="user_county_id" value=""  />

                </div>

				<!--div>
						<label>
							<input type="checkbox" class="cbr cbr-blue">
							Blue color
						</label>
				</div-->


				<div class="form-group">
					<button type="submit" class="btn btn-primary  btn-block text-left">
						<i class="fa-lock"></i>
						<?=__('注册')?>
					</button>

					<div class="info-links">
						<?=__('点击注册表示同意')?>
                        <a target="_blank" href="<?=urlh('account.php', 'Login', 'protocol')?>" title="<?=__('用户协议')?>">
                            <?=__('用户协议')?>
                        </a>
					</div>
				</div>


                <div class="login-footer text-right">
                    <a href="<?=urlh('account.php', 'Login', 'findpwd') . LoginModel::callbackStr()?>"><?=__('登录遇到问题')?></a> | <a href="<?=url('Login', 'login') . LoginModel::callbackStr()?>"><?=__('我已注册，现在登录')?></a>
                    <div class="info-links">
                    </div>
                </div>
			</form>
		</div>
	</div>
</div>
</div>


<?php $this->lazyJs('plugins/citypicker/city-picker.data.min', true) ?>
<?php $this->lazyJs('plugins/citypicker/city-picker.min', true) ?>
<?php $this->lazyJs('login') ?>
