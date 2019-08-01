<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<ul class="nav nav-tabs">
    <li><a href="<?=Zero_Registry::get('index_page')?>?ctl=Cashier_Order&met=index&typ=e"><?=__('账单中心')?></a></li>
	<li><a href="<?=Zero_Registry::get('index_page')?>?ctl=Cashier_Return&met=index&typ=e"><?=__('退货列表')?></a></li>
	<li class="active"><a href="<?=Zero_Registry::get('index_page')?>?ctl=Cashier_Order&met=online&typ=e"><?=__('线上订单')?></a></li>
</ul>

<div class="container">
    <div class="main-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row m-t-10">
                            <div class="col-xs-6 col-sm-3 col-md-3 col-lg-4 p-0">
                                <label class="col-xs-4 col-sm-4 col-md-4 col-lg-3 p-l-0 lin32 text-right" for="order_id"><?=__('订单号')?>：</label>
                                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-9 p-l-0">
                                    <input type="text" placeholder="<?=__('订单号')?>" id="order_id" maxlength="20" name="order_id" class="form-control" style="padding-right: 0px;" />
                                </div>
                            </div>
 
                            <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                                <button class="btn btn-warning waves-effect m-r-15 m-b-15" id="btn-query"><?=__('查询')?></button>
                                <button class="btn btn-warning waves-effect m-r-15 m-b-15" id="edt_ExcelPort" style="display: none"><?=__('导出')?></button>
                                <button class="btn btn-default waves-effect m-b-15" data-toggle="collapse" href="#ScreenDiv" id="btn-all"><?=__('筛选更多')?></button>
                            </div>
                        </div>
                        <div class="collapse" id="ScreenDiv">
                            <form role="form" id="searchForm" class="">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="col-sm-6 col-md-4 col-lg-4 form-group" id="consume_type">
                                        <label class="col-sm-4 col-md-4 col-lg-4 lin32 p-l-0 text-right font14 normal" for="order_state_id"><?=__('订单状态')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8 p-0">
                                            <select class="form-control" style="padding-right: 0px;" id="order_state_id">
                                                <option value="0"><?=__('全部')?></option>
                                                <option value="2010"><?=__("待付款")?></option>
                                                <option value="2011"><?=__("待订单审核")?></option>
												<option value="2013"><?=__("待财务审核")?></option>
												<option value="2020"><?=__("待配货/待出库审核")?></option>
												<option value="2030"><?=__("待发货")?></option>
												<option value="2040"><?=__("已发货/待收货确认")?></option>
												<option value="2060"><?=__("已完成/已签收")?></option>
												<option value="2070"><?=__("已取消/已作废")?></option>
                                            </select>
                                        </div>
                                    </div>
 
                                    <div class="col-sm-6 col-md-4 col-lg-4 form-group">
                                        <label class="col-sm-4 col-md-4 col-lg-4 lin32 p-l-0 text-right font14 normal" for="reservationtime"><?=__('消费时间')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8 p-0">
                                            <input type="text" placeholder="<?=__('请选择添加时间')?>" name="reservation" id="reservationtime" class="form-control" readonly="readonly" />
                                        </div>
                                    </div>
 
                                    <div class="col-sm-6 col-md-4 col-lg-4 form-group">
                                        <label class="col-sm-4 col-md-3 col-lg-3 lin32 p-l-0 text-right font14 normal">&nbsp;</label>
                                        <div class="col-sm-8 col-md-9 col-lg-9 p-0">
                                            <button type="button" class="btn btn-default waves-effect waves-light" id="btn-reset"><i class="fa fa-trash-o"></i> <?=__('重置')?></button>
                                            <button type="button" class="btn btn-warning waves-effect waves-light m-l-10" id="btn-search"><i class="fa fa-search "></i> <?=__('查询')?></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body" id="ConsumptionBill">
                        <table cellspacing="0" class="table table-striped table-bordered dt-responsive nowrap" id="tableWrapper"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
