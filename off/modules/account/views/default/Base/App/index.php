<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<link rel="stylesheet" href="<?=$this->css('plugins/validator/jquery.validator', true)?>">
<script type="text/javascript" src="<?=$this->js('plugins/validator/jquery.validator', true)?>" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->js('plugins/validator/local/zh_CN', true)?>" charset="utf-8"></script>
</head>
<body>
<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
	<div class="main-content">
		<div class="wrapper">
			<div class="grid-wrap">
				<table id="grid"></table>
				<div id="grid-pager"></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?=$this->js('modules/account/base/app_list')?>" charset="utf-8"></script>
