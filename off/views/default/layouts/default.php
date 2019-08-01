<?php if (!defined('ROOT_PATH')) exit('No Permission');?><!DOCTYPE html>
<html lang="zh-CN" dropEffect="none" class="no-js">
<head>
	<meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="renderer" content="webkit" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" />
	<meta name="description" content="上海迅有收银系统" />
	<meta name="author" content="" />
	<title><?=__('管理中心')?></title>
	<link rel="stylesheet" href="<?=$this->css('bootstrap')?>">
	<link rel="stylesheet" href="<?=$this->css('offline')?>"> 
    <link rel="shortcut icon" href="<?=$this->img('favicon.ico')?>" type="image/x-icon" />
    <?php if( $this->registry('language') == 'it') { ?> 
    <link rel="stylesheet" type="text/css" href="<?=$this->css('it',false)?>" />
    <?php } ?>
    <script type="text/javascript">
        window.SYS = {};
        SYS.VER = '<?=VER?>';
        SYS.DEBUG = <?=intval(DEBUG)?>;
        SYS.CONFIG = {
            account_url: '<?=Zero_Registry::get('base_url')?>/account.php',
            admin_url:   '<?=Zero_Registry::get('base_url')?>/admin.php',
            base_url:    '<?=Zero_Registry::get('base_url')?>',
            index_url:   '<?=Zero_Registry::get('url')?>',
            index_page:  '<?=Zero_Registry::get('index_page')?>',
            static_url:  '<?=Zero_Registry::get('static_url')?>'
        };

        var SYSTEM = SYSTEM || {};
        SYSTEM.skin = 'green';
        SYSTEM.language = "<?=$this->registry('language')?>";
    </script>
	<script src="<?=$this->js('common/jquery')?>?self=false"></script>
    <script src="<?=$this->js('lang/'.$this->registry('language'),false)?>"></script>   
	<script src="<?=$this->js('bootstrap/bootstrap.min')?>?self=false"></script>
	<script src="<?=$this->js('bootstrap/bootstrapValidator.min')?>"></script>
	<script src="<?=$this->js('bootstrap/bootstrap-table.min')?>"></script>
	<script src="<?=$this->js('bootstrap/bootstrap-table-zh-CN.min')?>"></script>
	<script src="<?=$this->js('plugins/cookie')?>"></script>
	<script src="<?=$this->js('plugins/base64')?>"></script>
	<script src="<?=$this->js('common')?>"></script>
	<script src="<?=$this->js('common/tips')?>"></script>
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="fixed-left">
	<?php include $this->getView(); ?>
	<?php foreach ($this->getLazyLoadJs() as $url):?>
		<script type="text/javascript" src="<?=$url?>"></script>
	<?php endforeach;?>
	<?php foreach ($this->getLazyLoadJsString() as $str):?>
		<script type="text/javascript"><?=$str?></script>
	<?php endforeach;?>

	<!-- 会员查询 -->
    <div id="myModalMember" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"><?=__('会员查询')?></h4>
                </div>
                <form role="form" class="form-horizontal" onsubmit="return false;">
                    <div class="modal-body" style="min-height: 480px; overflow-y: scroll;">
                        <div>
                            <div class="input-group m-b-15">
                                <input type="text" placeholder="<?=__('卡号')?>" class="form-control" id="cardNo">
                                <span class="input-group-btn">
                                    <button class="btn waves-effect waves-light btn-warning" type="button" id="btn-search"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                        <div>
                            <table id="MemberCarData" class="table table-bordered dt-responsive nowrap table-hover table-striped"></table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
	<!-- 会员弹框  end -->

	<!-- 收银弹框 -->
	<div id="PayCheckOutModal" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false">
        <div class="modal-dialog " style="width: 575px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"><?=__('收银')?></h4>
                </div>
                <form role="form" id="PayCheckOutForm" class="form-horizontal">
                    <div class="m-b-10">
                        <div class="content">
                            <div class="firtsROW">
                                <div class="m-t-15 lastROW paybj">
                                    <div class="col-xs-7 col-sm-6 col-md-6 col-lg-6 m-t-5 m-b-5">
                                        <div class="input-group m-r-5 sy_proup color_f60">
                                            <span class="input-group-btn border_new">
                                                <button class="btn waves-effect waves-light gray" type="button" style="height: 34px;"><?=__('应付金额')?></button><input type="hidden" value="" id="edtYinPayHiden" />
                                            </span>
                                            <input type="text" placeholder="0" value="0.00" class="form-control bor_paynew" disabled="disabled" name="example-input1-group2" id="edtYinPay" onkeyup="clearNoNum(this)" onfocus="this.select()" />
                                        </div>
                                    </div>
                                    <div class="col-xs-5 col-sm-6 col-md-6 col-lg-6 pull-right sy_adbox" id="OpenOnline">
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col_white" id="div_memMomey"><?=__('当前余额')?>&nbsp;<span id="span_currentMoney">0</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=__('当前积分')?>&nbsp;<span id="span_CurrentPoint">0</span><!--(￥<span id="IntegralIntoCash">0.00</span>)--></div>
                                </div>
                                <div class="clear">
                                    <div class="payment text-center" onselectstart="return false;" style="-moz-user-select: none;">
                                        <ul id="pay_ul">
                                            <li data-pay="1" id="PayCash"><i class="fa fa-check"></i>&nbsp;<?=__('现金')?></li>
                                            
                                            <li data-pay="3" id="PayBank"><i class="fa fa-check"></i>&nbsp;<?=__('银行卡')?></li>
                                            <li data-pay="4" id="PayIntegral"><i class="fa fa-check"></i>&nbsp;<?=__('积分')?></li>
                                            <!--<li data-pay="5" id="PayAlipay"><i class="fa fa-check"></i>&nbsp;<?=__('支付宝')?></li>
                                            <li data-pay="6" id="PayWeChat"><i class="fa fa-check"></i>&nbsp;<?=__('微信')?></li>-->
                                            <li data-pay="7" id="Union"><i class="fa fa-check"></i>&nbsp;<?=__('联合支付')?></li>
                                            <!--class="lianhe"-->
                                        </ul>
                                    </div>
                                    <div class="m-t-15 pay_pd row">
                                        <div class="col-xs-5 col-sm-6 col-md-6 col-lg-6 p-0 tm">
											<!--1.现金，2.余额，3.银行卡，4.积分，5.支付宝，6.微信-->
                                            <div class="input-group m-t-10 sy_proup">
                                                <span class="input-group-addon mm pay_fs" id="Pay_span1"></span>
                                                <input type="text" placeholder="0" class="form-control df fsmoney" autofocus="autofocus" name="Pay001" id="Pay001" onblur="PayFuKuan.blurChangeValue(this);" onkeyup="clearNoNum(this)" onchange="clearNoNum(this)" onfocus="this.select()" />
                                            </div>
                                            <div class="text-right col_88 m-t-5 font13" style="display: none" id="Prompt1"><?=__('积分支付')?><span id="Prompt1_span1">0.00</span><?=__('元，需抵扣')?><span id="Prompt1_span2">0</span><?=__('积分')?></div>

                                            <div id="Pay_div">
                                                <div class="input-group m-t-10 sy_proup">
                                                    <span class="input-group-addon mm pay_fs" id="Pay_span2"></span>
                                                    <input type="text" placeholder="0" class="form-control df fsmoney" name="Pay002" id="Pay002" onblur="PayFuKuan.blurChangeValue(this);" onkeyup="clearNoNum(this)" onfocus="this.select()" onchange="clearNoNum(this)" />
                                                </div>
                                                <div class="text-right col_88 m-t-5 font13" style="display: none" id="Prompt2"><?=__('积分支付')?><span id="Prompt2_span1">0.00</span><?=__('元，需抵扣')?><span id="Prompt2_span2">0</span><?=__('积分')?></div>
                                            </div>
                                            <div class="zhaoli font14 m-t-10" id="GiveChange_div"><?=__('找零')?>：<span id="GiveChange">0.00</span></div>
                                        </div>

                                        <div class="col-xs-7 col-sm-6 col-md-6 col-lg-6 m-t-10 jianpan" id="dKeyBox" style="width:260px; float: right">
                                            <div class="btn-toolbar m-b-5">
                                                <a href="#" type="button" id="num_1" data-num="1" class="btn btn-primary nu a1">1</a>
                                                <a href="#" type="button" id="num_2" data-num="2" class="btn btn-primary nu a1">2</a>
                                                <a href="#" type="button" id="num_3" data-num="3" class="btn btn-primary nu a1">3</a>
                                                <a href="#" type="button" id="num_10" data-num="10" class="btn btn-danger uu a2"><?= __('¥')?>10</a>
                                            </div>
                                            <div class="btn-toolbar m-b-5">
                                                <a href="#" type="button" id="num_4" data-num="4" class="btn btn-primary nu a1">4</a>
                                                <a href="#" type="button" id="num_5" data-num="5" class="btn btn-primary nu a1">5</a>
                                                <a href="#" type="button" id="num_6" data-num="6" class="btn btn-primary nu a1">6</a>
                                                <a href="#" type="button" id="num_20" data-num="20" class="btn btn-danger uu a2"><?= __('¥')?>20</a>
                                            </div>
                                            <div class="btn-toolbar m-b-5">
                                                <a href="#" type="button" id="num_7" data-num="7" class="btn btn-primary nu a1">7</a>
                                                <a href="#" type="button" id="num_8" data-num="8" class="btn btn-primary nu a1">8</a>
                                                <a href="#" type="button" id="num_9" data-num="9" class="btn btn-primary nu a1">9</a>
                                                <a href="#" type="button" id="num_50" data-num="50" class="btn btn-danger uu a2"><?= __('¥')?>50</a>
                                            </div>
                                            <div class="btn-toolbar m-b-5">
                                                <a href="#" type="button" id="num_0" data-num="0" class="btn btn-primary nu a1">0</a>
                                                <a href="#" type="button" id="Li1" data-num="00" class="btn btn-primary nu a1">00</a>
                                                <a href="#" type="button" id="num_d" data-num="d" class="btn btn-primary nu a1">.</a>
                                                <a href="#" type="button" id="num_100" data-num="100" class="btn btn-danger uu a2"><?= __('¥')?>100</a>
                                            </div>
                                            <div class="btn-toolbar m-b-5">
                                                <a href="#" type="button" id="num_s" data-num="s" class="btn btn-danger uu a3 ua"><i class="fa fa-long-arrow-left"></i></a>
                                                <a href="#" type="button" id="num_q" data-num="q" class="btn btn-danger uu a1 ua"><?=__('清除')?></a>
                                                <a href="#" type="button" id="num_m" data-num="m" class="btn btn-danger uu a2 ua"><?=__('抹零')?></a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="clear modal-footer" style="padding: 15px 0;">
                        <div class="pay_pda" style="margin-right: 0;">
                            <div class="sale_set">
                                <ul class="hidden">
                                    <li id="Print_div"><i class="fa fa-check"></i><?=__('打印小票')?></li>
                                </ul>
                            </div>
                            <div class="pull-right sure">
                                <button type="button" id="btnZhifu" class="btn btn-warning waves-effect waves-light btn-lg"><?=__('确认支付')?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- 弹框  end -->
</body>
</html>