<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<ul class="nav nav-tabs">
	<li class="active"><a href="#" data-toggle="tab" aria-expanded="false"><span id="nav-title"></span></a></li>
</ul>
<div class="container">
	<div class="main-content">
	<!--- s main-content --->
		<div class="row">
            <div class="col-md-12 col-md-12 col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-body">
                            <div class="col-sm-6 col-md-6 col-lg-6 p-r-0">
                                <div class="row dataRow">
                                    <form role="form" class="form-horizontal" id="comboForm">
                                        <div class="col-md-12 col-md-12 col-lg-12 height-a of">
                                            <div class="form-group">
                                                <label class="col-sm-3 col-md-3 col-lg-3  control-label" for="goods_cat"><?=__('套餐分类')?><span class="text-danger">*</span></label>
                                                <div class="col-sm-8 col-md-8 col-lg-8">
                                                    <select id="goods_cat" name="combo_cat_id" class="form-control"></select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 col-md-3 col-lg-3  control-label" for="combo_code"><?=__('套餐编号')?><span class="text-danger">*</span></label>
                                                <div class="col-sm-8 col-md-8 col-lg-8">
                                                    <input type="text" placeholder="" id="combo_code" name="combo_code" class="form-control" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 col-md-3 col-lg-3  control-label" for="combo_name"><?=__('套餐名称')?><span class="text-danger">*</span></label>
                                                <div class="col-sm-8 col-md-8 col-lg-8">
                                                    <input type="text" placeholder="" id="combo_name" name="combo_name" class="form-control" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 col-md-3 col-lg-3  control-label" for="combo_price"><?=__('销售金额')?><span class="text-danger">*</span></label>
                                                <div class="col-sm-8 col-md-8 col-lg-8">
                                                    <input type="text" placeholder="<?=__('销售金额')?>" id="combo_price" name="combo_price" value="0" maxlength="8" class="form-control" onfocus="if(this.value=='0') this.value='';" onblur="if(this.value=='') this.value='0';" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 col-md-3 col-lg-3  control-label" for="combo_is_discount"><?=__('是否打折')?></label>
                                                <div class="col-sm-8 col-md-8 col-lg-8">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 checkbox checkbox-warning" id="edt_MinDiscountAddDiv">
														<input type="checkbox" id="combo_is_discount" name="combo_is_discount">
                                                    <label for="combo_is_discount"><?=__('此产品可以打折')?></label>
													</div>
                                                </div>
                                            </div>
                                                
											<div class="form-group">
                                                <label class="col-sm-3 col-md-3 col-lg-3  control-label" for="combo_min_discount"><?=__('最低折扣')?><span class="text-danger">*</span></label>
                                                <div class="col-sm-8 col-md-8 col-lg-8">
                                                    <input type="text" disabled="disabled" placeholder="<?=__('最低折扣')?>" id="combo_min_discount" name="combo_min_discount" value="0" class="form-control" onfocus="if(this.value=='0') this.value='';" onblur="if(this.value=='') this.value='0';" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 col-md-3 col-lg-3  control-label" for="combo_is_points"><?=__('是否积分')?></label>
                                                <div class="col-sm-8 col-md-8 col-lg-8">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 checkbox checkbox-warning"  id="edt_PointTypeAddDiv">
                                                            <input type="checkbox" id="combo_is_points" maxlength="8" name="combo_is_points">
                                                            <label for="combo_is_points"><?=__('此产品可以积分')?></label>
                                                    </div>
                                                </div>
                                            </div>
                                                
											<div class="form-group">
                                                <label class="col-sm-3 col-md-3 col-lg-3  control-label" for="combo_points_amount"><?=__('赠送积分')?><span class="text-danger">*</span></label>
                                                <div class="col-sm-8 col-md-8 col-lg-8">
                                                    <input type="text" disabled="disabled" placeholder="<?=__('赠送积分')?>" id="combo_points_amount" maxlength="8" name="combo_points_amount" value="0" class="form-control" onfocus="if(this.value=='0') this.value='';" onblur="if(this.value=='') this.value='0';" autocomplete="off">
                                                </div>
                                            </div>
                                                
											<div class="form-group">
                                                <label class="col-sm-3 col-md-3 col-lg-3  control-label" for="combo_remark"><?=__('备注')?><span>&nbsp;&nbsp;</span></label>
                                                <div class="col-sm-8 col-md-8 col-lg-8">
                                                    <input type="text" placeholder="" id="combo_remark" name="combo_remark" class="form-control" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                            
										<div class="col-sm-12 col-md-12 col-lg-12 border_t form_btn">
                                            <div class="form_btn_1 col-sm-12 col-md-12 col-lg-12  m-t-10 m-b-10">
                                                <div class="col-sm-3 col-md-3 col-lg-3 "><!--勿删除此标签--></div>
                                                
												<button type="submit" class="btn b-racius3 btn-warning waves-effect waves-light" id="save"><?=__('保存')?></button>
                                                    
												<button type="button" class="btn b-racius3 btn-default waves-effect m-l-10" data-dismiss="modal" id="btn-return"><?=__('返回')?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                                
							<div class="col-sm-6  col-md-6 col-lg-6 p-0">
                                <div class="row dataRow">
                                    <div class="form-group">
                                        <button class="btn btn-default waves-effect waves-light m-b-15" id="btn-goods"><?=__('添加套餐产品')?> <i class="fa fa-plus"></i></button>
                                    </div>
                                    
									<div class="table-responsive">
                                        <table id="tableCombo" class="table table-striped table-bordered dt-responsive nowrap"></table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- panel-body -->
                    </div>
                    <!-- panel -->
                </div>
            </div>
            <!-- End 新增产品 -->
        </div> 
	<!--- end main-content --->
	</div>
</div>
<div id="goodsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal_w_780">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><?=__('产品列表')?></h4>
            </div>
            <form role="form" id="goodsForm" class="form-horizontal" onsubmit="return false;">
                <div class="modal-body qingchu">
                    <div class="">
                        <div id="toolbar">
                            <div class="input-group m-b-10">
                                <input type="text" placeholder="<?=__('产品编号')?>" class="form-control" name="goodsCode" id="goodsCode">
                                <span class="input-group-btn">
                                    <button class="btn waves-effect waves-light btn-warning" type="button" id="btn-query"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="goodsTable" class="table table-striped table-bordered dt-responsive nowrap"></table>
                    </div>
                </div>
                <div class="modal-footer tc">
                    <button type="button" id="goods-confirm" class="btn b-racius3 btn-warning waves-effect waves-light"><?=__('确定')?></button>
                    <button type="button" id="btn-cancel" class="btn b-racius3 btn-default waves-effect" data-dismiss="modal"><?=__('关闭')?></button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script type="text/javascript" src="<?=$this->js('controllers/goods/comboManage')?>" charset="utf-8"></script>