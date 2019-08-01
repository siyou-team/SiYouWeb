<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>

<link rel="stylesheet" href="<?=$this->css('plugins/zTree/css/zTreeStyle/zTreeStyle', true)?>">
<script src="<?=$this->js('plugins/zTree/js/jquery.ztree.all-3.5', true)?>"></script>
<div id="manage-wrap">
    <div class="manage-edit-box">
        <div class="box-main">
            <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form">
                <input type="hidden" class="input-text form-control" name="brand_id" id="brand_id"  placeholder="<?=__('品牌编号')?>" autocomplete="off" />
                <div class="form-section">
                    <label class="input-label" for="brand_name"><?=__('品牌名称')?></label>
                    <input type="text" class="input-text form-control" name="brand_name" id="brand_name"  placeholder="<?=__('品牌名称')?>" autocomplete="off" />
                </div><!--
                <div class="form-section">
                    <label class="input-label" for="brand_name_pinyin"><?/*=__('品牌拼音')*/?></label>
                    <input type="text" class="input-text form-control" name="brand_name_pinyin" id="brand_name_pinyin"  placeholder="<?/*=__('品牌拼音')*/?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="brand_initial"><?/*=__('首字母')*/?></label>
                    <input type="text" class="input-text form-control" name="brand_initial" id="brand_initial"  placeholder="<?/*=__('首字母')*/?>" autocomplete="off" />
                </div>-->
                <div class="form-section">
                    <label class="input-label" for="brand_desc"><?=__('品牌描述')?></label>
                    <input type="text" class="input-text form-control" name="brand_desc" id="brand_desc"  placeholder="<?=__('品牌描述')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <span id="category_id"></span>
                </div>
                <div class="form-section radio-inline">
                    <label class="input-label hide" for="brand_show_type"><?=__('展示方式')?></label>
                    <label title="图片" for="brand_show_type_1"><input class="cbr cbr-success form-control" id="brand_show_type_1" name="brand_show_type" value="1" type="radio" checked >图片</label>
                    <label title="文字" for="brand_show_type_2"><input class="cbr cbr-success form-control" id="brand_show_type_2" name="brand_show_type" value="2" type="radio"  >文字</label>
                </div>
                <div class="form-section">
                    <label class="input-label" for="brand_image"><?=__('品牌LOGO')?></label>
                    <a href="#"  data-toggle="image" class="img-thumbnail  picture_upload_replace" id="picture_upload_category_image" data-target="category_image">
                        <input type="hidden" class="input-text form-control" name="brand_image" id="brand_image" value="<?=$this->img('image.png', true)?>" />
                        <img  src="<?=$this->img('image.png', true)?>"  width="64" height="64"   data-toggle="tooltip" data-container="body" />
                    </a>
                </div>
                <!--<div class="form-section radio-inline">
                    <label class="input-label hide" for="brand_recommend"><?/*=__('是否推荐')*/?></label>
                    <label title="是" for="brand_recommend_1"><input class="cbr cbr-success form-control" id="brand_recommend_1" name="brand_recommend" value="1" type="radio"  >推荐</label><label title="否" for="brand_recommend_0"><input class="cbr cbr-success form-control" id="brand_recommend_0" name="brand_recommend" value="0" type="radio" checked >不推荐</label>
                </div>
                <div class="form-section radio-inline">
                    <label class="input-label hide" for="brand_enable"><?/*=__('是否启用')*/?></label>
                    <label title="启用" for="brand_enable_1"><input class="cbr cbr-success form-control" id="brand_enable_1" name="brand_enable" value="1" type="radio" checked >启用</label><label title="禁用" for="brand_enable_0"><input class="cbr cbr-success form-control" id="brand_enable_0" name="brand_enable" value="0" type="radio"  >禁用</label>
                </div>
                <div class="form-section">
                    <label class="input-label" for="store_id"><?/*=__('店铺编号')*/?></label>
                    <input type="text" class="input-text form-control" name="store_id" id="store_id"  placeholder="<?/*=__('店铺编号')*/?>" autocomplete="off" />
                </div>-->
            </form>
        </div>
    </div>
</div>


<script type="text/javascript" src="<?= $this->js('plugins/plupload/plupload.full.min', true) ?>"></script>
<script type="text/javascript" src="<?= $this->js('img-upload') ?>"></script>
<script src="<?=$this->js('modules/seller/base/product/brand_list')?>"></script>