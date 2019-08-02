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


            <form method="post" role="form" id="findpwd_step3" class="login-form fade-in-effect">



                    <div class="login-header">
                        <a href="<?= Zero_Registry::get('url') ?>" class="logo">
                            <img src="<?= Base_ConfigModel::getConfig('text_site_logo', $this->img('logo-white-bg@2x.png'))?>" class="hide" alt="" width="80" />
                            <span><?=__('找回密码')?></span>
                        </a>
                        <p><?=sprintf(__('找回').' %s '.__('密码'), Base_ConfigModel::getConfig('account_site_name'))?></p>
                    </div>
                    <h4><?=__('第三步：')?></h4>

                <?php if (!isset($data['error'])) :?>
                    <input type="hidden" class="form-control" name="channel_verify_key" id="channel_verify_key" autocomplete="off" value="<?= @s('channel_verify_key', '')?>" />
                    <input type="hidden" class="form-control" name="channel_verify_code" id="channel_verify_code" autocomplete="off" value="<?= @s('channel_verify_code', '')?>" />
                    <input type="hidden" class="form-control" name="channel" id="channel" autocomplete="off" value="<?= @s('channel', 'mobile')?>" />


                    <div class="form-group">
                        <label class="control-label" for="pwd"><?=__('新密码')?></label>
                        <input type="password" class="form-control" name="pwd" id="pwd" autocomplete="off" value="" />
                    </div>


                    <div class="form-group">
                        <label class="control-label" for="confirm_pwd"><?=__('确认密码')?></label>
                        <input type="password" class="form-control" name="confirm_pwd" id="confirm_pwd" autocomplete="off" value="" />
                    </div>

                    <div class="form-group">
                        <button type="submit" id="submit_step3" class="btn btn-primary  btn-block text-left">
                            <i class="fa-lock"></i>
                            <?=__('修改密码')?>
                        </button>
                    </div>

                    <div class="login-footer text-right">
                        <a href="<?=url('Login', 'login') . LoginModel::callbackStr()?>"><?=__('我已注册，现在登录')?></a> | <a href="<?=url('Login', 'register') . LoginModel::callbackStr()?>"><?=__('立即注册')?></a>
                        <div class="info-links">
                        </div>
                    </div>
                <?php else: ?>
                    <br>
                    <h4><?= @$data['error']?></h4>
                    <div class="form-group">
                        <a href="<?= url('Login', 'findpwd')?>"><?=__('返回')?></a>
                    </div>
                <?php endif;?>

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


<!-- Bottom Scripts -->
<?php $this->lazyJs('login') ?>

