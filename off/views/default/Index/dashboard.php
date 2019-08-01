<style>
	#div_QuickReferen .col-lg-2{width:20%;overflow: hidden;text-overflow:ellipsis;white-space: nowrap;}
</style>
<div class="container">
	<div class="main-content" style="margin-top:20px;">
        <div class="row">
            <div class="view_left">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 p-0">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="portlet" style="padding: 0 10px 20px" id="div_QuickReferen">
							<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
								<a target="iframe-right" href="<?=Zero_Registry::get('index_page')?>?ctl=Member_Info&met=manage&typ=e"><div class="gnadd" title="<?=__('新增会员')?>"><i class="fa fa-user"></i><?=__('新增会员')?></div></a>
							</div>
								
							<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
								<a target="iframe-right" href="<?=Zero_Registry::get('index_page')?>?ctl=Goods_Base&met=manage&typ=e"><div class="gnadd" title="<?=__('新增产品')?>"><i class="fa fa-cube"></i><?=__('新增产品')?></div></a>
							</div>
							<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
								<a target="iframe-right" href="<?=Zero_Registry::get('index_page')?>?ctl=Cashier_Quick&met=index&typ=e"><div class="gnadd" title="<?=__('快速收银')?>"><i class="fa fa-shopping-cart"></i><?=__('快速收银')?></div></a>
							</div>
							<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
								<a target="iframe-right" href="<?=Zero_Registry::get('index_page')?>?ctl=Cashier_Goods&met=index&typ=e"><div class="gnadd" title="<?=__('产品收银')?>"><i class="fa fa-shopping-cart"></i><?=__('产品收银')?></div></a>
							</div>
							<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
								<a target="iframe-right" href="<?=Zero_Registry::get('index_page')?>?ctl=Member_Grade&met=index&typ=e"><div class="gnadd" title="<?=__('会员等级')?>"><i class="fa fa-user"></i><?=__('会员等级')?></div></a>
							</div>
						</div>
                    </div>					
                    <div class="clearfix"></div>
					
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0" id="data_div">
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <div class="portlet sumtj dw" id="div_01" data-container="body" data-toggle="popover" data-trigger="hover" data-html="true" data-placement="right" data-content="">
                                <div><?=__('毛利润')?></div>
                                <h3 style="color: #ffaf24;" id="edt_generalIncome"><?=$data['profit']?></h3>
                                <p><?=__('商品金额-商品成本')?><span id="edt_todayIncome"></span></p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <div class="portlet sumtj dw" id="div_02" data-container="body" data-toggle="popover" data-trigger="hover" data-html="true" data-placement="right" data-content="">
                                <div><?=__('销售额')?></div>
                                <h3 style="color: #548cff;" id="edt_expendAmount"><?=$data['total_money']?></h3>
                                <p><?=__('本月销售总额')?><span id="edt_todayExpendAmount"></span></p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <div class="portlet sumtj dw" id="div_03" data-container="body" data-toggle="popover" data-trigger="hover" data-html="true" data-placement="right" data-content="">
                                <div><?=__('产品总数')?></div>
                                <h3 style="color: #3fc91c;" id="edt_prepaIdIncome"><?=$data['goods_total']?></h3>
                                <p><?=__('当前店铺产品总数')?><span id="edt_todayprepaIdIncome"></span></p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <div class="portlet sumtj">
                                <div><?=__('会员总数')?></div>
                                <h3 style="color: #ff5cc1;" id="edt_sunMember"><?=$data['member_total']?></h3>
                                <p><?=__('当前店铺会员总数')?><span id="edt_addMember"></span></p>
                            </div>
                        </div>
                    </div>
					
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="panel panel-default" style="margin-bottom: 0 !important;">
							<div id="timeChange">
								<form class="form-inline" role="form">
									<div class="col-sm-12 col-md-12 col-lg-12 p-0 m-t-30 yjgb m-l-15">
										<button type="button" class="btn btn-purple waves-effect" id="1"><?=__('今日')?></button>
										<button type="button" class="btn btn-primary btn-custom waves-effect waves-light" id="-1"><?=__('最近七天')?></button>
										<button type="button" class="btn btn-success btn-custom waves-effect waves-light" id="3"><?=__('本月')?></button>
										<button type="button" class="btn btn-info btn-custom waves-effect waves-light" id="-2"><?=__('本年')?></button>
									</div>
								</form>
							</div>
						
                            <div id="myTabContent" class="tab-content clear">
								<div class="tab-pane fade active in">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div id='lineArea'  style='position: relative; width:100%; float:left;height: 460px; margin: 20px auto 0;'>
										</div>
									</div>
									<div class="clear"></div>
								</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?=$this->js('plugins/echarts/echarts-all') ?>"></script>
<script type="text/javascript" src="<?=$this->js('controllers/dashboard')?>" charset="utf-8"></script>