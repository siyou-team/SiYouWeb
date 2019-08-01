<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<ul class="nav nav-tabs">
	<li class="active"><a href="javascript:;"><?=__('会员管理')?></a></li>
</ul>
<div class="container">
	<div class="main-content">
		<div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row m-t-10 m-b-15">
                                <div class="col-sm-12 col-md-12 col-lg-12">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
                                    <button type="button" class="btn btn-default waves-effect m-b-15" id="btn-add"><?=__('新增')?> <i class="fa fa-plus"></i></button>&nbsp;&nbsp;
									<button type="button" class="btn btn-default waves-effect m-b-15" data-toggle="modal" data-target="#myModal-7" id="btn-import"><?=__('批量导入')?></button>&nbsp;&nbsp;
 
									<button type="button" class="btn btn-default waves-effect m-b-15" id="btn-refresh"><?=__('刷新')?></button>&nbsp;&nbsp;
									<button type="button" class="btn btn-default waves-effect m-b-15" data-toggle="collapse" data-target="#demo"><?=__('筛选会员')?></button></div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-2">
                                        <div class="input-group m-b-15">
                                            <input type="text" placeholder=<?=__("会员卡号")?> class="form-control" name="CardID" id="edt_CardID">
                                            <span class="input-group-btn">
                                                <button class="btn waves-effect waves-light btn-warning" type="button" id="edt_Quick"><i class="fa fa-search"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Start 会员筛选 -->
                            <div class="row collapse" id="demo">
                                <form role="form" id="grid-search-form" class="">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
									
                                        <div class="col-sm-6 col-md-4 col-lg-4 form-group">
                                            <label class="col-sm-4 col-md-3 col-lg-3 lin32 p-l-0 text-right font14 normal" for="edt_Level"><?=__('等　级')?></label>
                                            <div class="col-sm-8 col-md-9 col-lg-9 p-0">
                                                <select class="form-control" name="member_grade_id" id="edt_Level">
                                                    <option value=""><?=__('请选择')?></option>
													<?php if(!empty($data['grade'])): ?>
													<?php foreach($data['grade'] as $k=>$v): ?>
													<option value="<?=$v['member_grade_id']?>"><?=$v['member_grade_name']?></option>
													<?php endforeach; ?>
													<?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-4 form-group">
                                            <label class="col-sm-4 col-md-3 col-lg-3 lin32 p-l-0 text-right font14 normal" for="edt_Sex"><?=__('性　别')?></label>
                                            <div class="col-sm-8 col-md-9 col-lg-9 p-0">
                                                <select class="form-control" name="gender" id="edt_Sex">
                                                    <option value="0" selected="selected"><?=__('请选择')?></option>
                                                    <option value="2"><?=__('女')?></option>
                                                    <option value="1"><?=__('男')?></option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6 col-md-4 col-lg-4 form-group">
                                            <label class="col-sm-4 col-md-3 col-lg-3 lin32 p-l-0 text-right font14 normal">&nbsp;</label>
                                            <div class="col-sm-8 col-md-9 col-lg-9 p-0">
                                                <button type="button" class="btn btn-default waves-effect waves-light" id="edt_Reset"><i class="fa fa-trash-o"></i> <?=__('重置')?></button>
                                                <button type="button" class="btn btn-warning waves-effect waves-light m-l-10" id="search"><i class="fa fa-search"></i> <?=__('查询')?></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- panel-body -->
                    </div>
                    <!-- panel -->
                </div>
                <!-- col -->
            </div>
            <!-- End 搜索、按钮 -->
 
		<!-- Start 会员列表 -->
            <div class="row">
                <div class=" col-sm-12 col-md-12 col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table id="tableWrapper" class="table table-striped table-bordered dt-responsive nowrap"></table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- end 会员列表 -->
	</div>
</div>

<!--会员批量导入-->
    <div class="modal fade" id="ToleadModal" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" style="top: 0%;">
        <div class="modal-dialog modal_w_700">
            <div class="modal-content">
                <form enctype="multipart/form-data" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="ToleadLabel"></h4>
                    </div>
                    <div class="modal-body" style="width: 100%;">
                        <div class="content">
                            <div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <a id="Down" download="<?=__('会员批量导入模板(单次导入数据500条).xls')?>" class="download"><?=__('下载模板')?>
                                        </a>
                                    </div>
                                </div>
                                <div class="row m-t-10 m-b-10">
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-md-offset-1"></div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 p-l-0">
                                        <div class="row">
                                            <span>1、<?=__('导入数据时请仔细填写表格中的每一项数据，并严格按照指定的格式录入。')?></span>
                                        </div>
                                        <div class="row">
                                            <span>2、<?=__('一次性导入的数据量不易过大，对于大数据量建议分批次导入。')?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="col-lg-1 col-md-1 col-sm-1"></div>
                                        <div class="col-lg-10 col-md-10 col-sm-10">
                                            <input id="file-upload" class="projectfile" type="file" name="filedata"><input type="hidden" name="immediate" value="1" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer tc">
                        <button type="button" class="btn b-racius3 btn-warning waves-effect waves-light" id="Tolead_Submit"><?=__('导入')?></button>
                        <button type="button" class="btn b-racius3 btn-default waves-effect" data-dismiss="modal"><?=__('关闭')?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script src="<?=$this->js('controllers/member/info')?>" charset="utf-8"></script>