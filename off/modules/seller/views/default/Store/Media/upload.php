<?php if (!defined('ROOT_PATH')) exit('No Permission');?>

<div class="page-container">
    <div class="main-content">
        <script type="text/javascript">
            // Sample Javascript code for this page
            jQuery(document).ready(function ($)
            {
                // Sample Select all images
                $("#select-all").on('change', function (ev)
                {
                    var is_checked = $(this).is(':checked');

                    $(".album-image input[type='checkbox']").prop('checked', is_checked).trigger('change');
                });

                // Edit Modal
                $('.gallery-env a[data-action="edit"]').on('click', function (ev)
                {
                    ev.preventDefault();
                    $("#gallery-image-modal").modal('show');
                });

                // Delete Modal
                $('.gallery-env a[data-action="trash"]').on('click', function (ev)
                {
                    ev.preventDefault();
                    $("#gallery-image-delete-modal").modal('show');
                });


                // Sortable

                $('.gallery-env a[data-action="sort"]').on('click', function (ev)
                {
                    ev.preventDefault();

                    var is_sortable = $(".album-images").sortable('instance');

                    if (!is_sortable)
                    {
                        $(".gallery-env .album-images").sortable({
                            items: '> div'
                        });

                        $(".album-sorting-info").stop().slideDown(300);
                    }
                    else
                    {
                        $(".album-images").sortable('destroy');
                        $(".album-sorting-info").stop().slideUp(300);
                    }
                });
            });
        </script>
        
        <section class="gallery-env">
            
            <div class="row">
                
                <!-- Gallery Album Optipns and Images -->
                <div class="col-sm-9 gallery-right">
                    
                    <!-- Album Header -->
                    <div class="album-header">
                        <h2>General</h2>
                        
                        <ul class="album-options list-unstyled list-inline">
                            <li>
                                <input type="checkbox" class="cbr" id="select-all"/>
                                <label for="select-all"><?= __('全选') ?></label>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa-upload"></i>
                                    <?= __('添加图片') ?>
                                </a>
                            </li>
                            <li>
                                <a href="#" data-action="sort">
                                    <i class="fa-arrows"></i>
                                    <?= __('重新上传') ?>
                                </a>
                            </li>
                            <li>
                                <a href="#" data-action="edit">
                                    <i class="fa-edit"></i>
                                    <?= __('编辑') ?>
                                </a>
                            </li>
                            <li>
                                <a href="#" data-action="trash">
                                    <i class="fa-trash"></i>
                                    <?= __('删除') ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                    <!-- Sorting Information -->
                    <div class="album-sorting-info">
                        <div class="album-sorting-info-inner clearfix">
                            <a href="#"
                               class="btn btn-secondary btn-xs btn-single btn-icon btn-icon-standalone pull-right"
                               data-action="sort">
                                <i class="fa-save"></i>
                                <span><?= __('保存')?></span>
                            </a>
                            
                            <i class="fa-arrows-alt"></i>
                            <?= __('拖拽排序')?>
                        </div>
                    </div>
                    
                    <!-- Album Images -->
                    <div class="album-images row">
                        
                        <!-- Album Image -->
                        <div class="col-md-3 col-sm-4 col-xs-6">
                            <div class="album-image">
                                <a href="#" class="thumb" data-action="edit">
                                    <img src="assets/images/album-img-1.png" class="img-responsive"/>
                                </a>
                                
                                <a href="#" class="name">
                                    <span>IMG_007.jpg</span>
                                    <em>28 September 2014</em>
                                </a>
                                
                                <div class="image-options">
                                    <a href="#" data-action="edit"><i class="fa-pencil"></i></a>
                                    <a href="#" data-action="trash"><i class="fa-trash"></i></a>
                                </div>
                                
                                <div class="image-checkbox">
                                    <input type="checkbox" class="cbr"/>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Album Image -->
                        <div class="col-md-3 col-sm-4 col-xs-6">
                            <div class="album-image">
                                <a href="#" class="thumb" data-action="edit">
                                    <img src="assets/images/album-img-2.png" class="img-responsive"/>
                                </a>
                                
                                <a href="#" class="name">
                                    <span>IMG_008.jpg</span>
                                    <em>20 September 2014</em>
                                </a>
                                
                                <div class="image-options">
                                    <a href="#" data-action="edit"><i class="fa-pencil"></i></a>
                                    <a href="#" data-action="trash"><i class="fa-trash"></i></a>
                                </div>
                                
                                <div class="image-checkbox">
                                    <input type="checkbox" class="cbr"/>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Album Image -->
                        <div class="col-md-3 col-sm-4 col-xs-6">
                            <div class="album-image">
                                <a href="#" class="thumb" data-action="edit">
                                    <img src="assets/images/album-img-3.png" class="img-responsive"/>
                                </a>
                                
                                <a href="#" class="name">
                                    <span>IMG_060.jpg</span>
                                    <em>03 September 2014</em>
                                </a>
                                
                                <div class="image-options">
                                    <a href="#" data-action="edit"><i class="fa-pencil"></i></a>
                                    <a href="#" data-action="trash"><i class="fa-trash"></i></a>
                                </div>
                                
                                <div class="image-checkbox">
                                    <input type="checkbox" class="cbr"/>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Album Image -->
                        <div class="col-md-3 col-sm-4 col-xs-6">
                            <div class="album-image">
                                <a href="#" class="thumb" data-action="edit">
                                    <img src="assets/images/album-img-4.png" class="img-responsive"/>
                                </a>
                                
                                <a href="#" class="name">
                                    <span>IMG_1008.jpg</span>
                                    <em>23 August 2014</em>
                                </a>
                                
                                <div class="image-options">
                                    <a href="#" data-action="edit"><i class="fa-pencil"></i></a>
                                    <a href="#" data-action="trash"><i class="fa-trash"></i></a>
                                </div>
                                
                                <div class="image-checkbox">
                                    <input type="checkbox" class="cbr"/>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Album Image -->
                        <div class="col-md-3 col-sm-4 col-xs-6">
                            <div class="album-image">
                                <a href="#" class="thumb" data-action="edit">
                                    <img src="assets/images/album-img-5.png" class="img-responsive"/>
                                </a>
                                
                                <a href="#" class="name">
                                    <span>IMG_023.jpg</span>
                                    <em>30 July 2014</em>
                                </a>
                                
                                <div class="image-options">
                                    <a href="#" data-action="edit"><i class="fa-pencil"></i></a>
                                    <a href="#" data-action="trash"><i class="fa-trash"></i></a>
                                </div>
                                
                                <div class="image-checkbox">
                                    <input type="checkbox" class="cbr"/>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Album Image -->
                        <div class="col-md-3 col-sm-4 col-xs-6">
                            <div class="album-image">
                                <a href="#" class="thumb" data-action="edit">
                                    <img src="assets/images/album-img-6.png" class="img-responsive"/>
                                </a>
                                
                                <a href="#" class="name">
                                    <span>IMG_012.jpg</span>
                                    <em>16 July 2014</em>
                                </a>
                                
                                <div class="image-options">
                                    <a href="#" data-action="edit"><i class="fa-pencil"></i></a>
                                    <a href="#" data-action="trash"><i class="fa-trash"></i></a>
                                </div>
                                
                                <div class="image-checkbox">
                                    <input type="checkbox" class="cbr"/>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Album Image -->
                        <div class="col-md-3 col-sm-4 col-xs-6">
                            <div class="album-image">
                                <a href="#" class="thumb" data-action="edit">
                                    <img src="assets/images/album-img-7.png" class="img-responsive"/>
                                </a>
                                
                                <a href="#" class="name">
                                    <span>IMG_207.jpg</span>
                                    <em>25 June 2014</em>
                                </a>
                                
                                <div class="image-options">
                                    <a href="#" data-action="edit"><i class="fa-pencil"></i></a>
                                    <a href="#" data-action="trash"><i class="fa-trash"></i></a>
                                </div>
                                
                                <div class="image-checkbox">
                                    <input type="checkbox" class="cbr"/>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Album Image -->
                        <div class="col-md-3 col-sm-4 col-xs-6">
                            <div class="album-image">
                                <a href="#" class="thumb" data-action="edit">
                                    <img src="assets/images/album-img-8.png" class="img-responsive"/>
                                </a>
                                
                                <a href="#" class="name">
                                    <span>IMG_002.jpg</span>
                                    <em>24 August 2013</em>
                                </a>
                                
                                <div class="image-options">
                                    <a href="#" data-action="edit"><i class="fa-pencil"></i></a>
                                    <a href="#" data-action="trash"><i class="fa-trash"></i></a>
                                </div>
                                
                                <div class="image-checkbox">
                                    <input type="checkbox" class="cbr"/>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                    
                    
                    <button class="btn btn-white btn-block">
                        <i class="fa-bars"></i>
                        Load More Images
                    </button>
                
                </div>
                
                <!-- Gallery Sidebar -->
                <div class="col-sm-3 gallery-left">
                    
                    <div class="gallery-sidebar">
                        
                        <a href="#"
                           class="btn btn-block btn-secondary btn-icon btn-icon-standalone btn-icon-standalone-right">
                            <i class="fa fa-plus"></i>
                            <span><?=__('创建分组')?></span>
                        </a>
                        
                        <ul class="list-unstyled">
                            <li class="active">
                                <a href="#">
                                    <i class="fa-folder-open-o"></i>
                                    <span>General</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa-folder-o"></i>
                                    <span>Office</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa-folder-o"></i>
                                    <span>Las Vegas</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa-folder-o"></i>
                                    <span>Thailand</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa-folder-o"></i>
                                    <span>Nature</span>
                                </a>
                            </li>
                        </ul>
                    
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
                <img src="assets/images/album-image-full.jpg" class="img-responsive"/>
            </div>
            
            <div class="modal-body">
                
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="form-group">
                            <label for="field-1" class="control-label"><?= __('标题')?></label>
                            
                            <input type="text" class="form-control" id="field-1" placeholder="<?= __('输入图片标题')?>">
                        </div>
                    
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="form-group">
                            <label for="field-1" class="control-label"><?= __('描述')?></label>
                            
                            <textarea class="form-control autogrow" id="field-2" placeholder="<?= __('输入图片的描述')?>"
                                      style="min-height: 80px;"></textarea>
                        </div>
                    
                    </div>
                </div>
            
            </div>
            
            <div class="modal-footer modal-gallery-top-controls">
                <button type="button" class="btn btn-xs btn-white" data-dismiss="modal"><?= __('关闭')?></button>
                <button type="button" class="btn btn-xs btn-info"><?= __('裁剪图片')?></button>
                <button type="button" class="btn btn-xs btn-secondary"><?= __('保存')?></button>
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
                <button type="button" class="btn btn-danger"><?= __('删除') ?></button>
            </div>
        </div>
    </div>
</div>



