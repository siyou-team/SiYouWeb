<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<link rel="stylesheet" href="<?=$this->css('bootstrap-datepicker')?>">
<link rel="stylesheet" href="<?=$this->css('daterangepicker')?>">
<ul class="nav nav-tabs">
    <li><a href="<?=Zero_Registry::get('index_page')?>?ctl=Goods_Inventory&met=index&typ=e"><?=__('库存管理')?></a></li>
	<li class="active"><a href="<?=Zero_Registry::get('index_page')?>?ctl=Goods_Inventory&met=order&typ=e"><?=__('出入库明细')?></a></li>
	<li><a href="<?=Zero_Registry::get('index_page')?>?ctl=Goods_Allot&met=index&typ=e"><?=__('调入确认')?></a></li>
</ul>
<div class="container">
    <div class="main-content">
		<div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row m-t-10">
                            <div class="col-xs-6 col-sm-3 col-md-3 col-lg-4 p-0">
                                <label class="col-xs-4 col-sm-4 col-md-4 col-lg-3 p-l-0 lin32 text-right" for="inventory_id"><?=__('订单号')?>：</label>
                                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-9 p-l-0">
                                    <input type="text" placeholder="<?=__('输入单据号')?>" id="inventory_id" maxlength="20" name="inventory_id" class="form-control" style="padding-right: 0px;" />
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
                                        <label class="col-sm-4 col-md-4 col-lg-4 lin32 p-l-0 text-right font14 normal" for="inventory_type"><?=__('类型')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8 p-0">
                                            <select class="form-control" style="padding-right: 0px;" id="inventory_type"><option value="0"><?=__('全部')?></option><option value="1"><?=__('产品入库')?></option><option value="2"><?=__('销售出库')?></option><option value="3"><?=__('调拨出库')?></option><option value="4"><?=__('调拨入库')?></option>
                                            </select>
                                        </div>
                                    </div>
 
                                    <div class="col-sm-6 col-md-4 col-lg-4 form-group">
                                        <label class="col-sm-4 col-md-4 col-lg-4 lin32 p-l-0 text-right font14 normal" for="rangetime"><?=__('时间')?></label>
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
            <div class="panel-group panel-group-joined m-t-20" id="supplier">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="#collapseTwo" class="tianjia collapsed" data-parent="#accordion-test" data-toggle="collapse">
                                <i class="fa  md-person"></i><?=__('供应商信息')?>
                            </a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse guanbi_close" id="collapseTwo">
                        <form role="form" class="form-horizontal" id="memberInfoForm">
                            <div class="panel-body col-sm-12 col-md-12 col-lg-12" id="memberDivInfo">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 lin32" for="supplier_code"><?=__('供应商编号')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8 p-0">
                                            <input type="text" id="supplier_code" name="supplier_code" class="form-control" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 lin32" for="supplier_name"><?=__('供应商名称')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8 p-0">
                                            <input type="text" id="supplier_name" name="supplier_name" class="form-control" readonly="readonly">
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
                                            <input type="text" id="detail_order_id" name="inventory_id" class="form-control" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 control-label" for="inventory_amount"><?=__('金额')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8 ">
                                            <input type="text" id="inventory_amount" name="inventory_amount" class="form-control" readonly="readonly">
                                        </div>
                                    </div>
                                </div>
								
								<div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 control-label" for="inventory_number"><?=__('数量')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8  ">
                                            <input type="text" id="inventory_number" name="inventory_number" class="form-control" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 control-label" for="inventory_type_text"><?=__('类型')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8  ">
                                            <input type="text" id="inventory_type_text" name="inventory_type_text" class="form-control" readonly="readonly">
                                        </div>
                                    </div>
                                </div>
								
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 control-label" for="inventory_add_time"><?=__('订单日期')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8  ">
                                            <input type="text" id="inventory_add_time" name="inventory_add_time" class="form-control" readonly="readonly">
                                        </div>
                                    </div>
									
									<div class="form-group" id="seller_order_id">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 control-label" for="order_id"><?=__('销售单号')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8  ">
                                            <input type="text" id="order_id" name="order_id" class="form-control" readonly="readonly">
                                        </div>
                                    </div>
                                </div>
								
								<div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 p-0 control-label" for="inventory_remark"><?=__('备注')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8  ">
                                            <textarea id="inventory_remark" name="inventory_remark" class="form-control" readonly="readonly" style="height: 82px; line-height: 20px; overflow-x: hidden;"></textarea>
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

<script src="<?=$this->js('bootstrap/bootstrap-datetimepicker')?>" charset="utf-8"></script>
<script src="<?=$this->js('moment')?>" charset="utf-8"></script>
<script src="<?=$this->js('daterangepicker')?>" charset="utf-8"></script>
<script src="<?=$this->js('controllers/goods/inventoryOrder')?>" charset="utf-8"></script>