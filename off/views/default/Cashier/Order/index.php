<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<ul class="nav nav-tabs">
	<li class="active"><a href="javascript:;"><?=__('账单中心')?></a></li>
	<li><a href="<?=Zero_Registry::get('index_page')?>?ctl=Cashier_Return&met=index&typ=e"><?=__('退货列表')?></a></li>
	<li><a href="<?=Zero_Registry::get('index_page')?>?ctl=Cashier_Order&met=online&typ=e"><?=__('线上订单')?></a></li>
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
                                    <input type="text" placeholder="<?=__('输入单据号')?>" id="order_id" maxlength="20" name="order_id" class="form-control" style="padding-right: 0px;" />
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                                <button class="btn btn-warning waves-effect m-r-15 m-b-15" id="btn-query"><?=__('查询')?></button>
 
                                <button class="btn btn-default waves-effect m-b-15" data-toggle="collapse" href="#ScreenDiv" id="btn-all"><?=__('筛选更多')?></button>
                            </div>
                        </div>
                        <div class="collapse" id="ScreenDiv">
                            <form role="form" id="searchForm" class="">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="col-sm-6 col-md-4 col-lg-4 form-group" id="consume_type">
                                        <label class="col-sm-4 col-md-4 col-lg-4 lin32 p-l-0 text-right font14 normal" for="order_type"><?=__('消费类型')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8 p-0">
                                            <select class="form-control" style="padding-right: 0px;" id="order_type">
                                                <option value="0"><?=__('全部')?></option>
                                                <option value="1"><?=__('快速消费')?></option>
                                                <option value="2"><?=__('商品消费')?></option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-4 col-lg-4 form-group" style="border: 1px solid #;">
                                        <label class="col-sm-4 col-md-4 col-lg-4 lin32 p-l-0 text-right font14 normal" for="beginMoney" id="PaySomeMoney"><?=__('实付金额')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8 p-0">
                                            <div class="left widban">
                                                <input type="text" placeholder="<?=__('最低金额')?>" name="beginMoney" id="beginMoney" class="form-control" onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" />
                                            </div>
                                            <div class="left zhikd"> <?=__('至')?> </div>
                                            <div class="left widban">
                                                <input type="text" placeholder="<?=__('最高金额')?>" name="endMoney" id="endMoney" class="form-control" onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-4 form-group">
                                        <label class="col-sm-4 col-md-4 col-lg-4 lin32 p-l-0 text-right font14 normal" for="rangetime"><?=__('消费时间')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8 p-0">
                                            <input type="text" placeholder="<?=__('请选择添加时间')?>" name="reservation" id="rangetime" class="form-control" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-4 form-group">
                                        <label class="col-sm-4 col-md-3 col-lg-3 lin32 p-l-0 text-right font14 normal">&nbsp;</label>
                                        <div class="col-sm-8 col-md-9 col-lg-9 p-0">
                                            <button type="button" class="btn btn-default waves-effect waves-light" id="btn-reset"> <i class="fa fa-trash-o"></i> <?=__('重置')?></button>
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
                    <div class="panel-body">
                        <table cellspacing="0" class="table table-striped table-bordered dt-responsive nowrap" id="tableWrapper"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
<!-- 双击订单详情Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
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
                        <form role="form" class="form-horizontal" id="memberInfoForm">
                            <div class="panel-body col-sm-12 col-md-12 col-lg-12" id="memberDivInfo">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 lin32" for="user_name"><?=__('会员账号')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8 p-0">
                                            <input type="text" id="user_name" name="user_name" class="form-control" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 lin32" for="user_realname"><?=__('会员名称')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8 p-0">
                                            <input type="text" id="user_realname" name="user_realname" class="form-control" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 lin32" for="member_grade_name"><?=__('会员等级')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8 p-0">
                                            <input type="text" id="member_grade_name" name="member_grade_name" class="form-control" readonly="readonly">
                                        </div>
                                    </div>
                                </div>                               
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- 订单基本信息 -->
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
                        <form role="form" class="form-horizontal" id="orderGoodsForm">
                            <div class="clear m-t-15" id="order_info">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 control-label" for="detail_order_id"><?=__('订单号')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8 ">
                                            <input type="text" id="detail_order_id" name="order_id" class="form-control" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 control-label" for="order_pay_amount"><?=__('折后金额')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8 ">
                                            <input type="text" id="order_pay_amount" name="order_pay_amount" class="form-control" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 control-label" for="pay_money"><?=__('余额支付')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8 ">
                                            <input type="text" id="pay_money" name="pay_money" class="form-control" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 control-label" for="pay_cash"><?=__('现金支付')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8 ">
                                            <input type="text" id="pay_cash" name="pay_cash" class="form-control" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 control-label" for="pay_union"><?=__('刷卡支付')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8 ">
                                            <input type="text" id="pay_union" name="pay_union" class="form-control" readonly="readonly">
                                        </div>
                                    </div>   
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 control-label" for="order_create_time"><?=__('订单日期')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8  ">
                                            <input type="text" id="order_create_time" name="order_create_time" class="form-control" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 control-label" for="order_points"><?=__('获得积分')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8  ">
                                            <input type="text" id="order_points" name="order_points" class="form-control" readonly="readonly">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 control-label" for="order_number"><?=__('产品总数')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8  ">
                                            <input type="text" id="order_number" name="order_number" class="form-control" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 control-label" for="pay_online"><?=__('微信/支付宝')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8  ">
                                            <input type="text" id="pay_online" name="pay_online" class="form-control" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 control-label" for="order_remark"><?=__('备注')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8  ">
                                            <textarea id="order_remark" name="order_remark" class="form-control" readonly="readonly" style="height: 82px; line-height: 20px; overflow-x: hidden;"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- 消费商品 -->
            <form role="form" class="clear form-horizontal" id="order_goods">
                <div class="panel-body" id="order_goods_info">
                    <table cellspacing="0" class="table table-striped table-bordered dt-responsive nowrap" id="orderGoods"></table>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 退货modal -->
<div id="returnModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="returnModalLabel">退货</h4>
            </div>
            <form role="form" id="returnForm">
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="orderGoodsList" class="table table-striped table-bordered dt-responsive nowrap table-hover"></table>
                    </div>
                    <div id="refundPay">
                        <div class="form-group m-t-15">
							退货金额：<label id="returnMoney" style="color: red">0</label>
                        </div>
                        <div class="form-group">
                            <label for="return_remark" class="col-xs-2 col-sm-1 col-md-1 col-lg-1 p-0 lin32 normal">备注：</label>
                            <div class="col-xs-10 col-sm-11 col-md-11 col-lg-11">
                                <input type="text" class="form-control" id="return_remark" maxlength="100" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 p-0 m-b-15 m-t-15">
                            <button class="btn b-racius3 btn-warning waves-effect waves-light pull-left" id="btn-return" type="button">退货</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<link rel="stylesheet" href="<?=$this->css('bootstrap-datepicker')?>">
<link rel="stylesheet" href="<?=$this->css('daterangepicker')?>">
<script src="<?=$this->js('moment')?>" charset="utf-8"></script>
<script src="<?=$this->js('daterangepicker')?>" charset="utf-8"></script>
<script src="<?=$this->js('print/LodopFuncs')?>"></script>
<script src="<?=$this->js('common/print')?>"></script>
<script src="<?=$this->js('controllers/cashier/order')?>" charset="utf-8"></script>