<!-- 单据消费双击模态 -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" style="width: 750px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel1"><?=__('预览')?></h4>
            </div>
            <!-- 会员信息 -->
            <div class="panel-group panel-group-joined m-t-20">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="#collapseTwo" class="tianjia collapsed" data-parent="#accordion-test" data-toggle="collapse">
                                <i class="fa  md-person"></i><?=__('会员信息')?>
                            </a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse guanbi_close" id="collapseTwo">
                        <form role="form" class="form-horizontal" id="formModelXF1">
                            <div class="panel-body col-sm-12 col-md-12 col-lg-12" id="memberDivInfo">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 lin32" for="txt_MemCardXF"><?=__('会员卡号')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8 p-0">
                                            <input type="text" id="txt_MemCardXF" name="user_name" class="form-control" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 lin32" for="txt_MemNameXF"><?=__('会员名称')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8 p-0">
                                            <input type="text" id="txt_MemNameXF" name="user_realname" class="form-control" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 lin32" for="txt_MemLevelXF"><?=__('会员等级')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8 p-0">
                                            <input type="text" id="txt_MemLevelXF" name="member_grade_name" class="form-control" readonly="readonly">
                                        </div>
                                    </div>
                                </div>                              
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- 消费单据信息 -->
            <div class="panel-group panel-group-joined m-t-20">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="collapsed" href="#collapseThree" data-parent="#accordion-test" data-toggle="collapse">
                                <i class="fa  md-menu"></i><?=__('订单详情')?>
                            </a>
                        </h4>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-collapse collapse guanbi_close" id="collapseThree">
                        <form role="form" class="form-horizontal" id="formModelXF2">
                            <div class="clear m-t-15" id="BillMassage">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 control-label" for="txt_BillCodeXF"><?=__('订单号')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8 ">
                                            <input type="text" id="txt_BillCodeXF" name="order_id" class="form-control" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 control-label" for="txt_DiscountMoneyXF"><?=__('折后金额')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8 ">
                                            <input type="text" id="txt_DiscountMoneyXF" name="order_pay_amount" class="form-control" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 control-label" for="txt_PayMoneyXF"><?=__('余额支付')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8 ">
                                            <input type="text" id="txt_PayMoneyXF" name="pay_money" class="form-control" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 control-label" for="txt_PayCashXF"><?=__('现金支付')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8 ">
                                            <input type="text" id="txt_PayCashXF" name="pay_cash" class="form-control" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 control-label" for="txt_PayUnionXF"><?=__('刷卡支付')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8 ">
                                            <input type="text" id="txt_PayUnionXF" name="pay_union" class="form-control" readonly="readonly">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 control-label" for="txt_CreateTimeXF"><?=__('订单日期')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8  ">
                                            <input type="text" id="txt_CreateTimeXF" name="order_create_time" class="form-control" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 control-label" for="txt_TotalPointNumXF"><?=__('获得积分')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8  ">
                                            <input type="text" id="txt_TotalPointNumXF" name="order_points" class="form-control" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 control-label" for="txt_TotalNumXF"><?=__('产品总数')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8  ">
                                            <input type="text" id="txt_TotalNumXF" name="order_number" class="form-control" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 control-label" for="OtherPayXF"><?=__('微信/支付宝')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8  ">
                                            <input type="text" id="OtherPayXF" name="pay_online" class="form-control" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 control-label" for="txt_RemarkXF"><?=__('备注')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8  ">
                                            <textarea id="txt_RemarkXF" name="order_remark" class="form-control" readonly="readonly" style="height: 82px; line-height: 20px; overflow-x: hidden;"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- 消费商品 -->
            <form role="form" class="clear form-horizontal" id="formModelXF3">
                <div class="panel-body" id="ShopMassage">
                    <table cellspacing="0" class="table table-striped table-bordered dt-responsive nowrap" id="datatable-responsiveXF3"></table>
                </div>
            </form>
        </div>
    </div>
</div>

<link rel="stylesheet" href="<?=$this->css('bootstrap-datepicker')?>">
<link rel="stylesheet" href="<?=$this->css('daterangepicker')?>">
<script src="<?=$this->js('moment')?>" charset="utf-8"></script>
<script src="<?=$this->js('daterangepicker')?>" charset="utf-8"></script>
<script src="<?=$this->js('controllers/cashier/online')?>" charset="utf-8"></script>