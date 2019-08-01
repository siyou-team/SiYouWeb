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
                <input type="hidden" class="input-text form-control" name="order_item_id" id="order_item_id"  placeholder="<?=__('id')?>" autocomplete="off" />
                <div class="form-section">
                    <label class="input-label" for="order_id"><?=__('订单Id')?></label>
                    <input type="text" class="input-text form-control" name="order_id" id="order_id"  placeholder="<?=__('订单Id')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="buyer_id"><?=__('买家user_id  冗余')?></label>
                    <input type="text" class="input-text form-control" name="buyer_id" id="buyer_id"  placeholder="<?=__('买家user_id  冗余')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="store_id"><?=__('店铺ID')?></label>
                    <input type="text" class="input-text form-control" name="store_id" id="store_id"  placeholder="<?=__('店铺ID')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="product_id"><?=__('产品SPU')?></label>
                    <input type="text" class="input-text form-control" name="product_id" id="product_id"  placeholder="<?=__('产品SPU')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="item_id"><?=__('货品SKU')?></label>
                    <input type="text" class="input-text form-control" name="item_id" id="item_id"  placeholder="<?=__('货品SKU')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="item_name"><?=__('商品名称')?></label>
                    <input type="text" class="input-text form-control" name="item_name" id="item_name"  placeholder="<?=__('商品名称')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="category_id"><?=__('商品对应的类目ID')?></label>
                    <input type="text" class="input-text form-control" name="category_id" id="category_id"  placeholder="<?=__('商品对应的类目ID')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="spec_id"><?=__('规格id')?></label>
                    <input type="text" class="input-text form-control" name="spec_id" id="spec_id"  placeholder="<?=__('规格id')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="spec_info"><?=__('规格描述')?></label>
                    <input type="text" class="input-text form-control" name="spec_info" id="spec_info"  placeholder="<?=__('规格描述')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="item_unit_price"><?=__('商品价格单价')?></label>
                    <input type="text" class="input-text form-control" name="item_unit_price" id="item_unit_price"  placeholder="<?=__('商品价格单价')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="order_item_unit_price"><?=__('商品实际成交价单价')?></label>
                    <input type="text" class="input-text form-control" name="order_item_unit_price" id="order_item_unit_price"  placeholder="<?=__('商品实际成交价单价')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="order_item_quantity"><?=__('商品数量')?></label>
                    <input type="text" class="input-text form-control" name="order_item_quantity" id="order_item_quantity"  placeholder="<?=__('商品数量')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="order_item_image"><?=__('商品图片')?></label>
                    <input type="text" class="input-text form-control" name="order_item_image" id="order_item_image"  placeholder="<?=__('商品图片')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="order_item_return_num"><?=__('退货数量')?></label>
                    <input type="text" class="input-text form-control" name="order_item_return_num" id="order_item_return_num"  placeholder="<?=__('退货数量')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="order_item_amount"><?=__('商品总金额')?></label>
                    <input type="text" class="input-text form-control" name="order_item_amount" id="order_item_amount"  placeholder="<?=__('商品实际总金额 =  goods_pay_unit_price * goods_quantity')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="order_item_discount_amount"><?=__('优惠金额  负数')?></label>
                    <input type="text" class="input-text form-control" name="order_item_discount_amount" id="order_item_discount_amount"  placeholder="<?=__('优惠金额  负数')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="order_item_adjust_fee"><?=__('手工调整金额 负数')?></label>
                    <input type="text" class="input-text form-control" name="order_item_adjust_fee" id="order_item_adjust_fee"  placeholder="<?=__('手工调整金额 负数')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="order_item_points_fee"><?=__('积分费用')?></label>
                    <input type="text" class="input-text form-control" name="order_item_points_fee" id="order_item_points_fee"  placeholder="<?=__('积分费用')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="order_item_payment_amount"><?=__('实付金额 ')?></label>
                    <input type="text" class="input-text form-control" name="order_item_payment_amount" id="order_item_payment_amount"  placeholder="<?=__(' goods_payment_amount =  goods_amount + goods_discount_amount + goods_adjust_fee + goods_point_fee')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="order_item_evaluation_status"><?=__('评价状态')?></label>
                    <label title="未评价" for="order_item_evaluation_status_1"><input class="cbr cbr-success form-control" id="order_item_evaluation_status_1" name="order_item_evaluation_status" value="1" type="radio"  >未评价</label><label title="已评价" for="order_item_evaluation_status_2"><input class="cbr cbr-success form-control" id="order_item_evaluation_status_2" name="order_item_evaluation_status" value="2" type="radio"  >已评价</label><label title="失效评价" for="order_item_evaluation_status_3"><input class="cbr cbr-success form-control" id="order_item_evaluation_status_3" name="order_item_evaluation_status" value="3" type="radio"  >失效评价</label>
                </div>
                <div class="form-section">
                    <label class="input-label" for="activity_type_id"><?=__('活动类型')?></label>
                    <input type="text" class="input-text form-control" name="activity_type_id" id="activity_type_id"  placeholder="<?=__('0-默认;1101-加价购=搭配宝;1102-店铺满赠-小礼品;1103-限时折扣;1104-优惠套装;1105-店铺优惠券coupon优惠券;1106-拼团;1107-满减送;1108-阶梯价')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="activity_id"><?=__('促销活动ID')?></label>
                    <input type="text" class="input-text form-control" name="activity_id" id="activity_id"  placeholder="<?=__('与activity_type_id搭配使用, 团购ID/限时折扣ID/优惠套装ID')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="order_item_commission_rate"><?=__('分佣金比例')?></label>
                    <input type="text" class="input-text form-control" name="order_item_commission_rate" id="order_item_commission_rate"  placeholder="<?=__('分佣金比例')?>" autocomplete="off" />
                </div>

            </form>
        </div>
    </div>
</div>
<script src="<?=$this->js('modules/seller/order/order_item')?>"></script>