<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<style type="text/css">
	.modal .modal-dialog .modal-content{padding:0;}
	.small, small {font-size: 85%;}
	p{font-size:14px;}
	.title{font-size:14px;border:0;line-height:34px;}
</style>
<ul class="nav nav-tabs">
	<li class="active"><a href="#" data-toggle="tab" aria-expanded="false"><span id="nav-title"><?=__('员工管理')?></span></a></li>
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
            <form role="form" id="staffForm" class="form-horizontal">
                <div class="modal-body">
                    <div class="col-sm-9 col-md-9 col-lg-9">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="staff_name"><?=__('员工姓名')?></label>
                                    <div class="col-sm-9 col-md-9 col-lg-9 p-0">
                                        <input type="text" placeholder="" id="staff_name" name="staff_name" class="form-control">
                                    </div>
                                </div>
                            </div>
							
							<div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="staff_mobile"><?=__('手机号码')?></label>
                                    <div class="col-sm-9 col-md-9 col-lg-9 p-0">
                                        <input type="text" placeholder="" id="staff_mobile" name="staff_mobile" class="form-control">
                                    </div>
                                </div>
                            </div>
							
							<div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="staff_gender"><?=__('性  别')?></label>
                                    <div class="col-sm-9 col-md-9 col-lg-9 p-0">
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="edt_Male" value="1" name="staff_gender" style="margin-top: 5px;" <?php if(@$data['staff_gender'] == 1):?>checked="checked"<?php endif;?> >
                                            <label for="edt_Male"><?=__('先生')?></label>
                                        </div>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="edt_FeMale" value="2" name="staff_gender" style="margin-top: 5px;" <?php if(@$data['staff_gender'] == 2):?>checked="checked"<?php endif;?> >
                                            <label for="edt_FeMale"><?=__('女士')?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							<div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="staff_department_id"><?=__('所在部门')?></label>
                                    <div class="col-sm-9 col-md-9 col-lg-9 p-0">
                                        <select class="form-control" id="edt_Level" name="staff_department_id">
											<option value="0"><?=__('请选择')?></option>
											<?php if(!empty($data['department'])): ?>
											<?php foreach($data['department'] as $k=>$v): ?>
												<option <?php if($data['department_id'] == $v['department_id']):?> selected="selected" <?php endif;?> value="<?=$v['department_id']?>"><?=$v['department_name']?></option>
											<?php endforeach; ?>
											<?php endif; ?>
										</select>
                                    </div>
                                </div>
                            </div>
							
							<div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="staff_address"><?=__('员工地址')?></label>
                                    <div class="col-sm-9 col-md-9 col-lg-9 p-0">
                                        <input type="text" placeholder="" id="staff_address" name="staff_address" class="form-control">
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

<script src="<?=$this->js('controllers/setting/staff')?>" charset="utf-8"></script>