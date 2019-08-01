<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<link rel="stylesheet" href="<?=$this->css('bootstrap-datepicker')?>">
<link rel="stylesheet" href="<?=$this->css('daterangepicker')?>">
<ul id="myTab" class="nav nav-tabs navtab-bg">
    <li class="active"><a href="#Consumption" data-toggle="tab" aria-expanded="false"><?=__('消费概要')?></a></li>
    <li><a href="#Member" data-toggle="tab" aria-expanded="false"><?=__('会员消费')?></a></li>
</ul>
<div class="container">
	<div class="main-content">
		<div id="myTabContent" class="tab-content" style="padding: 20px 30px;">
            <!--消费概要-->
            <div class="tab-pane fade in active" id="Consumption">
                <div class="row panel-group" id="accordion">
                    <form class="form-inline" role="form">
                        <div class="col-sm-12 col-md-12 col-lg-12 p-0 m-b-15 yjgb">
							<button type="button" class="btn btn-purple btn-custom waves-effect" id="time1"><?=__('今日')?></button>
                            <button type="button" class="btn btn-primary btn-custom waves-effect waves-light" id="time2"><?=__('最近七天')?></button>
							<button type="button" class="btn btn-success btn-custom waves-effect waves-light" id="time3"><?=__('本月')?></button>
							<button type="button" class="btn btn-info btn-custom waves-effect waves-light" id="time4"><?=__('本年')?></button>
                             <button type="button" class="btn btn-success btn-custom waves-effect waves-light" id="time5"><?=__('最近时间')?></button>
                        </div>
                        <div class="input-group col-sm-12 col-md-12 col-lg-12 clear" id="Input_data1" style="display: none;">
                            <div class="lin32">
                                <input type="text" class="form-control" size="15" id="B_time" style="width: 230px;">
                                <button type="button" class="btn btn-warning waves-effect waves-light m-l-15" onclick="MemberAnalysis.ConsumptionSummary(5)"><?=__('查询')?></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="Time_Chart" id="Member_Pay">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6 lin32 ">
                            <div class="row well">
                                <div class="col-sm-5 col-md-5 col-lg-5 Menber_Info p-0">
                                    <h5><span style="font-size: 20px"><b><?=__('会员消费')?>:</b></span></h5>
                                </div>
                                <div class="col-sm-7 col-md-7 col-lg-7" style="font-size: 15px;">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <span><?=__('总消费金额')?>：</span>
                                            <span class="text-danger" id="totalMoney" style="font-size: 15px;"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <span><?=__('总消费笔数')?>：</span>
                                            <span class="text-danger" id="totalNum"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <span><?=__('日均消费额')?>：</span>
                                            <span class="text-danger" id="SevenAvgMoney"></span>
                                        </div>
                                    </div>
                                    <div class="row" style="display:none;">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <span><?=__('日均毛利润')?>：</span>
                                            <span class="text-danger" id="SevenAvgProfit"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-t-30 well">
                                <div class="col-sm-5 col-md-5 col-lg-5 Menber_Info p-0">
                                    <h5><span style="font-size: 20px;"><b><?=__('非会员消费')?>：</b></span></h5>
                                </div>
                                <div class="col-sm-7 col-md-7 col-lg-7 m-0" style="font-size: 15px;">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <span><?=__('总消费金额')?>：</span>
                                            <span class="text-info" id="UnTotalMoney" style="font-size: 14px;"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <span><?=__('总消费笔数')?>：</span>
                                            <span class="text-info" id="UnTotalSum"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <span><?=__('日均消费额')?>：</span>
                                            <span class="text-info" id="UnSevenAvgMoney"></span>
                                        </div>
                                    </div>
                                    <div class="row" style="display:none;">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <span><?=__('日均毛利润')?>：</span>
                                            <span class="text-info" id="UnSevenAvgProfit"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 lin32 ">
                            <div id="MemberEcharData" style="height: 300px; width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
                <!--会员消费-->
                <div class="tab-pane fade" id="Member" style="width: 100%">
                    <div class="row panel-group" id="accordion1">
                        <form class="form-inline" role="form">
                            <div class="col-sm-12 col-md-12 col-lg-12 p-0 m-b-15 yjgb">
                                <button type="button" class="btn btn-purple btn-custom waves-effect" id="mtime1"><?=__('今日')?></button>
								<button type="button" class="btn btn-primary btn-custom waves-effect waves-light" id="mtime2"><?=__('最近七天')?></button>
								<button type="button" class="btn btn-success btn-custom waves-effect waves-light" id="mtime3"><?=__('本月')?></button>
								<button type="button" class="btn btn-info btn-custom waves-effect waves-light" id="mtime4"><?=__('本年')?></button>
								 <button type="button" class="btn btn-success btn-custom waves-effect waves-light" id="mtime5"><?=__('最近时间')?></button>
                            </div>
                            <div class="input-group col-sm-12 col-md-12 col-lg-12 clear" id="Input_data2" style="display: none;">
                                <div class="lin32">
                                    <input type="text" class="form-control" size="15" id="B_time2" style="width: 230px;">
                                    <button type="button" class="btn btn-warning waves-effect waves-light m-l-15" onclick="MemberAnalysis.SexConsumptionSummary(5)"><?=__('查询')?></button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="Time_Chart" id="Member_date">
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6 lin32">
                                <div class="row well">
                                    <div class="col-sm-12 col-md-12 col-lg-12 Menber_Info">
                                        <div class="col-sm-12 col-md-4 col-lg-4 text-center p-0">
                                            <img src="<?=$this->img?>/male.png" class="img-responsive" style="margin: 0px auto" />
                                            <span style="font-size: 16px;"><?=__('男士消费')?></span>
                                        </div>
                                        <div class="col-sm-12 col-md-8 col-lg-8 " style="font-size: 15px;">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <span><?=__('总消费金额')?>：</span>
                                                    <span class="text-info" id="hyxfTotalMoney" style="font-size: 14px;"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <span><?=__('总消费笔数')?>：</span>
                                                    <span class="text-info" id="hyxfTotalSum"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <span><?=__('日均消费额')?>：</span>
                                                    <span class="text-info" id="hyxfAvgMoney"></span>
                                                </div>
                                            </div>
                                            <div class="row" style="display:none;">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <span><?=__('日均毛利润')?>：</span>
                                                    <span class="text-info" id="hyxfAvgProfit"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-30 well">
                                    <div class="col-sm-12 col-md-12 col-lg-12 Menber_Info">
                                        <div class="col-sm-12 col-md-4 col-lg-4 text-center p-0">
                                            <img class="img-responsive" src="<?=$this->img?>/female.png" style="margin: 0px auto" />
                                            <span style="font-size: 16px;"><?=__('女士消费')?></span>
                                        </div>
                                        <div class="col-sm-12 col-md-8 col-lg-8" style="font-size: 15px;">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <span><?=__('总消费金额')?>：</span>
                                                    <span class="color02 text-danger" id="hyxfSexTotalMoney" style="font-size: 14px;"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <span><?=__('总消费笔数')?>：</span>
                                                    <span class="color02 text-danger" id="hyxfSexTotalSum"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <span><?=__('日均消费额')?>：</span>
                                                    <span class="color02 text-danger" id="hyxfSexAvgMoney"></span>
                                                </div>
                                            </div>
                                            <div class="row" style="display:none;">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <span><?=__('日均毛利润')?>：</span>
                                                    <span class="color02 text-danger" id="hyxfSexAvgProfit"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6 lin32">
                                <div id="hyxfEcharData" style="height: 300px; width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--会员分析-->
                <div class="tab-pane fade" id="jmeter" style="height: auto">
                    <div class="guide" style="top: 50px;" id="edt_Guide">
                        <div class="guide_bj"></div>
                        <div class="guide_main">
                            <div>
                                <h4 class="bold m-b-15 text-center"><?=__('您还没有开会员分析报表')?></h4>
                                <?=__('会员平均消费、回头率、消费能力、等数据分析')?>
                <p id="Agentstr" class="btn_buy"><a href="../ShopBuy/ProductDetail.html?Id=1002"><?=__('购买标准版')?></a></p>
                            </div>
                        </div>
                    </div>
                    <div class="row margin_top">
                        <div class="col-sm-4 col-md-4 col-lg-4 sales_border2">
                            <div class="panel panel-border panel-primary col-sm-12 col-md-12 col-lg-12">
                                <div class="row panel-heading">
                                    <h4><?=__('会员总数量')?></h4>
                                </div>
                                <div class="row panel-body">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <label class="sales_font text-warning" style="font-size: 1.8em" id="Membersum">0</label><span><?=__('位')?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4 sales_border2">
                            <div class="panel panel-border panel-primary col-sm-12">
                                <div class="row panel-heading">
                                    <h4><?=__('会员平均消费额')?></h4>
                                </div>
                                <div class="row panel-body">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <label class="sales_font text-warning" style="font-size: 1.8em" id="AvgTotalBuy">0</label><span><?=__('元')?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4 sales_border2">
                            <div class="panel panel-border panel-primary col-sm-12 col-md-12 col-lg-12">
                                <div class="row panel-heading">
                                    <h4><?=__('会员消费总额')?></h4>
                                </div>
                                <div class="row panel-body">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <label class="sales_font text-warning" style="font-size: 1.8em" id="SumTotalBuy">0</label><span><?=__('元')?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row rowThree">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="row col-sm-12 col-md-12 col-lg-12">
                                <div class="panel-group" id="accordion2">
                                    <div class="input-group col-sm-12 col-md-12 col-lg-12 clear">
                                        <div class="lin32">
                                            <input type="text" class="form-control" size="15" id="B_time3" style="width: 230px;">
                                            <button type="button" class="btn btn-warning m-l-10" id="Data_inputfx"><?=__('查询')?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 m-b-15 m-t-15" style="font-size: 17px;">
                                <label><?=__('这')?></label><label class="color03 text-warning" id="Count_day">0</label><label><?=__('天期间')?></label>
                            </div>
                            <div class="row" style="padding-top: 1%">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="panel panel-border panel-primary">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title"><?=__('增加会员')?></h4>
                                                </div>
                                                <div class="panel-body">
                                                    <span class="h3 text-warning" id="AddMember"></span><?=__('位')?>
                                                    <p class="p-t-10"><?=__('平均每天新增')?><span class="text-warning" id="AvgAddMember">0</span><?=__('位会员')?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="padding-top: 1%">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="panel panel-border panel-primary">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title"><?=__('短信发送量')?></h4>
                                                </div>
                                                <div class="panel-body">
                                                    <span class="h3 text-warning" id="lbl_SmsCount">0</span><?=__('条')?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="padding-top: 1%">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="panel panel-border panel-primary">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title"><?=__('消费总额')?></h4>
                                                </div>
                                                <div class="panel-body">
                                                    <span class="h3 text-warning" id="lbl_Consume">0</span><?=__('元')?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="row">
                                <div class="col-sm-7  col-md-7 col-lg-7 m-l-15 m-t-10">
                                    <div class="radio radio-danger radio-inline">
                                        <input type="radio" name="Member_select" id="hyfxrdo">
                                        <label for="hyfxrdo">
                                            <?=__('会员消费')?>
                                        </label>
                                    </div>
                                    <div class="radio radio-danger radio-inline">
                                        <input type="radio" name="Member_select" id="hyfxxzrdo">
                                        <label for="hyfxxzrdo">
                                            <?=__('会员新增')?>
                                        </label>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div id="MemberbarArea" style="width: 400px; height: 400px; margin: 0px auto;"></div>
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
<script src="<?=$this->js('controllers/report/member')?>" charset="utf-8"></script>