
<div class="modal_tip_hd modal-header">
    <div class="modal-header-text modal_tip_title"><?=__('帐号安全验证')?></div>
</div>
<div class="modal_tip_bd modal-body mod_tip_bd" >
    <div id="verify-mod-container">
        <div id="verify-mod-SMS" style="display: block;">
            <div class="disten30x103">
                <h6><?=__('请使用安全手机')?><em class="ff6 verify-masked"><?= substr($data['user_mobile'],0,3).'******'.substr($data['user_mobile'],9,2)?></em><?=__('获取验证码短信')?></h6>
                <div class="mod inputsend ">
                    <label class="input_bg">
                        <input class="resendinput" id="mobile-check-code" type="text" rule="^\d{6,8}$" name="ticket" style="height:40px" placeholder="<?=__('请输入短信验证码')?>">
                    </label>
                                        <span class="remain">
                                            <a href="javascript:void(0)" title="<?=__('发送短信')?>" class="verify-sendbtn-mobile"><?=__('发送短信')?></a>
                                        </span>
                </div>
                <div class="codetip mar10 captcha-box">
                </div>

                <div class="err_tip" style="display: none;">
                    <em class="icon_error"></em>
                    <span class="verify-error-con"><?=__('验证码输入错误')?></span>
                    <span class="verify-error-con empty-check-code"><?=__('请输入验证码')?></span>
                </div>
                <div class="err_tip send_left_times"></div>
                <div class="txt_link">
                                        <span class="verify-unavailable" style="display:none">
                                            <em class="acctip_icon icon_qst"></em><?=__('一直收不到验证短信？')?><a target="_blank" href="#"><?=__('查看可能原因')?></a>
                                        </span>
                </div>
            </div>
            <div class="tip_btns">
                <a class="btn_tip btn_commom btn-submit" href="javascript:void(0)" title="<?=__('确定')?>"><?=__('确定')?></a>
            </div>


            <div class="fixbottom" style="text-align:center">
                <div class="t_c">
                    <a href="javascript:void(0)" class="next_step verify-into-list" title="<?=__('换用其他验证方式')?>"><?=__('换用其他验证方式')?></a>
                </div>
            </div>



        </div>
    </div>
</div>
