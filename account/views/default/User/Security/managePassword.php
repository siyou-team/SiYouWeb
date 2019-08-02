<div id="password" class="mod_acc_tip"  style="width:440px;height:440px">
    <div class="mod_tip_hd modal_tip_hd modal-header">
        <div class="modal-header-text modal_tip_title"><?=__('修改密码')?></div>
    </div>
    <form id="password-form">
        <div class="mod_tip_bd">
            <div class="modify_pwd">
                <dl>
                    <dt><?=__('原密码')?></dt>
                    <dd class="grpOldPass">
                        <label class="labelbox"><input class="oldPass" style="height:40px" name="user_password" type="password" id="old_password" placeholder="<?=__('输入原密码')?>" autocomplete="off" disableautocomplete=""></label>
                        <!-- 错误信息提示 -->
                        <div class="wng_pwd err_tip err_tip_independ" style="display:none;" _text="<?=__('原密码不正确')?>"><?=__('原密码不正确')?></div>
                        <div class="empty_pwd err_tip err_tip_independ" style="display:none;" _text="<?=__('原密码不能为空')?>"><?=__('原密码不能为空')?></div>
                    </dd>
                    <dt><?=__('新密码')?></dt>
                    <dd class="grpOldPass">
                        <label class="labelbox"><input class="newPass" style="height:40px" id="new_pass1" type="password" placeholder="<?=__('输入新密码')?>" autocomplete="off" disableautocomplete=""></label>
                        <!-- 错误信息显示时隐藏 -->
                        <div class="empty_pwd err_tip_independ err_tip" style="display:none;" _text="<?=__('新密码不能为空')?>"><?=__('新密码不能为空')?></div>
                        <div class="pwd_fmt err_tip_independ err_tip" style="display:none;" _text="<?=__('密码长度8~16位，其中数字，字母和符号至少包含两种')?>"><?=__('密码长度8~16位，其中数字，字母和符号至少包含两种')?></div>
                        <!-- 错误信息显示时隐藏 -->
                    </dd>
                    <dt><?=__('重复密码')?></dt>
                    <dd class="grpNewPass">
                        <label class="labelbox"><input class="newPass2" style="height:40px" id="new_pass2" type="password" placeholder="<?=__('重复新密码')?>" autocomplete="off" disableautocomplete=""></label>
                        <!-- 错误信息显示时隐藏 -->
                        <div class="pwd_mismatch err_tip_independ err_tip" style="display:none;" _text="<?=__('两次输入的新密码不一致')?>"><?=__('两次输入的新密码不一致')?></div>
                        <!-- 错误信息显示时隐藏 -->
                        <div class="empty_pwd2 err_tip_independ err_tip" style="display:none;" _text="<?=__('请重复新密码')?>"><?=__('请重复新密码')?></div>
                        <!-- 错误信息显示时隐藏 -->
                        <div class="same_pwd err_tip_independ err_tip" style="display:none;" _text="<?=__('不能与原密码相同')?>"><?=__('不能与原密码相同')?></div>
                        <!-- 错误信息显示时隐藏 -->
                        <div class="too_much err_tip_independ err_tip" style="display:none;" _text="<?=__('您的操作频率过快，请稍后再试。')?>"><?=__('您的操作频率过快，请稍后再试。')?>x</div>
                        <!-- 错误信息显示时隐藏 -->
                        <div class="eq_email err_tip_independ err_tip" style="display:none;" _text="<?=__('密码不能与邮箱相同')?>"><?=__('密码不能与邮箱相同')?></div>
                        <div class="pwd_in_black err_tip_independ err_tip" style="display:none;" _text="<?=__('您的密码可能存在安全风险，请您重新设置一个全新的密码')?>"><?=__('您的密码可能存在安全风险，请您重新设置一个全新的密码')?></div>

                        <div class="pwd_risk_error err_tip_independ err_tip" style="display:none;" _text="<?=__('新密码不能包含帐号，绑定手机，绑定邮箱')?>"><?=__('新密码不能包含帐号，绑定手机，绑定邮箱')?></div>
                        <!-- 错误信息提示去掉class=txt_tip -->
                        <div class="txt_tip" _text="<?=__('密码长度8~16位，其中数字，字母和符号至少包含两种')?>"><?=__('密码长度8~16位，其中数字，字母和符号至少包含两种')?></div>

                    </dd>
                    <!--3次后弹出-->
                    <?php $rand_key = rand();?>
                    <dl class="capt_box" style="display: block;">
                        <span></span>
                        <dt><?=__('验证码')?></dt>
                        <dd class="inputcode">
                            <div class="form-group input-group">
                                <input type="text" class="form-control no-right-border verify-input" name="verify_code" id="verify_code" placeholder="<?=__('验证码')?>"  autocomplete="off"  />
                                <span class="input-group-addon verify_code" id="verify_code_mobile" style="cursor: pointer;background:url('<?= urlh('account.php', 'VerifyCode', 'image', '', '', array('rand_key' => $rand_key)) ?>') no-repeat center;background-size:cover;">
                                    <p style="width:100px;"></p>
                                    <input type="hidden" name="rand_key" id="rand_key" value="<?=$rand_key?>">
                                </span>

                            </div>
                        </dd>
                        <div style="display:none;" class="wng_capt err_tip err_tip_independ" _text="<?=__('验证码不正确，请重新输入')?>"><?=__('验证码不正确，请重新输入')?></div>
                        <div style="display:none;" class="empty_capt err_tip err_tip_independ" _text="请输入图片验证码"><?=__('请输入图片验证码')?></div>
                    </dl>
                </dl>
            </div>
            <div class="tip_btns">
                <a class="btn_tip btn_commom btnOK password" title="<?=__('确定')?>"><?=__('确定')?></a>
                <a class="btn_tip btn_back btnCancel"  title="<?=__('取消')?>"><?=__('取消')?></a>
            </div>
        </div>
    </form>
</div>