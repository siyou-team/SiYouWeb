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
                <input type="hidden" class="input-text form-control" name="distributor_level_id" id="distributor_level_id"  placeholder="<?=__('等级ID')?>" autocomplete="off" />
                <div class="form-section">
                    <label class="input-label" for="distributor_leve_name"><?=__('等级名称')?></label>
                    <input type="text" class="input-text form-control" name="distributor_leve_name" id="distributor_leve_name"  placeholder="<?=__('等级名称')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="distributor_level_discount_rate"><?=__('等级折扣')?></label>
                    <input type="text" class="input-text form-control" name="distributor_level_discount_rate" id="distributor_level_discount_rate"  placeholder="<?=__('等级折扣')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="distributor_level_order"><?=__('等级排序')?></label>
                    <input type="text" class="input-text form-control" name="distributor_level_order" id="distributor_level_order"  placeholder="<?=__('等级排序')?>" autocomplete="off" />
                </div>

            </form>
        </div>
    </div>
</div>
<script src="<?=$this->js('modules/seller/supplier/supplier_grade')?>"></script>