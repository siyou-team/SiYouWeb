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

                <div class="form-section">
                    <label class="input-label" for="user_nickname"><?=__('门店管理员账号')?></label>
                    <input type="text" class="input-text form-control" name="user_nickname"  placeholder="<?=__('门店管理员账号')?>" autocomplete="off" />
                </div>

                <div class="form-section">
                    <label class="input-label" for="user_password"><?=__('门店管理员密码')?></label>
                    <input type="text" class="input-text form-control" name="user_password"  placeholder="<?=__('门店管理员密码')?>" autocomplete="off" />
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    user_nickname = '';
    user_password = '';
    $('[name="user_nickname"]').bind('input propertychange', function() {
        window.user_nickname = $(this).val()
    });
    $('[name="user_password"]').bind('input propertychange', function() {
        window.user_password = $(this).val()
    });

</script>
<script src="<?= $this->js('modules/seller/chain/chain_base') ?>"></script>