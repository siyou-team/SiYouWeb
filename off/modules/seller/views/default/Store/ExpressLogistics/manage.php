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
                <input type="hidden" class="input-text form-control" name="logistics_id" id="logistics_id"  placeholder="<?=__('物流Id')?>" autocomplete="off" />

                <div class="form-section">
                    <label class="input-label" for="logistics_name"><?=__('物流名称')?></label>
                    <input type="text" class="input-text form-control" name="logistics_name" id="logistics_name"  placeholder="<?=__('物流名称')?>" autocomplete="off" />
                </div>
                <div class="form-section hide">
                    <label class="input-label" for="logistics_pinyin"><?=__('物流')?></label>
                    <input type="text" class="input-text form-control" name="logistics_pinyin" id="logistics_pinyin"  placeholder="<?=__('物流')?>" autocomplete="off" />
                </div>
                <div class="form-section hide">
                    <label class="input-label" for="logistics_number"><?=__('物流公司编号')?></label>
                    <input type="text" class="input-text form-control" name="logistics_number" id="logistics_number"  placeholder="<?=__('物流公司编号')?>" autocomplete="off" />
                </div>
                <div class="form-section hide">
                    <label class="input-label" for="logistics_state"><?=__('电子面单状态')?></label>
                    <input type="text" class="input-text form-control" name="logistics_state" id="logistics_state"  placeholder="<?=__('电子面单状态')?>" autocomplete="off" />
                </div>

                <div class="form-section">
                    <span id="express_id"></span>
                </div>

                <div class="form-section">
                    <input id="logistics_is_default" name="logistics_is_default" type="checkbox" value="1"  data-on-text="默认" data-off-text="非默认">
                </div>
                <div class="form-section  hide">
                    <label class="input-label" for="logistics_tpl_item"><?=__('运单模板')?></label>
                    <input type="text" class="input-text form-control" name="logistics_tpl_item" id="logistics_tpl_item"  placeholder="<?=__('运单模板')?>" autocomplete="off" />
                </div>
                <div class="form-section  hide">
                    <label class="input-label" for="logistics_tpl_top"><?=__('运单模板上偏移量，单位为毫米mm')?></label>
                    <input type="text" class="input-text form-control" name="logistics_tpl_top" id="logistics_tpl_top"  placeholder="<?=__('运单模板上偏移量，单位为毫米mm')?>" autocomplete="off" />
                </div>
                <div class="form-section  hide">
                    <label class="input-label" for="logistics_tpl_left"><?=__('运单模板左偏移量，单位为毫米mm')?></label>
                    <input type="text" class="input-text form-control" name="logistics_tpl_left" id="logistics_tpl_left"  placeholder="<?=__('运单模板左偏移量，单位为毫米mm')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="logistics_phone"><?=__('联系电话')?></label>
                    <input type="text" class="input-text form-control" name="logistics_phone" id="logistics_phone"  placeholder="<?=__('联系电话')?>" autocomplete="off" />
                </div>
                <div class="form-section  hide">
                    <label class="input-label" for="logistics_mobile"><?=__('联系手机')?></label>
                    <input type="text" class="input-text form-control" name="logistics_mobile" id="logistics_mobile"  placeholder="<?=__('联系手机')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="logistics_contacter"><?=__('联系人')?></label>
                    <input type="text" class="input-text form-control" name="logistics_contacter" id="logistics_contacter"  placeholder="<?=__('联系人')?>" autocomplete="off" />
                </div>
                <div class="form-section  hide">
                    <label class="input-label" for="logistics_tax"><?=__('传真')?></label>
                    <input type="text" class="input-text form-control" name="logistics_tax" id="logistics_tax"  placeholder="<?=__('传真')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="logistics_address"><?=__('联系地址')?></label>
                    <input type="text" class="input-text form-control" name="logistics_address" id="logistics_address"  placeholder="<?=__('联系地址')?>" autocomplete="off" />
                </div>
                <div class="form-section  hide">
                    <label class="input-label" for="logistics_fee"><?=__('物流运费')?></label>
                    <input type="text" class="input-text form-control" name="logistics_fee" id="logistics_fee"  placeholder="<?=__('物流运费')?>" autocomplete="off" />
                </div>
                <div class="form-section radio-inline hide">
                    <label class="input-label hide" for="fee_type"><?=__('运费类型')?></label>
                </div>
                <div class="form-section">
                    <input id="logistics_is_enable" name="logistics_is_enable" type="checkbox" value="1" checked="checked" data-on-text="启用" data-off-text="禁用">
                </div>

            </form>
        </div>
    </div>
</div>

<script src="<?=$this->js('modules/seller/store/store_express_logistics')?>"></script>