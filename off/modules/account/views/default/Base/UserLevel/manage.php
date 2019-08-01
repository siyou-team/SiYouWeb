<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<div id="manage-wrap">
    <div class="manage-edit-box">
        <div class="box-main">
            <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form">
                <input type="hidden" class="input-text form-control" name="user_level_id" id="user_level_id"  placeholder="<?=__('')?>" autocomplete="off" />
                <div class="form-section">
                    <label class="input-label" for="user_level_name"><?=__('等级名称')?></label>
                    <input type="text" class="input-text form-control" name="user_level_name" id="user_level_name"  placeholder="<?=__('等级名称')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="user_level_exp"><?=__('经验值')?></label>
                    <input type="text" class="input-text form-control" name="user_level_exp" id="user_level_exp"  placeholder="<?=__('经验值')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="user_level_logo"><?=__('LOGO')?></label>
                    <input type="text" class="input-text form-control" name="user_level_logo" id="user_level_logo"  placeholder="<?=__('LOGO')?>" autocomplete="off" />
                </div>
                <div class="form-section hide">
                    <label class="input-label" for="user_level_rate"><?=__('折扣率')?></label>
                    <input type="text" class="input-text form-control" name="user_level_rate" id="user_level_rate"  placeholder="<?=__('折扣率')?>" autocomplete="off" />
                </div>

            </form>
        </div>
    </div>
</div>
<script src="<?=$this->js('modules/account/base/base_user_level')?>"></script>