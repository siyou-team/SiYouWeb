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
                <input type="hidden" class="input-text form-control" name="return_id" id="return_id"  placeholder="<?=__('退单号')?>" autocomplete="off" />
                <div class="form-section">
                    <label class="input-label" for="return_number"><?=__('退货编号')?></label>
                    <input type="text" class="input-text form-control" name="return_number" id="return_number"  placeholder="<?=__('退货编号')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="service_type_id"><?=__('服务类型')?></label>
                    <input type="text" class="input-text form-control" name="service_type_id" id="service_type_id"  placeholder="<?=__('服务类型')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="order_id"><?=__('订单编号')?></label>
                    <input type="text" class="input-text form-control" name="order_id" id="order_id"  placeholder="<?=__('订单编号')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="order_number"><?=__('订单编号')?></label>
                    <input type="text" class="input-text form-control" name="order_number" id="order_number"  placeholder="<?=__('订单编号')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="order_amount"><?=__('订单总额')?></label>
                    <input type="text" class="input-text form-control" name="order_amount" id="order_amount"  placeholder="<?=__('订单总额')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="order_item_ids"><?=__('退货商品编号')?></label>
                    <input type="text" class="input-text form-control" name="order_item_ids" id="order_item_ids"  placeholder="<?=__('0为退款')?>" autocomplete="off" />
                </div>
        </div>
    </div>
</div>
<script src="<?=$this->js('modules/seller/supplier/supplier_index')?>"></script>