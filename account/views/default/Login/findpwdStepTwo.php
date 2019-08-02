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
</head>
<body class="page-body login-page login-light">

<div class="login-container">

    <div class="row">


        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <!-- Errors container -->
            <div class="errors-container">
                <?php @$data['error']?>
            </div>

            <form method="post" role="form" id="findpwd_step2" class="login-form fade-in-effect">

                <div class="login-header">
                    <a href="<?= Zero_Registry::get('url') ?>" class="logo">
                        <img src="<?= Base_ConfigModel::getConfig('text_site_logo', $this->img('logo-white-bg@2x.png'))?>" class="hide" alt="" width="80" />
                        <span><?=__('找回密码')?></span>
                    </a>
                    <p><?=sprintf(__('找回').' %s '.__('密码'), Base_ConfigModel::getConfig('account_site_name'))?></p>
                </div>
                <h4><?=__('第二步：')?></h4>


                <?php if (!isset($data['error'])) :?>
                    <input type="hidden" class="form-control" name="user_id" id="user_id" autocomplete="off" value="<?= @$data['user_id']?>" />
                    <input type="hidden" class="form-control" name="channel" id="channel" autocomplete="off" value="<?= @$data['channel']?>" />
                    <?php if (s('channel', 'mobile') == 'mobile'):?>

                        <?php if (@$data['canChange']):?>
                            <a class="btn btn-default" href="<?= urlh('account.php' ,'Login', 'findpwdStepTwo', '', array('user_account'=>s('user_account',''),'verify_code'=>s('verify_code',''),'rand_key'=>s('rand_key',''),'channel'=>'email'))?>">
                                <i class="fa-exchange"></i>
                                <?=__('切换至')?><span><?=__('邮箱')?></span>
                            </a>
                        <?php endif;?>
                        <div class="form-group">
                            <label class="control-label" for="channel_verify_key"><?=__('注册手机')?></label>
                            <input type="text" class="form-control" disabled name="channel_verify_key" id="channel_verify_key" autocomplete="off" value="<?= @$data['channel_verify_key']?>" />
                        </div>
                        <div class="form-group input-group">
                            <input type="text" class="form-control" id="channel_verify_code" name="channel_verify_code" value="" placeholder="<?=__('输入短信验证码')?>" oninput="writeClear($(this));" onFocus="writeClear($(this));" pattern="[0-9]*" />
                            <span class="input-group-addon" style="padding: 0;">
                                <input class="btn btn-blue" id="pay_passwd_mobile_btn" href="javascript: void(0);" value="<?=__('获取短信验证')?>" />
                            </span>
                        </div>
                    <?php else:?>
                        <?php if (@$data['canChange']):?>
                            <a class="btn btn-default text-left" href="<?= urlh('account.php', 'Login', 'findpwdStepTwo', '', array('user_account'=>s('user_account',''),'verify_code'=>s('verify_code',''),'rand_key'=>s('rand_key',''),'channel'=>'mobile'))?>">
                                <i class="fa-exchange"></i>
                                <?=__('切换至')?><span><?=__('手机')?></span>
                            </a>
                        <?php endif;?>
                        <div class="form-group">
                            <label class="control-label" for="channel_verify_key"><?=__('注册邮箱')?></label>
                            <input type="text" class="form-control" disabled name="channel_verify_key" id="channel_verify_key" autocomplete="off" value="<?= @$data['channel_verify_key']?>" />
                        </div>
                        <div class="form-group input-group">
                            <input type="text" class="form-control" id="channel_verify_code" name="channel_verify_code" value="" placeholder="<?=__('输入邮件验证码')?>" oninput="writeClear($(this));" onFocus="writeClear($(this));" pattern="[0-9]*" />
                            <span class="input-group-addon" style="padding: 0;">
                                <input class="btn btn-blue" id="email_code_btn" href="javascript: void(0);" value="<?=__('获取验证码')?>" />
                            </span>
                        </div>
                    <?php endif;?>

                    <div class="form-group">
                        <button type="submit" id="submit_step2" class="btn btn-primary  btn-block text-left">
                            <i class="fa-lock"></i>
                            <?=__('下一步')?>
                        </button>
                    </div>
                <?php else: ?>
                    <h4><?= @$data['error']?></h4>
                    <div class="form-group">
                        <a href="<?= urlh('account.php','Login', 'findpwd')?>"><?=__('返回')?></a>
                    </div>
                <?php endif;?>

                <div class="login-footer text-right">
                    <a href="<?=url('Login', 'login') . LoginModel::callbackStr()?>"><?=__('我已注册，现在登录')?></a> | <a href="<?=url('Login', 'register') . LoginModel::callbackStr()?>"><?=__('立即注册')?></a>
                    <div class="info-links">
                    </div>
                </div>

            </form>

        </div>

        <div class="col-sm-2"></div>
    </div>

</div>
</body>
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


