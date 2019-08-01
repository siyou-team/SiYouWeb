<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<style type="text/css">
	.modal .modal-dialog .modal-content{padding:0;}
	.pagingUl{float: right;padding: 0;margin: 0;list-style: none;}
    .pagingUl li{float: left;list-style: 30px;text-align: center;margin-left:-1px;}
    .pagingUl li a{text-decoration: none;display: inline-block;padding:6px 12px;text-align: center;background: #ffffff;color: #373e4a;font-size: 12px;border: 1px solid #ddd;}
	.prv, .next{padding:6px 12px;float: left;text-align: center;border: 1px solid #ddd;cursor: pointer;margin-left:-1px;}
	.first, .last{padding:6px 12px;font-size: 12px;text-align: center;border: 1px solid #ddd;cursor: pointer;}
	.actives {background-color: #337ab7!important;color: #ffffff!important;}
	
	.goodsList{padding:0 15px;}
	.goodsList .goods{padding:0px;margin-bottom:10px;}
	.goodsList .goods-detail{background: #fff;height: 80px;border: 1px solid #dadada;border-radius: 5px;box-shadow: 1px 1px 1px 0 #eee;cursor:pointer;}
	.goodsList .goods-detail .goods-img{width:60px;height:60px;float:left;padding: 7.5px 5px;background: #FFF;height: 78px;padding-right: 10px;width: 70px;border-radius: 5px 0px 0px 5px;}
	.goodsList .text_xz{margin-left: 5px;float:left;width: 50%;line-height:30px;margin-right:-5px;}
	.goodsList .text_20{height:20px;line-height:20px;}
	.even{margin-right:5px;}
	.odd{margin-left:5px;}
</style>
	
<ul class="nav nav-tabs">
	<li class="active"><a href="javascript:;"><?=__('产品收银')?></a></li>
</ul>
<OBJECT ID="TestOCX" CLASSID="CLSID:B72CA6E3-F35B-4BF1-B0F0-456A2F84CE7C" CODEBASE="c-d.CAB" width=180 height=50 style="display:none;">
<PARAM NAME="port" VALUE="COM3" />
</OBJECT>
<div class="container">
    <div class="main-content">
        <div class="row">
            <div class="col-sm-5 col-md-5 col-lg-5">
                <div class="panel panel-default">
                    <!-- /产品搜索 -->
                    <div class="panel-body">
                        <div class="input-group">
                            <input type="text" id="goodsCode" name="goodsCode" class="form-control" placeholder="<?=__('产品编号')?>" autocomplete="off">
                            <span class="input-group-btn">
                                <button type="button" class="btn waves-effect waves-light btn-warning" id="edt_Search"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div>
					<button type="button" class="btn btn-default waves-effect pull-right m-r-15" id="btn-add-goods"><?=__('新增产品')?> <i class="fa fa-plus"></i></button>

                    <!-- /产品图片 -->
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 ">
                                <div class="portfolioFilter title-box">
                                    <ul class="nav nav-pills fenlei" id="edt_UlgoodsClass">
                                        <li class="active"><a href="#" onclick="GoodsCashier.search(0)" style="border-bottom: none 0px;"><?=__('全部商品')?></a></li>
										<li><a style="border-bottom:none 0px;" href="#" data-toggle="tab"  onclick="GoodsCashier.search(1)" id="GoodsGroup"><?=__('套餐')?></a></li>
                                    </ul>
                                    <div class="change hidden">
                                        <button type="button" class="btn waves-effect waves-light btn-warning" id="GoodsCashierClass_Pre"><i class="fa fa-angle-left" title="<?=__('向左')?>"></i></button>
                                        <button type="button" class="btn waves-effect waves-light btn-warning m-l-5" id="GoodsCashierClass_Next"><i class="fa fa-angle-right" title="<?=__('向右')?>"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" container">
                        <div class="row port" style="margin-top: -1%">
                            <div class="goodsList" id="ul_GoodsList">
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="panel panel-default col-sm-12  col-md-12 col-lg-12 pull-right m-t-15" style="margin-bottom:0;">
                        <nav class="pull-right">
                            <ul class="pagination m-b-15" id="edt_PageInit"></ul>
                        </nav>
                    </div>
                    <!-- /产品图片结束 -->
                </div>
            </div>
            <div class="col-sm-7 col-md-7 col-lg-7 p-l-0">
                <div class="panel  panel-default">
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" id="memberKey" name="memberKey" class="form-control" placeholder="<?=__('会员卡号')?>" data-flag="103" autocomplete="off">
                                <label class="input-group-btn">
                                    <button type="button" class="btn waves-effect waves-light btn-warning" id="bth-member"><i class="fa fa-search"></i></button>
                                </label>
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger waves-effect waves-light" id="edt_Sk"><?=__('散客')?></button>
                        <button type="button" class="btn btn-default waves-effect pull-right" id="edt_AddMem"><?=__('新增会员')?> <i class="fa fa-plus"></i></button>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="portlet" style="box-shadow: none;">
                            <!-- /portlet heading -->
                            <div class="panel-collapse collapse" id="div_MemInfo">
                                <div class="panel-collapse collapse in">
                                    <div class="pull-right m-t-10">
                                        <span class="divider"></span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-collapse collapse in" id="MemInfo">
                                    <div class="col-sm-3 col-md-3 col-lg-2 m-b-10" style="padding-left: 5px;">
                                        <img src="" id="avatar" class="b-racius0" width="85" height="85">
                                    </div>
                                    <div class="sy_hy02 col-sm-9 col-md-9 col-lg-10 lin32 p-r-0" style="padding-left: 15px;">
                                        <h4 id="member_card"></h4>
                                        <div class="biaoqianA m-t-10 m-l-10">
                                            <ul id="tag_name">
                                            </ul>
                                        </div>
                                        <div class="clearfix"></div>
                                        <p><?=__('积分')?>：<span id="member_points" class="text-warning font14">&nbsp;</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Portlet -->
                    </div>
					<div class="clear m-r-15 text-right">
						<div class="center-block" id="">
                            <button class="btn b-racius3 btn-success waves-effect waves-light btn-lg m-t-5 m-r-5" type="button" id="edt_ClearTable"><?=__('清空')?></button>
                            <button class="btn b-racius3 btn-warning waves-effect waves-light btn-lg m-t-5 m-r-5" type="button" id="edt_Pay"><?=__('结帐')?></button>
                        </div>
					</div>
                    <div class="clear panel-body">
                        <table class="table table-bordered table-hover" id="tbl_CartData"></table>
                        <div class="row m-t-15 m-b-15">
                            <div class="col-sm-6 col-md-6 col-lg-6 h5"><?=__('共')?><span class="text-warning bold" id="span_GoodsTypeNum">0</span><?=__('种商品，数量')?><span class="text-warning bold" id="span_totalGoodsNum">0</span></div>
                            <div class="col-sm-6 col-md-6 col-lg-6 text-right h5"><?=__('合计金额')?>：<?= __('￥')?><span class="text-warning" id="p_hjje">0.00</span></div>
                            <div class="clearfix"></div>
                            <div class="col-sm-12 col-md-8 col-lg-8 p-r-0" id="div_Special" style="display:none;">
                                <div class="h5 col-sm-4 col-md-4 col-lg-3 p-0"><?=__('优惠活动')?>：</div>
                                <div class="col-sm-8 col-md-6 col-lg-6 p-0">
                                    <select id="goodsCashier_select_Special" data-toggle="mouseover" data-placement="bottom" data-original-title="" class="form-control p-0"></select>&nbsp;
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 text-right h5 p-l-0 pull-right"><?=__('折后金额')?>：<?= __('￥')?><span class="text-warning" id="p_zhje">0.00</span></div>
                            <div class="clearfix"></div>
                            <div class="col-sm-12 col-md-4 col-lg-4 text-right h5 p-l-0 pull-right" id="div_Point"><?=__('合计积分')?>：&nbsp;&nbsp;&nbsp;<span class="text-warning" id="p_hjjf">0.00</span></div>
                            <div class="col-sm-12 col-md-12 col-lg-12 p-r-0" style="display:none;">
                                <div class="h5 col-sm-4 col-md-3 col-lg-2 p-0"><?=__('备　 注')?>：</div>
                                <div class="col-sm-8 col-md-9 col-lg-10 p-l-0">
                                    <textarea id="txtare_Remark" name="Remark" rows="2" class="form-control" maxlength="150"></textarea>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- container -->

<!-- 右侧弹窗start -->
<div class="right_M" id="ReviseNumberModal">
    <div class="rightShow">
        <h3 id="ReviseNumberLabel"><?=__('商品信息')?><a><i class="fa fa-close" id="Rs_close"></i></a></h3>
        <form role="form" id="ReviseNumberForm" class="form-horizontal">
            <input type="hidden" id="Revisecount" />
            <div class="form-group">
                <label class="col-sm-3 col-md-2 col-lg-2 lin32 text-right"><?=__('商品单价')?>：</label>
                <div class="col-sm-9 col-md-10 col-lg-10">
                    <input type="text" class="form-control" id="lbl_Price" maxlength="8" name="Price" />
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 col-md-2 col-lg-2 lin32 text-right"><?=__('商品数量')?>：</label>
                <div class="col-sm-9 col-md-10 col-lg-10">
                    <input type="text" class="form-control" id="edt_Qty" name="Qty" />
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 col-md-2 col-lg-2 lin32 text-right"><?=__('商品积分')?>：</label>
                <div class="col-sm-9 col-md-10 col-lg-10">
                    <input type="text" class="form-control" id="edt_Point" name="Point" maxlength="8" />
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 col-md-2 col-lg-2 lin32 text-right"><?=__('商品小计')?>：</label>
                  <div class="col-sm-9 col-md-10 col-lg-10 lin32 font14 text-warning" style="position: relative;">  <span style="position: absolute;left:20px;top: 2px;"><?= __('￥')?></span><input type="text" class="form-control text-warning"  id="lbl_TotalMoney" maxlength="8" name="TotalMoney" style="padding-left:18px;" /></div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group clear" style="display: none;">
                <label class="fm_left"><?=__('提成员工')?>：<span></span></label>
                <div class="col-sm-9 col-md-9 col-lg-9 ">
                    <div class="input-group">
                        <input type="hidden" id="edtStaff" class="form-control" name="Staff" />
                        <span class="input-group-btn">
                            <button class="btn b-racius3 btn-danger waves-effect waves-light" id="edt_SetStaff" type="button"><i class="fa fa-wrench"></i></button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group staff">
                <div class="clear">
                    <div class="col-xs-5 col-sm-5 col-md-4 col-lg-4">
                        <div id="div_GoodsCashierzTree" class="ztree"></div>
                    </div>
                    <div class="col-xs-7 col-sm-7 col-md-8 col-lg-8">
                        <div class="table-responsive">
                            <table id="tbl_GoodsCashierStaff" class="table table-striped table-bordered dt-responsive nowrap"></table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer tc clear">
                <button type="submit" id="edt_ReviseNumber" class="btn b-racius3 btn-warning waves-effect waves-light"><?=__('保存')?></button>
                <button type="button" id="edt_ReviseNumberClose" class="btn b-racius3 btn-default waves-effect" data-dismiss="modal"><?=__('关闭')?></button>
            </div>
        </form>
    </div>
</div>
<!-- 右侧弹窗 end -->

<!--套餐内商品库存不足-->
<div id="NoStockModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal_w_500">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><?=__('提示')?></h4>
            </div>
            <form role="form" id="Form1" class="form-horizontal">
                <div class="modal-body">
                    <div class="clear">
                        <div class="form-group tc">
                            <label class="control-label"><?=__('当前套餐内,有部分商品库存不足')?></label>
                        </div>
                    </div>
                    <div class="clear">
                        <div class="clear table-responsive">
                            <table id="tbl_NoStockGoodsData" class="table table-striped table-bordered dt-responsive nowrap"></table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer tc">
                    <button type="button" class="btn b-racius3 btn-default waves-effect" data-dismiss="modal"><?=__('取消')?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--产品信息列表-->
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
                        <div class="input-group col-sm-12 col-md-12 col-lg-12">
                            <input type="text" placeholder="<?=__('产品编号/简码/名称')?>" class="form-control col-sm-12 col-md-12 col-lg-12" name="NameCode" id="NameCode" />
                            <span class="input-group-btn">
                                <button class="btn waves-effect waves-light btn-warning" type="button" id="Btn_Gquery"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div>
                    <div>
                        <table id="tbl_Goods" class="table table-striped table-bordered dt-responsive nowrap"></table>
                    </div>
                </div>
                <div class="modal-footer tc">
                    <button type="button" id="edt_Ok" class="btn b-racius3 btn-warning waves-effect waves-light"><?=__('确定')?></button>
                    <button type="button" class="btn b-racius3 btn-default waves-effect" data-dismiss="modal"><?=__('关闭')?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="addGoodsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="goodsModalLabel" aria-hidden="true" style="display: none">
    <div class="modal-dialog" style="width: 750px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="goodsModalLabel">新增产品</h4>
            </div>
            <form role="form" id="addGoodsForm" class="form-horizontal">
                <div class="modal-body">
                    <div class="col-sm-9 col-md-9 col-lg-9">
						<div class="row hidden">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="goods_name"><?=__('产品分类')?><span class="text-danger">*</span></label>
                                    <div class="col-sm-9 col-md-9 col-lg-9 p-0">
                                        <select id="goods_cat" name="goods_cat_id" class="form-control"></select>
                                    </div>
                                </div>
                            </div>
                        </div>
					
						<div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="goods_code"><?=__('产品编号')?><span class="text-danger">*</span></label>
                                    <div class="col-sm-9 col-md-9 col-lg-9 p-0">
                                        <input type="text" placeholder="" id="goods_code" name="goods_code" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
					
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="goods_name"><?=__('产品名称')?><span class="text-danger">*</span></label>
                                    <div class="col-sm-9 col-md-9 col-lg-9 p-0">
                                        <input type="text" placeholder="" id="goods_name" name="goods_name" class="form-control" autocomplete="off" value="reparto">
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="goods_price"><?=__('零售价格')?><span class="text-danger">*</span></label>
                                    <div class="col-sm-9 col-md-9 col-lg-9 p-0">
                                        <input type="text" placeholder="" id="goods_price" name="goods_price" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="row hidden">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="goods_cost"><?=__('成本价')?><span class="text-danger">*</span></label>
                                    <div class="col-sm-9 col-md-9 col-lg-9 p-0">
                                        <input type="text" placeholder="" id="goods_cost" name="goods_cost" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
 
                        <div class="row hidden">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="col-sm-3 col-md-3 col-lg-3 control-label" for="goods_remark"><?=__('备注')?></label>
                                    <div class="col-sm-9 col-md-9 col-lg-9 p-0">
                                        <input type="text" name="goods_remark" id="goods_remark" class="form-control" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="modal-footer tc">
                    <button type="submit" class="btn b-racius3 btn-warning waves-effect waves-light" id="btn-save-goods"><?=__('保存')?></button>
                    <button type="button" class="btn b-racius3 btn-default waves-effect" data-dismiss="modal"><?=__('取消')?></button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script src="<?=$this->js('common/member')?>"></script>
<script src="<?=$this->js('common/cashier')?>"></script>
<script src="<?=$this->js('print/LodopFuncs')?>"></script>
<script src="<?=$this->js('common/print')?>"></script>
<script src="<?=$this->js('plugins/page')?>"></script>
<script src="<?=$this->js('controllers/cashier/goods')?>" charset="utf-8"></script>