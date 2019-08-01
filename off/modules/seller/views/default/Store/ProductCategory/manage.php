<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<div id="manage-wrap">
    <div class="manage-edit-box">
        <div class="box-main">
            <form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form">
                <input type="hidden" class="input-text form-control" name="store_product_cat_id" id="store_product_cat_id"  placeholder="<?=__('分类编号')?>" autocomplete="off" />
                <div class="form-section">
                    <label class="input-label" for="store_product_cat_name"><?=__('分类名称')?></label>
                    <input type="text" class="input-text form-control" name="store_product_cat_name" id="store_product_cat_name"  placeholder="<?=__('分类名称')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="parent_id"><?=__('父编号')?></label>
                    <input type="text" class="input-text form-control" name="parent_id" id="parent_id"  placeholder="<?=__('父编号')?>" autocomplete="off" />
                </div>
                <div class="form-section">
                    <label class="input-label" for="store_product_cat_order"><?=__('排序')?></label>
                    <input type="text" class="input-text form-control" name="store_product_cat_order" id="store_product_cat_order"  placeholder="<?=__('排序,数字越小越靠前')?>" autocomplete="off" />
                </div>

                <div class="form-section">
                    <label class="col-sm-2 control-label" for="store_product_cat_image">分类图片</label>
                    <div class="inline">
                        <a href="#"  data-toggle="image" class="img-thumbnail  picture_upload_replace" id="picture_upload_replace_id" data-target="store_product_cat_image">
                            <input type="hidden" class="form-control" name="store_product_cat_image" id="store_product_cat_image"
                                   value="" placeholder="商品单价" autocomplete="off"/>
                            <img src=""  data-placeholder="" width="100" height="100" data-toggle="tooltip" /></a>
                    </div>
                    <div class="btn btn-default btn-primary J_choosePic">从图片空间选择</div>
                </div>
                <div class="form-section">
                    <input id="store_product_cat_enable" name="store_product_cat_enable" type="checkbox" value="1" checked="checked" data-on-text="启用" data-off-text="禁用">
                </div>

            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= $this->js('plugins/plupload/plupload.full.min', true) ?>"></script>
<script type="text/javascript" src="<?= $this->js('img-upload') ?>"></script>
<script src="<?=$this->js('modules/seller/store_product_category')?>"></script>
<script src="<?=$this->js('modules/seller/product/product_select_pic')?>"></script>