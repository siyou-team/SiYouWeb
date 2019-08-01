<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<ul class="nav nav-tabs">
	<li class="active"><a href="#" data-toggle="tab" aria-expanded="false"><span id="nav-title"><?=__('系统参数设置')?></span></a></li>
</ul>
<div class="container">
	<div class="main-content set-right">
	<!--- s main-content --->
		<div class="panel panel-default">
            <form role="form" class="form-horizontal" id="settingForm">
                <div class="panel-body" style="overflow: auto;">
                    <div class="row">
                        <div class="row m-t-10 xtkd">
                            <div class="col-sm-12 col-md-12 col-lg-12" style="border-bottom: 1px solid #edecec;">
                                <label class="h4 text-warning">消费设置</label><label class="text-muted">&nbsp;&nbsp;|&nbsp;&nbsp;消费、积分、兑换比例及设置</label>
                            </div>
                        </div>
						
						<div class="row m-t-10 xtkd">
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label class="left lin32">限制单笔总额：</label>&nbsp;&nbsp;
                                <label class="left lin32">总额不超过</label>
                                <input type="text" class="bdzhi" id="total_price" name="total_price" value="<?=$data['total_price']?>" />
                                <label class="left lin32">万元</label>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label class="left lin32">限制单价：</label>&nbsp;&nbsp;
                                <label class="left lin32">单价不超过</label>
                                <input type="text" class="bdzhi" id="unit_price" name="unit_price" value="<?=$data['unit_price']?>" />
                                <label class="left lin32">万元</label>
                            </div>
                        </div>

                        <div class="row m-t-10 xtkd">
                            <div class="col-sm-12 col-md-6 col-lg-6 form-group">
                                <label class="left lin32">消费折算积分比例：</label>&nbsp;&nbsp;
                                <label class="left lin32 text-danger">1</label>
                                <label class="left lin32">元折算</label>
                                <input type="text" class="bdzhi" id="point_precision" name="point_precision"   value="<?=$data['point_precision']?>"/>
                                <label class="left lin32"> 积分</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row m-t-10 xtkd">
                            <div class="col-sm-12 col-md-12 col-lg-12" style="border-bottom: 1px solid #edecec;">
                                <label class="h4 text-warning">支付设置</label><label class="text-muted">&nbsp;&nbsp;|&nbsp;&nbsp;消费时支付方式设置</label>
                            </div>
                        </div>
                        <div class="row m-t-10 xtkd">
                            <div class="col-sm-4 col-md-2 col-lg-2">
                                <div class="checkbox checkbox-danger checkbox-inline">
                                    <input type="checkbox" data-pay="1" id="PayCash" name="pay_method" value="1">
                                    <label for="PayCash">现金支付</label>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-2 col-lg-2">
                                <div class="checkbox checkbox-danger checkbox-inline">
                                    <input type="checkbox" data-pay="3" id="PayBank" name="pay_method" value="3">
                                    <label for="PayBank">银联支付</label>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-2 col-lg-2">
                                <div class="checkbox checkbox-danger checkbox-inline">
                                    <input type="checkbox" data-pay="5" id="PayAlipay" name="pay_method" value="5">
                                    <label for="PayAlipay">支付宝支付</label>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-2 col-lg-2">
                                <div class="checkbox checkbox-danger checkbox-inline">
                                    <input type="checkbox" data-pay="6" id="PayWeChat" name="pay_method" value="6">
                                    <label for="PayWeChat">微信支付</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="row m-t-10 xtkd">
                            <div class="col-sm-12 col-md-12 col-lg-12" style="border-bottom: 1px solid #edecec;">
                                <label class="h4 text-warning">库存设置</label><label class="text-muted">&nbsp;&nbsp;|&nbsp;&nbsp;库存设置</label>
                            </div>
                        </div>
                        <div class="row m-t-10 xtkd">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="col-sm-6 col-md-4 col-lg-4 form-group">
                                    <label class="lin32 left">库存预警： 商品低于</label>
                                    <input type="text" class="bdzhi left" name="stock_warning" id="stock_warning" value="<?=$data['stock_warning']?>" />
                                    <label class="left lin32">件</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="text-center">
                        <button class="btn btn-warning waves-effect m-b-30" type="submit" id="btn-save" style="">保存</button>
                    </div>
                </div>
            </form>
        </div> 
	<!--- end main-content --->
	</div>
</div>
<script src="<?=$this->js('controllers/setting/index')?>" charset="utf-8"></script>