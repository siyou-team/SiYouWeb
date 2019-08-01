<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<ul class="nav nav-tabs">
	<li class="active"><a href="#" data-toggle="tab" aria-expanded="false"><span id="nav-title"><?=__('供应商管理')?></span></a></li>
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
            <form role="form" id="supplierForm" class="form-horizontal">
                <div class="modal-body">
                    <div class="col-sm-9 col-md-9 col-lg-9">
                        <div class="row">
							<div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="supplier_code"><?=__('供应商编号')?></label>
                                    <div class="col-sm-9 col-md-9 col-lg-9 p-0">
                                        <input type="text" placeholder="" id="supplier_code" name="supplier_code" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                            </div>
						
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="supplier_name"><?=__('供应商名称')?></label>
                                    <div class="col-sm-9 col-md-9 col-lg-9 p-0">
                                        <input type="text" placeholder="" id="supplier_name" name="supplier_name" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                            </div>
							
							<div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="supplier_contactor"><?=__('联系人')?></label>
                                    <div class="col-sm-9 col-md-9 col-lg-9 p-0">
                                        <input type="text" placeholder="" id="supplier_contactor" name="supplier_contactor" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                            </div>
							
							<div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="supplier_telephone"><?=__('联系电话')?></label>
                                    <div class="col-sm-9 col-md-9 col-lg-9 p-0">
                                        <input type="text" placeholder="" id="supplier_telephone" name="supplier_telephone" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                            </div>
							
							<div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="supplier_address"><?=__('联系地址')?></label>
                                    <div class="col-sm-9 col-md-9 col-lg-9 p-0">
                                        <input type="text" placeholder="" id="supplier_address" name="supplier_address" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                            </div>
							
							<div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="supplier_remark"><?=__('备注')?></label>
                                    <div class="col-sm-9 col-md-9 col-lg-9 p-0">
                                        <textarea id="supplier_remark" name="supplier_remark" class="form-control" style="resize: none;" rows="2"></textarea>
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

<script src="<?=$this->js('controllers/goods/supplier')?>" charset="utf-8"></script>