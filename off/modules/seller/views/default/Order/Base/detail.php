<?php if (!defined('ROOT_PATH')) {exit('No Permission');} ?>
<style>
    .form-section .wrapper div
    {
        padding-right: 0px;
    }
</style>

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
    <div class="main-content">
        <div class="row">
            <div class="">
                <ul class="nav nav-tabs">
                    <li class="<?= s('tab', 'detail') == 'detail' ? 'active' : '' ?>"><a href="#tab-detail" data-toggle="tab" data-url="<?=url('Order_Base', 'getOrderDetail', 'seller', sprintf('order_id=%s', s('order_id')))?>"><?=__('订单详情')?></a></li>
                    <li class="<?= s('tab') == 'stock' ? 'active' : '' ?>"><a href="#tab-stock" data-toggle="tab" data-url="<?=url('Order_Base', 'getOrderStock', 'seller', sprintf('order_id=%s', s('order_id')))?>"><?=__('出库发货记录')?></a></li>
                    <li class="<?= s('tab') == 'fund' ? 'active' : '' ?>"><a href="#tab-fund" data-toggle="tab" data-url="<?=url('Consume_Record', 'orderRecord', 'pay', sprintf('order_id=%s', s('order_id')))?>"><?=__('收款记录')?></a></li>
                </ul>
                <div class="tab-content col-xs-12" style="padding: 0">
                    <div class="tab-pane" id="tab-detail">

                        <div class="btn-group  pull-right" style="position: absolute;top:-40px;right: 0px;">
                            <button type="button" class="btn btn-default" id="btn-print"><i class="fa fa-print"></i>&nbsp; <?=__('打印')?></button>
                            <button type="button" class="btn btn-default" id="btn-export"><i class="fa fa-file-excel-o"></i>&nbsp; <?=__('导出')?></button>
                            <!--<button type="button" class="btn btn-default" id="btn-undo"><i class="fa fa-undo"></i>&nbsp; <?/*=__('退回')*/?></button>-->

                            <a class="btn btn-default btn-single" id="btn-review" :data-order_state_id="order_base_row.order_state_id" v-if="order_base_row.order_state_id == StateCode.ORDER_STATE_WAIT_FINANCE_REVIEW && order_base_row.can_financereview">
                                <i class="fa fa-check-square"></i>&nbsp; <?=__('财务审核')?>
                            </a>
                            <a class="btn btn-default btn-single" id="btn-review" :data-order_state_id="order_base_row.order_state_id" v-else-if="order_base_row.order_state_id == StateCode.ORDER_STATE_PICKING && order_base_row.can_picking">
                                <i class="fa fa-check-square"></i>&nbsp; <?=__('出库')?>
                            </a>
                            <a class="btn btn-default btn-single" id="btn-review" :data-order_state_id="order_base_row.order_state_id" v-else-if="order_base_row.order_state_id == StateCode.ORDER_STATE_WAIT_SHIPPING && order_base_row.can_shipping">
                                <i class="fa fa-check-square"></i>&nbsp; <?=__('发货')?>
                            </a>
                            <a class="btn btn-default btn-single" id="btn-review" :data-order_state_id="order_base_row.order_state_id" v-else-if="order_base_row.order_state_id == StateCode.ORDER_STATE_WAIT_REVIEW && order_base_row.can_review">
                                <i class="fa fa-check-square"></i>&nbsp; <?=__('审核')?>
                            </a>
                            <a class="btn btn-default btn-single" id="btn-review" :data-order_state_id="order_base_row.order_state_id" v-else-if="order_base_row.order_state_id == StateCode.ORDER_STATE_WAIT_PAY">
                                <i class="fa fa-plus"></i>&nbsp; <?=__('添加收款记录')?>
                            </a>
                            <a class="btn btn-default btn-single" data-toggle="chat"><i class="fa-question"></i></a>
                        </div>
                        <div class="panel panel-default mb0">
                            <div class="panel-body pt0">
                                <h4 class="order_state red" :data-state_id="order_base_row.order_state_id" v-text="order_base_row.order_state_name"></h4>
                                订单号：<span v-text="order_base_row.order_id"></span><i></i>
                                &nbsp;&nbsp;客户名称：<span v-text="order_base_row.buyer_user_name"></span><i></i>
                                &nbsp;&nbsp;业务员：<span></span><i></i>

                                <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form" class="form-horizontal config-form" action="<?=$this->registry('url')?>?mdu=seller&ctl=Store_Base&met=edit&typ=json"  data-validator-option="{stopOnError:false, timely:false}">

                                    <div class="form-group">
                                        <div class="col-sm-12 text-inline">
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12 J_grid_box">
                                        <div class="wrapper" style="">
                                            <div class="grid-wrap grid-wrap-order-detail" style="">
                                                <table id="grid_order_detail"></table>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <div class="text-right col-sm-10 col-md-11">
                                                <div>活动优惠：</div>
                                                <div>优惠券抵扣：</div>
                                                <div v-if="order_base_row.order_is_paid == StateCode.ORDER_PAID_STATE_YES || order_base_row.order_state_id == StateCode.ORDER_STATE_SHIPPED">&nbsp;&nbsp;运费：</div>
                                                <div v-else><i class="fa fa-edit" id="J_editFeeAmount"></i>&nbsp;&nbsp;运费：</div>
                                                <div>应付金额：</div>
                                            </div>
                                            <div class="text-right col-md-1 col-sm-2">
                                                <div>-<span v-text="order_base_row.order_discount_amount">0</span>元</div>
                                                <div>-<span v-text="order_base_row.voucher_price">0</span>元</div>
                                                <div><span id="fee" v-text="order_base_row.order_shipping_fee">0</span>元</div>
                                                <div><span class="text-red" id="order_total_amount" v-text="order_base_row.order_payment_amount"></span>元</div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="order-detail-info">


                                <!--<div class="form-section col-sm-12">
                                        <label class="text-right col-sm-2 col-md-1"data-toggle="tooltip" title="" data-original-title="交货日期">交货日期：</label>
                                        <div class="content col-sm-10 col-md-11">
                                            YYYY-MM-DD&nbsp;&nbsp;<i class="fa fa-edit"></i>
                                        </div>
                                        <input class="input-text hide form-control datepicker col-sm-10 col-md-11 col-sm-offset-2 col-md-offset-1" name="delivery_date" id="delivery_date"  placeholder="<?/*=__('交货日期')*/?>" autocomplete="off" />

                                    </div>


                                    <div class="form-section col-sm-12">
                                        <label class="text-right col-sm-2 col-md-1" for="" data-toggle="tooltip" title="" data-original-title="备注说明">
                                            备注说明：
                                        </label>
                                        <div class="col-sm-10 col-md-11">
                                            <i class="fa fa-plus-square"></i><span class="content"></span>
                                        </div>
                                    </div>-->

                            </div>
                        </div>

                        <div class="panel panel-default mb0">
                            <div class="panel-heading">
                                <div class="panel-title">收货信息
                                </div>
                            </div>
                            <div class="panel-body">

                                客户名称 ：<span v-text="delivery_row.da_name"></span>&nbsp;&nbsp;
                                收货人 ：<span v-text="delivery_row.da_name"></span>&nbsp;&nbsp;
                                联系方式 ：<span v-text="delivery_row.da_mobile"></span>&nbsp;&nbsp;
                                收货地址 : <span v-text="delivery_row.da_province"></span>/<span v-text="delivery_row.da_city"></span>/<span v-text="delivery_row.da_county"></span>&nbsp;&nbsp;<span v-text="delivery_row.da_address"></span>
                            </div>
                        </div>
                        <div class="panel panel-default mb0 collapsed">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    操作日志
                                </div>
                                <div class="panel-options">
                                    <a href="#" data-toggle="panel">
                                        <span class="collapse-icon">–</span>
                                        <span class="expand-icon">+</span>
                                    </a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class=" table-responsive table table-striped" id="J_OrderStateLog">
                                    <thead>
                                    <tr>
                                        <th>操作人</th>
                                        <th>时间</th>
                                        <th>操作类别</th>
                                        <th>操作日志</th>
                                    </tr>
                                    </thead>
                                    <tbody v-if="state_log.length>0">
                                    <tr v-for="log in state_log">
                                        <td v-text="log.user_nickname"></td>
                                        <td v-text="log.order_state_time"></td>
                                        <td v-text="log.order_state_type"></td>
                                        <td v-text="log.order_state_note"></td>
                                    </tr>
                                    </tbody>
                                    <tbody  v-else>
                                    <tr>
                                        <td colspan="4">暂无数据</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-stock">

                        <div class="panel panel-default mb0">
                            <div class="panel-body  pt0">

                                <div class="mb20">
                                    <h4 class="order_state red" :data-state_id="stock_base_row.order_state_id" v-text="stock_base_row.order_state_name"></h4>
                                    订单号：<span v-text="stock_base_row.order_id"></span>&nbsp;&nbsp;
                                    客户名称：<span v-text="stock_base_row.buyer_user_name"></span>&nbsp;&nbsp;
                                    业务员：<span></span>&nbsp;&nbsp;<br>
                                    收货信息 ：<span v-text="delivery_row.da_name"></span>，
                                    <span v-text="delivery_row.da_name"></span>，
                                    <span v-text="delivery_row.da_mobile"></span>，
                                    <span v-text="delivery_row.da_province"></span>/<span v-text="delivery_row.da_city"></span>/<span v-text="delivery_row.da_county"></span>&nbsp;&nbsp;
                                    <span v-text="delivery_row.da_address"></span>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default mb0" v-if="stock_base_row.not_out_of_warehouse_total">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <?=__('待出库商品清单')?>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped table-bordered">
                                    <caption v-if="(stock_base_row.order_state_id == StateCode.ORDER_STATE_PICKING || stock_base_row.order_state_id == StateCode.ORDER_STATE_WAIT_SHIPPING)">

                                        <div class="form-group pull-left">
                                            <span  class="<?= Store_ConfigModel::ifEnabledInvoicing($data['store_id']) ? '' : 'hide' ?>">
                                            出库仓库：
                                            <span id="warehouse_id"></span>
                                            </span>
                                            <input class="icheck" type="checkbox" name="showGtZeroStock" id="J_showGtZeroStock" data-type-all="">
                                            <label for="">仅显示库存大于0的商品</label>

                                        </div>

                                        <div class="pull-right">本次出库数设为0表示此商品暂不出库
                                            <button class="btn btn-secondary btn-single" data-color="blue" data-style="slide-left" id="J_outOfStock">出库</button>
                                        </div>
                                    </caption>
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>主图	</th>
                                        <th>商品名称</th>
                                        <!--<th>规格</th>-->
                                        <th>单位</th>
                                        <th>库存数量（默认仓库）</th>
                                        <th>订购数</th>
                                        <th>已出库数</th>
                                        <th>本次出库数</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="item_list" v-for="(item,index) in stock_base_row.items">
                                        <td v-text="index+1"></td>
                                        <td><img :src="item.order_item_image" height="40" width="40" /></td>
                                        <td v-text="item.item_name"></td>
                                       <!-- <td v-text="item.spec_info"></td>-->
                                        <td v-text="item.unit_name"></td>
                                        <td class="sell_out" v-text="item.warehouse_item_quantity" v-if="item.warehouse_item_quantity <= 0"></td>
                                        <td v-text="item.warehouse_item_quantity" v-else></td>
                                        <td v-text="item.order_item_quantity"></td>
                                        <td v-text="item.out_of_warehouse_num"></td>
                                        <td v-if="item.order_item_quantity == item.out_of_warehouse_num || item.warehouse_item_quantity <= 0">0</td>
                                        <td v-else><input min="0" type="number" :data-order_item_id="item.order_item_id" :data-item_id="item.item_id" :data-order_item_unit_price="item.order_item_unit_price" :max="item.order_item_quantity-item.out_of_warehouse_num" class="out_warehouse form-control" autocomplete="off" :value="item.order_item_quantity-item.out_of_warehouse_num"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="panel panel-default mb0" v-for="stock_row in stock_bill">
                            <div class="panel-heading">
                                <div class="panel-title" v-if="stock_row.logistics.order_logistics_id && stock_row.logistics.logistics_enable == 0">
                                    <?=__('已作废记录')?>
                                </div>
                                <div class="panel-title" v-if="stock_row.logistics.logistics_enable == 1">
                                    <?=__('发货记录')?>
                                </div>
                                <div class="panel-title" v-else>
                                    <?=__('出库记录')?>
                                </div>
                            </div>
                            <div class="panel-body">
                                <caption>
                                    <div class="pull-right" v-if="stock_row.logistics.order_logistics_id && stock_row.logistics.logistics_enable == 0">
                                        <button type="button" :data-order_id="stock_row.order_id" :data-stock_bill_id="stock_row.stock_bill_id" class="btn btn-default btn-blue J_deleteLogistics" :data-order_logistics_id="stock_row.logistics.order_logistics_id">&nbsp; <?=__('删除')?></button>
                                    </div>
                                    <div class="pull-right" v-else
                                         :data-logistics_id="stock_row.logistics.logistics_id"
                                         :data-logistics_name="stock_row.logistics.logistics_name"
                                         :data-logistics_time="stock_row.logistics.logistics_time"
                                         :data-logistics_number="stock_row.logistics.logistics_number"
                                         :data-logistics_explain="stock_row.logistics.logistics_explain"
                                         :data-order_logistics_id="stock_row.logistics.order_logistics_id"
                                         :data-order_id="stock_row.order_id"
                                         :data-stock_bill_id="stock_row.stock_bill_id">
                                        <button type="button" class="btn btn-default J_editDelivery" v-if="stock_row.logistics.order_logistics_id && stock_row.logistics.logistics_enable"><i class="fa fa-edit"></i>&nbsp; <?=__('修改物流')?></button>
                                        <button type="button" class="btn btn-default J_print"><i class="fa fa-print"></i>&nbsp; <?=__('打印')?></button>
                                        <button type="button" class="btn btn-default J_export"><i class="fa fa-file-excel-o"></i>&nbsp; <?=__('导出')?></button>
                                        <!--<button type="button" class="btn btn-default J_undo"><i class="fa fa-undo"></i>&nbsp; <?php/*=__('退回')*/?></button>-->
                                        <button type="button" class="btn btn-default J_post" v-if="!(stock_row.logistics.order_logistics_id && stock_row.logistics.logistics_enable)">&nbsp; <?=__('发货')?></button>
                                    </div>
                                </caption>
                                <table class="table table-striped table-bordered" :data-stock_bill_id="stock_row.stock_bill_id">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>主图	</th>
                                        <th>商品名称</th>
                                        <!--<th>规格</th>-->
                                        <th>单位</th>
                                        <th>本次出库数</th>
                                        <th>出库小计</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(stock_item_row,index) in stock_row.items">
                                        <td v-text="index+1"></td>
                                        <td><img :src="stock_item_row.order_item_image" height="40" width="40" /></td>
                                        <td v-text="stock_item_row.item_name"></td>
                                        <!--<td v-text="stock_item_row.spec_info"></td>-->
                                        <td v-text="stock_item_row.unit_name"></td>
                                        <td v-text="stock_item_row.bill_item_quantity"></td>
                                        <td v-text="stock_item_row.bill_item_quantity +'*'+ stock_item_row.unit_name"></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <!-- 出库/发货情况 -->
                                <div>
                                    <div class="form-group row" v-if="stock_row.logistics.order_logistics_id">
                                        <label class="col-sm-2 control-label">状态</label>
                                        <div class="col-sm-10 text-inline" v-if="stock_row.logistics.logistics_enable">
                                            待签收
                                        </div>
                                        <div class="col-sm-10 text-inline" v-else>
                                            已作废
                                        </div>
                                    </div>
                                    <div class="form-group row" v-if="stock_row.logistics.order_logistics_id">
                                        <label class="col-sm-2 control-label">备注</label>
                                        <div class="col-sm-10 text-inline" v-text="stock_row.logistics.logistics_explain"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 control-label">出库信息</label>
                                        <div class="col-sm-10 text-inline">
                                            出库编号：<span v-text="stock_row.stock_bill_id"></span>
                                            &nbsp;&nbsp;出库时间：<span v-text="stock_row.stock_bill_time"></span>
                                            &nbsp;&nbsp;出库数量：<span v-text="stock_row.item_quantity"></span>
                                            &nbsp;&nbsp;出库仓库：<span v-text="stock_row.warehouse_name"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row" v-if="stock_row.logistics.order_logistics_id && stock_row.logistics.logistics_enable">
                                        <label class="col-sm-2 control-label">物流信息</label>
                                        <div class="col-sm-10 text-inline">
                                            发货日期：<span v-text="stock_row.logistics.logistics_time"></span>
                                            &nbsp;&nbsp;物流公司：<span v-text="stock_row.logistics.logistics_name"></span>
                                            &nbsp;&nbsp;物流单号：<span v-text="stock_row.logistics.order_tracking_number"></span>
                                            &nbsp;&nbsp;物流备注：<span v-text="stock_row.logistics.logistics_explain"></span>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-fund">

                        <div class="panel panel-default mb0">
                            <div class="panel-body  pt0">
                                <div class="mb20">
                                    <h4 class="order_state"><?=s('order_id')?></h4>
                                    订单金额：<span v-html="formatMoney(fund.order_payment_amount)"></span>
                                    已付款：<span v-text="formatMoney(fund.trade_payment_money+fund.trade_payment_recharge_card+fund.trade_payment_points+fund.trade_payment_credit+fund.trade_payment_redpack)"></span>
                                    待确认：<span v-text="formatMoney(fund.payment_waiting_review)"></span>
                                    待支付：<span v-text="formatMoney(fund.trade_payment_amount)"></span>
                                </div>


                                <table class="table table-bordered table-striped dataTable text-center">
                                    <thead>
                                    <tr>
                                        <th>支付流水号</th>
                                        <th>时间</th>
                                        <th>付款金额</th>
                                        <th>支付方式</th>
                                        <th>收款账户</th>
                                        <th>状态</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="item in fund.items">
                                        <td v-text="item.consume_record_id"></td>
                                        <td v-text="item.record_time"></td>
                                        <td v-text="formatMoney(Math.abs(item.record_money))"></td>
                                        <td v-text="payment_met_id(item.payment_met_id)"></td>
                                        <td v-text="item.payment_channel_name"></td>
                                        <td v-text="item.record_enable"></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="btn-group  pull-right" style="position: absolute;top:40px;right: 30px;" v-if="fund.trade_payment_amount>0">
                            <a class="btn btn-default btn-single" id="payment_btn" :data-user_id="fund.buyer_id"><i class="fa  fa-plus"></i>&nbsp; <?=__('添加付款记录')?></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_fee_amount">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title">修改邮费</h4>
            </div>
            <div class="modal-body">
                <form class="form-inline" role="form">
                    <div class="form-group">
                        <label class="form-label">运费金额 :</label>
                        <input type="text" class="form-control" name="fee" id="modal_fee" placeholder="<?=__('运费金额')?>" >
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" id="J_confirmEditFee">确定修改</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?= $this->js('vue.min', true) ?>"></script>
<script src="<?= $this->js('modules/seller/order/order_item_detail') ?>"></script>


<script type="text/x-template" id="note_text">
<div class="chat-group">
    <strong>订单审核后，需要修改/作废怎么办？</strong>
    <a><span class="user-status is-online"></span><em>在财务审核、出库审核、发货审核环节需要修改订单，相应审核人员可点击【退回】，并在备注中填写退回原因。可将订单退回给订单审核员修改/作废。；</em></a>
    <a><span class="user-status is-online"></span><em>订单在“待收货确认”状态下，不可修改/作废。</em></a>
    <a><span class="user-status is-online"></span><em>如有订单完成后，还需修改的需求，可开启“订单核准功能”。</em></a>
</div>
</script>

<script>
    $(function () {
        var defaultPage = Public.getDefaultPage();
        defaultPage.$('#chat_title').html('<?=@$layout_data['menu_name']?>');
        defaultPage.$('.chat-group').remove();
        defaultPage.$('.chat-header').after($('#note_text').html());
    });
</script>