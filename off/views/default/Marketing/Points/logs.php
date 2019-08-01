<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<link rel="stylesheet" href="<?=$this->css('bootstrap-datepicker')?>">
<link rel="stylesheet" href="<?=$this->css('daterangepicker')?>">
<ul class="nav nav-tabs">
	<li><a href="<?=Zero_Registry::get('index_page')?>?ctl=Marketing_Points&met=exchange&typ=e"><?=__('积分兑换')?></a></li>
    <li><a href="<?=Zero_Registry::get('index_page')?>?ctl=Marketing_Points&met=gift&typ=e"><?=__('礼品管理')?></a></li>
	<li><a href="<?=Zero_Registry::get('index_page')?>?ctl=Marketing_Points&met=index&typ=e"><?=__('积分变动')?></a></li>
	<li class="active"><a href="<?=Zero_Registry::get('index_page')?>?ctl=Marketing_Points&met=logs&typ=e"><?=__('积分日志')?></a></li>
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
                                        <label class="col-sm-4 col-md-4 col-lg-4 lin32 p-l-0 text-right font14 normal" for="points_type"><?=__('消费类型')?></label>
                                        <div class="col-sm-8 col-md-8 col-lg-8 p-0">
                                            <select class="form-control" style="padding-right: 0px;" id="points_type">
                                                <option value="0"><?=__('全部')?></option>
                                                <option value="1"><?=__('积分增加')?></option>
                                                <option value="2"><?=__('积分减少')?></option>
												<option value="3"><?=__('积分清零')?></option>
												<option value="4"><?=__('积分兑换')?></option>
												<option value="5"><?=__('商品消费')?></option>
                                            </select>
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

<script src="<?=$this->js('bootstrap/bootstrap-datetimepicker')?>" charset="utf-8"></script>
<script src="<?=$this->js('moment')?>" charset="utf-8"></script>
<script src="<?=$this->js('daterangepicker')?>" charset="utf-8"></script>
<script src="<?=$this->js('controllers/marketing/logs')?>" charset="utf-8"></script>