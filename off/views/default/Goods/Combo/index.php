<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<ul class="nav nav-tabs">
	<li class="active"><a href="#"><?=__('套餐管理')?></a></li>
</ul>
<div class="container">
	<div class="main-content">
	<!--- s main-content --->
		<div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row m-t-10 m-b-15">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="form-btn"></div>
                            <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                                <div class="input-group">
                                    <input type="text" placeholder="<?=__('套餐编号')?>" class="form-control" name="combo_code" id="combo_code">
                                    <span class="input-group-btn">
                                        <button class="btn waves-effect waves-light btn-warning" type="button" id="btn-query"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="tableWrapper" class="table table-striped table-bordered dt-responsive nowrap"></table>
                        </div>
                        <!-- End 产品数据-->
                    </div>
                    <!-- panel-body -->
                </div>
                <!-- panel -->
            </div>
            <!-- col -->
        </div>
	<!--- end main-content --->
	</div>
</div>
<script type="text/javascript" src="<?=$this->js('controllers/goods/combo')?>" charset="utf-8"></script>