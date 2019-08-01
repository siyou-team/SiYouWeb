<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<ul class="nav nav-tabs">
	<li class="active"><a href="#"><?=__('产品管理')?></a></li>
	<li><a href="<?=Zero_Registry::get('index_page')?>?ctl=Goods_Inventory&met=index&typ=e"><?=__('库存管理')?></a></li>
</ul>
<div class="container">
	<div class="main-content">
	<!--- s main-content --->
	<div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
					<div class="clear row in">
                        <div class="panel-body" id="topInfo">
                            <div class="col-sm-6 col-md-3 col-lg-3">
                                <div class="panel panel-border panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><?=__('共有商品')?></h3>
                                    </div>
                                    <div class="panel-body">
                                        <span class="h3 text-warning" id="total">0</span><?=__('件')?>
                                        <p class="p-t-10"><?=__('库存低于10的商品有')?><span id="low_num"></span><?=__('件')?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-3">
                                <div class="panel panel-border panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><?=__('库存商品总成本')?></h3>
                                    </div>
                                    <div class="panel-body">
                                        <span class="h3 text-warning" id="cost_total">0</span><?=__('元')?>
                                        <p class="p-t-10"><?=__('正常商品')?><span id="normal">0</span>，<?=__('停售商品')?><span id="stop_num">0</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6  col-md-3 col-lg-3">
                                <div class="panel panel-border panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><?=__('库存预警的商品')?></h3>
                                    </div>
									<div class="panel-body">
                                        <span class="h3 text-warning" id="warn_num">0</span><?=__('件')?>
                                        <p class="p-t-10"><?=__('库存低于5件')?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-3">
                                <div class="panel panel-border panel-primary">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <h3 class="panel-title"><?=__('近七日销售')?><span>Top3</span><?=__('商品')?></h3>
                                        </div>
                                    </div>
                                    <div class="panel-body" style="padding-bottom: 0;">
                                        <div id="top3_html" style="height: 74px; overflow: hidden;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End 产品数据-->
				
                    <div class="row m-t-15">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="col-sm-12 col-md-12 col-lg-12" id="form-btn"></div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-right">
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-7">
                                <div class="input-group m-b-10">
                                    <input type="text" placeholder="<?=__('产品编号')?>/<?=__('名称')?>" class="form-control" name="goodsCode" id="goodsCode">
                                    <span class="input-group-btn">
                                        <button class="btn waves-effect waves-light btn-warning" type="button" id="btn-query"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-5 m-t-5 ">
                                <a class="ayels open pull-right" href="javascript:void(0);">
                                    <label id="goods_total" class="m-r-5"><?=__('产品总数')?>:<span class="text-danger" id="total_num"></span></label>
                                    <button data-toggle="collapse" href="#topInfo" class="btn btn-icon waves-effect btn-default btn-xs m-b-5" id="btn-info">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </a>
                            </div>
                        </div>

                    </div>
                    <!-- Start 产品筛选 -->
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div id="ScreenDiv" class="collapse">
                            <div class="panel-body col-sm-12 col-md-12 col-lg-12">
                                <form role="form" id="searchForm">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="col-sm-6 col-md-6 col-lg-6 form-group">
                                            <label class="col-sm-4 col-md-3 col-lg-3 lin32 p-l-0 text-right font14 normal" for="goods_source"><?=__('商品来源')?></label>
                                            <div class="col-sm-8 col-md-9 col-lg-9 p-0">
                                                <select id="goods_source" name="goods_source" class="form-control">
													<option value="0"><?=__('请选择')?></option>
                                                    <option value="1"><?=__('普通发布')?></option>
                                                    <option value="2"><?=__('线上同步')?></option>
												</select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6 form-group">
                                            <label class="col-sm-4 col-md-3 col-lg-3 lin32 p-l-0 text-right font14 normal" for="goods_status"><?=__('商品状态')?></label>
                                            <div class="col-sm-8 col-md-9 col-lg-9 p-0">
                                                <select name="goods_status" id="goods_status" class="form-control">
                                                    <option value=""><?=__('请选择')?></option>
                                                    <option value="1"><?=__('正常销售')?></option>
                                                    <option value="2"><?=__('商品停售')?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6 form-group">
                                            <label class="col-sm-4 col-md-3 col-lg-3 lin32 p-l-0 text-right font14 normal" for="price"><?=__('零售价')?></label>
                                            <div class="col-sm-8 col-md-9 col-lg-9 p-0">
                                                <div class="left widban">
                                                    <input type="text" placeholder="0.00" id="price" class="form-control" onkeyup="this.value=this.value.replace(/^(\-)*(\d+)\.(\d\d\d).*$/,'$1$2.$3')"></div>
                                                <div class="left zhikd"><?=__('至')?></div>
                                                <div class="left widban pull-right">
                                                    <input type="text" placeholder="0.00" id="price_end" class="form-control" onkeyup="this.value=this.value.replace(/^(\-)*(\d+)\.(\d\d\d).*$/,'$1$2.$3')"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6 form-group">
                                            <label class="col-sm-4 col-md-3 col-lg-3 lin32 p-l-0 text-right font14 normal" for="discount"><?=__('最低折扣')?></label>
                                            <div class="col-sm-8 col-md-9 col-lg-9 p-0">
                                                <div class="left widban">
                                                    <input type="text" placeholder="<?=__('折扣')?>" id="discount" class="form-control" onkeyup="this.value=this.value.replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3')"></div>
                                                <div class="left zhikd"><?=__('至')?></div>
                                                <div class="left widban pull-right">
                                                    <input type="text" placeholder="<?=__('折扣')?>" id="discount_end" class="form-control" onkeyup="this.value=this.value.replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3')"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6 form-group">
                                            <label class="col-sm-4 col-md-3 col-lg-3 lin32 p-l-0 text-right font14 normal" for="time"><?=__('添加时间')?></label>
                                            <div class="col-sm-8 col-md-9 col-lg-9 p-0">
                                                <input type="text" placeholder="<?=__('请选择添加时间')?>" name="time" id="time" class="form-control" readonly="readonly" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6 form-group">
                                            <label class="col-sm-4 col-md-3 col-lg-3 lin32 p-l-0 text-right font14 normal">&nbsp;</label>
                                            <div class="col-sm-8 col-md-9 col-lg-9 p-0">
                                                <button type="reset" class="btn btn-default waves-effect waves-light" id="btn-reset"><i class="fa fa-trash-o"></i> <?=__('重置')?></button>
                                                <button type="button" class="btn btn-warning waves-effect waves-light m-l-10" id="btn-search"><i class="fa fa-search "></i> <?=__('查询')?></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- panel-body -->
            </div>
            <!-- panel -->
        </div>
        <!-- col -->
    </div>
    
	<div class="row">
		<div class="col-md-12 col-md-12 col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table id="tableWrapper" class="table table-striped table-bordered dt-responsive nowrap"></table>
                </div>
            </div>
        </div>				
    </div>
	<!--- end main-content --->
	</div>
