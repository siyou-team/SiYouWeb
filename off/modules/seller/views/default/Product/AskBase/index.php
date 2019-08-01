<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
    <div class="main-content">
        <div class="row form-inline">
            <div class="col-sm-12">
                <form class="form-inline title-form" id="grid-search-form">

                    <div class="form-group">
                        <input type="text" id="product_id" name="product_id" class="form-control" placeholder="输入商品ID"   autocomplete="off" >
                    </div>

                    <div class="form-group">
                        <input type="text" id="user_nickname" name="user_nickname" class="form-control" placeholder="输入用户名称"   autocomplete="off" >
                    </div>

                    <div class="form-group">
                        <input type="text" id="ask_question" name="ask_question" class="form-control" placeholder="输入咨询内容"   autocomplete="off" >
                    </div>

                    <div class="form-group">
                        <button class="btn btn-secondary btn-single" data-color="blue" data-style="slide-left" id="search"><i class="fa fa-search" aria-hidden="true"></i> 查询</button>
                    </div>


                    <div class="btn-group  pull-right">
                        <button type="button" class="btn btn-default" id="btn-add"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?=__('新增')?></button>
                        <a class="btn btn-default btn-single" id="btn-refresh"><i class="fa-refresh"></i> <?=__('刷新')?></a><a class="btn btn-default btn-single" data-toggle="chat"><i class="fa-question"></i></a>
                    </div>
                </form>

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

<script src="<?=$this->js('modules/seller/product/product_ask_base')?>"></script>