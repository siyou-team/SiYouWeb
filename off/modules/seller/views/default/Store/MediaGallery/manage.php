<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<style type="text/css">
    body {
        background-color: #fff;
        min-width: 200px;
    }
</style>

<div id="manage-wrap">
    <div class="manage-edit-box">
        <div class="box-main">
            <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form">
                <input type="hidden" class="input-text form-control" name="gallery_id" id="gallery_id"  placeholder="<?=__('商品图片Id')?>" autocomplete="off" />
                <div class="form-section">
                    <label class="input-label" for="gallery_name"><?=__('相册名称')?></label>
                    <input type="text" class="input-text form-control" name="gallery_name" id="gallery_name"  placeholder="<?=__('相册名称')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="gallery_desc"><?=__('相册描述')?></label>
                    <input type="text" class="input-text form-control" name="gallery_desc" id="gallery_desc"  placeholder="<?=__('相册描述')?>" autocomplete="off" />
                </div>

                <div class="form-section hide">
                    <label class="control-label" for="gallery_is_default"  title="默认相册" data-toggle="tooltip">默认相册</label>
                    <div class="switch">
                        <input name="gallery_is_default" id="gallery_is_default" type="checkbox" value="0">
                    </div>
                </div>

                <div class="form-section">
                    <label class="input-label" for="gallery_order"><?=__('排序')?></label>
                    <input type="text" class="input-text form-control" name="gallery_order" id="gallery_order"  placeholder="<?=__('排序')?>" autocomplete="off" />
                </div>
                <div class="form-section radio-inline">
                    <label class="input-label hide" for="brand_show_type"><?=__('附件册')?></label>
                    <label title="图片" for="gallery_type_image"><input class="cbr cbr-success form-control" id="gallery_type_image" name="gallery_type" value="image" type="radio" checked >图片</label>
                    <label title="影音" for="gallery_type_video"><input class="cbr cbr-success form-control" id="gallery_type_video" name="gallery_type" value="video" type="radio"  >影音</label>
                    <label title="其他" for="gallery_type_other"><input class="cbr cbr-success form-control" id="gallery_type_other" name="gallery_type" value="other" type="radio"  >其他</label>
                </div>
                <div class="form-section">
                    <label class="input-label" for="gallery_cover"><?=__('封面')?></label>
                    <a href="#"  data-toggle="image" class="img-thumbnail  picture_upload_replace" id="picture_upload_category_image" data-target="category_image">
                        <input type="hidden" class="input-text form-control" name="gallery_cover" id="gallery_cover" value="<?=$this->img('image.png', true)?>" />
                        <img  src="<?=$this->img('image.png', true)?>"  width="64" height="64"   data-toggle="tooltip" data-container="body" />
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?= $this->js('img-upload') ?>"></script>
<script src="<?=$this->js('modules/seller/store/store_media_gallery')?>"></script>
