<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>	
<ul class="nav nav-tabs">
	<li><a href="<?=Zero_Registry::get('index_page')?>?ctl=Marketing_Points&met=exchange&typ=e"><?=__('积分兑换')?></a></li>
	<li><a href="<?=Zero_Registry::get('index_page')?>?ctl=Marketing_Points&met=gift&typ=e"><?=__('礼品管理')?></a></li>
	<li class="active"><a href="<?=Zero_Registry::get('index_page')?>?ctl=Marketing_Points&met=index&typ=e"><?=__('积分变动')?></a></li>
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
								<input type="text" placeholder="<?=__('会员卡号')?>" class="form-control" name="memberKey" id="memberKey" onfocus="this.select();" data-flag="108" autocomplete="off">
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

                        <div class="col-sm-7 col-md-7 col-lg-7 m-t-40 m-b-10">
                            <form role="form" id="pointsForm">
                                <h4 class="jfbd"><?=__('积分变动')?></h4>
                                <div class="clear">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <label class="left p-0 lin32 m-r-10"><?=__('选择类型')?>：</label>
                                        <div class="col-xs-8 col-sm-8 col-md-9 col-lg-10 p-0">
                                            <div class="left marr8 radio radio-danger m-t-5"><input type="radio" name="radio2" id="points_add" checked="checked" /><label for="points_add"><?=__('增加')?></label></div>
                                            <div class="left radio radio-danger m-t-5"><input type="radio" name="radio2" id="points_del" /><label for="points_del"><?=__('扣除')?></label></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clear m-t-10 form-group">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <label class="left p-0 lin32 m-r-10 "><?=__('变动数额')?>：</label>
                                        <div class="col-xs-6 col-sm-8 col-md-8 col-lg-7 p-0">
                                            <input type="text" placeholder="变动数额" id="edtGiftPoint" name="points" maxlength="8" class="form-control" value="0" autocomplete="off" />
                                        </div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div class="clear m-t-10 form-group">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <label class="left p-0 lin32 m-r-10 ">　　<?=__('备注')?>：</label>
                                        <div class="col-xs-6 col-sm-8 col-md-8 col-lg-7 p-0">
                                            <input type="text" id="remark" name="remark" class="form-control" autocomplete="off" />
                                        </div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div class="clear m-t-10">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <label class="left zuok m-r-10">&nbsp;</label>
                                        <div class="col-xs-6 col-sm-8 col-md-8 col-lg-7 p-0">
                                            <button type="submit" class="btn b-racius3 btn-warning waves-effect waves-light serch2" id="btn-confirm"><?=__('确定')?></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <h4 class="jfbd"><?=__('会员积分清零')?></h4>
                                 <div class="clear m-t-15 form-group">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <label class="left p-0 lin32 m-r-10 ">　　<?=__('备注')?>：</label>
                                        <div class="col-xs-6 col-sm-8 col-md-8 col-lg-7 p-0">
                                            <input type="text" id="clear_remark" name="clear_remark" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div class="clear m-t-10">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <label class="left p-0 lin32 m-r-10 "></label>
                                        <div class="col-xs-6 col-sm-8 col-md-8 col-lg-7 text-center">
                                            <button type="button" class="btn b-racius3 btn-warning waves-effect waves-light" id="btn-reset"><?=__('清零')?></button>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
<script src="<?=$this->js('common/member')?>"></script>
<script src="<?=$this->js('controllers/marketing/points')?>" charset="utf-8"></script>