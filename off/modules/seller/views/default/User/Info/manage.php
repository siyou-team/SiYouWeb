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
                <input type="hidden" class="input-text form-control" name="user_id" id="user_id"  placeholder="用户id" autocomplete="off" />

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
                
               <!-- <div class="form-section">
                    <label class="input-label" for="user_group">用户组</label>
                    <input type="text" class="input-text form-control" name="user_group" id="user_group"  placeholder="用户组" autocomplete="off" />
                </div>-->

                <!--<div class="form-group">
                    <label class="col-sm-2 control-label" for="product_image">商品主图</label>
                    <div class="inline">
                        <a href="#"  data-toggle="image" class="img-thumbnail  picture_upload_replace" id="picture_upload_replace_id" data-target="product_image">
                            <input type="hidden" class="form-control" name="product_image" id="product_image"
                                   value="<?/*= @$product['product_image'] */?>" placeholder="商品单价" autocomplete="off"/>
                            <img src="<?/*= @$product['product_image'] */?>"  data-placeholder="" width="100" height="100" data-toggle="tooltip" /></a>
                    </div>
                    <div class="btn btn-default btn-primary J_choosePic">从图片空间选择</div>
                </div>
                <div class="form-section">
                    <label class="input-label" for="user_avatar">头像</label>
                    <input type="text" class="input-text form-control" name="user_avatar" id="user_avatar"  placeholder="头像" autocomplete="off" />
                </div>-->

                <div class="form-section radio-inline">
                    <label class="input-label hide" for="brand_show_type"><?=__('性别')?></label>
                    <label title="男" for="user_gender_1"><input class="cbr cbr-success form-control" id="user_gender_1" name="user_gender" value="1" type="radio" checked >男</label>
                    <label title="女" for="user_gender_2"><input class="cbr cbr-success form-control" id="user_gender_2" name="user_gender" value="2" type="radio"  >女</label>
                </div>
                <div class="form-section">
                    <label class="input-label" for="user_realname">真实姓名</label>
                    <input type="text" class="input-text form-control" name="user_realname" id="user_realname"  placeholder="真实姓名" autocomplete="off" />
                </div>

                <!--<div class="form-section">
                    <label class="input-label" for="user_birthday">生日</label>
                    <input type="text" class="input-text form-control datepicker" name="user_birthday" id="user_birthday"  placeholder="生日(DATE)" autocomplete="off" />
                </div>


                <div class="form-section">
                    <label class="input-label" for="user_idcard">身份证</label>
                    <input type="text" class="input-text form-control" name="user_idcard" id="user_idcard"  placeholder="身份证" autocomplete="off" />
                </div>-->

            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?=$this->js('modules/seller/user/info')?>" charset="utf-8"></script>

