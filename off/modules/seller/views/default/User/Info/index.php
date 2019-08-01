<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
	<div class="main-content">

		<div class="row">
			<div class="col-sm-6">
				<a class="btn btn-default btn-single" id="search" data-color="green" data-style="expand-right"><i class="fa fa-search" aria-hidden="true"></i> 查询</a>
			</div>
			<div class="col-sm-6">
				<div class="btn-group  pull-right">
					<button type="button" class="btn btn-default" id="btn-add"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?=__('新增')?></button>
					<a class="btn btn-default btn-single" id="btn-refresh"><i class="fa fa-refresh" aria-hidden="true"></i> <?=__('刷新')?></a>                    <a class="btn btn-default btn-single" data-toggle="chat"><i class="fa-question"></i></a>
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
<script type="text/javascript" src="<?=$this->js('modules/seller/user/info')?>" charset="utf-8"></script>