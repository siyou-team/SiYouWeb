<?php
$rand_key = rand();
?>
<link rel="stylesheet" href="<?=$this->css('security')?>">
<style>
    @media screen and (max-width: 768px) {
        .signin-info ul {
            display: none
        }
    }

    .verify_code{
        cursor: pointer;background:url('<?=Zero_Registry::get('url')?>?ctl=VerifyCode&met=image&rand_key=<?=$rand_key?>') no-repeat center;background-size:cover;
    }

    h1, h2, h3, h4, h5, h6 {
        font-size: 100%;
        font-weight:bold;
    }

    h6 {
        display: block;
        font-size: 15px;
    }
    
</style>

<div class="n-frame">
    <ul class="device-detail-area">
        <li id="changePassword" class="click-row" >
            <div class="font-img-item clearfix">
                <em class="fi-ico fa fa-cog " ></em>
                <p class="title-normal dis-inb"><?=__('实名认证')?>

                    <?php if (0 == $data['user_certification']):?>
                    <span id="certification">
                        <span class="warning-tip">&nbsp;</span>
                        <span class="color-active"><?= __('未认证') ?></span>
                    </span>
                    <?php elseif (1 == $data['user_certification']):?>
                    <?php elseif (2 == $data['user_certification']):?>
                    <span id="certification">
                        <span class="warning-tip">&nbsp;</span>
                        <span class="color-active"><?= __('待审核') ?></span>
                    </span>
                    <?php  endif; ?>
                </php>
                <p class="font-default">
                    <?=__('用于提升账号的安全性和信任级别。认证后的账号不能修改认证信息。')?>
                </p>
                <i class="arrow_r"></i>
            </div>

            <div class="ada-btn-area" >
                <?php if ($data['user_certification']) :?>
                    <a class="n-btn" href="<?=urlh('account.php', 'User_Security', 'certification')?>"><?=__('查看')?></a>
                <?php else:?>
                    <a class="n-btn"  href="<?=urlh('account.php', 'User_Security', 'certification')?>"><?=__('认证')?></a>
                <?php endif;?>
            </div>
        </li>
        <li id="changePassword" class="click-row" >
            <div class="font-img-item clearfix">
                <em class="fi-ico fa fa-lock" ></em>
                <p class="title-normal dis-inb"><?=__('帐号密码')?></p>
                <p class="font-default">
                    <?=__('用于保护帐号信息和登录安全')?>
                </p>
                <i class="arrow_r"></i>
            </div>

            <div class="ada-btn-area" >

                <a class="n-btn btnChangeMobile"  id="passwd-manage"   data-fancybox data-type="ajax"  data-src="<?=urlh('account.php', 'User_Security', 'checkSecurityChange', null , '_pjax=1')?>"><?=__('修改')?></a>

            </div>
        </li>
        <li id="changeEmail" class="click-row">


            <div class="font-img-item clearfix">
                <em class="fi-ico fa fa-envelope-o"></em>
                
                <?php
                $email_span_bind = in_array(User_BindConnectModel::EMAIL, $data['bind_type_row'])?'inline-block':'none';
                
                $email_span_unbind = in_array(User_BindConnectModel::EMAIL, $data['bind_type_row'])?'none':'inline-block';
                $email_bind = in_array(User_BindConnectModel::EMAIL, $data['bind_type_row'])?'block':'none';
                $email_unbind = in_array(User_BindConnectModel::EMAIL, $data['bind_type_row'])?'none':'block';
                ?>

                <p class="title-normal dis-inb"><?=__('安全邮箱')?> <?=@$data[User_BindConnectModel::EMAIL]?>
                    <span id="email_span_unbind" style="display:<?=$email_span_unbind?>">
                                    <span class="warning-tip">&nbsp;</span>
                                    <span class="color-active"><?=__('未绑定')?></span>
                                </span></p>

                <p class="font-default email-check" id="email_bind" style="display:<?=$email_bind?>"><?=__('安全邮箱可以用于登录帐号，重置密码或其他安全验证')?></p>


                <p class="font-default color-active " id="email_unbind" style="display:<?=$email_unbind?>"><?=__('安全邮箱将可用于登录帐号和重置密码，建议立即设置')?></p>

                <i class="arrow_r"></i>
            </div>


            <div class="ada-btn-area" >

                <a class="n-btn btnChangeMobile fancybox" id="email-manage" data-fancybox data-type="ajax"  data-src="<?=urlh('account.php', 'User_Security', 'manageEmail', null, '_pjax=1' )?>"><?=__(!in_array(User_BindConnectModel::EMAIL, $data['bind_type_row'])?'绑定':'修改')?></a>


            </div>


        </li>
       
