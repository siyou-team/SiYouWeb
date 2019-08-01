<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
    <div class="main-content">
        <div class="row form-inline">
            <div class="col-sm-12">
                <div class="btn-group  pull-right">
                    <button type="button" class="btn btn-default" id="btn-chooser-item-rule"><?=__('新增')?></button>
                    <a class="btn btn-default btn-single" id="btn-refresh"><i class="fa-refresh"></i> <?=__('刷新')?></a><a class="btn btn-default btn-single" data-toggle="chat"><i class="fa-question"></i></a>
                </div>
            </div>
        </div>
        <div class="wrapper">
            <div class="grid-wrap">
                <table id="grid_rule_manage"></table>

            </div>
        </div>
    </div>
</div>

<script src="<?=$this->js('modules/seller/store_activity_rule_manage')?>"></script>