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
                <input type="hidden" class="input-text form-control" name="department_id" id="department_id"  placeholder="<?=__('部门编号')?>" autocomplete="off" />
                <input type="hidden" class="input-text form-control" name="department_parent_id" id="department_parent_id"  placeholder="<?=__('上级部门')?>" autocomplete="off" />

                <div class="form-section">
                    <label class="input-label" for="department_name"><?=__('权限组名称')?></label>
                    <input type="text" class="input-text form-control" name="department_name" id="department_name"  placeholder="<?=__('权限组名称')?>" autocomplete="off" />
                </div>
                <div class="form-section radio-inline">
                    <label class="input-label hide" for="department_enable"><?=__('是否启用')?></label>
                    <label title="启用" for="department_enable_1"><input class="cbr cbr-success form-control" id="department_enable_1" name="department_enable" value="1" type="radio" checked >启用</label>
                    <label title="禁用" for="department_enable_2"><input class="cbr cbr-success form-control" id="department_enable_2" name="department_enable" value="2" type="radio">禁用</label>
                </div>

            </form>
        </div>
    </div>
</div>
<script src="<?=$this->js('modules/seller/store/store_employee_department')?>"></script>