<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<style type="text/css">
    body {
        background-color: #fff;
        min-width: 200px;
    }
</style>
<link rel="stylesheet" href="<?=$this->css('bootstrap-datetimepicker')?>">
	<ul class="nav nav-tabs">
        <li class="active"><a href="#" data-toggle="tab" aria-expanded="false"><span id="nav-title"></span></a></li>
    </ul>
	<div class="container">
        <div class="main-content">
            <!-- Start 新增以及修改会员 -->
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form role="form" id="frm_AddMem" class="form-horizontal">
                                <div class="col-sm-10 col-md-10 col-lg-10">
									<div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-4  control-label"><?=__('会员账号')?></label>
                                        <div class="col-sm-8 col-md-10 col-lg-8">
                                            <input type="text" id="edt_CardID" placeholder="" name="user_account" class="form-control" <?php if(@$data['user_account']): ?> readonly="readonly" value="<?=$data['user_account']?>" <?php endif; ?> autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-4  control-label"><?=__('会员卡号')?></label>
                                        <div class="col-sm-8 col-md-10 col-lg-8">
                                            <input type="text" id="member_card" placeholder="" name="member_card" class="form-control" <?php if(@$data['member_card']): ?> readonly="readonly" value="<?=$data['member_card']?>" <?php endif; ?> autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-4  control-label"><?=__('会员姓名')?></label>
                                        <div class="col-sm-8 col-md-10 col-lg-8">
                                            <input type="text" name="user_realname" placeholder="" id="edt_CardName" class="form-control" value="<?=@$data['user_realname']?>" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-4  control-label"><?=__('手机号码')?><span class="text-danger">*</span></label>
                                        <div class="col-sm-8 col-md-10 col-lg-8">
                                            <input type="text" placeholder="" name="user_mobile" id="edt_Mobile" class="form-control" onkeyup="this.value = this.value.replace(/[^0-9]/g, '')" value="<?=@$data['user_mobile']?>" autocomplete="off">
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-4 control-label"><?=__('称呼')?><span></span></label>
                                        <div class="col-sm-8 col-md-10 col-lg-8">
                                            <div class="radio radio-danger radio-inline">
                                                <input type="radio" id="edt_Male" value="1" name="user_gender" style="margin-top: 5px;" <?php if(@$data['user_gender'] == 1):?>checked="checked"<?php endif;?> >
                                                <label for="edt_Male"><?=__('先生')?></label>
                                            </div>
                                            <div class="radio radio-danger radio-inline">
                                                <input type="radio" id="edt_FaMale" value="2" name="user_gender" style="margin-top: 5px;" <?php if(@$data['user_gender'] == 2):?>checked="checked"<?php endif;?> >
                                                <label for="edt_FaMale"><?=__('女士')?></label>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-4 control-label"><?=__('会员生日')?></label>
                                        <div class="col-sm-8 col-md-10 col-lg-8">                                           
                                            <div class="col-sm-6 col-md-6 col-lg-6 p-0">
												<input type="text" id="user_birthday" name="user_birthday" class="form-control pull-right" readonly="readonly" value="<?=@$data['user_birthday']?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-4 control-label"><?=__('会员等级')?><span class="text-danger">*</span></label>
                                        <div class="col-sm-8 col-md-10 col-lg-8">
                                            <div class="input-group">
                                                <select class="form-control" id="edt_Level" name="member_grade_id">
													<option value="0"><?=__('普通会员')?></option>
													<?php if(!empty($data['grade'])): ?>
													<?php foreach($data['grade'] as $k=>$v): ?>
													<option <?php if($data['member_grade_id'] == $v['member_grade_id']):?> selected="selected" <?php endif;?> value="<?=$v['member_grade_id']?>"><?=$v['member_grade_name']?></option>
													<?php endforeach; ?>
													<?php endif; ?>
												</select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
									
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-4  control-label" for=""><?=__('身份证')?><span></span></label>
                                        <div class="col-sm-8 col-md-10 col-lg-8">
                                            <input type="text" placeholder="" id="" name="user_idcard" class="form-control" value="<?=@$data['user_idcard']?>" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-4  control-label" for=""><?=__('邮箱')?><span></span></label>
                                        <div class="col-sm-8 col-md-10 col-lg-8">
                                            <input type="text" placeholder="" id="Text1" name="user_email" class="form-control" value="<?=@$data['user_email']?>" autocomplete="off">
                                        </div>
                                    </div>
									
									<div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-4  control-label" for="member_address"><?=__('地址')?><span></span></label>
                                        <div class="col-sm-8 col-md-10 col-lg-8">
                                            <input type="text" placeholder="" id="Text1" name="member_address" class="form-control" value="<?=@$data['member_address']?>" autocomplete="off">
                                        </div>
                                    </div>
									
									<div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-4  control-label" for="member_remark"><?=__('备注')?><span></span></label>
                                        <div class="col-sm-8 col-md-10 col-lg-8">
                                            <input type="text" placeholder="" id="Text1" name="member_remark" class="form-control" value="<?=@$data['member_remark']?>" autocomplete="off">
                                        </div>
                                    </div>
 
                                    <div class="col-sm-12 col-md-12 col-lg-12 border_t form_btn form-group">
                                        <div class="col-sm-12 col-md-12 col-lg-12 m-t-10 text-center">
                                            <button type="submit" class="btn btn-warning btn-padding"><?=__('保存')?></button>
                                            <button type="button" id="edt_Cancel" class="btn btn-gray btn-padding m-l-10" data-dismiss="modal"><?=__('取消')?></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End 新增会员 -->
    </div>
<script src="<?=$this->js('bootstrap/bootstrap-datetimepicker')?>" charset="utf-8"></script>
<script src="<?=$this->js('controllers/member/manage')?>" charset="utf-8"></script>