<!--        <li id="changeMobile" class="click-row">-->
<!--            <div class="font-img-item clearfix">-->
<!--                <em class="fi-ico fa fa-mobile"></em>-->
<!--                --><?php
//                $mobile_span_bind = in_array(User_BindConnectModel::MOBILE, $data['bind_type_row'])?'inline-block':'none';
//                $mobile_span_unbind =in_array(User_BindConnectModel::MOBILE, $data['bind_type_row'])?'none':'inline-block';
//                $mobile_bind = in_array(User_BindConnectModel::MOBILE, $data['bind_type_row'])?'block':'none';
//                $mobile_unbind = in_array(User_BindConnectModel::MOBILE, $data['bind_type_row'])?'none':'block';
//
//                ?>
<!---->
<!--                <p class="title-normal dis-inb">--><?//=__('安全手机')?><!-- --><?//=@$data[User_BindConnectModel::MOBILE]?>
<!--                    <span id="mobile_span_unbind" style="display:--><?//=$mobile_span_unbind?><!--">-->
<!--                                        <span class="warning-tip"  >&nbsp;</span>-->
<!--                                        <span class="color-active" >--><?//=__('未绑定')?><!--</span>-->
<!--                                    </span></p>-->
<!--                <p class="font-default mobile-check" id="mobile_bind" style="display:--><?//=$mobile_bind?><!--">--><?//=__('安全手机可以用于登录帐号，重置密码或其他安全验证')?><!--</p>-->
<!---->
<!---->
<!---->
<!--                <p class="font-default color-active" id="mobile_unbind" style="display:--><?//=$mobile_unbind?><!--">--><?//=__('安全邮箱将可用于登录帐号和重置密码，建议立即设置')?><!--</p>-->
<!---->
<!---->
<!--                <i class="arrow_r"></i>-->
<!--            </div>-->
<!--            <div class="ada-btn-area mobile-check"   >-->
<!---->
<!--                <a class="n-btn btnChangeMobile fancybox" id="mobile-manage" data-fancybox data-type="ajax"  data-src="--><?//=urlh('account.php', 'User_Security', 'manageMobile', null , '_pjax=1')?><!--">--><?//=__(!in_array(User_BindConnectModel::MOBILE, $data['bind_type_row'])?'绑定':'修改')?><!--</a>-->
<!---->
<!--            </div>-->
<!---->
<!--        </li>-->

    </ul>
</div>

<a class="fancybox hide"  id="verity-change-email" data-fancybox data-type="ajax"  data-src="<?=urlh('account.php', 'User_Security', 'verifyEmail', null, '_pjax=1' )?>"><?=__(!in_array(User_BindConnectModel::EMAIL, $data['bind_type_row'])?'绑定':'修改')?></a>

<a class="fancybox hide"  id="verity-change-mobile" data-fancybox data-type="ajax"  data-src="<?=urlh('account.php', 'User_Security', 'verifyMobile', null, '_pjax=1' )?>"><?=__(!in_array(User_BindConnectModel::MOBILE, $data['bind_type_row'])?'绑定':'修改')?></a>

<?php $this->lazyJs('security-index') ?>


