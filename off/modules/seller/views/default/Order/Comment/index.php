<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
    <div class="main-content">
        <div class="row form-inline">
            <div class="col-sm-12">
                <div class="btn-group  pull-right">
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

<script src="<?=$this->js('modules/seller/order/order_comment')?>"></script>