<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<style type="text/css">
    body {
        background-color: #fff;
        min-width: 200px;
    }
</style>
<div id="manage-wrap">
    <div class="manage-edit-box">
        <div class="box-main row">
            <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form" data-validator-option="{stopOnError:false, timely:false}">
                <input type="hidden" class="input-text form-control" name="activity_id" id="activity_id"  placeholder="<?=__('活动编号')?>" autocomplete="off" />
                <?php if(@i('activity_type_id')):?>
                    <input type="hidden" name="activity_type_id" value="<?=i('activity_type_id')?>" />
                <?php endif;?>

                <div class="form-section col-xs-12">
                    <label class="input-label" for="activity_title" title="<?=__('活动名称')?>" data-toggle="tooltip" ><?=__('活动名称')?></label>
                    <input type="text" class="input-text form-control" name="activity_title" id="activity_title"  placeholder="<?=__('活动名称')?>" data-rule="<?=__('活动名称')?>:required" required autocomplete="off" />
                </div>

                <div class="form-section col-xs-6">
                    <label class="input-label" for="activity_starttime" title="<?=__('开始时间发布之后不能修改')?>" data-toggle="tooltip" ><?=__('活动开始时间')?></label>
                    <input type="text" class="input-text form-control datepicker" name="activity_starttime" id="activity_starttime" <?php if(i('activity_id')){ echo 'disabled';}?> placeholder="<?=__('活动开始时间')?>" data-rule="<?=__('活动开始时间')?>:required" required autocomplete="off" />
                </div>

                <div class="form-section col-xs-6">
                    <label class="input-label" for="activity_endtime" title="<?=__('结束时间发布之后不能修改')?>" data-toggle="tooltip" ><?=__('活动结束时间')?></label>
                    <input type="text" class="input-text form-control datepicker" name="activity_endtime" id="activity_endtime"  placeholder="<?=__('活动结束时间')?>" <?php if(i('activity_id')){ echo 'disabled';}?> data-rule="<?=__('活动结束时间')?>:required" required autocomplete="off" />
                </div>

                <div class="form-section col-xs-12">
                    <label class="input-label" for="group_days_limit"><?=__('成团天数限制')?></label>
                    <input type="text" class="input-text form-control" name="group_days_limit" id="group_days_limit"  placeholder="<?=__('请输入成团天数限制')?>" data-rule="<?=__('成团天数')?>:required" required autocomplete="off" />
                </div>

                <div class="form-section col-xs-12">
                    <label class="input-label" for="activity_intro"><?=__('活动简介')?></label>
                    <textarea id="activity_intro" name="activity_intro" class="input-text form-control autosize"></textarea>
                </div>

                <div class="form-section hide col-xs-6">
                    <label class="input-label" for="activity_order" title="<?=__('优先级')?>" data-toggle="tooltip" ><?=__('优先级')?></label>
                    <input type="text" class="input-text form-control" name="activity_order" id="activity_order"  placeholder="<?=__('优先级')?>" data-rule="<?=__('优先级')?>:required" required autocomplete="off" />
                </div>


                <div class="form-group-separator"></div>
                <div class="form-section col-xs-12">
                    <label class="input-label" for="item_id" title="<?=__('拼团商品')?>" data-toggle="tooltip" ><?=__('拼团商品')?></label>
                    <div class="col-xs-12" id="select_item">
                        <input type="hidden" class="input-text form-control" name="item_id" id="item_id" required autocomplete="off" />
                        <input type="hidden" class="input-text form-control" name="item_unit_price" id="item_unit_price" required autocomplete="off" />
                        <input type="text" class="input-text form-control" name="item_name" id="item_name"  placeholder="<?=__('选择商品')?>" data-rule="<?=__('选择商品')?>:required" readonly required autocomplete="off" />
                    </div>
                </div>

                <div class="form-section col-xs-6">
                    <label class="input-label" for="group_buy_limit" title="<?=__('商品限购')?>" data-toggle="tooltip" ><?=__('商品限购')?></label>
                    <input type="text" class="input-text form-control" name="group_buy_limit" id="group_buy_limit"  placeholder="<?=__('每人最多购买数量，0为不限购')?>" data-rule="<?=__('商品限购')?>:required" required autocomplete="off" />
                </div>

                <div class="form-section col-xs-6">
                    <label class="input-label" for="group_quantity" title="<?=__('拼团人数')?>" data-toggle="tooltip" ><?=__('拼团人数')?></label>
                    <input type="text" class="input-text form-control" name="group_quantity" id="group_quantity"  placeholder="<?=__('拼团人数')?>" data-rule="<?=__('拼团人数')?>:required" required autocomplete="off" />
                </div>

                <div class="form-section col-xs-12">
                    <label class="input-label" for="group_discount_type" title="<?=__('选择优惠方式')?>" data-toggle="tooltip" ><?=__('选择优惠方式')?></label>
                    <br />
                    <label title="以固定价格购买" for="group_discount_type1"><input class="cbr cbr-success form-control" id="group_discount_type1" name="group_discount_type" value="1" type="radio" checked >以固定价格购买</label>
                    <label title="优惠固定金额" for="group_discount_type2"><input class="cbr cbr-success form-control" id="group_discount_type2" name="group_discount_type" value="2" type="radio">优惠固定金额</label>
                    <label title="以固定折扣购买" for="group_discount_type3"><input class="cbr cbr-success form-control" id="group_discount_type3" name="group_discount_type" value="3" type="radio">以固定折扣购买</label>
                </div>


                <div class="form-section col-xs-6 group_discount group_discount1">
                    <label class="input-label" for="group_sale_price" title="<?=__('拼团单价')?>" data-toggle="tooltip" ><?=__('拼团单价')?></label>
                    <input type="text" class="input-text form-control" name="group_sale_price" id="group_sale_price"  placeholder="<?=__('拼团单价')?>" data-rule="<?=__('拼团单价')?>:required" required autocomplete="off" />
                </div>

                <div class="form-section col-xs-6 hide group_discount group_discount2">
                    <label class="input-label" for="group_fixed_amount" title="<?=__('优惠固定金额')?>" data-toggle="tooltip" ><?=__('优惠固定金额')?></label>
                    <input type="text" class="input-text form-control" name="group_fixed_amount" id="group_fixed_amount"  placeholder="<?=__('优惠固定金额')?>" data-rule="<?=__('优惠固定金额')?>:required" required autocomplete="off" />
                </div>

                <div class="form-section col-xs-6 hide group_discount group_discount3">
                    <label class="input-label" for="group_fixed_discount" title="<?=__('固定折扣')?>" data-toggle="tooltip" ><?=__('固定折扣')?></label>
                    <input type="text" class="input-text form-control" name="group_fixed_discount" id="group_fixed_discount"  placeholder="<?=__('固定折扣')?>" data-rule="<?=__('固定折扣')?>:required" required autocomplete="off" />
                </div>

                <div class="form-section col-xs-12 group_discount group_discount1">
                    <label class="input-label" for="alone_sale_price" title="<?=__('单独购买')?>" data-toggle="tooltip" ><?=__('单独购买')?></label>
                    <input type="text" class="input-text form-control" name="alone_sale_price" id="单独购买"  placeholder="<?=__('单独购买')?>" data-rule="<?=__('单独购买')?>:required" required autocomplete="off" />
                </div>

            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?= $this->js('plugins/plupload/plupload.full.min', true) ?>"></script>
<script type="text/javascript" src="<?= $this->js('img-upload') ?>"></script>
<script src="<?=$this->js('modules/seller/store_activity_base')?>"></script>
<script src="<?=$this->js('modules/seller/store_activity_group')?>"></script>
<script src="<?=$this->js('modules/seller/product/product_select_pic')?>"></script>
