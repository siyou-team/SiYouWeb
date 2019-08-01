<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>


<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
    <div class="main-content">
        <div class="row">
            <form class="form-inline title-form" id="grid-search-form">
                <div class="col-sm-12">
                    <div class="form-group">
                        <select name="order_state_id" class="input_txt form-inline title-form form-control select2" style="width:140px;">
                            <option value="0" selected>全部状态</option>
                            <option value="2010">等待买家付款</option>
                            <option value="2011">待订单审核</option>
                            <option value="2013">待财务审核</option>
                            <option value="2020">等待卖家配货</option>
                            <option value="2030">等待卖家发货</option>
                            <option value="2040">等待买家确认收货</option>
                            <option value="2050">买家已签收</option>
                            <option value="2060">交易成功</option>
                            <option value="2070">交易关闭</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <?php if (i('kind_id')):?>
                            <input type="hidden" id="kind_id" name="kind_id" value="<?=i('kind_id')?>" >
                        <?php else: ?>
                            <select name="kind_id"  class="input_txt form-inline title-form form-control select2" style="width:100px;">
                                <option value="0">订单类型</option>
                                <option value="1201">实物订单</option>
                                <option value="1202">服务订单</option>
                                <option value="1203">电子卡券</option>
                                <option value="1204">外卖订单</option>
                            </select>
                        <?php endif;?>
                    </div>

                    <input type="text" id="order_id" name="order_id" class="ui-input form-control ui-input-ph" placeholder="订单编号"   autocomplete="off" style="width:100px;" >
                    <input type="text" id="order_title" name="order_title" class="ui-input form-control ui-input-ph" placeholder="订单标题"   autocomplete="off" style="width:100px;" >

                    <div class="form-group">
                        <select class="input_txt form-inline title-form form-control select2" style="width: 120px;" id="buyer_user_id" name="buyer_user_id" placeholder="请输入买家用户昵称" >
                        </select>
                    </div>
                    

                    <input type="text" id="order_date" name="order_date" class="ui-input form-control ui-input-ph datepicker"  data-format="Y-m-d"  data-timepicker="false" placeholder="订单日期"   autocomplete="off"  style="width:100px;" >
                    <a class="btn btn-default btn-single" data-color="blue" data-style="slide-left" id="search"><i class="fa fa-search" aria-hidden="true"></i> 查询</a>


                    <div class="btn-group  pull-right">
                        <?php
                        $show_out = true;
                        foreach ($data['sc_order_process'] as $order_process):?>
                            <?php if ($order_process == StateCode::ORDER_PROCESS_CHECK):?>
                                <a class="btn btn-default hide btn-single J_operate_btn" id="btn-order-review"><?=__('订单审核')?></a>
                            <?php elseif ($order_process == StateCode::ORDER_PROCESS_FINANCE_REVIEW):?>
                                <a class="btn btn-default hide btn-single J_operate_btn" id="btn-order-finance-review"><?=__('财务审核')?></a>
                            <?php elseif (($order_process == StateCode::ORDER_PROCESS_OUT || $order_process == StateCode::ORDER_PROCESS_SHIPPED) && $show_out):
                                $show_out = false;?>
                                <a class="btn btn-default hide btn-single J_operate_btn" id="btn-stock-out-review"><?=__('出库审核')?></a>
                            <?php elseif ($order_process == StateCode::ORDER_PROCESS_SHIPPED):?>
                                <a class="btn btn-default hide btn-single J_operate_btn" id="btn-delivery-review"><?=__('发货确认')?></a>
                            <?php endif;?>
                        <?php endforeach;?>


                        <button type="button" class="btn btn-default" id="btn-pickup"><i class="fa fa-barcode" aria-hidden="true"></i> <?= __('提货核销') ?></button>
                        <button type="button" class="btn btn-default" id="btn-add"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?=__('新增')?></button>
                        <a class="btn btn-default btn-single" id="btn-refresh"><i class="fa-refresh"></i> <?=__('刷新')?></a>
                        <a class="btn btn-default btn-single" data-toggle="chat"><i class="fa-question"></i></a>

                    </div>
                </div>
            </form>
        </div>
        <div class="wrapper">
            <div class="grid-wrap">
                <table id="grid"></table>
                <div id="grid-pager"></div>
            </div>
        </div>
    </div>
</div>

<script src="<?=$this->js('modules/seller/order_base')?>"></script>
