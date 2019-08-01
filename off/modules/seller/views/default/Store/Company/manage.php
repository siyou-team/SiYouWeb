<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>


<link rel="stylesheet" href="<?=$this->css('plugins/citypicker/css/city-picker', true)?>">

<div class="page-container">
    <!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
    <div class="main-content">
        <div class="page-title">
            <div class="title-env">
                <h1 class="title"><?= __('店铺设置') ?></h1>
                <p class="description"><?= __('店铺设置-网站店铺内容基本选项设置') ?></p>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form" class="form-horizontal config-form" action="<?=$this->registry('url')?>?ctl=Store_Company&met=edit&typ=json"  data-validator-option="{stopOnError:false, timely:false}">
                    <input type="hidden" class="form-control" name="company_id" id="company_id" value="<?= @$data['company_id'] ?>"  placeholder="<?=__('公司Id')?>" autocomplete="off" />
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="company_name"><?=__('企业全称')?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="company_name" id="company_name" value="<?= @$data['company_name'] ?>"  placeholder="<?=__('企业全称(length=>2,50)')?>" autocomplete="off" data-rule="<?=__('企业全称')?>:required" required  />
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="company_area"><?=__('公司所在地')?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="company_area" id="company_area" value="<?= @$data['company_area'] ?>"  placeholder="<?=__('公司所在地')?>" autocomplete="off"  data-toggle="city-picker" data-rule="<?=__('公司所在地')?>:required" required readonly  />
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="company_address"><?=__('地址')?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="company_address" id="company_address" value="<?= @$data['company_address'] ?>"  placeholder="<?=__('请输入公司详细地址')?>" autocomplete="off" data-rule="<?=__('地址')?>:required" required />
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="company_zipcode"><?=__('邮编')?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="company_zipcode" id="company_zipcode" value="<?= @$data['company_zipcode'] ?>"  placeholder="<?=__('请输入公司邮编')?>" autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="company_phone"><?=__('电话')?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="company_phone" id="company_phone" value="<?= @$data['company_phone'] ?>"  placeholder="<?=__('请输入公司电话')?>" autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="company_website"><?=__('公司网址')?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="company_website" id="company_website" value="<?= @$data['company_website'] ?>"  placeholder="<?=__('请输入公司网址')?>" autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="company_description"><?=__('公司介绍')?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="company_description" id="company_description" value="<?= @$data['company_description'] ?>"  placeholder="<?=__('请输入公司介绍')?>" autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="contacts_name"><?=__('联系人')?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="contacts_name" id="contacts_name" value="<?= @$data['contacts_name'] ?>"  placeholder="<?=__('联系人')?>" autocomplete="off" data-rule="<?=__('联系人')?>:required" required />
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="contacts_position"><?=__('职位')?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="contacts_position" id="contacts_position" value="<?= @$data['contacts_position'] ?>"  placeholder="<?=__('职位')?>" autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="contacts_phone"><?=__('联系人电话')?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="contacts_phone" id="contacts_phone" value="<?= @$data['contacts_phone'] ?>"  placeholder="<?=__('联系人电话')?>" autocomplete="off" data-rule="required;mobile;" required />
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="contacts_email"><?=__('联系人email')?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="contacts_email" id="contacts_email" value="<?= @$data['contacts_email'] ?>"  placeholder="<?=__('联系人email')?>" autocomplete="off"  data-rule="required;email;" />
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="company_registered_capital"><?=__('注册资金')?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="company_registered_capital" id="company_registered_capital" value="<?= @$data['company_registered_capital'] ?>"  placeholder="<?=__('注册资金(required)')?>" autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="company_employee_count"><?=__('员工总数')?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="company_employee_count" id="company_employee_count" value="<?= @$data['company_employee_count'] ?>"  placeholder="<?=__('员工总数')?>" autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="company_taxnum"><?=__('纳税人识别号')?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="company_taxnum" id="company_taxnum" value="<?= @$data['company_taxnum'] ?>"  placeholder="<?=__('纳税人识别号')?>" autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="company_invoice"><?=__('发票抬头')?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="company_invoice" id="company_invoice" value="<?= @$data['company_invoice'] ?>"  placeholder="<?=__('发票抬头')?>" autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group-separator"></div>

                    <div class="form-group">
                        <a type="submit" class="btn btn-primary btn-single btn-block btn-icon btn-icon-standalone" id="submit-btn">
                            <i class="fa-pencil"></i>
                            <span>修改</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>


<script src="<?=$this->js('plugins/citypicker/js/city-picker.data', true)?>"></script>
<script src="<?=$this->js('plugins/citypicker/js/city-picker', true)?>"></script>
<script src="<?=$this->js('modules/seller/store_company_manage')?>"></script>

