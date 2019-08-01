<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<style type="text/css">
    body {
        background-color: #fff;
        min-width: 200px;
    }
</style>
<div id="manage-wrap">
    <div class="manage-edit-box">
        <div class="box-main row">
            <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form" data-validator-option="{stopOnError:false, timely:false}">
                <input type="hidden" class="input-text form-control" name="activity_id" id="activity_id"  placeholder="<?=__('活动编号')?>" autocomplete="off" />
                <?php if(@i('activity_type_id')):?>
                    <input type="hidden" name="activity_type_id" value="<?=i('activity_type_id')?>" />
                <?php endif;?>


                <div class="form-section">
                    <label class="input-label" for="activity_title" title="<?=__('活动名称将显示在活动列表中，方便商家管理使用。')?>" data-toggle="tooltip"  ><?=__('活动名称')?></label>
                    <input type="text" class="input-text form-control" name="activity_title" id="activity_title"  placeholder="<?=__('活动标题')?>" autocomplete="off"  data-rule="<?=__('活动名称')?>:required" required />
                </div>

                <div class="form-section">
                    <label class="input-label" for="activity_starttime" title="<?=__('开始时间发布之后不能修改')?>" data-toggle="tooltip" ><?=__('活动开始时间')?></label>
                    <input type="text" class="input-text form-control datepicker" name="activity_starttime" id="activity_starttime" <?php if(i('activity_id')){ echo 'disabled';}?> placeholder="<?=__('活动开始时间')?>" data-rule="<?=__('活动开始时间')?>:required" required autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="activity_endtime" title="<?=__('结束时间发布之后不能修改')?>" data-toggle="tooltip" ><?=__('活动结束时间')?></label>
                    <input type="text" class="input-text form-control datepicker" name="activity_endtime" id="activity_endtime"  placeholder="<?=__('活动结束时间')?>" <?php if(i('activity_id')){ echo 'disabled';}?> data-rule="<?=__('活动结束时间')?>:required" required autocomplete="off" />
                </div>

                <div class="form-section col-xs-6">
                    <label class="input-label" for="activity_image">活动海报</label>
                    <a href="#"  data-toggle="image" class="img-thumbnail  picture_upload_replace" id="picture_upload_activity_image" data-target="activity_image">
                        <input type="hidden" class="input-text form-control" name="activity_image" id="activity_image" value="<?=$this->img('image.png', true)?>" />
                        <img  src="<?=$this->img('image.png', true)?>"  width="64" height="64"   data-toggle="tooltip" data-container="body" /><em class="pur-edit"></em>
                    </a>
                </div>

                <div class="form-section col-xs-6">
                    <label class="input-label" for="start_join_time" title="<?=__('参加开始时间发布之后不能修改')?>" data-toggle="tooltip"><?=__('参加开始时间')?></label>
                    <input type="text" class="input-text form-control datepicker" name="start_join_time" id="start_join_time" data-format="Y-m-d"  placeholder="<?=__('活动开始时间')?>" autocomplete="off" data-rule="<?=__('活动开始时间')?>:required" required  />
                </div>
                <div class="form-section col-xs-6">
                    <label class="input-label" for="end_join_time" title="<?=__('参加截止时间发布之后不能修改')?>" data-toggle="tooltip"><?=__('参加截止时间')?></label>
                    <input type="text" class="input-text form-control datepicker" name="end_join_time" id="end_join_time" data-format="Y-m-d"   placeholder="<?=__('活动结束时间')?>" autocomplete="off" data-rule="<?=__('活动结束时间')?>:required" required  />
                </div>

                <div class="form-section col-xs-6">
                    <label class="input-label" for="activity_sponsor"><?=__('主办方')?></label>
                    <input type="text" class="input-text form-control" name="activity_sponsor" id="activity_sponsor"  placeholder="<?=__('请输入主办方单位')?>" autocomplete="off"  data-rule="<?=__('联系人')?>:required"  />
                </div>

                <div class="form-section col-xs-6">
                    <label class="input-label" for="activity_co_sponsor"><?=__('协办方')?></label>
                    <input type="text" class="input-text form-control" name="activity_co_sponsor" id="activity_co_sponsor"  placeholder="<?=__('请输入协办方单位')?>" autocomplete="off"  data-rule="<?=__('联系人')?>:required"  />
                </div>

                <div class="form-section col-xs-6">
                    <label class="input-label" for="activity_address"><?=__('活动举办地址')?></label>
                    <input type="text" class="input-text form-control" name="activity_address" id="activity_address"  placeholder="<?=__('请输入活动举办地址')?>" autocomplete="off"  data-rule="<?=__('联系人')?>:required"  />
                </div>

                <div class="form-section col-xs-6">
                    <label class="input-label" for="contact_organizer"><?=__('联系人')?></label>
                    <input type="text" class="input-text form-control" name="contact_organizer" id="contact_organizer"  placeholder="<?=__('请输入联系人')?>" autocomplete="off"  data-rule="<?=__('联系人')?>:required"  />
                </div>

                <div class="form-section col-xs-6">
                    <label class="input-label" for="contact_phone"><?=__('联系电话')?></label>
                    <input type="text" class="input-text form-control" name="contact_phone" id="contact_phone"  placeholder="<?=__('请输入联系电话')?>" autocomplete="off"  data-rule="<?=__('联系电话')?>:required"  />
                </div>

                <div class="form-section col-xs-12">
                    <label class="input-label" for="activity_intro"><?=__('活动规则')?></label>
                    <textarea id="activity_intro" name="activity_intro" rows="4" class="input-text form-control autosize"></textarea>
                </div>

                <div class="form-section col-xs-6">
                    <label class="input-label" for="guest_image">嘉宾介绍</label>
                    <a href="#"  data-toggle="image" class="img-thumbnail  picture_upload_replace" id="picture_upload_guest_image" data-target="guest_image">
                        <input type="hidden" class="input-text form-control" name="guest_image" id="guest_image" value="<?=$this->img('image.png', true)?>" />
                        <img  src="<?=$this->img('image.png', true)?>"  width="64" height="64"   data-toggle="tooltip" data-container="body" /><em class="pur-edit"></em>
                    </a>
                </div>

                <div class="form-section col-xs-12">
                    <label class="col-sm-2 control-label" for="activity_detail_intro">活动详细介绍</label>
                    <div class="col-sm-10">
                        <textarea class="ckeditor" name="activity_detail_intro" id="activity_detail_intro" rows="5"></textarea>
                    </div>
                </div>

                <div class="form-section col-xs-12">
                    <label class="col-sm-2 control-label" for="activity_process">相关议程</label>
                    <div class="col-sm-10">
                        <textarea class="ckeditor" name="activity_process" id="activity_process" rows="5"></textarea>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?= $this->js('plugins/plupload/plupload.full.min', true) ?>"></script>
<script type="text/javascript" src="<?= $this->js('img-upload') ?>"></script>
<script src="<?=$this->js('modules/seller/store_activity_base')?>"></script>
<script src="<?=$this->js('modules/seller/product/product_select_pic')?>"></script>

<script type="text/javascript" src="<?=$this->js('ckeditor/ckeditor', true)?>"></script>
<script type="text/javascript" src="<?=$this->js('ckeditor/config', true)?>"></script>
