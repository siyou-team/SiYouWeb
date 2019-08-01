<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<link rel="stylesheet" href="<?=$this->css('bootstrap-datepicker')?>">
<link rel="stylesheet" href="<?=$this->css('daterangepicker')?>">
<ul class="nav nav-tabs">
	<li class="active"><a href="#" data-toggle="tab" aria-expanded="false"><span id="nav-title"><?=__('操作日志')?></span></a></li>
</ul>
<div class="container">
     <div class="main-content">
        <div class="tab-content" style="padding:20px 30px;">
            <form role="form" id="searchForm" class="form-horizontal m-t-15">
                <div class="form-group col-sm-6 col-md-6 col-lg-3 p-0">
                    <label class="col-sm-4 col-md-4 col-lg-4 control-label" for="edt_PassDate"><?=__('操作日期')?>：</label>
                    <div class="col-sm-8 col-md-8 col-lg-8 p-0">
                        <input type="text" placeholder="<?=__('请选择添加时间')?>" name="reservation" id="reservationtime" class="form-control p-0" readonly="readonly" style="background: #fafafa;" />
                    </div>
                </div>
                <div class="form-group col-sm-6 col-md-6 col-lg-3 p-0">
                    <label class="col-sm-4 col-md-4 col-lg-4 control-label">&nbsp;</label>
                    <div class="col-sm-8 col-md-8 col-lg-8 p-0">
                        <button type="button" class="btn btn-default waves-effect waves-light" id="btnReset"><i class="fa fa-trash-o"></i> <?=__('重置')?></button>
                        <button class="btn btn-warning waves-effect waves-light m-l-10" type="button" id="btnSelect"><i class="fa fa-search"></i> <?=__('查询')?></button>
                    </div>
                </div>
            </form>
            <div class="clear">
				<table class="table table-bordered" id="tableWrapper"></table>
			</div>
        </div>
    </div>
</div>

<script src="<?=$this->js('bootstrap/bootstrap-datetimepicker')?>" charset="utf-8"></script>
<script src="<?=$this->js('moment')?>" charset="utf-8"></script>
<script src="<?=$this->js('daterangepicker')?>" charset="utf-8"></script>
<script src="<?=$this->js('controllers/setting/logs')?>" charset="utf-8"></script>