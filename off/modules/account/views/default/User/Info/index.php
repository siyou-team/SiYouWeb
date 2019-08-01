<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
	<div class="main-content">

		<div class="row">

            <form class="form-inline title-form" id="grid-search-form">
                <div class="col-sm-12">
                    <input type="text" id="user_account" name="user_account" class="ui-input form-control ui-input-ph" placeholder="输入用户账号"   autocomplete="off" >
                    <input type="text" id="user_nickname" name="user_nickname" class="ui-input form-control ui-input-ph" placeholder="输入用户昵称"   autocomplete="off" >
                    <a class="btn btn-default btn-single" data-color="blue" data-style="slide-left" id="search"><i class="fa fa-search" aria-hidden="true"></i> 查询</a>
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
<script type="text/javascript" src="<?=$this->js('modules/account/user/info')?>" charset="utf-8"></script>