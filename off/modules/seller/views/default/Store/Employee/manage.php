<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<style type="text/css">
    body {
        background-color: #fff;
        min-width: 200px;
    }
</style>
<div id="manage-wrap">
    <div class="manage-edit-box">
        <div class="box-main">
            <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form">
                <input type="hidden" class="input-text form-control" name="user_id" id="user_id" autocomplete="off" />
                <input type="hidden" class="input-text form-control" name="employee_id" id="employee_id" autocomplete="off" />

                <div class="form-section">
                    <label class="input-label" for="user_account">用户名</label>
                    <input type="text" class="input-text form-control" name="user_account" id="user_account"  placeholder="用户名" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="user_password">密码</label>
                    <input type="text" class="input-text form-control" name="user_password" id="user_password"  placeholder="密码" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="user_nickname"> 用户昵称</label>
                    <input type="text" class="input-text form-control" name="user_nickname" id="user_nickname"  placeholder=" 用户昵称" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label title="锁定" for="user_state_0"><input class="cbr cbr-success" id="user_state_0" name="user_state" value="0" type="radio"  >锁定</label>
                    <label title="未激活" for="user_state_1"><input class="cbr cbr-success" id="user_state_1" name="user_state" value="1" type="radio" checked >未激活</label>
                    <label title="已激活" for="user_state_2"><input class="cbr cbr-success" id="user_state_2" name="user_state" value="2" type="radio"  >已激活</label>
                </div>

                <!--<div class="form-section">
                    <label class="input-label" for="rights_group_id"><?/*=__('权限组')*/?></label>
                    <input type="text" class="input-text form-control" name="rights_group_id" id="rights_group_id"  placeholder="<?/*=__('权限组(DOT)')*/?>" autocomplete="off" />
                </div>
                
                <div class="form-section">
                    <label class="input-label" for="user_type_id"><?/*=__('用户类别')*/?></label>
                    <input type="text" class="input-text form-control" name="user_type_id" id="user_type_id"  placeholder="<?/*=__('用户类别')*/?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="user_level_id"><?/*=__('用户等级')*/?></label>
                    <input type="text" class="input-text form-control" name="user_level_id" id="user_level_id"  placeholder="<?/*=__('用户等级')*/?>" autocomplete="off" />
                </div>-->
                
                <!--<div class="form-section">
                    <label class="input-label" for="user_group"><?/*=__('用户组')*/?></label>
                    <input type="text" class="input-text form-control" name="user_group" id="user_group"  placeholder="<?/*=__('用户组')*/?>" autocomplete="off" />
                </div>-->
                <div class="form-group-separator111"></div>
                <div class="form-group">
                    <label class="control-label" for="user_avatar">头像</label>
                    <div class="inline">
                        <a href="#"  data-toggle="image" class="img-thumbnail picture_upload_replace" id="voucher_image_upload_replace_id" data-target="user_avatar">
                            <input type="hidden" class="form-control" name="user_avatar" id="user_avatar"
                                   value="" placeholder="头像" autocomplete="off"/>
                            <img  src=""  data-placeholder="" width="50" height="50" data-toggle="tooltip" /></a>
                    </div>
                    <div class="btn btn-default btn-primary J_choosePic">从图片空间选择</div>
                </div>
                <!--<div class="form-section">
                    <label class="input-label" for="user_avatar"><?/*=__('头像')*/?></label>
                    <input type="text" class="input-text form-control" name="user_avatar" id="user_avatar"  placeholder="<?/*=__('头像')*/?>" autocomplete="off" />
                </div>-->
                <div class="form-section radio-inline">
                    <label class="input-label hide" for="user_gender"><?=__('性别')?></label>
                    <label title="男" for="user_gender_1"><input class="cbr cbr-success form-control" id="user_gender_1" name="user_gender" value="1" type="radio" checked >男</label><label title="女" for="user_gender_2"><input class="cbr cbr-success form-control" id="user_gender_2" name="user_gender" value="2" type="radio"  >女</label>
                </div>
                <!--<div class="form-section">
                    <label class="input-label" for="user_realname"><?/*=__('真实姓名')*/?></label>
                    <input type="text" class="input-text form-control" name="user_realname" id="user_realname"  placeholder="<?/*=__('真实姓名')*/?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="user_birthday"><?/*=__('生日')*/?></label>
                    <input type="text" class="input-text form-control" name="user_birthday" id="user_birthday"  placeholder="<?/*=__('生日(DATE)')*/?>" autocomplete="off" />
                </div>-->
                <div class="form-section">
                    <label class="input-label" for="user_mobile"><?=__('手机号码')?></label>
                    <input type="text" class="input-text form-control" name="user_mobile" id="user_mobile"  placeholder="<?=__('手机号码(mobile)')?>" autocomplete="off" />
                </div>
                <!--<div class="form-section">
                    <label class="input-label" for="user_tel"><?/*=__('电话')*/?></label>
                    <input type="text" class="input-text form-control" name="user_tel" id="user_tel"  placeholder="<?/*=__('电话')*/?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="user_email"><?/*=__('用户邮箱')*/?></label>
                    <input type="text" class="input-text form-control" name="user_email" id="user_email"  placeholder="<?/*=__('用户邮箱(email)')*/?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="user_qq"><?/*=__('QQ')*/?></label>
                    <input type="text" class="input-text form-control" name="user_qq" id="user_qq"  placeholder="<?/*=__('QQ')*/?>" autocomplete="off" />
                </div>-->
                <!--<div class="form-section">
                    <label class="input-label" for="user_ww"><?/*=__('阿里旺旺')*/?></label>
                    <input type="text" class="input-text form-control" name="user_ww" id="user_ww"  placeholder="<?/*=__('阿里旺旺')*/?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="user_idcard"><?/*=__('身份证')*/?></label>
                    <input type="text" class="input-text form-control" name="user_idcard" id="user_idcard"  placeholder="<?/*=__('身份证')*/?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="user_province_id"><?/*=__('省')*/?></label>
                    <input type="text" class="input-text form-control" name="user_province_id" id="user_province_id"  placeholder="<?/*=__('省')*/?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="user_city_id"><?/*=__('城市')*/?></label>
                    <input type="text" class="input-text form-control" name="user_city_id" id="user_city_id"  placeholder="<?/*=__('城市')*/?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="user_county_id"><?/*=__('县')*/?></label>
                    <input type="text" class="input-text form-control" name="user_county_id" id="user_county_id"  placeholder="<?/*=__('县')*/?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="user_address"><?/*=__('详细地址')*/?></label>
                    <input type="text" class="input-text form-control" name="user_address" id="user_address"  placeholder="<?/*=__('详细地址')*/?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="user_sign"><?/*=__('签名')*/?></label>
                    <input type="text" class="input-text form-control" name="user_sign" id="user_sign"  placeholder="<?/*=__('签名')*/?>" autocomplete="off" />
                </div>-->
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= $this->js('plugins/plupload/plupload.full.min', true) ?>"></script>
<script type="text/javascript" src="<?= $this->js('img-upload') ?>"></script>
<script src="<?=$this->js('modules/seller/product/product_select_pic')?>"></script>
<script type="text/javascript" src="<?=$this->js('modules/seller/store/store_employee_manage')?>" charset="utf-8"></script>

