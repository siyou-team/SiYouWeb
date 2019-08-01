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
                <div class="form-section">
                    <label class="input-label" for="item_type_id"><?=__('1默认2团购商品3限时折扣商品4组合套装5赠品')?></label>
                    <input type="text" class="input-text form-control" name="item_type_id" id="item_type_id"  placeholder="<?=__('1默认2团购商品3限时折扣商品4组合套装5赠品')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="order_item_name"><?=__('退款商品名称')?></label>
                    <input type="text" class="input-text form-control" name="order_item_name" id="order_item_name"  placeholder="<?=__('退款商品名称')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="order_item_num"><?=__('退货数量')?></label>
                    <input type="text" class="input-text form-control" name="order_item_num" id="order_item_num"  placeholder="<?=__('退货数量')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="order_item_image"><?=__('商品图片')?></label>
                    <input type="text" class="input-text form-control" name="order_item_image" id="order_item_image"  placeholder="<?=__('商品图片')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="return_item_image"><?=__('退货凭证')?></label>
                    <input type="text" class="input-text form-control" name="return_item_image" id="return_item_image"  placeholder="<?=__('退货凭证')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="return_refund_amount"><?=__('退款金额 = goods_payment_amount/goods_quantity, 因为涉及到折扣等等  或者 为订单中  order_payment_amount')?></label>
                    <input type="text" class="input-text form-control" name="return_refund_amount" id="return_refund_amount"  placeholder="<?=__('退款金额 = goods_payment_amount/goods_quantity, 因为涉及到折扣等等  或者 为订单中  order_payment_amount')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="store_id"><?=__('店铺编号')?></label>
                    <input type="text" class="input-text form-control" name="store_id" id="store_id"  placeholder="<?=__('店铺编号')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="seller_user_id"><?=__('卖家ID')?></label>
                    <input type="text" class="input-text form-control" name="seller_user_id" id="seller_user_id"  placeholder="<?=__('卖家ID')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="seller_user_account"><?=__('卖家账号')?></label>
                    <input type="text" class="input-text form-control" name="seller_user_account" id="seller_user_account"  placeholder="<?=__('卖家账号')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="buyer_user_id"><?=__('买家ID')?></label>
                    <input type="text" class="input-text form-control" name="buyer_user_id" id="buyer_user_id"  placeholder="<?=__('买家ID')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="buyer_user_account"><?=__('买家会员名')?></label>
                    <input type="text" class="input-text form-control" name="buyer_user_account" id="buyer_user_account"  placeholder="<?=__('买家会员名')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="return_add_time"><?=__('添加时间')?></label>
                    <input type="text" class="input-text form-control" name="return_add_time" id="return_add_time"  placeholder="<?=__('添加时间')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="return_reason_id"><?=__('退款理由id')?></label>
                    <input type="text" class="input-text form-control" name="return_reason_id" id="return_reason_id"  placeholder="<?=__('退款理由id')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="return_reason"><?=__('退款理由')?></label>
                    <input type="text" class="input-text form-control" name="return_reason" id="return_reason"  placeholder="<?=__('退款理由')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="return_buyer_message"><?=__('买家退货备注')?></label>
                    <input type="text" class="input-text form-control" name="return_buyer_message" id="return_buyer_message"  placeholder="<?=__('买家退货备注')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="return_addr_contacter"><?=__('收货人')?></label>
                    <input type="text" class="input-text form-control" name="return_addr_contacter" id="return_addr_contacter"  placeholder="<?=__('收货人')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="return_tel"><?=__('联系电话')?></label>
                    <input type="text" class="input-text form-control" name="return_tel" id="return_tel"  placeholder="<?=__('联系电话')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="return_addr"><?=__('收货地址详情')?></label>
                    <input type="text" class="input-text form-control" name="return_addr" id="return_addr"  placeholder="<?=__('收货地址详情')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="return_post_code"><?=__('邮编')?></label>
                    <input type="text" class="input-text form-control" name="return_post_code" id="return_post_code"  placeholder="<?=__('邮编')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="express_id"><?=__('物流公司编号')?></label>
                    <input type="text" class="input-text form-control" name="express_id" id="express_id"  placeholder="<?=__('物流公司编号')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="return_tracking_number"><?=__('物流单号')?></label>
                    <input type="text" class="input-text form-control" name="return_tracking_number" id="return_tracking_number"  placeholder="<?=__('物流单号')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="plantform_return_state_id"><?=__('申请状态平台')?></label>
                    <label title="处理中" for="plantform_return_state_id_3180"><input class="cbr cbr-success form-control" id="plantform_return_state_id_3180" name="plantform_return_state_id" value="3180" type="radio" checked >处理中</label><label title="为待管理员处理卖家同意或者收货后" for="plantform_return_state_id_3181"><input class="cbr cbr-success form-control" id="plantform_return_state_id_3181" name="plantform_return_state_id" value="3181" type="radio"  >为待管理员处理卖家同意或者收货后</label><label title="为已完成" for="plantform_return_state_id_3182"><input class="cbr cbr-success form-control" id="plantform_return_state_id_3182" name="plantform_return_state_id" value="3182" type="radio"  >为已完成</label>
                </div>
                <div class="form-section">
                    <label class="input-label" for="return_state_id"><?=__('卖家处理状态')?></label>
                    <label title="新发起等待卖家审核" for="return_state_id_3190"><input class="cbr cbr-success form-control" id="return_state_id_3190" name="return_state_id" value="3190" type="radio" checked >新发起等待卖家审核</label><label title="卖家同意" for="return_state_id_3191"><input class="cbr cbr-success form-control" id="return_state_id_3191" name="return_state_id" value="3191" type="radio"  >卖家同意</label><label title="卖家不同意" for="return_state_id_3192"><input class="cbr cbr-success form-control" id="return_state_id_3192" name="return_state_id" value="3192" type="radio"  >卖家不同意</label><label title="卖家审核通过如果有退货则收到退货" for="return_state_id_3193"><input class="cbr cbr-success form-control" id="return_state_id_3193" name="return_state_id" value="3193" type="radio"  >卖家审核通过如果有退货则收到退货</label>
                </div>
                <div class="form-section">
                    <input id="return_flag" name="return_flag" type="checkbox" value="1" checked="checked" data-on-text="需要退货" data-off-text="">
                </div>
                <div class="form-section">
                    <label class="input-label" for="return_type"><?=__('申请类型')?></label>
                    <label title="退款申请" for="return_type_1"><input class="cbr cbr-success form-control" id="return_type_1" name="return_type" value="1" type="radio" checked >退款申请</label><label title="退货申请" for="return_type_2"><input class="cbr cbr-success form-control" id="return_type_2" name="return_type" value="2" type="radio"  >退货申请</label><label title="虚拟退款" for="return_type_3"><input class="cbr cbr-success form-control" id="return_type_3" name="return_type" value="3" type="radio"  >虚拟退款</label>
                </div>
                <div class="form-section">
                    <input id="return_order_lock" name="return_order_lock" type="checkbox" value="1" checked="checked" data-on-text="需要锁定" data-off-text="">
                </div>
                <div class="form-section">
                    <label class="input-label" for="return_item_state_id"><?=__('物流状态')?></label>
                    <select class="form-control select2" name="return_item_state_id" id="return_item_state_id" style="width:100%;">
                        <option value="2030" selected >待发货</option><option value="2040"  >已发货/待收货确认</option><option value="2060"  >已完成/已签收</option><option value="2070"  >已取消/已作废</option>
                    </select>
                </div>
                <div class="form-section">
                    <label class="input-label" for="return_store_time"><?=__('商家处理时间')?></label>
                    <input type="text" class="input-text form-control" name="return_store_time" id="return_store_time"  placeholder="<?=__('商家处理时间')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="return_store_message"><?=__('商家备注')?></label>
                    <input type="text" class="input-text form-control" name="return_store_message" id="return_store_message"  placeholder="<?=__('商家备注')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="return_commision_fee"><?=__('退还佣金')?></label>
                    <input type="text" class="input-text form-control" name="return_commision_fee" id="return_commision_fee"  placeholder="<?=__('退还佣金')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="return_finish_time"><?=__('退款完成时间')?></label>
                    <input type="text" class="input-text form-control" name="return_finish_time" id="return_finish_time"  placeholder="<?=__('退款完成时间')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="return_platform_message"><?=__('平台留言')?></label>
                    <input type="text" class="input-text form-control" name="return_platform_message" id="return_platform_message"  placeholder="<?=__('平台留言')?>" autocomplete="off" />
                </div>

            </form>
        </div>
    </div>
</div>
<script src="<?=$this->js('modules/seller/order/order_return')?>"></script>