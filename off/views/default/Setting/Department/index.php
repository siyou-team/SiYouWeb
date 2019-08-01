<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<style type="text/css">
	.modal .modal-dialog .modal-content{padding:0;}
	.small, small {font-size: 85%;}
	p{font-size:14px;}
	.title{font-size:14px;border:0;line-height:34px;}
</style>
<ul class="nav nav-tabs">
	<li class="active"><a href="#" data-toggle="tab" aria-expanded="false"><span id="nav-title"><?=__('部门设置')?></span></a></li>
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
            <form role="form" id="departmentForm" class="form-horizontal">
                <div class="modal-body">
                    <div class="col-sm-9 col-md-9 col-lg-9">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="department_name"><?=__('部门名称')?></label>
                                    <div class="col-sm-9 col-md-9 col-lg-9 p-0">
                                        <input type="text" placeholder="" id="department_name" name="department_name" class="form-control">
                                    </div>
                                </div>
                            </div>
							
							<div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="department_stop"><?=__('是否启用')?></label>
                                    <div class="col-sm-9 col-md-9 col-lg-9 p-0">
                                        <div class="left marr8 radio radio-danger">
                                            <input type="radio" name="department_stop" id="department_enable" checked="checked" />
                                            <label for="department_enable"><?=__('启用')?></label>
                                        </div>
                                        <div class="left radio radio-danger">
                                            <input type="radio" name="department_stop" id="department_stop" />
                                            <label for="department_stop"><?=__('禁用')?></label>
                                        </div>
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

<script src="<?=$this->js('controllers/setting/department')?>" charset="utf-8"></script>