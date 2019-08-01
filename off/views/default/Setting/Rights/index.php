<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<style type="text/css">
	.modal .modal-dialog .modal-content{padding:0;}
	.small, small {font-size: 85%;}
	p{font-size:14px;}
	.title{font-size:14px;border:0;line-height:34px;}
</style>
<link rel="stylesheet" href="<?=$this->css('common/zTreeStyle/zTree')?>">
<ul class="nav nav-tabs">
	<li class="active"><a href="#" data-toggle="tab" aria-expanded="false"><span id="nav-title"><?=__('角色权限')?></span></a></li>
</ul>
<div class="container">
	<div class="main-content">
	<!--- s main-content --->
		<!-- Start 列表 -->
		<div class="row">
			<div class=" col-sm-12 col-md-12 col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row m-t-10 m-b-15">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="formBtn"></div>
                        </div>
					
						<table id="tableWrapper" class="table table-striped table-bordered dt-responsive nowrap"></table>
					</div>
				</div>
			</div>

		</div>
		<!-- end 列表 -->
	<!--- end main-content --->
	</div>
</div>

	<div id="editModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
		<div class="modal-dialog" style="width: 750px">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title" id="myModalLabel"></h4>
				</div>
				<form role="form" id="rightsGroupForm" class="form-horizontal">
					<div class="modal-body">
						<div class="col-sm-9 col-md-9 col-lg-9">
							<div class="row">
								<div class="col-sm-12 col-md-12 col-lg-12">
									<div class="form-group">
										<label class="col-sm-3 control-label" for="rights_group_name"><?=__('角色名称')?></label>
										<div class="col-sm-9 col-md-9 col-lg-9 p-0">
											<input type="text" placeholder="" id="rights_group_name" name="rights_group_name" class="form-control" autocomplete="off">
										</div>
									</div>
								</div>
								
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="modal-footer tc">
						<button type="submit" class="btn b-racius3 btn-warning waves-effect waves-light" id="btn-save"><?=__('保存')?></button>
						<button type="button" class="btn b-racius3 btn-default waves-effect" data-dismiss="modal"><?=__('取消')?></button>
					</div>
				</form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>

	<!--角色组权限设置-->
    <div class="modal fade" id="rightsModel" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title"><?=__('角色组权限设置')?></h4>
                    </div>
                    <form role="form" class="form-horizontal" id="rightsForm">
                        <div class="modal-body">
                            <div class="form-group">
                                <ul id="zTreeRights" class="ztree"></ul>
                            </div>
                        </div>
                        <div class="modal-footer tc">
                            <button type="submit" class="btn btn-warning waves-light" id="btnSave"><?=__('保存')?></button>
                            <button type="button" class="btn btn-default waves-effect " data-dismiss="modal"><?=__('取消')?></button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>
    </div>

<script src="<?=$this->js('plugins/ztree/jquery.ztree')?>" charset="utf-8"></script>
<script src="<?=$this->js('plugins/ztree/jquery.ztree.excheck')?>" charset="utf-8"></script>
<script src="<?=$this->js('controllers/setting/rights')?>" charset="utf-8"></script>