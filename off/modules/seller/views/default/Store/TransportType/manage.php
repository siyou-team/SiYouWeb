<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>


<div id="manage-wrap">
    <div class="manage-edit-box">
        <div class="box-main">
            <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form">
                <input type="hidden" class="input-text form-control" name="transport_type_id" id="transport_type_id"  placeholder="<?=__('物流及售卖区域id')?>" autocomplete="off" />
                <div class="form-section">
                    <label class="input-label" for="transport_type_name"><?=__('模板名称')?></label>
                    <input type="text" class="input-text form-control" name="transport_type_name" id="transport_type_name"  placeholder="<?=__('模板名称')?>" autocomplete="off" />
                </div>

                <div class="form-section  radio-inline">
                    <label class="input-label" for="transport_type_pricing_method"></label>
                    <label title="按件数" for="transport_type_pricing_method_1"><input class="cbr cbr-success form-control" id="transport_type_pricing_method_1" name="transport_type_pricing_method" value="1" type="radio" checked >按件数</label><label title="按重量" for="transport_type_pricing_method_2"><input class="cbr cbr-success form-control" id="transport_type_pricing_method_2" name="transport_type_pricing_method" value="2" type="radio"  >按重量</label><label title="按体积" for="transport_type_pricing_method_3"><input class="cbr cbr-success form-control" id="transport_type_pricing_method_3" name="transport_type_pricing_method" value="3" type="radio"  >按体积</label>
                </div>
                
                <div class="form-section">
                    <input id="transport_type_free" name="transport_type_free" type="checkbox" value="1"  data-on-text="全免（不限制地区且免运费）" data-off-text="不全免">
                </div>
                
                <div class="form-section">
                    <label class="input-label" for="transport_type_freight_free"><?=__('运费额度，如果全免则此处设置不起作用')?></label>
                    <input type="text" class="input-text form-control" name="transport_type_freight_free" id="transport_type_freight_free"  placeholder="<?=__('运费额度')?>" autocomplete="off" />
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?=$this->js('modules/seller/store_transport_type')?>"></script>
