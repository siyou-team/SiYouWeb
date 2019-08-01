<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<ul class="nav nav-tabs">
	<li class="active"><a href="<?=Zero_Registry::get('index_page')?>?ctl=Marketing_Points&met=exchange&typ=e"><?=__('积分兑换')?></a></li>
	<li><a href="<?=Zero_Registry::get('index_page')?>?ctl=Marketing_Points&met=gift&typ=e"><?=__('礼品管理')?></a></li>
	<li><a href="<?=Zero_Registry::get('index_page')?>?ctl=Marketing_Points&met=index&typ=e"><?=__('积分变动')?></a></li>
	<li><a href="<?=Zero_Registry::get('index_page')?>?ctl=Marketing_Points&met=logs&typ=e"><?=__('积分日志')?></a></li>
</ul>

<div class="container">
	<div class="main-content">
		<div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-sm-5 col-md-5 col-lg-5 border_r m-t-20 m-b-10">
							<div class="input-group col-sm-10 col-md-10 col-lg-10 m-b-15">
								<input type="text" placeholder="<?=__('会员卡号')?>" class="form-control" name="memberKey" id="memberKey" onfocus="this.select();" data-flag="107" autocomplete="off">
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
                            <div class="m-l-15">
                                <div class="form-group">
                                    <button type="button" class="btn btn-default waves-effect waves-light m-b-15" id="btn-gift"><?=__('选择兑换的礼品')?> <i class="fa fa-plus"></i></button>
                                </div>
                                <div class="clear m-b-15 table-responsive">
                                    <table id="tableWrapper" class="table table-striped table-bordered dt-responsive nowrap"></table>
                                </div>
                                <div class="">
                                    <?=__('总数')?>：<label id="exchange_num">0</label>&nbsp;&nbsp;&nbsp;<?=__('总积分')?>：<label id="exchange_points">0</label>
                                </div>

                                <div class="form-group">
                                    <label for="remark" class="left lin32"><?=__('备注')?>：</label>
                                    <input type="text" class="form-control kd02" id="remark" style="width:350px;" maxlength="35" autocomplete="off" />
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12 col-md-12 col-lg-12 p-0">
                                        <button class="btn b-racius3 btn-warning waves-effect waves-light pull-left" id="btn-exchange" type="button"><?=__('兑换')?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	<!-- end main-content -->
	</div>
</div>

<!-- 礼品信息 -->
<div id="giftModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><?=__('礼品查询')?></h4>
            </div>
            <form role="form" class="form-horizontal" id="giftForm">
                <div class="modal-body">
                    <div class="clear hidden">
                        <div class="input-group col-sm-12 col-md-12 col-lg-12 m-b-15" id="toolbar">
                            <input type="text" placeholder="<?=__('礼品')?>" class="form-control" id="gift_code" autocomplete="off">
                            <span class="input-group-btn">
                                <button class="btn waves-effect waves-light btn-warning" type="button" id="btn-gift-search"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="clear m-t-10 table-responsive">
                        <table id="giftModalData" name="giftModalData" class="table table-striped table-bordered dt-responsive nowrap" ></table>
                    </div>
                </div>
            </form>
            <div class="modal-footer tc">
                <button type="button" id="btn-confirm" class="btn b-racius3 btn-warning waves-effect waves-light"><?=__('确定')?></button>
                <button type="button" id="edt_Cancel" class="btn b-racius3 btn-default waves-effect" data-dismiss="modal"><?=__('关闭')?></button>
            </div>
        </div>
    </div>
</div>
<script src="<?=$this->js('common/member')?>"></script>
<script src="<?=$this->js('controllers/marketing/exchange')?>" charset="utf-8"></script>