</div>


	<!--产品批量导入-->
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" style="top: 0%;">
        <div class="modal-dialog modal_w_700">
            <div class="modal-content">
                <form enctype="multipart/form-data" method="post">
                    <div class="modal-header">
                        <button type="button" class="close"
                            data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                        <h4 class="modal-title" id="importLabel"></h4>
                    </div>
                    <div class="modal-body" style="width: 100%">
                        <div class="content m-b-5">
                            <div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <a id="Down" download="<?=__('产品批量导入模板(单次导入数据500条).xls')?>" class="download"><?=__('下载模板')?>
                                        </a>
                                    </div>
                                </div>
                                <div class="row m-t-10 m-b-10">
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-md-offset-1"></div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">
                                        <div class="row">
                                            <span>1、<?=__('导入数据时请仔细填写表格中的每一项数据，并严格按照指定的格式录入。')?></span>
                                        </div>
                                        <div class="row">
                                            <span>2、<?=__('一次性导入的数据量不易过大，对于大数据量建议分批次导入。')?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="col-lg-1 col-md-1 col-sm-1"></div>
                                        <div class="col-lg-10 col-md-10 col-sm-10">
                                            <input id="file-upload" class="projectfile" type="file" name="filedata"><input type="hidden" name="immediate" value="1" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer tc">
                        <button type="button" class="btn b-racius3 btn-warning waves-effect waves-light" id="import-submit"><?=__('导入')?></button>
                        <button type="button" class="btn b-racius3 btn-default waves-effect" data-dismiss="modal"><?=__('关闭')?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
	
	<!-- 同步线上产品 -->
    <div class="modal fade" id="synchroModal" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" style="top: 0%;">
        <div class="modal-dialog modal_w_700">
            <div class="modal-content">
                <div class="modal-header">
                        <button type="button" class="close"
                            data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                        <h4 class="modal-title" id="synchroHeader"></h4>
                    </div>
                    <div class="modal-body" style="width: 100%">
                        <div class="content m-b-5">
                            <div>
                                <div class="row m-t-10 m-b-10">
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-md-offset-1"></div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">
                                        <div class="row">
                                            <span>1、<?=__('一次最多可以同步500条数据，如果数据过多请多次同步。')?></span>
                                        </div>
                                        <div class="row">
                                            <span>2、<?=__('已经同步的商品不会重复同步。')?></span>
                                        </div>
										<div class="row">
                                            <span>3、<?=__('如果线上的商品条形码和线下的商品编码重复，将不会同步。')?></span>
                                        </div>
										<div class="row">
                                            <span>4、<?=__('如果线上的商品条形码为空，将生产随机的条形码。')?></span>
                                        </div>
										<div class="row">
                                            <span>5、<?=__('只同步线上正常销售的商品，违规商品和仓库中的商品将不同步。')?></span>
                                        </div>
                                    </div>
                                </div>
								
								<div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="col-lg-10 col-md-10 col-sm-10">
                                            <label class="left p-0 lin32 m-r-10"><?=__('同步后商品状态')?>：</label>
                                            <div class="col-xs-8 col-sm-8 col-md-9 col-lg-10 p-0">
                                                <div class="left marr8 radio radio-danger m-t-5">
                                                    <input type="radio" name="radio2" id="goods_sales" checked="checked" />
                                                    <label for="goods_sales"><?=__('销售')?></label>
                                                </div>
                                                <div class="left radio radio-danger m-t-5">
                                                    <input type="radio" name="radio2" id="goods_stop" />
                                                    <label for="goods_stop"><?=__('停售')?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer tc">
                        <button type="button" class="btn b-racius3 btn-warning waves-effect waves-light" id="synchro-submit"><?=__('同步')?></button>
                        <button type="button" class="btn b-racius3 btn-default waves-effect" data-dismiss="modal"><?=__('关闭')?></button>
                    </div>
            </div>
        </div>
    </div>
<link rel="stylesheet" href="<?=$this->css('bootstrap-datepicker')?>">
<link rel="stylesheet" href="<?=$this->css('daterangepicker')?>">
<script src="<?=$this->js('moment')?>" charset="utf-8"></script>
<script src="<?=$this->js('daterangepicker')?>" charset="utf-8"></script>
<script src="<?=$this->js('print/LodopFuncs')?>"></script>
<script src="<?=$this->js('common/print')?>"></script>
<script src="<?=$this->js('controllers/goods/lists')?>" charset="utf-8"></script>