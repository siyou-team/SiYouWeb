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
<div style=" background-color: rgb(90, 44, 28);background: url(<?=$this->img('login-slide.png')?>) no-repeat -1px; padding: 0px 0;">
	<div class="login-container">
	<div class="row" style="">
        <div class="col-sm-7"></div>
		<div class="col-sm-5">
			<!-- Errors container -->
			<div class="errors-container">


			</div>

			<!-- Add class "fade-in-effect" for login form effect -->
			<form method="post" role="form" id="register_mobile" class="login-form fade-in-effect">

                <div class="login-header" style="display: none">
                    <!--
                    <a href="<?= Zero_Registry::get('url') ?>" class="logo">
                        <img src="<?= Base_ConfigModel::getConfig('text_site_logo', $this->img('logo-white-bg@2x.png'))?>" class="hide" alt="" width="80" />
                    </a>-->
                        <span>
                            <a href="<?=url('Login', 'register') . LoginModel::callbackStr()?>" class="mobile"><?=__('标准注册')?> </a>
                            <?php if ($data['connect']['mobile_status']['config_value']):?>
                                |
                                <a href="<?=url('Login', 'register_mobile') . LoginModel::callbackStr()?>" class="mobile" style="font-size: 18px">
                                <i class="fa-mobile"></i>
                                <?=__('手机号注册')?>
                            </a>
                            <?php endif;?></span>

                    <p style="display: none;"><?= sprintf(__('注册').' %s '.__('账号'), Base_ConfigModel::getConfig('account_site_name'))?></p>

                    <!--<?php if ($data['connect']['mobile_status']['config_value']):?>
                        <div class="text-right">
                            <a href="<?=url('Login', 'register') . LoginModel::callbackStr()?>" class="mobile">
                                <i class="fa-mobile"></i>
                                标准注册
                            </a>
                        </div>
                    <?php endif;?>-->

                </div>
                
                <div class="form-group">
                    <label class="control-label" for="user_account"><?=__('手机号')?></label>
                    <input required type="text" class="form-control" name="user_account" id="channel_verify_key" pattern="(\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$" autocomplete="off" />
                </div>

                <div class="form-group" style="display: none">
                    <label class="control-label" for="user_password"><?=__('密码')?></label>
                    <input type="password" class="form-control" name="user_password" id="user_password" autocomplete="off" />
                </div>

                <div class="form-group" style="display: none">
                    <label class="control-label" for="user_password_b"><?=__('确认密码')?></label>
                    <input type="password" class="form-control" name="user_password_b" id="user_password_b" autocomplete="off" />
                </div>

				<div class="form-group input-group" style="display: ;">
					<input type="text" class="form-control no-right-border" name="verify_code" id="verify_code" placeholder="<?=__('验证码')?>"  autocomplete="off"  />
							<span class="input-group-addon verify_code">
								<p style="width:100px;"></p>
								<input type="hidden" name="rand_key" id="rand_key" value="<?=$rand_key?>">
							</span>

				</div>

                <div class="form-group input-group">
                    <input type="text" class="form-control" id="channel_verify_code" name="channel_verify_code" value="" placeholder="<?=__('输入短信验证码')?>" oninput="writeClear($(this));" pattern="[0-9]*" />
                    <span class="input-group-addon" style="padding: 0;">
                                <input class="btn btn-blue" id="pay_passwd_mobile_btn" href="javascript: void(0);" value="<?=__('获取短信验证')?>" />
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
					<button type="submit" class="btn btn-primary active">
						<i class="fa-lock"></i>
						<?=__('手机号注册')?>
					</button>

                    <a class="btn btn-default" href="<?=url('Login', 'register') . LoginModel::callbackStr()?>">
                        <i class="fa-mobile"></i>
                        <?=__('标准注册')?>
                    </a>

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
