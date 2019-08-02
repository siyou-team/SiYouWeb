
    <div class="modal_tip_hd modal-header">
        <div class="modal-header-text modal_tip_title"><?=__('帐号安全验证')?></div>

    </div>
    <div class="modal_tip_bd modal-body mod_tip_bd" >
        <div id="verify-mod-sendTicketTip-email">
            <div id="verify-mod-send_ticket_tip-email">
                <div class="identity_phone_effect">
                    <div class="disten20x10">
                        <h4 class="pb0 send-ticket-header"><?=__('为了保护帐号安全，需要验证邮箱有效性')?></h4>
                    </div>
                    <div class="description">
                        <p>

                            <span class="send-ticket-tip"><?=__('点击发送邮件按钮，将会发送一封有验证码的邮件至邮箱')?></span>
                            <span class="ff6 verify-masked"> <?= strHandel(User_BindConnectModel::EMAIL, $data[User_BindConnectModel::EMAIL])?></span>

                        </p>
                        <p class="send-ticket-prompt"></p>
                    </div>
                </div>
                <div class="tip_btns">
                    <button class="btn_tip btn_commom verify-sendbtn-email"><?=__('发送邮件')?></button>

                </div>

                <?php if(count($data) > 1): ?>
                    <div class="fixbottom" style="text-align:center">
                        <div class="t_c">
                            <a href="javascript:void(0)"  class="next_step verify-into-list"  id="verify-email" title="<?=__('短信验证')?>"><?=__('短信验证')?></a>

                        </div>
                    </div>
                <?php endif;?>
            </div>
        </div>
        <div id="verify-mod-container-email" style="display:none;text-align: center;width:330px;margin-left: -20px;height:150px">
            <div id="verify-mod-SMS" >
                <div class="disten30x103">
                    <h6><?=__('请使用安全邮箱')?><em class="ff6 verify-masked"><?= strHandel(User_BindConnectModel::EMAIL, $data[User_BindConnectModel::EMAIL])?></em><?=__('获取邮件')?></h6>
                    <div class="mod inputsend ">
                        <label class="input_bg">
                            <input class="resendinput" id="email-check-code" type="text" rule="^\d{6,8}$" name="ticket" style="height:40px" placeholder="<?=__('请输入验证码')?>">
                        </label>
                        <span class="remain">
                            <a href="javascript:void(0)" title="<?=__('发送邮件')?>" class="verify-sendbtn-email" id="send-verify"><?=__('发送邮件')?></a>
                            <a class="verify-again"  title="<?=__('重新发送')?>"  style="display:none;background-color: rgb(236,236,236);color:rgb(180,180,180)" id="send-verify-again" autocomplete="off" disableautocomplete="true"><?=__('重新发送(')?><span id="send-again-span"><?=__('60')?></span><?=__(')')?></a>

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
                            <em class="acctip_icon icon_qst"></em><?=__('一直收不到验证邮件？')?><a target="_blank" href="#"><?=__('查看可能原因')?></a>
                        </span>
                    </div>
                </div>
                <div class="tip_btns">
                    <a class="btn_tip btn_commom btn-submit"  href="javascript:void(0)" title="<?=__('确定')?>"><?=__('确定')?></a>
                </div>

                <?php if(count($data) > 1): ?>
                    <div class="fixbottom" style="text-align:center">
                        <div class="t_c">
                            <a href="javascript:void(0)"  class="next_step verify-into-list" id="verify-email" title="<?=__('短信验证')?>"><?=__('短信验证')?></a>

                        </div>
                    </div>
                <?php endif;?>

            </div>
        </div>
    </div>
