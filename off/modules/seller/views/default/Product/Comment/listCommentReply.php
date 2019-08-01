<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
    <div class="main-content">
        <div class="row form-inline">
            <div class="col-sm-12">
                <form class="form-inline title-form" id="grid-search-form">

                    <div class="form-group">
                            <input type="text" id="user_name" name="user_name" class="form-control" placeholder="输入评论者姓名"   autocomplete="off" >
                    </div>

                    <div class="form-group">
                        <input type="text" id="user_name_to" name="user_name_to" class="form-control" placeholder="输入回复用户名称"   autocomplete="off" >
                    </div>

                    <div class="form-group">
                        <input type="text" id="comment_reply_content" name="comment_reply_content" class="form-control" placeholder="输入评论回复内容"   autocomplete="off" >
                    </div>

                    <div class="form-group">
                        <button class="btn btn-secondary btn-single" data-color="blue" data-style="slide-left" id="search"><i class="fa fa-search" aria-hidden="true"></i> 查询</button>
                    </div>


                    <div class="btn-group  pull-right">
                        <button type="button" class="btn btn-default" id="btn-add" data-w="600" data-h="200"><?=__('回复评论')?></button>
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

<script src="<?=$this->js('modules/seller/product/product_comment_reply')?>"></script>
