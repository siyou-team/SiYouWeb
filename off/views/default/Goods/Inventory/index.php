<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<ul class="nav nav-tabs">
	<li><a href="<?=Zero_Registry::get('index_page')?>?ctl=Goods_Base&met=index&typ=e"><?=__('产品管理')?></a></li>
    <li class="active"><a href="<?=Zero_Registry::get('index_page')?>?ctl=Goods_Inventory&met=index&typ=e"><?=__('库存管理')?></a></li>
	<!--<li><a href="<?=Zero_Registry::get('index_page')?>?ctl=Goods_Inventory&met=order&typ=e"><?=__('出入库明细')?></a></li>-->
</ul>
<div class="container">
    <div class="main-content">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row m-t-10">
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xs-12 ">
                                <div id="form-btn"></div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right">
                                <div>
                                    <div class="input-group m-b-10">
                                        <input type="text" placeholder="<?=__('产品编号')?>" class="form-control" name="goodsKey" id="goodsKey" />
                                        <span class="input-group-btn">
                                            <button class="btn waves-effect waves-light btn-warning" type="button" id="btn-query"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="ScreenDiv" class=" collapse">
                            <div class="panel-body col-sm-12 col-md-12 col-lg-12">
                                <div class="form-horizontal" id="searchForm">
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="col-xs-4 col-sm-3 col-md-3 col-lg-2 control-label" for="LogicStockNum"><?=__('库存数量')?></label>
                                        <div class="col-xs-8 col-sm-9 col-md-9 col-lg-9">
                                            <select id="Sel_StockNum" class="form-control" style="float: left; width: 50%">
                                                <option value=""><?=__('选择')?></option>
                                                <option value="1"><?=__('大于')?></option>
                                                <option value="2"><?=__('小于')?></option>
                                                <option value="3"><?=__('等于')?></option>
                                                <option value="4"><?=__('大于等于')?></option>
                                                <option value="5"><?=__('小于等于')?></option>
                                            </select>
                                            <input type="text" placeholder="<?=__('库存数量')?>" id="LogicStockNum" class="form-control" style="float: left; width: 49%; margin-left: 1%;" />
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                        <button type="reset" class="btn btn-default waves-effect waves-light m-r-15" id="btnReset"><i class="fa fa-trash-o"></i> <?=__('重置')?></button>
                                        <button type="button" class="btn btn-warning waves-effect waves-light" id="btnSrech"><i class="fa fa-search"></i> <?=__('查询')?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clear m-t-15 table-responsive">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 商品入库Table -->
<div class="modal fade" id="inventoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" style="width: 750px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><?=__('产品入库')?></h4>
            </div>
            <form role="form" class="form-horizontal" id="GoodsFormModel">
                <div class="modal-body">
                    <div class="row">
                        <div class="btn-group btn-form col-xs-12 col-sm-3 col-md-3 col-lg-3 ">
                            <button type="button" class="btn btn-default waves-effect waves-light m-b-15" id="check-goods"><?=__('选择产品')?> <i class="fa fa-plus"></i></button>
                        </div>
                        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 ">
                            <label class="col-xs-12 col-sm-6 col-md-6 col-lg-3  control-label" for="supplier"><?=__('供应商')?>：</label>
                            <div class="btn-group btn-form col-xs-12 col-sm-6 col-md-6 col-lg-9 ">
                                <div class="form-group">
                                    <select id="supplier" name="supplier" class="form-control">
                                        <option value=""><?=__('请选择')?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12">
                            <div class="form-group table-responsive" style="max-height: 250px; overflow-y: scroll;">
                                <table id="tbl_GoodsList" class="table table-striped table-bordered dt-responsive nowrap"></table>
                            </div>
                        </div>
                    </div>
                    <div class="row">                     
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <label class="col-xs-3 col-sm-2 col-md-2 col-lg-2 lin32 p-0" for="inventory_remark"><?=__('备注')?>：</label>
                            <div class="col-xs-9 col-sm-10 col-md-10 col-lg-10 p-0">
                                <input id="inventory_remark" name="inventory_remark" class="form-control" style="height: 30px;" autocomplete="off" />
                            </div>
                        </div>
						<div class="clear"></div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
                            <div class="clear">
                                <label for="inventory_number"><?=__('总数量')?>：</label><span class="h4 text-success" id="inventory_number"> 0</span>
                            </div>
                            <div class="clear">
                                <label for="inventory_amount"><?=__('总金额')?>：<?=__('￥')?></label><span class="h4 text-warning" id="inventory_amount">0</span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer tc">
                    <button type="submit" class="btn btn-warning waves-effect waves-light" id="btn-save"><?=__('保存')?></button>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"><?=__('取消')?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 产品选择列表 -->
