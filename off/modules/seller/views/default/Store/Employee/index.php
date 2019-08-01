<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
    <div class="main-content">
        <div class="row form-inline">
            <div class="col-sm-12">
                <div class="btn-group  pull-right">
                    <button type="button" class="btn btn-default" id="btn-employee-department"><?=__('部门设置')?></button>
                    <button type="button" class="btn btn-default" id="btn-right-group"><?=__('角色权限设置')?></button>
                    <button type="button" class="btn btn-default" id="btn-add"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?=__('新增')?></button>
                    <a class="btn btn-default btn-single" id="btn-refresh"><i class="fa-refresh"></i> <?=__('刷新')?></a><a class="btn btn-default btn-single" data-toggle="chat"><i class="fa-question"></i></a>
                </div>
            </div>
        </div>
        <div class="wrapper">
            <div class="grid-wrap">
                <table id="grid"></table>
                <div id="grid-pager"></div>
            </div>
        </div>

        <div id="initCombo" class="dn">
            <input type="text" class="textbox rightsGroupAuto" name="rights_group_name" autocomplete="off">
        </div>
        <div id="discountRateBox" class="shadow target_box dn"></div>
    </div>
</div>

<script src="<?=$this->js('modules/seller/store/store_employee')?>"></script>