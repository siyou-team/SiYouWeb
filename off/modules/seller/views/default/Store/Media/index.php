<?php if (!defined('ROOT_PATH')) {
    exit('No Permission');
} ?>
<style>
    .li-drop-default{
        border: 2px solid #b7b7b7;
    }

</style>

<script type="text/javascript" src="<?= $this->js('jquery-ui.min', true) ?>"></script>
<div class="page-container">
    <div class="main-content">
        <section class="gallery-env">

            <div class="row">

                <!-- Gallery Album Optipns and Images -->
                <div class="col-sm-9 gallery-right">

                    <!-- Album Header -->
                    <div class="album-header">
                        <h2><?= __('全部图片') ?></h2>

                        <ul class="album-options list-unstyled list-inline">
                            <li>
                                <a href="javascript:void(0)" id="compare">
                                    <i class="fa-download"></i>
                                    <?= __('同步图片') ?>
                                </a>
                            </li>
                            <li>
                                <input type="checkbox" class="cbr" id="select-all"/>
                                <label for="select-all"><?= __('全选') ?></label>
                            </li>
                            <li>
                                <a href="javascript:void(0)" id="upload_img">
                                    <i class="fa-upload"></i>
                                    <?= __('添加图片') ?>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" data-action="sort">
                                    <i class="fa-arrows"></i>
                                    <?= __('重新排序') ?>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" data-action="move">
                                    <i class="fa-edit"></i>
                                    <?= __('移动分类') ?>
                                </a>
                            </li>
                            <li class="hide">
                                <a href="javascript:void(0)" data-action="edit">
                                    <i class="fa-edit"></i>
                                    <?= __('编辑') ?>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" data-action="trash">
                                    <i class="fa-trash"></i>
                                    <?= __('删除') ?>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Sorting Information -->
                    <div class="album-sorting-info album-sorting-div">
                        <div class="album-sorting-info-inner album-sorting-div-inner clearfix">
                            <a href="javascript:void(0)" id="save-sort" class="btn btn-secondary btn-xs btn-single btn-icon btn-icon-standalone pull-right"
                               data-action="sort">
                                <i class="fa-save"></i>
                                <span><?= __('保存') ?></span>
                            </a>

                            <i class="fa-arrows-alt"></i>
                            <?= __('拖拽排序') ?>
                        </div>
                    </div>

                    <!-- Sorting Information -->
                    <div class="album-sorting-info album-move-div">
                        <div class="album-sorting-info-inner album-move-div-inner clearfix">
                            <i class="fa-arrows-alt"></i>
                            将图片点击拖动到想要移动到的分类下。
                        </div>
                    </div>

                    <div id="media-lists">
                    <!-- Album Images -->
                        <div class="album-images row">

                            <!-- Album Image -->
                            <!--<div @click="selectCheckbox(item.media_id)" v-for="item in items" :id="'image-div-' + item.media_id" class="media-image col-md-3 col-sm-4 col-xs-6"
                                 :data-media_name="item.media_name"
                                 :data-media_desc="item.media_desc"
                                 :data-url="item.url"
                                 :data-media_id="item.media_id">

                                <div class="album-image">
                                    <a href="javascript:void(0)" class="thumb" data-action="edit">
                                        <img :data-original="item.url" :src="item.url" class="img-responsive"/>
                                    </a>

                                    <a href="javascript:void(0)" class="name">
                                        <span v-text="item.media_name"></span>
                                        <em v-text="item.media_desc"></em>
                                    </a>

                                    <div class="image-options ">
                                        <a href="javascript:void(0)" :data-media_id="item.media_id" data-action="edit"><i class="fa-pencil"></i></a>
                                        <a href="javascript:void(0)" :data-media_id="item.media_id" data-action="trash"><i class="fa-trash"></i></a>
                                    </div>

                                    <div class="image-checkbox">
                                        <input type="checkbox" class="cbr" :data-media_id="item.media_id" />
                                    </div>
                                </div>
                            </div>-->




                        </div>
                        <button id="loadMore" class="hide btn btn-white btn-block">
                            <i class="fa-bars"></i>
                            加载更多
                        </button>
                    </div>
                    <div class="row">
                        <!--<ul class="pagination center-block" >
                            <li v-show="page!=1" @click="page-- && goto(page)" ><a href="javascript:void(0)">上一页</a></li>
                            <li v-for="index in pages" @click="goto(index)" :class="{'active':page == index}" :key="index">
                                <a href="javascript:void(0)" v-text="index"></a>
                            </li>
                            <li v-show="total!=page&&total!=0 " @click="page++ && goto(page++)"><a href="javascript:void(0)" >下一页</a></li>
                        </ul>-->
                    </div>

                </div>
                <!-- Gallery Sidebar -->
                <div class="col-sm-3 gallery-left ">

                    <div class="gallery-sidebar" id="gallery-sidebar">

                        <a href="javascript:void(0)" id="admin-gallery" class="btn btn-block btn-secondary btn-icon btn-icon-standalone btn-icon-standalone-right">
                            <i class="fa fa-plus"></i>
                            <span><?= __('图片分类管理') ?></span>
                        </a>

                        <ul class="list-unstyled">
                            <?php
                            $default_gallery_id = 0;
                            foreach ($data['gallery_rows'] as $k => $row): ?>
                                <li data-gallery_id="<?= $row['gallery_id'] ?>" class="media-li <?= ($row['gallery_is_default'] && $default_gallery_id = $row['gallery_id']) ? 'active' : '' ?>">
                                    <a href="javascript:void(0)">
                                        <i class="<?= $row['gallery_is_default'] ? 'fa-folder-open-o' : 'fa-folder-o' ?>"></i>
                                        <span><?= $row['gallery_name'] ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                            <li data-gallery_id="0" class="media-li <?= ($default_gallery_id == 0) ? 'active' : '' ?>">
                                <a href="javascript:void(0)">
                                    <i class="<?= $default_gallery_id == 0 ? 'fa-folder-open-o' : 'fa-folder-o' ?>"></i>
                                    <span>未分类</span>
                                </a>
                            </li>
                        </ul>
                        <form id="upload_form">
                            <input type="hidden" id="gallery_id" name="gallery_id" value="1">
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

