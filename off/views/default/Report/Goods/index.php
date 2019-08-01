<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<link rel="stylesheet" href="<?=$this->css('bootstrap-datepicker')?>">
<link rel="stylesheet" href="<?=$this->css('daterangepicker')?>">
<ul id="myTab" class="nav nav-tabs navtab-bg">
    <li class="active"><a href="#EveryDayConsumption" data-toggle="tab"><?=__('每日销售概览')?></a></li>
    <li><a href="#Consumption" data-toggle="tab"><?=__('商品销售量')?></a></li>
</ul>
    
<div class="container">
    <div class="main-content">
        <div class="clear">
            <div class="tab-content" style="padding: 20px 30px;">
                <!-- 商品销售量 -->
                <div class="tab-pane fade" id="Consumption">
                    <div class="row panel-group">
                        <div class="col-sm-8 col-md-8 col-lg-8 p-0">
                            <form class="form-inline" role="form">
                                <div class="clear m-b-15 yjgb">
                                    <button type="button" class="btn btn-purple btn-custom waves-effect" id="goodsTime1"><?=__('今日')?></button>
                                    <button type="button" class="btn btn-primary btn-custom waves-effect waves-light" id="goodsTime2"><?=__('最近七天')?></button>
									<button type="button" class="btn btn-success btn-custom waves-effect waves-light" id="goodsTime3"><?=__('本月')?></button>
									<button type="button" class="btn btn-info btn-custom waves-effect waves-light" id="goodsTime4"><?=__('本年')?></button>
                                    <button type="button" class="btn btn-warning  btn-custom waves-effect waves-light" id="goodsTime5"><?=__('最近时间')?></button>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12" id="Input_data1" style="display: none;">
                                    <div>
                                        <input type="text" class="form-control left" size="15" id="B_time" style="width: 230px;">
                                    </div>
                                    <button type="button" class="btn btn-warning waves-effect waves-light m-l-10 left" id="GoodsRefrsh"><?=__('查询')?></button>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4 m-t-10 p-0">
                            <div class="radio radio-danger radio-inline">
                                <input type="radio" name="radioInline" checked="checked" id="rdoTotalGoods" /><label for="rdoTotalGoods"><?=__('总销售')?></label>
                            </div>
                            <div class="radio radio-danger radio-inline">
                                <input type="radio" name="radioInline" id="rdoMember" /><label for="rdoMember"><?=__('会员')?></label>
                            </div>
                            <div class="radio radio-danger radio-inline">
                                <input type="radio" name="radioInline" id="rdoNonMember" /><label for="rdoNonMember"><?=__('非会员')?></label>
                            </div>
                        </div>
                    </div>
                    <div class="row m-t-20">
                        <div class="col-sm-8 col-md-8 col-lg-8 m-t-15 bang">
                            <div class="btn-group">
                                <a href="#" class="btn btn-info btn-custom waves-effect waves-light" id="top1">Top 10</a>
                                <a href="#" class="btn btn-success btn-custom waves-effect waves-light" id="top2">Top 20</a>
                                <a href="#" class="btn btn-warning  btn-custom waves-effect waves-light" id="top3">Top 30</a>
								<a href="#" class="btn btn-warning  btn-custom waves-effect waves-light" id="top4">Top 50</a>
								<a href="#" class="btn btn-warning  btn-custom waves-effect waves-light" id="top5">Top 100</a>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4 m-t-15">
                            <div class="btn-group chartlb">
                                <a href="#" class="btn btn-warning" id="TotalMoney"><?=__('按金额显示')?></a>
                                <a href="#" class="btn btn-default" id="TotalNum"><?=__('按数量显示')?></a>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 clear m-t-20">
                            <div id="GoodsEcahrData" style="width: 800px; height: 300px; margin: 0px auto;"></div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <table class="table table-striped table-bordered dt-responsive nowrap" id="Goods_list"></table>
                        </div>
                    </div>
                </div>

                <!--  每日销售概览-->
                <div class="tab-pane fade in active" id="EveryDayConsumption">
                    <div class="row panel-group">
                        <div class="col-sm-12 col-md-8 col-lg-6">
                            <form class="form-inline row" role="form">
                                <div class="col-sm-12 col-md-12 col-lg-12 yjgb">
                                    <button type="button" class="btn btn-purple btn-custom waves-effect" id="time1"><?=__('今日')?></button>
                                    <button type="button" class="btn btn-primary btn-custom waves-effect waves-light" id="time2"><?=__('最近七天')?></button>
									<button type="button" class="btn btn-success btn-custom waves-effect waves-light" id="time3"><?=__('本月')?></button>
									<button type="button" class="btn btn-info btn-custom waves-effect waves-light" id="time4"><?=__('本年')?></button>
                                    <button type="button" class="btn btn-warning  btn-custom waves-effect waves-light" id="time5"><?=__('最近时间')?></button>
                                    <div class="input-group col-sm-12 col-md-12 col-lg-12 clear m-t-10 m-b-10" id="Input_data" style="display: none;">
                                        <div class="lin32">
                                            <input type="text" class="form-control" id="ipt_BTime" readonly="readonly" style="width: 230px;" />
                                            <button type="button" class="btn btn-warning waves-effect waves-light m-l-15" id="Data_input"><?=__('查询')?></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-6  m-t-15">
                            <div class="radio radio-danger radio-inline">
                                <input type="radio" name="memebrs" checked="checked" id="rdoTotalsales" /><label for="rdoTotalsales"><?=__('总销售')?></label>
                            </div>
                            <div class="radio radio-danger radio-inline">
                                <input type="radio" name="memebrs" id="rdoMemberCard" /><label for="rdoMember"><?=__('会员')?></label>
                            </div>
                            <div class="radio radio-danger radio-inline">
                                <input type="radio" name="memebrs" id="rdoSK" /><label for="rdoNonMember"><?=__('非会员')?></label>
                            </div>
                        </div>
                    </div>
                    <div class="Time_Chart" id="Member_Pay">
                        <!--销售总额 毛利润 ...-->
                        <div class="row ">
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="sales_border2">
                                    <div class="panel panel-border panel-primary col-sm-12 col-md-12 col-lg-12">
                                        <div class="row panel-heading">
                                            <h4><?=__('销售总额')?></h4>
                                        </div>
                                        <div class="row panel-body">
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <label class="sales_font text-warning" style="font-size: 1.8em" id="TotalSales">0</label><span><?= __('￥')?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sales_border2">
                                    <div class="panel panel-border panel-primary col-sm-12 col-md-12 col-lg-12">
                                        <div class="row panel-heading">
                                            <h4><?=__('销售订单数')?></h4>
                                        </div>
                                        <div class="row panel-body">
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <label class="sales_font text-warning" style="font-size: 1.8em" id="sumProfit">0</label><span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--图表-->
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-lg-12 sales_box2">
                                        <div id="SaleEcharData" style="width: 100%; height: 400px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--table-->
                        <div class="row sales_box3">
                            <div class="col-sm-12 col-md-12 col-lg-12 ">
                                <table class="table table-bordered" id="SalesTable_list"></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 

<script src="<?=$this->js('bootstrap/bootstrap-datetimepicker')?>" charset="utf-8"></script>
<script src="<?=$this->js('moment')?>" charset="utf-8"></script>
<script src="<?=$this->js('daterangepicker')?>" charset="utf-8"></script>
<script src="<?=$this->js('plugins/echarts.common.min')?>" charset="utf-8"></script>
<script src="<?=$this->js('controllers/report/goods')?>" charset="utf-8"></script>