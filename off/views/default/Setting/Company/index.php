<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<link rel="stylesheet" href="<?=$this->css('common/citypicker/css/city-picker')?>">
<style type="text/css">
	.modal .modal-dialog .modal-content{padding:0;}
	.small, small {font-size: 85%;}
	p{font-size:14px;}
	.title{font-size:14px;border:0;line-height:34px;}
</style>
<ul class="nav nav-tabs">
	<li class="active"><a href="#" data-toggle="tab" aria-expanded="false"><span id="nav-title"><?=__('公司信息')?></span></a></li>
</ul>
<div class="container">
	<div class="main-content">
	<!--- s main-content --->
		<div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-body">
                            <form role="form" class="form-horizontal" id="companyForm">
								<input type="hidden" name="company_id" id="company_id" value="<?=@$data['company_id']?>" >
                                <div class="col-sm-10 col-md-10 col-lg-10">
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-3  control-label" for="company_name"><?=__('企业全称')?><span class="text-danger">*</span></label>
                                        <div class="col-sm-8 col-md-10 col-lg-9 p-l-0">
                                            <div class="input-group dw">
                                                <input type="text" placeholder="" id="company_name" name="company_name" class="form-control" value="<?=@$data['company_name']?>" >
                                            </div>
                                        </div>
                                    </div>
									<div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-3  control-label" for="company_country"><?=__('国家')?></label>
                                        <div class="col-sm-8 col-md-10 col-lg-9 p-l-0">
                                            <div class="input-group dw">
                                                <input placeholder="<?=__('国家')?>" type="text" placeholder="" id="company_country" name="company_country" class="form-control" value="<?=@$data['company_country']?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-3  control-label" for="company_area"><?=__('公司所在地')?><span class="text-danger">*</span></label>
                                        <div class="col-sm-8 col-md-10 col-lg-9 p-l-0">
                                            <input type="text" id="company_area" name="company_area" class="form-control" value="<?=@$data['company_area']?>" autocomplete="off"  data-toggle="city-picker" data-rule="<?=__('公司所在地')?>:required" required readonly>
                                        </div>
                                    </div>
 
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-3  control-label" for="company_address"><?=__('街道地址')?><span class="text-danger">*</span><span>&nbsp;</span></label>
                                        <div class="col-sm-8 col-md-10 col-lg-9 p-l-0">
                                            <input type="text" placeholder="" id="company_address" name="company_address" class="form-control" value="<?=@$data['company_address']?>">
											<p class="clear m-t-10" style=""  id="zk_p"><?=__('只需要填写街道地址即可，不需要重复填写所在区域')?></p>
                                        </div>
                                    </div>
									
                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-3  control-label" for="company_taxnum"><?=__('纳税人识别号')?><span>&nbsp;</span></label>
                                        <div class="col-sm-8 col-md-10 col-lg-9 p-l-0">
                                            <input type="text" placeholder="<?=__('纳税人识别号')?>" id="company_taxnum" name="company_taxnum" class="form-control" value="<?=@$data['company_taxnum']?>">
                                        </div>
                                    </div>
									<div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-3  control-label" for="company_phone"><?=__('电话')?><span>&nbsp;</span></label>
                                        <div class="col-sm-8 col-md-10 col-lg-9 p-l-0">
                                            <input type="text" placeholder="<?=__('电话')?>" id="company_phone" name="company_phone" class="form-control" value="<?=@$data['company_phone']?>">
                                        </div>
                                    </div>
									<div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-3  control-label" for="contacts_email"><?=__('邮箱')?><span>&nbsp;</span></label>
                                        <div class="col-sm-8 col-md-10 col-lg-9 p-l-0">
                                            <input type="text" placeholder="<?=__('邮箱')?>" id="contacts_email" name="contacts_email" class="form-control" value="<?=@$data['contacts_email']?>">
                                        </div>
                                    </div>
									<div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-3  control-label" for="contacts_name"><?=__('联系人')?><span>&nbsp;</span></label>
                                        <div class="col-sm-8 col-md-10 col-lg-9 p-l-0">
                                            <input type="text" placeholder="<?=__('联系人')?>" id="contacts_name" name="contacts_name" class="form-control" value="<?=@$data['contacts_name']?>">
                                        </div>
                                    </div>
									<div class="form-group col-sm-12 col-md-12 col-lg-6 p-0">
                                        <label class="col-sm-4 col-md-2 col-lg-3  control-label" for="contacts_position"><?=__('职位')?><span>&nbsp;</span></label>
                                        <div class="col-sm-8 col-md-10 col-lg-9 p-l-0">
                                            <input type="text" placeholder="<?=__('职位')?>" id="contacts_position" name="contacts_position" class="form-control" value="<?=@$data['contacts_position']?>">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
									
                                    <div class="form-group col-sm-12 col-md-12 col-lg-12 p-0 text-center">
                                        <button type="submit" class="btn btn-warning btn-padding" id="save"><?=__('保存')?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- panel-body -->
                    </div>
                    <!-- panel -->
                </div>
            </div>
            <!-- End 公司信息 -->
        </div>
	<!--- end main-content --->
	</div>
</div>

<script src="<?=$this->js('plugins/citypicker/js/city-picker.data')?>"></script>
<script src="<?=$this->js('plugins/citypicker/js/city-picker')?>"></script>
<script src="<?=$this->js('controllers/setting/company')?>" charset="utf-8"></script>