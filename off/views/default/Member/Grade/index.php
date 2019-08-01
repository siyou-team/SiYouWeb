<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<ul class="nav nav-tabs">
    <li class="active"><a href="#" data-toggle="tab" aria-expanded="false"><span><?=__('会员等级')?></span></a></li>
</ul>
<div class="container">
    <div class="main-content">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-default">
                    <div class="row m-l-15" id="formBtn">
                        <button id="btn-add" class="btn btn-default waves-effect waves-light m-t-30 m-b-10 m-r-15"><?=__('新建会员等级')?> <i class="fa fa-plus"></i></button>
                    </div>

                    <div class="panel-body">
                        <table id="tableWrapper" class="table table-striped table-bordered table-responsive"></table>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>

<div id="editMemlevelModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
        <div class="modal-dialog" style="width: 750px">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <form role="form" id="memlevelsForm" class="form-horizontal">
                    <div class="modal-body">
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="member_grade_name"><?=__('等级名称')?></label>
                                        <div class="col-sm-9 col-md-9 col-lg-9 p-0">
                                            <input type="text" placeholder="" id="member_grade_name" name="member_grade_name" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="ch_PointPercent">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 control-label" for="member_grade_pointsrate"><?=__('积分兑换比例')?></label>
                                        <div class="col-sm-9 col-md-9 col-lg-9 p-0">
                                            <input type="text" placeholder="<?=__('积分兑换比例，消费10元=1积分则积分兑换比例为0.1')?>" id="member_grade_pointsrate" name="member_grade_pointsrate" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 control-label" for="member_grade_discountrate"><?=__('折扣比例')?></label>
                                        <div class="col-sm-9 col-md-9 col-lg-9 p-0">
                                            <input type="text" placeholder="<?=__('9折即0.9，不打折即1')?>" id="member_grade_discountrate" name="member_grade_discountrate" class="form-control" onkeyup="clearNoNum(this);">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-3 col-lg-3 control-label" for=""><?=__('备注')?></label>
                                        <div class="col-sm-9 col-md-9 col-lg-9 p-0">
                                            <input type="text" name="member_grade_desc" id="member_grade_desc" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="modal-footer tc">
                        <button type="submit" class="btn b-racius3 btn-warning waves-effect waves-light" id="btnDelay"><?=__('保存')?></button>
                        <button type="button" class="btn b-racius3 btn-default waves-effect" data-dismiss="modal"><?=__('取消')?></button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<script src="<?=$this->js('controllers/member/grade')?>" charset="utf-8"></script>