</div>


<!-- Gallery Modal Image -->
<div class="modal fade" id="gallery-image-modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-gallery-image">
                <img src="<?= $this->img('album-image-full.jpg') ?>" class="img-responsive"/>
            </div>

            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group">
                            <label for="field-1" class="control-label"><?= __('标题') ?></label>

                            <input type="text" class="form-control" id="field-1" placeholder="<?= __('输入图片标题') ?>">
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group">
                            <label for="field-2" class="control-label"><?= __('描述') ?></label>

                            <textarea class="form-control autogrow" id="field-2" placeholder="<?= __('输入图片的描述') ?>" style="min-height: 80px;"></textarea>
                        </div>

                    </div>
                </div>

            </div>

            <div class="modal-footer modal-gallery-top-controls">
                <button type="button" class="btn btn-xs btn-white" data-dismiss="modal"><?= __('关闭') ?></button>
                <button type="button" class="hide btn btn-xs btn-info"><?= __('裁剪图片') ?></button>
                <button type="button" id="btn-save-media" class="btn btn-xs btn-secondary"><?= __('保存') ?></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_upload">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only"><?= __('关闭') ?></span></button>
                <h4 class="modal-title">上传图片</h4>
            </div>
            <form id="upload_form">
                <input type="hidden" name="gallery_id" id="gallery_id" />
            </form>
            <div class="modal-body">
                <form class="form-inline">
                    <div class="form-inline">
                        <label class="control-label">网络图片：</label>
                        <input type="text" class="form-control" id="pic_url" style="margin:0 10px;width:400px"
                               placeholder="请贴入网络图片地址" autocomplete="off"/>
                        <button type="button" class="btn btn-primary" onclick="getPicUrl()">提取</button>
                    </div>
                    <div class="form-inline clearfix" style="margin:15px 0 0">
                        <label class="control-label" style="float:left">本地图片：</label>
                        <div id="photos_area" class="photos_area">
                            <a class="cover_btn picture_cover_btn picture_upload_add" id="cover_btn_big"><span>+</span></a>
                        </div>
                    </div>
                    <div class="controls preview-container"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= __('关闭') ?></button>
                <button type="button" class="btn btn-primary upload_complete">上传完成</button>
            </div>
        </div>
    </div>
</div>

<!-- Gallery Delete Image (Confirm)-->
<div class="modal fade" id="gallery-image-delete-modal" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title"><?= __('确定删除图片') ?></h4>
            </div>

            <div class="modal-body">
                
                <?= __('你确定要删除这张图片吗?') ?>?

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal"><?= __('关闭') ?></button>
                <button type="button" class="btn btn-danger btn-delete"><?= __('删除') ?></button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?= $this->js('plugins/plupload/plupload.full.min', true) ?>"></script>
<script type="text/javascript" src="<?= $this->js('img-upload') ?>"></script>
<script type="text/javascript" src="<?= $this->js('vue.min', true) ?>"></script>
<?php $this->lazyJs('modules/seller/store/lists_store_media') ?>

