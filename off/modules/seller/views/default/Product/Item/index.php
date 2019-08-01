<?php if (!defined('ROOT_PATH')) exit('No Permission');?>

<link rel="stylesheet" href="<?=$this->css('plugins/zTree/css/zTreeStyle/zTreeStyle', true)?>">
<script src="<?=$this->js('plugins/zTree/js/jquery.ztree.all-3.5', true)?>"></script>
<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
	<div class="main-content">
        <div class="row" id="search_box">
            <div class="col-sm-12">
                <form id="grid-search-form">
                    <span id="user"></span>
                    <input type="text" id="product_name" name="product_name" class="ui-input form-control ui-input-ph" style="width: 150px;" placeholder="输入商品名称"   autocomplete="off" >
                    <input type="text" id="product_id" name="product_id" class="ui-input form-control ui-input-ph" style="width: 150px;" placeholder="输入商品平台货号"   autocomplete="off" >

                    <span ><span id="category_id"></span></span>

                    <a class="btn btn-default btn-single" data-color="blue" data-style="slide-left" id="search"><i class="fa fa-search" aria-hidden="true"></i> 查询</a>
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
<script src="<?=$this->js('modules/seller/product/product_item')?>"></script>