<div id="GoodsModal" class="modal fade" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 750px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><?=__('产品列表')?></h4>
            </div>
            <form role="form" id="GoodsForm" class="form-horizontal">
                <div class="modal-body" style="min-height: 400px;">
                    <div>
                        <div class="input-group col-sm-12 col-md-12 col-lg-12 m-b-15">
                            <input type="text" placeholder="<?=__('产品编号')?>" class="form-control col-sm-12 col-md-12 col-lg-12" name="goodsCode" id="goodsCode" />
                            <span class="input-group-btn">
                                <button class="btn waves-effect waves-light btn-warning" type="button" id="btn-gquery"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div>
                    <div>
                        <table id="tbl_Goods" class="table table-striped table-bordered dt-responsive nowrap"></table>
                    </div>
                </div>
                <div class="modal-footer tc">
                    <button type="button" id="confirm-goods" class="btn b-racius3 btn-warning waves-effect waves-light"><?=__('确定')?></button>
                    <button type="button" class="btn b-racius3 btn-default waves-effect" data-dismiss="modal"><?=__('关闭')?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 产品调拨 -->
<div class="modal fade" id="AllotModal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" style="width: 750px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="backModalLabel"><?=__('产品调拨')?></h4>
            </div>
            <form role="form" class="form-horizontal" id="formModel">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12 col-md-12">
                            <div class="col-sm-2 col-md-2 col-lg-2 p-0">
                                <button type="button" class="btn btn-default waves-effect waves-light m-b-15" id="ShowStocks"><?=__('选择产品')?> <i class="fa fa-plus"></i></button>
                            </div>
                            <div class="col-sm-5 col-md-5 col-lg-5 p-0 m-b-10">
                                <label class="col-sm-4 col-md-4 col-lg-4 lin32 text-right p-0" for="out_chain_id"><?=__('调出店铺')?>：</label>
                                <div class="col-sm-8 col-md-8 col-lg-8">
                                    <select id="out_chain_id" class="form-control" style="width: 100%;"></select>
                                </div>
                            </div>
                            <div class="col-sm-5 col-md-5 col-lg-5 p-0 m-b-10">
                                <label class="col-sm-4 col-md-4 col-lg-4 lin32 text-right p-0" for="in_chain_id"><?=__('调入店铺')?>：</label>
                                <div class="col-sm-8 col-md-8 col-lg-8">
                                    <select id="in_chain_id" class="form-control"></select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-12 col-md-12 m-t-10">
                            <div style="max-height: 210px; overflow-y: scroll;">
                                <table id="tbl_GoodsStock" class="table table-striped table-bordered dt-responsive nowrap"></table>
                            </div>
                        </div>
                    </div>
                    <div class="row m-t-15">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <label class="col-xs-3 col-sm-3 col-md-2 col-lg-3 lin32 p-0" for="allot_remark"><?=__('备注')?>：</label>
                            <div class="col-xs-9 col-sm-9 col-md-10 col-lg-9 p-0">
                                <input id="allot_remark" name="allot_remark" class="form-control" style="height: 30px;" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-right">
                            <label class="control-label" for="allot_number"><?=__('总数量')?>：</label><span class="h4 text-success" id="allot_number">0</span><label class="control-label" for="allot_money">&nbsp;&nbsp;<?=__('总金额')?>：</label> <?=__('￥')?> <span class="h4 text-warning" id="allot_money">0</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer tc clear">
                    <button type="submit" class="btn btn-warning waves-effect waves-light" id="btnSub"><?=__('保存')?></button>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"><?=__('取消')?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--模态框 库存信息-->
<div id="StockModal" class="modal fade" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 750px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><?=__('库存列表')?></h4>
            </div>
            <form role="form" id="StockForm" class="form-horizontal">
                <div class="modal-body" style="min-height: 400px;">
                    <div class="">
                        <div class="input-group col-sm-12 col-md-12 col-lg-12 m-b-15">
                            <input type="text" placeholder="<?=__('产品编号')?>" class="form-control col-sm-12 col-md-12 col-lg-12" id="StockCode" />
                            <span class="input-group-btn">
                                <button class="btn waves-effect waves-light btn-warning" type="button" id="StockSearch"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="">
                        <table id="tbl_Stocks" class="table table-striped table-bordered dt-responsive nowrap"></table>
                    </div>
                </div>
                <div class="modal-footer tc">
                    <button type="button" id="btn_Ok" class="btn b-racius3 btn-warning waves-effect waves-light"><?=__('确定')?></button>
                    <button type="button" id="btn_Cancel" class="btn b-racius3 btn-default waves-effect" data-dismiss="modal"><?=__('关闭')?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 库存盘点Table Modal -->
