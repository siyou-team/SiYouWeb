<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<div id="manage-wrap">
    <div class="manage-edit-box">
        <div class="box-main">
            <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form">
                <input type="hidden" class="input-text form-control" name="return_id" id="return_id"  placeholder="<?=__('退单号')?>" autocomplete="off" />

                <div class="form-section">
                    <label class="input-label hide" for="return_flag"><?=__('退货类型')?></label>
                    <label title="不用退货" for="return_flag_0"><input class="cbr cbr-success form-control" id="return_flag_0" name="return_flag" value="0" type="radio"  >不用退货</label><label title="需要退货" for="return_flag_1"><input class="cbr cbr-success form-control" id="return_flag_1" name="return_flag" value="1" type="radio" checked >需要退货</label>
                </div>
                <div class="form-section">
                    <label class="input-label" for="return_store_message"><?=__('商家备注')?></label>
                    <input type="text" class="input-text form-control" name="return_store_message" id="return_store_message"  placeholder="<?=__('商家备注')?>" autocomplete="off" />
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?=$this->js('modules/seller/order/return_review')?>"></script>