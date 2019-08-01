<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
    <div class="main-content">
        <div class="row">
            <form class="form-inline title-form" id="grid-search-form">
                <div class="col-sm-12">
                    <div class="form-group">
                        <select name="return_state_id" id="grid-search-form" class="input_txt form-inline title-form form-control select2" style="width:200px;">
                            <option value="0" selected>全部状态</option>
                            <option value="3100">等待审核</option>
                            <option value="3105">审核通过</option>
                            <option value="3110">审核失败</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-secondary btn-single" data-color="blue" data-style="slide-left" id="search"><i class="fa fa-search" aria-hidden="true"></i> 查询</button>
                    </div>
                    <div class="btn-group  pull-right">
                        <a class="btn btn-default btn-single" id="btn-refresh"><i class="fa-refresh"></i> <?=__('刷新')?></a>
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

<script src="<?=$this->js('modules/seller/supplier/supplier_index')?>"></script>
