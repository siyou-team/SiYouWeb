<?php if (!defined('ROOT_PATH')) exit('No Permission');?>
<?php
$rand_key = rand();
?>
<style>
	@media screen and (max-width: 768px) {.signin-info ul{display: none}}
	.verify_code{
		cursor: pointer;background:url('<?=Zero_Registry::get('url')?>?ctl=VerifyCode&met=image&rand_key=<?=$rand_key?>') no-repeat center;background-size:cover;
	}
</style>
<div style=" background-color: rgb(90, 44, 28);background: url(<?=$this->img?><?=__('/newlogin.jpg')?>) no-repeat -1px; padding: 0px 0;background-size: 100% 100%;min-height:480px;">
    <form method="post" role="form" id="register_mobile" class="login-form fade-in-effect" style="display: block;width: 25%;position: absolute;left: 60%;">
        <div class="login-header" style="display: none">
            <span>
                <a href="<?=url('Login', 'register') . LoginModel::callbackStr()?>" class="mobile"><?=__('标准注册')?> </a>
            </span>
            <p style="display: none;">
                <?= sprintf(__('注册').' %s '.__('账号'), Base_ConfigModel::getConfig('account_site_name'))?>
            </p>
        </div>
        <div class="form-group">
            <label class="control-label" for="user_account"><?=__('账号')?></label>
            <input type="text" class="form-control" name="user_account" id="user_account"  autocomplete="off" />
        </div>

        <div class="form-group" >
            <label class="control-label" for="user_password"><?=__('密码')?></label>
            <input type="password" class="form-control" name="user_password" id="user_password" autocomplete="off" />
        </div>
        <div class="form-group" >
            <label class="control-label" for="user_password_b"><?=__('确认密码')?></label>
            <input type="password" class="form-control" name="user_password_b" id="user_password_b" autocomplete="off" />
        </div>
        <div class="form-group">
            <label class="control-label" for="user_phone"><?=__('手机号')?></label>
            <input type="text" class="form-control" name="user_phone" id="user_phone"  autocomplete="off" />
        </div>
        <div class="form-group input-group" >
            <input type="text" class="form-control no-right-border" name="verify_code" id="verify_code" placeholder="<?=__('验证码')?>"  autocomplete="off"  />
            <span class="input-group-addon verify_code" style="width:50%">
                <p style="width:100px;"></p>
                <input type="hidden" name="rand_key" id="rand_key" value="<?=$rand_key?>" style="width:100%">
            </span>
        </div>
        <div class="form-group input-group">
            <input type="text" class="form-control" id="channel_verify_code" name="channel_verify_code" value="" placeholder="<?=__('输入短信验证码')?>" oninput="writeClear($(this));" pattern="[0-9]*" />
            <span class="input-group-addon" style="padding: 0;width: 50%;">
                <input class="btn btn-blue" id="pay_passwd_mobile_btn" href="javascript: void(0);" value="<?=__('获取短信验证')?>" style="width: 100%;"/>
            </span>
        </div>
        <button type="submit" class="btn btn-primary active" style="width:100%;background-color: red;border: none;">
            <i class="fa-lock"></i>
            <?=__('注册')?>
        </button>
        <div class="info-links">
            <?=__('点击注册表示同意')?>
            <a target="_blank" href="<?=urlh('account.php', 'Login', 'protocol')?>" title="<?=__('用户协议')?>">
                    <?=__('用户协议')?>
            </a>
        </div>
        <div class="login-footer text-right">
                <a href="<?=urlh('account.php', 'Login', 'findpwd') . LoginModel::callbackStr()?>"><?=__('登录遇到问题')?></a> | <a href="<?=url('Login', 'login') . LoginModel::callbackStr()?>"><?=__('我已注册，现在登录')?></a>
                <div class="info-links">
                </div>
        </div>
    </form>
</div>
</div>
<?php $this->lazyJs('login') ?>
