<div class="mod_acc_tip mobile" id="addMobile" style="width:440px;height:440px">
    <?php $rand_key = rand();?>
    <input type="hidden" name="mobile_bind_id" id="mobile_bind_id">
    <div id="is_check" style="">

        <div class="mod_tip_hd modal-header">
            <div class="modal-header-text modal_tip_title"><?=__('修改安全手机')?></div>
            <a class="btn_mod_close" href="" title=""></a>
        </div>
        <div class="mod_tip_bd">
            <div class="tabbar_panel">
                <div class="tabbar">
                    <div class="tab_opt c_b">
                        <span class="phonetab1 now"><?=__('输入新手机')?></span>
                        <span class="phonetab2"><?=__('验证新手机')?></span>
                        <span class="phonetab3 end"><?=__('完成')?></span>
                    </div>
                    <div class="tabline c_b" style="display:inline-block;margin-left: 60px">
                        <i class="phonetab1 now"></i>
                        <i class="phonetab2"></i>
                        <i class="phonetab2"></i>
                        <span class="justify_fix"></span>
                    </div>
                </div>
            </div>
            <div class="wapbox">
                <dl class="binding phonestep1">
                    <dt><?=__('请输入安全手机号码')?></dt>
                    <dd class="zindex_4">
                        <div class="tits set_qst_tit">
                            <p class="c_b"><span><?=__('中国')?></span><em><?=__('+86')?></em></p>
                            <i class="icon_cirarr"></i>
                        </div>

                    </dd>
                    <dd>
                        <div>
                            <label class="input_bg"><input type="tel" style="height:40px"  class="new_phone" name="phone" id="bind_id" placeholder="<?=__('请输入手机号码')?>" autocomplete="off" disableautocomplete=""></label>
                            <input type="hidden" class="full_new_phone" value="" autocomplete="off" disableautocomplete="">
                        </div>
                        <div class="err_tip error-con" _text="" style="display: none;"><em class="icon_error"></em><span></span></div>
                        <div class="err_tip wng_fmt err_tip_independ" style="display:none" _text="手机号码格式错误"><?=__('手机号码格式错误')?></div>
                        <div class="err_tip empty_phone err_tip_independ" style="display:none" _text="请输入手机号码"><?=__('请输入手机号码')?></div>

                        <div class="err_tip phone_bound_elsewhere err_tip_independ" style="display:none" _text="该号码已绑定"<?=__('该号码已绑定')?>></div>
                    </dd>
                    <dd>
                        <div class="inputcode">
                            <div class="form-group input-group">
                                <input type="text" class="form-control no-right-border verify-input"  name="verify_code" id="verify_code" placeholder="<?=__('验证码')?>"  autocomplete="off"  />
                                <span class="input-group-addon verify_code" style="cursor: pointer;background:url('<?= urlh('account.php', 'VerifyCode', 'image', '', '', array('rand_key' => $rand_key)) ?>') no-repeat center;background-size:cover;">
                                    <p style="width:100px;"></p>
                                    <input type="hidden" name="rand_key" id="rand_key" value="<?=$rand_key?>">
                                </span>

                            </div>
                        </div>
                        <div class="err_tip error-con" _text="" style="display: none;"><em class="icon_error"></em><span></span></div>
                    </dd>

                    <div class="err_tip empty_capt err_tip_independ" style="display:none" _text="<?=__('请输入验证码')?>"><?=__('请输入验证码')?></div>
                    <div style="display:none;" class="err_tip wng_capt err_tip_independ" _text="<?=__('验证码不正确，请重新输入')?>"><?=__('验证码不正确，请重新输入')?></div>
                    <div class="tip_btns">
                        <a class="btn_tip btn_commom" id="mobile-next" title="<?=__('下一步')?>"><?=__('下一步')?></a>
                    </div>
                </dl>
                <dl class="bind_info_panel bind-info-panel" style="display:none">
                    <div class="tip_btns">
                        <a class="btn_tip btn_commom btn_commcon_mobile" data-action="ok" data-type="PH" title="<?=__('确定')?>"><?=__('确定')?></a>
                        <a class="btn_tip btn_back" data-action="back" data-type="PH" title="<?=__('返回')?>"><?=__('返回')?></a>
                    </div>
                </dl>
                <dl class="verify" style="display:none">
                    <div class="disten30x103 phonestep2">
                        <h6 class="pb10"><?=__('我们向您的手机')?> <em id="mobile_id"> </em><?=__('发送了一条验证短信')?> <br><?=__('请输入短信中的验证码')?></h6>
                        <div class="mod inputsend">
                            <label class="input_bg"><input class="phone_capt remain_input" style="height:40px"  id="bind_access_token" type="text" name="ticket" placeholder="<?=__('请输入验证码')?>" autocomplete="off" disableautocomplete=""></label>

                            <span class="remain">
                                    <a class="verify-sendbtn-mobile-again" id="send-verify" title="<?=__('重新发送')?>" autocomplete="off" disableautocomplete="true"><?=__('发送短信')?></a>
                                    <a class="verify-again"  title="<?=__('重新发送')?>"  style="display:none;background-color: rgb(236,236,236);color:rgb(180,180,180)" id="send-verify-again" autocomplete="off" disableautocomplete="true"><?=__('重新发送(')?><span id="send-again-span"><?=__('60')?></span><?=__(')')?></a>
                                </span>
                        </div>
                        <div class="err_tip error-con" _text="" style="display: none;"><em class="icon_error"></em><span></span></div>
                        <div class="err_tip empty_capt err_tip_independ" style="display:none" _text="<?=__('请输入验证码')?>"><?=__('请输入验证码')?></div>
                        <div class="err_tip wng_capt err_tip_independ" style="display:none;" _text="<?=__('验证码错误或已过期')?>"><?=__('验证码错误或已过期')?></div>
                    </div>
                    <div class="tip_btns" style="padding-top:35px">
                        <a class="btn_tip btn_commom mobile"  title="<?=__('确定')?>"><?=__('确定')?></a>
                        <a class="btn_tip btn_back btn-close" title="<?=__('取消')?>"><?=__('取消')?></a>
                    </div>
                    <div class="txt_qst" style="margin-top:40px"><em class="icon_qst"></em><a target="_blank" title="<?=__('我为何收不到验证码')?>？"><?=__('我为何收不到验证码？')?></a></div>
                </dl>
                <dl style="display:none" class="success">
                    <div class="t_c">
                        <h4><?=__('您已成功修改安全手机！')?></h4>
                    </div>
                    <div class="tip_btns wap_btn_abs" style="padding-top:100px">
                        <a class="btn_tip btn_commom btn-close" title="<?=__('返回我的帐号')?>"><?=__('返回我的帐号')?></a>
                    </div>
                </dl>
            </div>
        </div>

    </div>

</div>