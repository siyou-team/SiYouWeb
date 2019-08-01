<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
    <div class="main-content">
        <div class="row form-inline">
            <div class="col-sm-12">
                <div class="btn-group  pull-right">
                    <a href="<?= urlh('admin.php', 'Base_UserLevel', 'expRule', 'account')?>" class="btn btn-default btn-single"></i> <?=__('规则设置')?></a>
                    <button type="button" class="btn btn-default" id="btn-add"><?=__('新增等级')?></button>
                    <button type="button" class="btn btn-default hide" id="btn-exp"><?=__('规则设置-商城设置')?></button>

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
    </div>
</div>

<script src="<?=$this->js('modules/account/base/base_user_level')?>"></script>