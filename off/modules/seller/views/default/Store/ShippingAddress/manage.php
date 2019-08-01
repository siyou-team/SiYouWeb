<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<style type="text/css">
    body {
        background-color: #fff;
        min-width: 200px;
    }
</style>
<link rel="stylesheet" href="<?=$this->css('plugins/citypicker/css/city-picker', true)?>">
<div id="manage-wrap">
    <div class="manage-edit-box">
        <div class="box-main">
            <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form">
                <input type="hidden" class="input-text form-control" name="ss_id" id="ss_id"  placeholder="<?=__('地址Id')?>" autocomplete="off" />
                <div class="form-section">
                    <label class="input-label" for="ss_name"><?=__('联系人')?></label>
                    <input type="text" class="input-text form-control" name="ss_name" id="ss_name"  placeholder="<?=__('联系人')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="ss_mobile"><?=__('手机号码')?></label>
                    <input type="text" class="input-text form-control" name="ss_mobile" id="ss_mobile"  placeholder="<?=__('手机号码')?>" autocomplete="off" />
                </div>
                <div class="form-section">

                    <div class="">
                        <input type="text" class="form-control" name="ss_district_info" id="ss_district_info" value=""  placeholder="<?=__('请输入发货地址')?>" autocomplete="off"  data-rule="<?=__('收货地址')?>:required" required readonly  />
                    </div>
                </div>
                <input type="hidden" class="input-text form-control" name="ss_province_id" id="ss_province_id" />
                <input type="hidden" class="input-text form-control" name="ss_province" id="ss_province" />
                <input type="hidden" class="input-text form-control" name="ss_city_id" id="ss_city_id" />
                <input type="hidden" class="input-text form-control" name="ss_city" id="ss_city" />
                <input type="hidden" class="input-text form-control" name="ss_county_id" id="ss_county_id" />
                <input type="hidden" class="input-text form-control" name="ss_county" id="ss_county" />

                <div class="form-section">
                    <label class="input-label" for="ss_postalcode"><?=__('邮编')?></label>
                    <input type="text" class="input-text form-control" name="ss_postalcode" id="ss_postalcode"  placeholder="<?=__('邮编')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="ss_address"><?=__('详细地址-不必重复填写地区')?></label>
                    <input type="text" class="input-text form-control" name="ss_address" id="ss_address"  placeholder="<?=__('详细地址-不必重复填写地区')?>" autocomplete="off" />
                </div>

                <div class="form-section radio-inline">
                    <label class="input-label hide" for="brand_show_type"><?=__('是否默认')?></label>
                    <label title="默认" for="ss_is_default_1"><input class="cbr cbr-success form-control" id="ss_is_default_1" name="ss_is_default" value="1" type="radio" checked >默认</label>
                    <label title="非默认" for="ss_is_default_0"><input class="cbr cbr-success form-control" id="ss_is_default_0" name="ss_is_default" value="0" type="radio"  >非默认</label>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="<?=$this->js('plugins/citypicker/js/city-picker.data', true)?>"></script>
<script src="<?=$this->js('plugins/citypicker/js/city-picker', true)?>"></script>
<script src="<?=$this->js('modules/seller/store/store_shipping_address')?>"></script>
<script>

</script>