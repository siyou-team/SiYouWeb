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
                <div class=" col-xs-12" style="padding: 0">
                    <div class="" id="tab-detail">

                        <div class="btn-group  pull-right" style="position: absolute;top:0px;right: 10px;z-index: 2;">
                            <button type="button" class="btn btn-default" id="btn-print"><i class="fa fa-print"></i>&nbsp; <?=__('打印')?></button>
                            <button type="button" class="btn btn-default" id="btn-export"><i class="fa fa-file-excel-o"></i>&nbsp; <?=__('导出')?></button>
                            <!--<button type="button" class="btn btn-default" id="btn-undo"><i class="fa fa-undo"></i>&nbsp; <?/*=__('退回')*/?></button>-->
                            <a class="btn btn-default btn-single" id="un-review" :data-order_state_id="return_row.return_state_id" v-if="return_row.return_state_id == StateCode.RETURN_PROCESS_CHECK">
                                <i class="fa fa-check-square"></i>&nbsp; <?=__('不通过')?>
                            </a>
                            <a class="btn btn-default btn-single" id="btn-review" :data-order_state_id="return_row.return_state_id" v-if="return_row.return_state_id == StateCode.RETURN_PROCESS_CHECK">
                                <i class="fa fa-check-square"></i>&nbsp; <?=__('通过审核')?>
                            </a>
                            <a class="btn btn-default btn-single" id="btn-review" :data-order_state_id="return_row.return_state_id" v-else-if="return_row.return_state_id == StateCode.RETURN_PROCESS_RECEIVED">
                                <i class="fa fa-check-square"></i>&nbsp; <?=__('确认收货')?>
                            </a>
                            <a class="btn btn-default btn-single" id="btn-review" :data-order_state_id="return_row.return_state_id" v-else-if="return_row.return_state_id == StateCode.RETURN_PROCESS_REFUND">
                                <i class="fa fa-check-square"></i>&nbsp; <?=__('确认付款')?>
                            </a>
                            <a class="btn btn-default btn-single" data-toggle="chat"><i class="fa-question"></i></a>
                        </div>
                        <div class="panel panel-default mb0">
                            <div class="panel-body pt0">
                                <h4 class="order_state red" :data-state_id="return_row.return_state_id" v-text="return_row.return_state_name"></h4>
                                退单号：<span v-text="return_row.return_id"></span><i></i>
                                &nbsp;&nbsp;客户名称：<span v-text="return_row.buyer_user_name"></span><i></i>
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
                                                <div v-if="return_row.return_is_paid">&nbsp;&nbsp;实际退款总额：</div>
                                                <div v-else><i class="fa fa-edit" id="J_editRefundAmount"></i>&nbsp;&nbsp;实际退款总额：</div>
                                            </div>
                                            <div class="text-right col-md-1 col-sm-2">
                                                <div><span class="text-red" id="return_total_amount" v-text="return_row.return_refund_amount"></span>元</div>
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
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_refund_amount">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title">修改退款金额</h4>
            </div>
            <div class="modal-body">
                <form class="form-inline" role="form">
                    <div class="form-group">
                        <label class="form-label">退款金额 :</label>
                        <input type="text" class="form-control" name="return_refund_amount" id="return_refund_amount" placeholder="<?=__('请输入退款金额')?>" >
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" id="J_confirmEditRefund">确定修改</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?= $this->js('vue.min', true) ?>"></script>
<script src="<?= $this->js('modules/seller/order/order_return_detail') ?>"></script>


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