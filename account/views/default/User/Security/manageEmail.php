<div class="mod_acc_tip email" id="email" style="width:440px;height:420px">
    <?php $rand_key = rand();?>
    <input type="hidden" name="email_bind_id" id="email_bind_id">
    <div class="mod_tip_hd modal-header">
        <div class="modal-header-text modal_tip_title"><?=__('绑定安全邮箱')?></div>
        <a class="btn_mod_close"></a>
    </div>
    <div class="mod_tip_bd">
        <div class="tabbar_panel">
            <div class="tabbar">
                <div class="tab_opt c_b">
                    <!-- 选中添加class为now -->
                    <span class="mailtab1 now"><?=__('输入新邮箱')?></span>
                    <span class="mailtab2"><?=__('验证新邮箱')?></span>
                    <span class="mailtab3 end"><?=__('完成')?></span>
                </div>
                <div class="tabline c_b" style="display:inline-block;margin-left:55px">
                    <i class="mailtab1 now"></i>
                    <i class="mailtab2"></i>
                    <i class="mailtab3"></i>
                    <span class="justify_fix"></span>
                </div>
            </div>
        </div>

        <div class="wapbox">
            <dl class="binding mailstep1">
                
                <dt><?=__('请输入新的安全邮箱地址')?></dt>
                <dd>
                    <label class="input_bg"><input type="text" style="height:40px"  placeholder="<?=__('请输入邮箱')?>" id="bind_id" class="new_email"  autocomplete="off" disableautocomplete=""></label>
                </dd>
                <div class="err_tip wng_fmt err_tip_independ" style="display:none" _text="<?=__('邮箱格式错误')?>"><?=__('邮箱格式错误')?></div>
                <div class="err_tip empty_email err_tip_independ" style="display:none" _text="<?=__('请输入邮箱地址')?>"><?=__('请输入邮箱地址')?></div>

                <div class="err_tip email_bound_elsewhere err_tip_independ" style="display:none" _text="<?=__('该邮箱地址已绑定')?>"><?=__('该邮箱地址已绑定')?></div>

                <dd class="inputcode">
                    <div class="form-group input-group">
                        <input type="text"  class="form-control no-right-border"  style="height:40px" name="verify_code" id="verify_code" placeholder="<?=__('验证码')?>"  autocomplete="off"  />
                        <span class="input-group-addon verify_code" style="cursor: pointer;background:url('<?= urlh('account.php', 'VerifyCode', 'image', '', '', array('rand_key' => $rand_key)) ?>') no-repeat center;background-size:cover;">
                            <p style="width:100px;"></p>
                            <input type="hidden" name="rand_key" id="rand_key" value="<?=$rand_key?>">
                        </span>
                    </div>
                
                </dd>
                <div style="display:none;" class="err_tip empty_capt err_tip_independ" _text="<?=__('请输入验证码')?>"><?=__('请输入验证码')?></div>
                <div style="display:none;" class="err_tip wng_capt err_tip_independ" _text="<?=__('验证码不正确，请重新输入')?>"><?=__('验证码不正确，请重新输入')?></div>

                <div class="tip_btns" style="margin-top:30px">
                    <a class="btn_tip btn_commom" id="email-next" title="<?=__('下一步')?>"><?=__('下一步')?></a>
                </div>
            </dl>
            <dl class="verify" style="display:none;">
                <div class="disten30x103 mailstep2">
                    <input type="hidden" name="bind_id" id="bind_id">
                    <h6 class="doub_ln"><?=__('')?><?=__('我们向')?> <em id="bind_id_email"></em> <?=__('发送了验证邮件')?><br><?=__('请输入邮件中的验证码')?></h6>
                    <div class="mod inputsend">
                        <label class="input_bg"><input type="text" placeholder="<?=__('请输入验证码')?>" id="bind_access_token" class="capt_box remain_input" style="height:40px" autocomplete="off" ></label>
                        <span class="remain">
                            <a title="<?=__('发送邮件')?>" class="verify-sendbtn-email-again" id="send-verify"><?=__('发送邮件')?></a>
                            <a class="verify-again"  title="<?=__('重新发送')?>"  style="display:none;background-color: rgb(236,236,236);color:rgb(180,180,180)" id="send-verify-again" autocomplete="off" disableautocomplete="true"><?=__('重新发送(')?><span id="send-again-span"><?=__('60')?></span><?=__(')')?></a>
                        </span>
                    
                    </div>
                    <div style="display:none;" class="err_tip empty_capt err_tip_independ" _text="<?=__('请输入验证码')?>"><?=__('请输入验证码')?></div>
                    <div style="display:none;" class="err_tip wng_capt err_tip_independ" _text="<?=__('验证码错误或已过期')?>"><?=__('验证码错误或已过期')?></div>

                </div>
                <div class="tip_btns">
                    <a class="btn_tip btn_commom email"  title="<?=__('确定')?>"><?=__('确定')?></a>
                    <a class="btn_tip btn_back btn-close"  title="<?=__('取消')?>"><?=__('取消')?></a>
                </div>
                <div class="txt_qst" style="margin-top:30px"><em class="icon_qst"></em><a target="_blank"  title="<?=__('一直收不到验证邮件')?>"><?=__('一直收不到验证邮件')?></a></div>
            </dl>
            <dl style="display:none;" class="success">
                <div class="t_c">
                    <h4 style="text-align:center"><?=__('您已成功绑定安全邮箱！')?></h4>
                </div>
                <div class="tip_btns wap_btn_abs">
                    <a class="btn_tip btn_commom btn-close" title="<?=__('返回我的帐号')?>"><?=__('返回我的帐号')?></a>
                </div>
            </dl>
        </div>
        </form>
    </div>
</div>
