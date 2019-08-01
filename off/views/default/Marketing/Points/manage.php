<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<ul class="nav nav-tabs">
	<li><a href="<?=Zero_Registry::get('index_page')?>?ctl=Marketing_Points&met=exchange&typ=e"><?=__('积分兑换')?></a></li>
	<li class="active"><a href="<?=Zero_Registry::get('index_page')?>?ctl=Marketing_Points&met=addGift&typ=e"><?=__('礼品管理')?></a></li>
	<li><a href="<?=Zero_Registry::get('index_page')?>?ctl=Marketing_Points&met=index&typ=e"><?=__('积分变动')?></a></li>
	<li><a href="<?=Zero_Registry::get('index_page')?>?ctl=Marketing_Points&met=logs&typ=e"><?=__('积分日志')?></a></li>
</ul>
<div class="container">
	<div class="main-content">
		<div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form role="form" class="form-horizontal" id="giftForm">
                            <div class="col-sm-9 col-md-7 col-lg-7 p-l-0">
                                <div class="row dataRow font14">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 height-a of">
                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-lg-2  control-label normal" for="points_gift_code"><?=__('礼品编号')?><span class="text-danger">*</span></label>
                                            <div class="col-sm-6 col-md-6 col-lg-7">
                                                <input type="text" placeholder="<?=__('输入礼品编号')?>" id="points_gift_code" name="points_gift_code" class="form-control" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-lg-2 control-label normal" for="points_gift_name"><?=__('礼品名称')?><span class="text-danger">*</span></label>
                                            <div class="col-sm-6 col-md-6 col-lg-7">
                                                <input type="text" id="points_gift_name" name="points_gift_name" class="form-control"  autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-lg-2  control-label normal" for="points_gift_price"><?=__('礼品价值')?><span class="text-danger">*</span></label>
                                            <div class="col-sm-6 col-md-6 col-lg-7">
                                                <input type="text" id="points_gift_price" name="points_gift_price" class="form-control" maxlength="8" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-lg-2  control-label normal" for="points_gift_points"><?=__('兑换所需积分')?><span class="text-danger">*</span></label>
                                            <div class="col-sm-6 col-md-6 col-lg-7">
                                                <input type="text" id="points_gift_points" name="points_gift_points" class="form-control" maxlength="8" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-lg-2  control-label normal" for="points_gift_stock"><?=__('库存')?><span class="text-danger">*</span></label>
                                            <div class="col-sm-6 col-md-6 col-lg-7">
                                                <input type="text" id="points_gift_stock" name="points_gift_stock" class="form-control" maxlength="8"  autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 col-lg-2  control-label normal" for="points_gift_remark"><?=__('备注')?></label>
                                            <div class="col-sm-6 col-md-6 col-lg-7">
                                                <input type="text" id="points_gift_remark" name="points_gift_remark" class="form-control" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear col-sm-12 col-md-12 col-lg-12 border_t form_btn">
                                        <div class="col-md-12 col-md-12 col-lg-12 m-t-10">
                                            <div class="col-sm-3 col-md-3 col-lg-3 ">
                                                <!--勿删除此标签-->
                                            </div>
                                            <button type="submit" class="btn b-racius3 btn-warning waves-effect waves-light"><?=__('保存')?></button>
                                            <button type="button" class="btn b-racius3 btn-default waves-effect m-l-10" data-dismiss="modal" id="btn-reset"><?=__('返回')?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- panel-body -->
                </div>
                <!-- panel -->
            </div>
        </div>
	</div>
</div>

<script src="<?=$this->js('controllers/marketing/manage')?>" charset="utf-8"></script>