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
                <input type="hidden" class="input-text form-control" name="user_id" id="user_id"  placeholder="<?=__('用户ID')?>" autocomplete="off" />
                <div class="form-section">
                    <label class="input-label" for="user_account"><?=__('用户名')?></label>
                    <input type="text" class="input-text form-control" name="user_account" id="user_account"  placeholder="<?=__('用户名')?>" autocomplete="off" />
                </div>

                
                <div class="form-section">
                    <label class="input-label" for="user_password"><?=__(' 用户密码')?></label>
                    <input type="text" class="input-text form-control" name="user_password" id="user_password"  placeholder="<?=__(' 用户密码')?>" autocomplete="off" />
                </div>
                


                <div class="form-section">
                    <label class="input-label" for="rights_group_id"><?=__('权限组')?></label>
                    <input type="text" class="input-text form-control" multiple name="rights_group_id" id="rights_group_id"  placeholder="<?=__('权限组(DOT)')?>" autocomplete="off" />
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?=$this->js('controllers/user/user_base')?>"></script>
