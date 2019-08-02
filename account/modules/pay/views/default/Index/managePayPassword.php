<div class="mod_box"  id="profile-manage" style="width: 600px;">
    <div class="mod_box_hd">
        <h4><?= $data['isSet'] ? __('修改支付密码') : __('设置支付密码') ?></h4>
    </div>
    <div class="mod_box_bd">

        <div class="manage-edit-box">
            <div class="box-main">
                <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form">

                    <div class="row step1">
                        <div class="form-section col-xs-12">
                            <?=__('第一步：短信验证')?>
                        </div>
                        <div class="form-section col-xs-12" >
                            <label class="not-bind-mobile-tip hide"><?=__('您未绑定手机')?>，
                                <a class="red" href="<?= urlh('account.php', 'User_Security', 'index','')?>"><?=__('点击进入')?></a>
                                <?=__('绑定手机s')?>
                            </label>
                            <label><?=__('您当前的手机号码是')?><em id="mobile"></em></label>
                        </div>
                        <div class="form-section col-xs-12" >
                            <li class="form-item">
                                <h4><?=__('验&nbsp;证&nbsp;码')?></h4>
                                <div class="input-box">
                                    <input type="text" id="captcha" name="captcha" maxlength="4" size="10" class="inp" autocomplete="off" placeholder="<?=__('输入图形验证码')?>" oninput="writeClear($(this));"/>
                                    <span class="input-del code"></span> <a href="javascript:void(0)" id="refreshcode" style="height: 40px;width: 120px;display: inline-block" class="code-img"><img border="0" style="width: 100%;height: 100%" id="codeimage" name="codeimage"></a>
                                    <input type="hidden" id="codekey" name="codekey" value="">
                                </div>
                            </li>
                            <li class="form-item">
                                <h4><?=__('短信验证')?></h4>
                                <div class="input-box">
                                    <input type="text" id="code" name="code" value="" maxlength="6" placeholder="<?=__('输入短信验证码')?>" oninput="writeClear($(this));" onFocus="writeClear($(this));" pattern="[0-9]*" />
                                    <input class="btn btn-blue" id="pay_passwd_mobile_btn" type="button" href="javascript: void(0);" value="<?=__('获取短信验证')?>" />
                                </div>
                            </li>
                        </div>
                        <div class="form-section col-xs-12">
                            <a href="javascript:void(0)" id="J_nextStep" class="btn disabled btn-primary" title="下一步">
                                <?= __('下一步') ?>
                            </a>
                        </div>
                    </div>
                    <div class="row step2 hide">
                        <div class="form-section col-xs-12">
                            <?=__('第二步：设置支付密码')?>
                        </div>
                        <div class="form-section col-xs-12" >
                            <label class="input-label" for="ud_postalcode"> <?=__('支付密码')?></label>
                            <input type="text" class="input-text form-control" name="user_pay_psw" id="user_pay_psw" value="" placeholder="<?=__('支付密码')?>" autocomplete="off" />
                        </div>
                        <div class="form-section text-center col-xs-12" >
                            <a class="btn btn-primary add" id="J_resetPayPsw" ><?=__('确认修改')?></a>
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
        }), t ? e.find(".btn").addClass("disabled") : e.find(".btn").removeClass("disabled");
    }
</script>

<?php $this->lazyJs('modules/pay/pay_passwd') ?>


