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

                <div class="form-section col-xs-12">
                    <label class="input-label" for="activity_title" title="<?=__('活动名称')?>" data-toggle="tooltip" ><?=__('活动名称')?></label>
                    <input type="text" class="input-text form-control" name="activity_title" id="activity_title"  placeholder="<?=__('活动名称')?>" data-rule="<?=__('活动名称')?>:required" required autocomplete="off" />
                </div>

                <div class="form-section col-xs-6">
                    <label class="input-label" for="activity_starttime" title="<?=__('开始时间发布之后不能修改')?>" data-toggle="tooltip" ><?=__('活动开始时间')?></label>
                    <input type="text" class="input-text form-control datepicker" name="activity_starttime" id="activity_starttime" <?php if(i('activity_id')){ echo 'disabled';}?> placeholder="<?=__('活动开始时间')?>" data-rule="<?=__('活动开始时间')?>:required" required autocomplete="off" />
                </div>

                <div class="form-section col-xs-6">
                    <label class="input-label" for="activity_endtime" title="<?=__('结束时间发布之后不能修改')?>" data-toggle="tooltip" ><?=__('活动结束时间')?></label>
                    <input type="text" class="input-text form-control datepicker" name="activity_endtime" id="activity_endtime"  placeholder="<?=__('活动结束时间')?>" <?php if(i('activity_id')){ echo 'disabled';}?> data-rule="<?=__('活动结束时间')?>:required" required autocomplete="off" />
                </div>

                <div class="form-group-separator"></div>

                <div class="form-section col-xs-12">
                    <label class="input-label" for="item_id" title="<?=__('砍价商品')?>" data-toggle="tooltip" ><?=__('砍价商品')?></label>

                    <template style="display: none;">
                        <input type="text" class="input-text form-control wp50" name="activity_item" id="activity_item"  placeholder="<?=__('活动商品')?>" data-rule="<?=__('活动商品')?>:required" required autocomplete="off" />
                        <a class="btn btn-default btn-single ladda-button" data-color="blue" data-style="slide-left" id="search">
                            <span class="ladda-label">
                                <i class="fa fa-search" aria-hidden="true"></i> 
                            查询</span>
                            <span class="ladda-spinner"></span>
                        </a>
                    </template>
                    

                    <div class="col-xs-12" id="select_item" >
                        <input type="hidden" class="input-text form-control" name="item_id" id="item_id" required autocomplete="off" />
                        <input type="hidden" class="input-text form-control" name="item_unit_price" id="item_unit_price" required autocomplete="off" />
                        <input type="hidden" class="input-text form-control" name="item_name" id="item_name" required autocomplete="off" />
                        <input type="text" class="input-text form-control" name="item_show" id="item_show"  placeholder="<?=__('选择商品')?>" data-rule="<?=__('选择商品')?>:required" readonly required autocomplete="off" />
                    </div>
                </div>

                <div class="form-section col-xs-12">
                    <label class="input-label" for="activity_image">活动海报</label>

                    <a href="#"  data-toggle="image" class="img-thumbnail  picture_upload_replace" id="picture_upload_activity_image" data-target="activity_image">
                        <input type="hidden" class="input-text form-control" name="activity_image" id="activity_image" value="<?=$this->img('image.png', true)?>" />
                        <img  src="<?=$this->img('image.png', true)?>"  width="64" height="64"   data-toggle="tooltip" data-container="body" /><em class="pur-edit"></em>
                    </a>
                </div>

                <div class="form-section col-xs-12">
                    <label class="input-label" for="cut_down_min_limit_price"><?=__('砍价底价')?></label>
                    <input type="text" class="input-text form-control" name="cut_down_min_limit_price" id="cut_down_min_limit_price"  placeholder="<?=__('砍价底价')?>" data-rule="<?=__('砍价底价')?>:required" required autocomplete="off" />
                </div>

                <div class="form-section col-xs-12">
                    <label class="input-label" for="cut_down_type" title="<?=__('砍价方式')?>" data-toggle="tooltip" ><?=__('砍价方式')?></label>
                    <br />
                    <label title="固定价格" for="cut_down_type1"><input class="cbr cbr-success form-control" id="cut_down_type1" name="cut_down_type" value="1" type="radio" checked >固定价格</label>
                    <label title="价格范围" for="cut_down_type2"><input class="cbr cbr-success form-control" id="cut_down_type2" name="cut_down_type" value="2" type="radio">价格范围</label>
                </div>

                <div class="form-section col-xs-12">
                    <label class="input-label" for="cut_down_first" title="<?=__('砍价第一刀')?>" data-toggle="tooltip" ><?=__('砍价第一刀')?></label>
                    <br />
                </div>
                <div class="form-section col-xs-6 cut_down cut_down_type1">
                    <label class="input-label" for="cut_down_fixed_price" title="<?=__('固定价格')?>" data-toggle="tooltip" ><?=__('固定价格')?></label>
                    <input type="text" class="input-text form-control" name="cut_down_fixed_price" id="cut_down_fixed_price"  placeholder="<?=__('固定价格')?>" data-rule="<?=__('固定价格')?>:required" required autocomplete="off" />
                </div>

                <div class="form-section hide col-xs-6 cut_down cut_down_type2">
                    <label class="input-label" for="cut_down_min_price" title="<?=__('最低价')?>" data-toggle="tooltip" ><?=__('最低价')?></label>
                    <input type="text" class="input-text form-control" name="cut_down_min_price" id="cut_down_min_price"  placeholder="<?=__('最低价')?>" data-rule="<?=__('最低价')?>:required" required autocomplete="off" />
                </div>
                <div class="form-section hide col-xs-6 cut_down cut_down_type2">
                    <label class="input-label" for="cut_down_max_price" title="<?=__('最高价')?>" data-toggle="tooltip" ><?=__('最高价')?></label>
                    <input type="text" class="input-text form-control" name="cut_down_max_price" id="cut_down_max_price"  placeholder="<?=__('最高价')?>" data-rule="<?=__('最高价')?>:required" required autocomplete="off" />
                </div>

                <div class="form-section col-xs-12">
                    <label class="input-label" for="cut_down_share" title="<?=__('分享多砍一刀')?>" data-toggle="tooltip" ><?=__('分享多砍一刀')?></label>
                    <br />
                </div>
                <div class="form-section col-xs-6 cut_down cut_down_type1">
                    <label class="input-label" for="cut_down_share_fixed_price" title="<?=__('固定价格')?>" data-toggle="tooltip" ><?=__('固定价格')?></label>
                    <input type="text" class="input-text form-control" name="cut_down_share_fixed_price" id="cut_down_share_fixed_price"  placeholder="<?=__('固定价格')?>" data-rule="<?=__('固定价格')?>:required" required autocomplete="off" />
                </div>

                <div class="form-section hide col-xs-6 cut_down cut_down_type2">
                    <label class="input-label" for="cut_down_share_max_price" title="<?=__('最低价')?>" data-toggle="tooltip" ><?=__('最低价')?></label>
                    <input type="text" class="input-text form-control" name="cut_down_share_max_price" id="cut_down_share_max_price"  placeholder="<?=__('最低价')?>" data-rule="<?=__('最低价')?>:required" required autocomplete="off" />
                </div>
                <div class="form-section hide col-xs-6 cut_down cut_down_type2">
                    <label class="input-label" for="cut_down_share_min_price" title="<?=__('最高价')?>" data-toggle="tooltip" ><?=__('最高价')?></label>
                    <input type="text" class="input-text form-control" name="cut_down_share_min_price" id="cut_down_share_min_price"  placeholder="<?=__('最高价')?>" data-rule="<?=__('最高价')?>:required" required autocomplete="off" />
                </div>

                <div class="form-section col-xs-12">
                    <label class="col-sm-2 control-label" for="activity_intro">活动简介</label>
                    <div class="col-sm-10">
                        <textarea class="form-control autosize" name="activity_intro" id="activity_intro" rows="5"></textarea>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?= $this->js('plugins/plupload/plupload.full.min', true) ?>"></script>
<script type="text/javascript" src="<?= $this->js('img-upload') ?>"></script>
<script src="<?=$this->js('modules/seller/store_activity_base')?>"></script>
<script src="<?=$this->js('modules/seller/store_activity_cut_price')?>"></script>
<script src="<?=$this->js('modules/seller/product/product_select_pic')?>"></script>

