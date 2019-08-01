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
                <div class="form-section col-xs-12">
                    <label class="input-label" for="lottery_image">活动海报</label>

                    <a href="#"  data-toggle="image" class="img-thumbnail  picture_upload_replace" id="picture_upload_lottery_image" data-target="lottery_image">
                        <input type="hidden" class="input-text form-control" name="lottery_image" id="lottery_image" value="<?=$this->img('image.png', true)?>" />
                        <img  src="<?=$this->img('image.png', true)?>"  width="64" height="64"   data-toggle="tooltip" data-container="body" /><em class="pur-edit"></em>
                    </a>
                </div>

                <div class="form-section  col-xs-12">
                    <label class="input-label" for="lottery_type">活动类型</label>
                    <br />
                    <label title="幸运大转盘" for="lottery_type1"><input class="cbr cbr-success form-control" id="lottery_type1" name="lottery_type" value="1" type="radio" checked >幸运大转盘</label>
                    <label title="砸金蛋" for="lottery_type2"><input class="cbr cbr-success form-control" id="lottery_type2" name="lottery_type" value="2" type="radio"  >砸金蛋</label>
                </div>



                <div class="form-section col-xs-6">
                    <label class="input-label" for="activity_starttime" title="<?=__('开始时间发布之后不能修改')?>" data-toggle="tooltip" ><?=__('活动开始时间')?></label>
                    <input type="text" class="input-text form-control datepicker" name="activity_starttime" id="activity_starttime" <?php if(i('activity_id')){ echo 'disabled';}?> placeholder="<?=__('活动开始时间')?>" data-rule="<?=__('活动开始时间')?>:required" required autocomplete="off" />
                </div>
                <div class="form-section col-xs-6">
                    <label class="input-label" for="activity_endtime" title="<?=__('结束时间发布之后不能修改')?>" data-toggle="tooltip" ><?=__('活动结束时间')?></label>
                    <input type="text" class="input-text form-control datepicker" name="activity_endtime" id="activity_endtime"  placeholder="<?=__('活动结束时间')?>" <?php if(i('activity_id')){ echo 'disabled';}?> data-rule="<?=__('活动结束时间')?>:required" required autocomplete="off" />
                </div>

                <div class="form-section col-xs-6">
                    <label class="input-label" for="lottery_day_times"><?=__('抽奖次数')?></label>
                    <input type="text" class="input-text form-control" name="lottery_day_times" id="lottery_day_times"  placeholder="<?=__('每天免费抽奖次数')?>" autocomplete="off"  data-rule="<?=__('抽奖次数')?>:required"  />
                </div>

                <div class="form-section hide col-xs-6">
                    <label class="input-label" for="lottery_share_add_times"><?=__('分享一次增加抽奖次数')?></label>
                    <input type="text" class="input-text form-control" name="lottery_share_add_times" id="lottery_share_add_times"  placeholder="<?=__('分享一次增加抽奖次数')?>" autocomplete="off"  data-rule="<?=__('分享一次增加抽奖次数')?>:required"  />
                </div>

                <div class="form-section hide col-xs-6">
                    <label class="input-label" for="lottery_max_awards_times"><?=__('最大中奖次数')?></label>
                    <input type="text" class="input-text form-control" name="lottery_max_awards_times" id="lottery_max_awards_times"  placeholder="<?=__('最大中奖次数')?>" autocomplete="off"  data-rule="<?=__('最大中奖次数')?>:required"  />
                </div>

                <div class="form-section col-xs-12">
                    <label class="input-label" for="activity_intro"><?=__('活动规则')?></label>
                    <textarea id="activity_intro" name="activity_intro" class="input-text form-control autosize"></textarea>
                </div>

            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?= $this->js('plugins/plupload/plupload.full.min', true) ?>"></script>
<script type="text/javascript" src="<?= $this->js('img-upload') ?>"></script>
<script src="<?=$this->js('modules/seller/store_activity_base')?>"></script>
<script src="<?=$this->js('modules/seller/product/product_select_pic')?>"></script>
