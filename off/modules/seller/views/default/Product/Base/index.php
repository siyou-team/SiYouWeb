<?php if (!defined('ROOT_PATH')) exit('No Permission');?>
<link rel="stylesheet" href="<?=$this->css('plugins/zTree/css/zTreeStyle/zTreeStyle', true)?>">
<script src="<?=$this->js('plugins/zTree/js/jquery.ztree.all-3.5', true)?>"></script>
<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
	<div class="main-content" style="padding-top: 10px;">
		<div class="row">
			<div class="col-sm-12">
                <form class="form-inline title-form" id="grid-search-form">

                    <div class="form-group">
                        <input type="text" id="product_name" name="product_name" class="form-control" placeholder="输入商品名称"   autocomplete="off" >
                    </div>

                    <div class="form-group">
                        <input type="text" id="product_id" name="product_id" class="form-control" placeholder="输入商品平台货号"   autocomplete="off" >
                    </div>

                    <div class="form-group">
                        <button class="btn btn-secondary btn-single" data-color="blue" data-style="slide-left" id="search"><i class="fa fa-search" aria-hidden="true"></i> 查询</button>
                    </div>

                    
                    <div class="form-group btn-group pull-right" id="J_product_state">
                        <button type="button" class="btn btn-default active" id="btn-state-all"><i class="fa fa-futbol-o" aria-hidden="true"></i> 全部</button>
                        <button type="button" class="btn btn-default" id="btn-state-1001"><i class="fa fa-shopping-cart" aria-hidden="true"></i> 售卖中</button>
                        <button type="button" class="btn btn-default" id="btn-state-1002"><i class="fa fa-building" aria-hidden="true"></i> 仓库中</button>
                        <button type="button" class="btn btn-default" id="btn-state-1000"><i class="fa fa-lock" aria-hidden="true"></i> 违禁</button>
                        <button class="btn btn-default" id="btn-refresh"><i class="fa fa-refresh" aria-hidden="true"></i> <?=__('刷新')?></button>
                        <a class="btn btn-default btn-single" data-toggle="chat"><i class="fa-question"></i></a>
                    </div>

                    <div class="form-group btn-group pull-right">
                        <button type="button" class="btn btn-primary" id="btn-add"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?=__('新增')?></button>
                        <button type="button" class="btn btn-default hide J_operate_btn" id="btn-on"><i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i> 上架</button>
                        <button type="button" class="btn btn-default hide J_operate_btn" id="btn-off"><i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i> 下架</button>
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
<script type="text/javascript">
	var product_state_id = <?=request_int('product_state_id', -1)?>;
	var product_verify_id = <?=request_int('product_verify_id', -1)?>;

    var shop_url = "<?=Zero_Registry::get('base_url')?>" + "/index.php";
</script>
<script src="<?=$this->js('modules/seller/product/product_base_list')?>"></script>