<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
    <div class="main-content">
        <div class="row form-inline">
            <div class="col-sm-12">

                <div class="btn-group  pull-right">
                    <a class="btn btn-primary btn-single hide" id="set-express"> <?=__('设置物流公司')?></a>
                    <a class="btn btn-default btn-single hide" id="select-enabled"> <?=__('选中已启用物流')?></a>
                    <button type="button" class="btn btn-default" id="btn-add"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?=__('新增')?></button>
                    <a class="btn btn-default btn-single" id="btn-refresh"><i class="fa fa-refresh" aria-hidden="true"></i> <?=__('刷新')?></a>
                    <a class="btn btn-default btn-single" data-toggle="chat"><i class="fa-question"></i></a>
                </div>
            </div>
        </div>
        <div class="wrapper">
            <div class="grid-wrap">
                <table id="grid"></table>
                <div id="grid-pager"></div>
            </div>
        </div>
    </div>
</div>

<script src="<?=$this->js('modules/seller/store/store_express_logistics')?>"></script>