<?php if (!defined('ROOT_PATH')) {
    exit('No Permission');
} ?>
<div class="page-container">
    <div class="main-content">


        <div class="row">

            <form id="pickUpForm">
                <input type="text" id="chain_code" name="chain_code" class="ui-input form-control ui-input-ph" placeholder="请输入提货码" autocomplete="off" />
                <input type="hidden" name="order_id" class="ui-input form-control ui-input-ph" autocomplete="off" />
                <a class="btn btn-default btn-single" data-color="blue" id="J_search"><i class="fa fa-search"></i>查找订单</a>
                <a class="btn btn-default btn-single hide" data-color="blue" id="J_pickUp"><i class="fa fa-check-square"></i>确认提货</a>
            </form>
            <div id="orderData" class="hide">
                <div class="panel panel-default mb0">
                    <div class="panel-body pt0">
                        <h4 class="order_state red" :data-state_id="order_info.order_state_id" v-text="order_info.order_state_name"></h4>
                        订单号：<span v-text="order_info.order_id"></span><i></i>
                        &nbsp;&nbsp;客户名称：<span v-text="order_info.buyer_user_name"></span><i></i>
                        &nbsp;&nbsp;业务员：<span></span><i></i>

                        <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form" class="form-horizontal config-form">

                            <div class="form-group">
                                <div class="col-sm-12 text-inline">
                                    <table class="table table-bordered">
                                        <caption>订单商品列表</caption>
                                        <thead>
                                        <tr>
                                            <th>商品名称</th>
                                            <th>单位</th>
                                            <th>单价</th>
                                            <th>数量</th>
                                            <th>金额小计</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="item in items">
                                            <td v-text="item.item_name"></td>
                                            <td v-text="item.unit_name ? item.unit_name : ''"></td>
                                            <td v-text="item.order_item_unit_price"></td>
                                            <td v-text="item.order_item_quantity"></td>
                                            <td v-text="item.order_item_amount"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="text-right col-sm-10 col-md-11">
                                        <div>活动优惠：</div>
                                        <div>优惠券抵扣：</div>
                                        <div>运费：</div>
                                        <div>应付金额：</div>
                                    </div>
                                    <div class="text-right col-md-1 col-sm-2">
                                        <div>-<span v-text="order_info.order_discount_amount">0</span>元</div>
                                        <div>-<span v-text="order_info.voucher_price">0</span>元</div>
                                        <div><span id="fee" v-text="order_info.order_shipping_fee">0</span>元</div>
                                        <div><span class="text-red" id="order_total_amount" v-text="order_info.order_payment_amount"></span>元</div>
                                    </div>
                                </div>
                            </div>
                        </form>
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
            </div>
        </div>

    </div>
</div>

<script type="text/javascript" src="<?= $this->js('vue.min', true) ?>"></script>
<script src="<?= $this->js('modules/seller/order/order_pickup_by_code') ?>"></script>