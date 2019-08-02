<?php if (!defined('ROOT_PATH')) exit('No Permission');?>

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
        cursor: pointer;background:url('<?= urlh('account.php', 'VerifyCode', 'image', '', '', array('rand_key' => $rand_key)) ?>') no-repeat center;background-size:cover;
    }
</style>

<div style=" background-color: rgb(90, 44, 28);">
    <div class="login-container">
        <div class="row" style="background: url(<?=$this->img('login-slide.jpg')?>) no-repeat -1px; padding: 0px 0;">
            <div class="col-sm-7"></div>
            <div class="col-sm-5">
                <!-- Errors container -->
                <div class="errors-container">
                    <?php @$data['error']?>
                </div>


                <!-- Add class "fade-in-effect" for login form effect -->
                <form method="post" role="form" id="findpwd_step1" class="login-form fade-in-effect">

                    <div class="login-header">
                        <a href="<?= Zero_Registry::get('url') ?>" class="logo">
                            <img src="<?= Base_ConfigModel::getConfig('text_site_logo', $this->img('logo-white-bg@2x.png'))?>" class="hide" alt="" width="80" />
                            <span><?=__('找回密码')?></span>
                        </a>
                        <p style="display: none;"><?=(sprintf(__('修改支付密码').'%s'.__('密码'), Base_ConfigModel::getConfig('account_site_name')))?></p>
                    </div>


                    <div class="form-group">
                        <label class="control-label" for="user_account"><?=__('账号')?></label>
                        <input type="text" class="form-control" name="user_account" id="user_account" autocomplete="off" />
                    </div>

                    <div class="form-group input-group">
                        <input type="text" class="form-control no-right-border" name="verify_code" id="verify_code" placeholder="<?=__('验证码')?>"  autocomplete="off"  />
                        <span class="input-group-addon verify_code">
                                    <p style="width:100px;"></p>
                                    <input type="hidden" name="rand_key" id="rand_key" value="<?=$rand_key?>">
                                </span>
                    </div>

                    <div class="form-group btn-group btn-block">
                        <button type="submit" class="btn btn-primary btn-block text-left" data-channel="mobile">
                            <i class="fa-lock"></i>
                            <?=__('下一步')?>
                        </button>
                    </div>

                    <div class="login-footer text-right">
                        <a href="<?=url('Login', 'login') . LoginModel::callbackStr()?>"><?=__('我已注册,现在登录')?></a> | <a href="<?=url('Login', 'register') . LoginModel::callbackStr()?>"><?=__('立即注册')?></a>
                        <div class="info-links">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function writeClear(e) {
        e.val().length > 0 ? e.parent().addClass("write") : e.parent().removeClass("write"), btnCheck(e.parents(".step1"))
    }

    function btnCheck(e) {
        var t = !0;
        e.find("input").each(function () {
            $(this).hasClass("no-follow") || 0 == $(this).val().length && (t = !1);
            console.info(t);
        }), t ? e.find(".btn").removeClass("disabled") : e.find(".btn").addClass("disabled");
    }
</script>

<?php $this->lazyJs('login') ?>
