<?php if (!defined('ROOT_PATH')) exit('No Permission');?>
<style>
    #login{
        display: block;
        width: 21.5%;
        position: absolute;
        top: 143px;
        left: 27.4%;
        z-index: 1;
    }
    #submit{
        background-color: #c51818;
        font-size: 2rem;
        font-weight: 600;
        border-radius: 6px;
        text-align: center;
        line-height: 13px;
    }
    .navbar horizontal-menu{
        margin:0px !important;
        margin-left:20px;
    }
</style>
<div style="background-color: rgb(90, 44, 28); background: url(<?=$this->img?><?=__('/login-slide.png')?>) no-repeat -1px; padding: 0px 0;    background-size: 100% 100%;min-height: 480px;">
		<form method="post" role="form" id="login" class="login-form fade-in-effect">
            <div class="login-header">
                <a href="<?= Zero_Registry::get('url') ?>" class="logo">
                    <img src="<?= Base_ConfigModel::getConfig('text_site_logo', $this->img('logo-white-bg@2x.png'))?>" class="hide" alt="" width="80" />
                    <span><?=__('登录')?></span>
                </a>
                <p style="display: none;"><?= sprintf(__('登录到').'  %s', Base_ConfigModel::getConfig('account_site_name'))?></p>

                <?php if ($data['connect']['mobile_status']['config_value']):?>
                <div class="text-right" style="display: none;">
                    <a href="<?=urlh('account.php', 'Connect_Mobile', 'login') . LoginModel::callbackStr()?>" class="mobile">
                        <i class="fa-mobile"></i>
                        <?=__('手机动态码登录')?>
                    </a>
                </div>
                <?php endif;?>
            </div>
            <div class="form-group">
                <label class="control-label" for="user_account"><?=__('账号')?></label>
                <input type="text" class="form-control" name="user_account" id="user_account" autocomplete="off" value="" />
            </div>
            <div class="form-group">
                <label class="control-label" for="user_password"><?=__('密码')?></label>
                <input type="password" class="form-control" name="user_password" id="user_password" autocomplete="off" value="" />
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary  btn-block text-left" id="submit">

                    <?=__('登录')?>
                </button>
            </div>

            <div class="login-footer text-right">
                <a href="<?=urlh('account.php', 'Login', 'findpwd') . LoginModel::callbackStr()?>"><?=__('找回密码')?></a> | <a href="<?=url('Login', 'register') . LoginModel::callbackStr()?>"><?=__('立即注册')?></a>
                <div class="info-links">
                </div>

            </div>
		</form>
</div>
<?php $this->lazyJs('login') ?>
