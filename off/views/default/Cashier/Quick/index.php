<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<style type="text/css">
	.modal .modal-dialog .modal-content{padding:0;}
</style>
<ul class="nav nav-tabs">
	<li class="active"><a href="javascript:;"><?=__('快速收银')?></a></li>
</ul>
<div class="container">
	<div class="main-content">
		<!-- Start 快速消费-收银 -->
        <div class="row">
            <div class="col-sm-12  col-md-12 col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-sm-5 col-md-5 col-lg-5 border_r m-t-20 m-b-10">
                            <div class="input-group col-sm-10 col-md-10 col-lg-10 m-b-15">
                                <input type="text" placeholder="<?=__('会员卡号')?>" class="form-control" name="memberKey" id="memberKey" onfocus="this.select();" data-flag="102" autocomplete="off">
                                <span class="input-group-btn">
                                    <button class="btn waves-effect waves-light btn-warning" type="button" id="bth-member"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 border_t m-t-10" style="padding: 0">
                                <div class="col-md-12 col-sm-12 text-center m-t-20">
                                    <img id="avatar" src="<?=$this->img?>/infoPic.jpg" class="b-racius0 b" width="125" height="125">
                                </div>
                                <div class="col-md-12 col-sm-12" style="padding: 0">
                                    <ul class="xf_aa ">
                                        <h4>
                                            <label id="member_account"></label>
                                            <span id="member_grade_name"></span>
                                        </h4>
                                        <div class="biaoqianA">
                                            <ul id="tag_name">
                                            </ul>
                                        </div>
                                        <div class="clearfix"></div>
                                        <li class="col-lg-6 col-md-6 col-sm-12 col-xs-12 "><span><?=__('会员卡号')?>：</span><i id="member_card"></i></li>
                                        <li class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><span><?=__('会员生日')?>：</span><i id="user_birthday"></i></li>
                                        <li class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><span><?=__('手机号码')?>：</span><i id="user_mobile"></i></li>
                                        <li class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><span><?=__('会员积分')?>：</span><i id="member_points"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-7 col-md-7 col-lg-7 m-t-20 m-b-10">
                            <form role="form" id="consumptionForm" class="form-horizontal">
                                <div class="col-sm-12 col-md-12 col-lg-12 height-a of cashier">
                                    <div class="form-group">
                                        <label class="col-sm-3  col-md-2 col-lg-2 control-label" for="edtMoney"><?=__('消费金额')?><span></span></label>
                                        <div class="col-sm-6 col-md-5 col-lg-5">
                                            <input type="text" placeholder="0.00" id="edtMoney" class="form-control" maxlength="8" onkeyup="clearNoNum(this);" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-2 col-lg-2 control-label" for="edtDiscountMoney"><?=__('折后金额')?><span></span></label>
                                        <div class="col-sm-6 col-md-5 col-lg-5">
                                            <input type="text" placeholder="0.00" id="edtDiscountMoney" class="form-control" readonly="readonly" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-md-2 col-lg-2 control-label" for="edtPoint"><?=__('可得积分')?><span></span></label>
                                        <div class="col-sm-6 col-md-5 col-lg-5">
                                            <input type="text" placeholder="0" id="edtPoint" class="form-control" readonly="readonly" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="form-group" style="display:none;">
                                        <label class="col-sm-3 col-md-2 col-lg-2 control-label" for="edtRemark"><?=__('备注')?><span></span></label>
                                        <div class="col-sm-9 col-md-5 col-lg-5">
                                            <textarea rows="3" class="form-control" id="edtRemark" style="resize: none;" maxlength="150"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group m-b-0">
                                        <label class="col-sm-3 col-md-2 col-lg-2 control-label">&nbsp;</label>
                                        <div class="col-sm-5 col-md-5 col-lg-5">
                                            <button class="btn btn-warning waves-effect waves-light btn-lg btn-lg1" id="edt_Pay" type="button"><?=__('结账')?></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End 快速消费-收银 -->
	</div>
</div>
<script src="<?=$this->js('common/member')?>"></script>
<script src="<?=$this->js('common/cashier')?>"></script>
<script src="<?=$this->js('print/LodopFuncs')?>"></script>
<script src="<?=$this->js('common/print')?>"></script>
<script src="<?=$this->js('controllers/cashier/quick')?>" charset="utf-8"></script>