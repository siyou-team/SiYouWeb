<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<ul class="nav nav-tabs">
	<li><a href="<?=Zero_Registry::get('index_page')?>?ctl=Marketing_Points&met=exchange&typ=e"><?=__('积分兑换')?></a></li>
    <li class="active"><a href="<?=Zero_Registry::get('index_page')?>?ctl=Marketing_Points&met=gift&typ=e"><?=__('礼品管理')?></a></li>
	<li><a href="<?=Zero_Registry::get('index_page')?>?ctl=Marketing_Points&met=index&typ=e"><?=__('积分变动')?></a></li>
	<li><a href="<?=Zero_Registry::get('index_page')?>?ctl=Marketing_Points&met=logs&typ=e"><?=__('积分日志')?></a></li>
</ul>
<div class="container">
    <div class="main-content">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row m-t-10 m-b-15">
                            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9" id="formBtn">
                            </div>
                            <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" placeholder="<?=__('礼品编号')?>" class="form-control" name="gift_code" id="gift_code" autocomplete="off">
                                        <span class="input-group-btn">
                                            <button class="btn waves-effect waves-light btn-warning" type="button" id="btn-query"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clear">
                            <table id="tableWrapper" class="table table-striped table-bordered dt-responsive nowrap"></table>
                        </div>
                        <!-- End 产品数据-->
                    </div>
                    <!-- panel-body -->
                </div>
                <!-- panel -->
            </div>
            <!-- col -->
        </div>
    </div>
</div>
<script src="<?=$this->js('controllers/marketing/gift')?>" charset="utf-8"></script>