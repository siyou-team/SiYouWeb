<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<ul class="nav nav-tabs">
	<li class="active"><a href="#" data-toggle="tab" aria-expanded="false"><span id="nav-title"><?=__('分店管理')?></span></a></li>
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

	<!--新增和修改模态框-->
    <div class="modal fade" id="editModel" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" style="width: 700px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <form role="form" class="form-horizontal" id="chainForm">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6 col-lg-6 col-md-6">
                                <label class="col-sm-4 col-md-4 col-lg-4 lin32 text-right font14 normal p-l-0" for="chain_name "><span class="text-danger">*</span><?=__('分店名称')?>：</label>
                                <div class="form-group col-sm-8 col-md-8 col-lg-8 p-0">
                                    <input type="text" id="chain_name" name="chain_name" class="form-control" style="background: #fafafa;" autocomplete="off">
                                </div>
                            </div>
							<div class="col-sm-6 col-lg-6 col-md-6">
                                <label class="col-sm-4 col-md-4 col-lg-4 lin32 text-right font14 normal p-l-0" for="chain_telephone "><span class="text-danger">*</span><?=__('联系电话')?>：</label>
                                <div class="form-group col-sm-8 col-md-8 col-lg-8 p-0">
                                    <input type="text" id="chain_telephone" name="chain_telephone" class="form-control" style="background: #fafafa;" autocomplete="off">
                                </div>
                            </div>
							<div class="col-sm-6 col-lg-6 col-md-6">
                                <label class="col-sm-4 col-md-4 col-lg-4 lin32 text-right font14 normal p-l-0" for="chain_contacter "><span class="text-danger">*</span><?=__('联 系 人')?>：</label>
                                <div class="form-group col-sm-8 col-md-8 col-lg-8 p-0">
                                    <input type="text" id="chain_contacter" name="chain_contacter" class="form-control" style="background: #fafafa;" autocomplete="off">
                                </div>
                            </div>
							<div class="col-sm-6 col-lg-6 col-md-6">
                                <label class="col-sm-4 col-md-4 col-lg-4 lin32 text-right font14 normal p-l-0" for="chain_email "><?=__('邮　箱')?>：</label>
                                <div class="form-group col-sm-8 col-md-8 col-lg-8 p-0">
                                    <input type="text" id="chain_email" name="chain_email" class="form-control" style="background: #fafafa;" autocomplete="off">
                                </div>
                            </div>
							<div class="col-sm-6 col-lg-6 col-md-6">
                                <label class="col-sm-4 col-md-4 col-lg-4 lin32 text-right font14 normal p-l-0" for="chain_address "><span class="text-danger">*</span><?=__('地　址')?>：</label>
                                <div class="form-group col-sm-8 col-md-8 col-lg-8 p-0">
                                    <input type="text" id="chain_address" name="chain_address" class="form-control" style="background: #fafafa;" autocomplete="off">
                                </div>
                            </div>
						</div>	
							
						<div id="account_info" class="modal-footer tc">
							<div class="col-sm-12 col-lg-12 col-md-12"><p style="font-size:16px;line-height:30px;margin-bottom:15px;"><?=__('账号信息')?></p></div>
							<div class="col-sm-6 col-lg-6 col-md-6">
                                <label class="col-sm-4 col-md-4 col-lg-4 lin32 text-right font14 normal p-l-0" for="user_account "><span class="text-danger">*</span><?=__('帐号')?>：</label>
                                <div class="form-group col-sm-8 col-md-8 col-lg-8 p-0">
                                    <input type="text" id="user_account" name="user_account" class="form-control" style="background: #fafafa;" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6 col-md-6">
                                <label class="col-sm-4 col-md-4 col-lg-4 lin32 text-right font14 normal p-l-0" for="user_realname"><span class="text-danger">*</span><?=__('姓名')?>：</label>
                                <div class="form-group col-sm-8 col-md-8 col-lg-8 p-0">
                                    <input type="text" id="user_realname" name="user_realname" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6 col-md-6">
                                <label class="col-sm-4 col-md-4 col-lg-4 lin32 text-right font14 normal p-l-0" for="user_password"><span class="text-danger">*</span><?=__('密码')?>：</label>
                                <div class="form-group col-sm-8 col-md-8 col-lg-8 p-0">
                                    <input type="password" id="user_password" name="user_password" class="form-control">
									<p class="clear m-t-10"><?=__('修改时可以不填写，表示不修改会员密码')?></p>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6 col-md-6">
                                <label class="col-sm-4 col-md-4 col-lg-4 lin32 text-right font14 normal p-l-0" for="repassword"><span class="text-danger">*</span><?=__('确认密码')?>：</label>
                                <div class="form-group col-sm-8 col-md-8 col-lg-8 p-0">
                                    <input type="password" id="repassword" name="repassword" class="form-control">
									<p class="clear m-t-10"><?=__('修改时可以不填写，表示不修改会员密码')?></p>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6 col-md-6">
                                <label class="col-sm-4 col-md-4 col-lg-4 lin32 text-right font14 normal p-l-0" for="user_mobile"><span class="text-danger">*</span><?=__('手机号码')?>：</label>
                                <div class="form-group col-sm-8 col-md-8 col-lg-8 p-0">
                                    <input type="text" id="user_mobile" name="user_mobile" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6 col-md-6">
                                <label class="col-sm-4 col-md-4 col-lg-4 lin32 text-right font14 normal p-l-0" for="rights_group_id"><?=__('角色')?>：</label>
                                <div class="form-group col-sm-8 col-md-8 col-lg-8 p-0">
                                    <select id="rights_group_id" name="rights_group_id" class="form-control">
										<?php 
											foreach($data['group'] as $k=>$v){
										?>
										<option value="<?=$v['rights_group_id']?>"><?=$v['rights_group_name']?></option>
										<?php }?>
									</select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer tc">
                            <button type="submit" class="btn b-racius3 btn-warning waves-effect waves-light" id="btnSave"><?=__('保存')?></button>
                            <button type="button" class="btn b-racius3 btn-default waves-effect m-r-15 " data-dismiss="modal"><?=__('取消')?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
	
<script src="<?=$this->js('controllers/setting/chain')?>" charset="utf-8"></script>