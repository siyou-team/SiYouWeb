<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<style type="text/css">
	.modal .modal-dialog .modal-content{padding:0;}
	.small, small {font-size: 85%;}
	p{font-size:14px;}
	.shifou li{font-size:14px;}
</style>

<ul class="nav nav-tabs">
	<li class="active"><a href="#" data-toggle="tab" aria-expanded="false"><span id="nav-title"></span></a></li>
</ul>
<div class="container">
	<div class="main-content">
	<!--- s main-content --->
		<div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-body">
                            <form role="form" class="form-horizontal" id="goodsForm">
								<div class="col-sm-2 col-md-2 col-lg-2 text-center">
                                    <div class="row dataRow">
                                        <div>
                                            <!-- 图片 -->
                                            <div class="col-sm-12 col-md-12 col-lg-12 mart ">
                                                <img id="up_image" src="" alt="" class="b" width="180">
												<input type="hidden" name="goods_image" id="image_input">
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 mart">
                                                <input id="image-upload" type="file" name="upfile">
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 m-t-10">
                                                <?=__('推荐尺寸')?>：400 X 400
                                            </div>
                                        </div>
                                    </div>
                                </div>
							
                                <div class="col-sm-10 col-md-10 col-lg-10">
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-3  control-label" for="goods_cat"><?=__('产品分类')?><span class="text-danger">*</span></label>
                                        <div class="col-sm-8 col-md-10 col-lg-9 p-l-0">
                                            <div class="input-group">
                                                <select id="goods_cat" name="goods_cat_id" class="form-control"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-3  control-label" for="goods_code"><?=__('产品编号')?><span class="text-danger">*</span></label>
                                        <div class="col-sm-8 col-md-10 col-lg-9 p-l-0">
                                            <div class="input-group dw">
                                                <input type="text" placeholder="" id="goods_code" name="goods_code" class="form-control" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-3  control-label" for="goods_name"><?=__('产品名称')?><span class="text-danger">*</span></label>
                                        <div class="col-sm-8 col-md-10 col-lg-9 p-l-0">
                                            <input type="text" id="goods_name" name="goods_name" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
 
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-3  control-label" for="goods_unit"><?=__('计量单位')?><span>&nbsp;</span></label>
                                        <div class="col-sm-8 col-md-10 col-lg-9 p-l-0">
                                            <input type="text" placeholder="" id="goods_unit" name="goods_unit" class="form-control"autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-3  control-label" for="goods_spec"><?=__('产品规格')?><span>&nbsp;</span></label>
                                        <div class="col-sm-8 col-md-10 col-lg-9 p-l-0">
                                            <input type="text" placeholder="<?=__('产品规格')?>" id="goods_spec" name="goods_spec" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-3  control-label" for="goods_price"><?=__('零售价格')?><span class="text-danger">*</span></label>
                                        <div class="col-sm-8 col-md-10 col-lg-9 p-l-0">
                                            <input type="text" placeholder="<?=__('零售价格')?>" id="goods_price" name="goods_price" maxlength="8" class="form-control" onfocus="if(this.value=='0') this.value='';" onblur="if(this.value=='') this.value='0';" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-3  control-label" for="goods_cost"><?=__('成本价')?><span class="text-danger">*</span></label>
                                        <div class="col-sm-8 col-md-10 col-lg-9 p-l-0">
                                            <input type="text" placeholder="<?=__('成本价')?>" id="goods_cost" maxlength="8" name="goods_cost" class="form-control" onfocus="if(this.value=='0') this.value='';" onblur="if(this.value=='') this.value='0';" autocomplete="off">
                                        </div>
                                    </div>
									<div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-3  control-label" for="goods_tax_rate"><?=__('产品税率')?></label>
                                        <div class="col-sm-8 col-md-10 col-lg-9 p-l-0">
                                            <input type="text" placeholder="<?=__('产品税率')?>" id="goods_tax_rate" maxlength="8" name="goods_tax_rate" class="form-control" onfocus="if(this.value=='0') this.value='';" onblur="if(this.value=='') this.value='0';" autocomplete="off" >
											<p class="clear m-t-10"><?=__('产品税率单位%')?></p>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-3  control-label" for="goods_vip_price"><?=__('产品会员价')?></label>
                                        <div class="col-sm-8 col-md-10 col-lg-9 p-l-0">
                                            <input type="text" placeholder="<?=__('产品会员价')?>" id="goods_vip_price" maxlength="8" name="goods_vip_price" class="form-control" onfocus="if(this.value=='0') this.value='';" onblur="if(this.value=='') this.value='0';" autocomplete="off">
                                        </div>
                                    </div>
                                     
                                    <div class="clearfix"></div>
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-3  control-label" for="is_points"><?=__('赠送积分')?></label>
                                        <div class="col-sm-8 col-md-10 col-lg-9 p-l-0">
                                            <div class="shifou"><ul><li class="active" id="is_points" onclick="Manage.isPoints(1);"><?=__('赠送')?></li><li id="no_points" onclick="Manage.isPoints(0);"><?=__('不赠送')?></li></ul><div class="clearfix"></div></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-3  control-label" for="is_discount"><?=__('是否打折')?></label>
                                        <div class="col-sm-8 col-md-10 col-lg-9 p-l-0">
                                            <div class="shifou"><ul><li class="active" id="is_discount" onclick="Manage.isDiscount(1);"><?=__('打折')?></li><li id="no_discount" onclick="Manage.isDiscount(0);"><?=__('不打折')?></li></ul><div class="clearfix"></div></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-3  control-label"  id="points_type" for="goods_points_type"><?=__('积分方式')?> <span class="text-danger" id="span_point">*</span></label>
                                        <div class="col-sm-8 col-md-10 col-lg-9 p-l-0">
                                            <input type="text" placeholder="<?=__('积分方式')?>" id="goods_points_type" name="goods_points_type"  maxlength="8" class="form-control" disabled="disabled" style="background: #fafafa;" onfocus="if(this.value=='0') this.value='';" onblur="Manage.blurFun(1)" onkeyup="Manage.changeFun(1)">
                                            <p class="clear m-t-10"><?=__('0按照金额自动计算积分，大于0时固定积分')?></p>
                                              <p class="clear m-t-10" style="color:rgb(169, 68, 66); display:none;" id="points_tips" ><?=__('请输入数字并且小数点后2位')?></p>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-3  control-label" for="goods_min_rate" id="min_rate"><?=__('最低折扣')?><span class="text-danger" id="span_discount">*</span></label>
                                        <div class="col-sm-8 col-md-10 col-lg-9 p-l-0">
                                            <input type="text" placeholder="<?=__('最低折扣')?>" id="goods_min_rate" name="goods_min_rate" class="form-control" disabled="disabled" style="background: #fafafa;" onfocus="if(this.value=='0') this.value='';" onblur="Manage.blurFun(2)" onkeyup="Manage.changeFun(2)">
                                            <p class="clear m-t-10"><?=__('为0时没有最低折扣，不为0时限制会员折扣')?></p>
                                            <p class="clear m-t-10" style="color:rgb(169, 68, 66); display:none;"  id="discount_tips"><?=__('折扣输入不正确，请输入大于等于0小于1的数字 且最多2位小数')?></p>
                                        </div>
                                    </div>
									
									<div class="form-group col-sm-12 col-md-12 col-lg-6 p-0" id="supplier">
                                        <label class="col-sm-4 col-md-2 col-lg-3  control-label" for="supplier_id">供应商<span>&nbsp;</span></label>
                                        <div class="col-sm-8 col-md-10 col-lg-9 p-l-0">
                                            <select class="form-control" id="supplier_id" name="supplier_id"></select>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 p-0" id="stocks">
                                        <label class="col-sm-4 col-md-2 col-lg-3  control-label" for="goods_stock">产品库存<span>&nbsp;</span></label>
                                        <div class="col-sm-8 col-md-10 col-lg-9 p-l-0">
                                            <input type="text" placeholder="产品库存" id="goods_stock" name="goods_stock" class="form-control" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-3  control-label" for="goods_remark"><?=__('备注')?><span>&nbsp;</span></label>
                                        <div class="col-sm-8 col-md-10 col-lg-9 p-l-0">
                                            <input type="text" placeholder="<?=__('产品备注')?>" id="goods_remark" name="goods_remark" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
 
                                    <div class="form-group col-sm-12 col-md-12 col-lg-12 p-0 text-center">
                                        <button type="submit" class="btn btn-warning btn-padding" id="save"><?=__('保存')?></button>
                                        <button type="button" class="btn btn-default btn-padding m-l-10" data-dismiss="modal" id="btn-reset"><?=__('返回')?></button>
                                    </div>
                                </div>
                            </form>
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
<link rel="stylesheet" href="<?=$this->css('common/fileinput')?>">
<script src="<?=$this->js('plugins/fileinput/fileinput.min')?>" charset="utf-8"></script>
<script src="<?=$this->js('plugins/fileinput/fileinput_locale_zh')?>" charset="utf-8"></script>
<script src="<?=$this->js('controllers/goods/manage')?>" charset="utf-8"></script>