<div class="modal fade" id="checkModal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" style="width: 750px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close check-close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><?=__('库存盘点')?></h4>
            </div>
            <form role="form" class="form-horizontal" id="check-form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12 col-md-12">
                            <div class="col-sm-12 col-md-12 col-lg-2 p-0">
                                <button type="button" class="btn btn-default waves-effect waves-light m-b-15" id="show-check"><?=__('选择产品')?> <i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-12 col-md-12 m-t-10">
                            <div class="col-sm-12 col-md-12 col-lg-12 p-0">
                                <div style="max-height: 400px; overflow-y: scroll;">
                                    <table id="table-check" class="table table-striped table-bordered dt-responsive nowrap"></table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-t-20">
                        <div class="col-sm-12 col-lg-12 col-md-12">
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <label for="over_qty"><?=__('报溢数量')?>：</label><span class="h5 text-success" id="over_qty">0</span>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <label for="over_amount"><?=__('报溢金额')?>：</label><span class="h5 text-warning"><span><?=__('￥')?></span><span id="over_amount">0</span></span>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <label for="loss_qty"><?=__('报损数量')?>：</label><span class="h5 text-success" id="loss_qty">0</span>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <label for="loss_amount"><?=__('报损金额')?>：</label><span class="h5 text-warning"><span><?=__('￥')?></span><span id="loss_amount">0</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="row m-t-5">
                        <div class="col-sm-12 col-lg-12 col-md-12">
                            <label class="col-xs-3 col-sm-2 col-md-2 col-lg-2 p-r-0" for="remark"><?=__('备　　注')?>：</label>
                            <div class="col-xs-9 col-sm-10 col-md-10 col-lg-10 p-l-0">
                                <div class="form-group">
                                    <input type="text" id="remark" autofocus="autofocus" name="remark" class="form-control" autocomplete="off" style="resize: none;" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear modal-footer tc">
                    <button type="submit" class="btn btn-warning waves-effect waves-light" id="btn-check-save"><?=__('保存')?></button>
                    <button type="button" class="btn btn-default waves-effect check-close" data-dismiss="modal"><?=__('取消')?></button>
                </div>
            </form>
        </div>
    </div>
</div>
	
<!--模态框 库存信息-->
<div id="InventoryModal" class="modal fade" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width: 750px;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title"><?=__('库存列表')?></h4>
			</div>
			<form role="form" id="InventoryForm" class="form-horizontal">
				<div class="modal-body" style="min-height: 400px;">
					<div class="">
						<div class="input-group col-sm-12 col-md-12 col-lg-12">
							<input type="text" placeholder="<?=__('产品编号')?>" class="form-control col-sm-12 col-md-12 col-lg-12" id="InventoryCode" />
							<span class="input-group-btn">
								<button class="btn waves-effect waves-light btn-warning" type="button" id="InventorySearch"><i class="fa fa-search"></i></button>
							</span>
						</div>
					</div>
					<div>
						<table id="tbl_Inventory" class="table table-striped table-bordered dt-responsive nowrap"></table>
					</div>
				</div>
				<div class="modal-footer tc">
					<button type="button" id="btn_Inventory" class="btn b-racius3 btn-warning waves-effect waves-light"><?=__('确定')?></button>
					<button type="button" class="btn b-racius3 btn-default waves-effect" data-dismiss="modal"><?=__('关闭')?></button>
				</div>
			</form>
		</div>
	</div>
</div>
	
<!--模态框 库存变更记录-->
<div id="DetailModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 750px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="LogTitle"><?=__('盘点记录')?></h4>
            </div>
            <form role="form" id="DetailForm" class="form-horizontal">
                <div class="modal-body">
                    <div class="clear">
                        <table id="tbl_GoodsLog" class="table table-striped table-bordered dt-responsive nowrap"></table>
                    </div>
                </div>
                <div class="modal-footer tc">
                    <button type="button" class="btn b-racius3 btn-default waves-effect" data-dismiss="modal"><?=__('关闭')?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?=$this->js('controllers/goods/inventory')?>" charset="utf-8"></script>
<script src="<?=$this->js('controllers/goods/allot')?>" charset="utf-8"></script>
<script src="<?=$this->js('controllers/goods/check')?>" charset="utf-8"></script>