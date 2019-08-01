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
                <input type="hidden" class="input-text form-control" name="index" id="index"  placeholder="<?=__('奖品编号')?>" autocomplete="off" />
                <input type="hidden" class="input-text form-control" name="activity_id" id="activity_id" autocomplete="off" />

                <div class="form-section">
                    <label class="input-label" for="awards_name" title="<?=__('奖品名称')?>" data-toggle="tooltip"  ><?=__('奖品名称')?></label>
                    <input type="text" class="input-text form-control" name="awards_name" id="awards_name"  placeholder="<?=__('奖品名称')?>" autocomplete="off"  data-rule="<?=__('奖品名称')?>:required" required />
                </div>
                <div class="form-section col-xs-12">
                    <label class="input-label" for="awards_image">奖品海报</label>

                    <a href="#"  data-toggle="image" class="img-thumbnail  picture_upload_replace" id="picture_upload_awards_image" data-target="awards_image">
                        <input type="hidden" class="input-text form-control" name="awards_image" id="awards_image" value="<?=$this->img('image.png', true)?>" />
                        <img  src="<?=$this->img('image.png', true)?>"  width="64" height="64"   data-toggle="tooltip" data-container="body" /><em class="pur-edit"></em>
                    </a>
                </div>

                <div class="form-section  col-xs-12">
                    <label class="input-label" for="awards_type">奖品类型</label>
                    <br />
                    <label title="自定义" for="awards_type1"><input class="cbr cbr-success form-control" id="awards_type1" name="awards_type" value="1" type="radio" checked >自定义</label>
                    <label title="优惠券" class="hide" for="awards_type2"><input class="cbr cbr-success form-control" id="awards_type2" name="awards_type" value="2" type="radio"  >优惠券</label>
                </div>

                <div class="form-section col-xs-6">
                    <label class="input-label" for="awards_quantity"><?=__('奖品数量')?></label>
                    <input type="text" class="input-text form-control" name="awards_quantity" id="awards_quantity"  placeholder="<?=__('奖品数量')?>" autocomplete="off"  data-rule="<?=__('奖品数量')?>:required"  />
                </div>

                <div class="form-section col-xs-6">
                    <label class="input-label" for="awards_probability"><?=__('奖品权重')?></label>
                    <input type="text" class="input-text form-control" name="awards_probability" id="awards_probability"  placeholder="<?=__('奖品权重(概率=当前权重/所有奖品权重)')?>" autocomplete="off"  data-rule="<?=__('奖品权重')?>:required"  />
                </div>

                <div class="form-section col-xs-6">
                    <label class="input-label" for="awards_title"><?=__('奖项名称')?></label>
                    <input type="text" class="input-text form-control" name="awards_title" id="awards_title"  placeholder="<?=__('奖项名称')?>" autocomplete="off"  data-rule="<?=__('奖项名称(例：一等奖)')?>:required"  />
                </div>

                <div class="form-section  col-xs-12">
                    <label class="input-label" for="awards_enable">是否可用</label>
                    <br />
                    <label title="是" for="awards_enable2"><input class="cbr cbr-success form-control" id="awards_enable1" name="awards_enable" value="1" type="radio" checked >是</label>
                    <label title="否" for="awards_enable1"><input class="cbr cbr-success form-control" id="awards_enable0" name="awards_enable" value="0" type="radio">否</label>
                </div>

                <div class="form-section hide col-xs-12">
                    <label class="input-label" for="activity_intro"><?=__('奖品规则')?></label>
                    <textarea id="activity_intro" name="activity_intro" class="input-text form-control autosize"></textarea>
                </div>

            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?= $this->js('plugins/plupload/plupload.full.min', true) ?>"></script>
<script type="text/javascript" src="<?= $this->js('img-upload') ?>"></script>
<script src="<?=$this->js('modules/seller/store_activity_lottery_item')?>"></script>
<script src="<?=$this->js('modules/seller/product/product_select_pic')?>"></script>

