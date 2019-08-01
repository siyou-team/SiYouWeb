<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
    <div class="main-content">
        <div class="row form-inline">
            <form class="form-inline title-form" id="grid-search-form">
                <div class="col-sm-12">
                    <div class="form-group">
                        <input type="text" id="chain_id" name="chain_id" class="form-control" placeholder="门店编号"   autocomplete="off" >
                    </div>

                    <div class="form-group">
                        <input type="text" id="chain_name" name="chain_name" class="form-control" placeholder="门店名称"   autocomplete="off" >
                    </div>
                    <div class="form-group">
                        <button class="btn btn-secondary btn-single" data-color="blue" data-style="slide-left" id="search"><i class="fa fa-search" aria-hidden="true"></i> 查询</button>
                    </div>

                    <div class="btn-group  pull-right">
                        <button type="button" class="btn btn-default" id="btn-add"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?=__('新增')?></button>
                        <a class="btn btn-default btn-single" id="btn-refresh"><i class="fa fa-refresh" aria-hidden="true"></i> <?=__('刷新')?></a>
                        <a class="btn btn-default btn-single" data-toggle="chat"><i class="fa-question"></i></a>
                    </div>
                </div>
            </form>
        </div>
        <div class="wrapper">
            <div class="grid-wrap">
                <table id="grid"></table>
                <div id="grid-pager"></div>
            </div>
        </div>
    </div>
</div>

<script src="<?= $this->js('modules/seller/chain/chain_base') ?>"></script>