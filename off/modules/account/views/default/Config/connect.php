<link rel="stylesheet" href="<?=$this->css('plugins/icheck/skins/all', true)?>">
<link rel="stylesheet" href="<?=$this->css('plugins/multiselect/css/multi-select', true)?>">
<link rel="stylesheet" href="<?=$this->css('plugins/select2/select2-new', true)?>">
<link rel="stylesheet" href="<?=$this->css('plugins/select2/select2-bootstrap', true)?>">
<?php
foreach ($data as $key =>$item) {
	$$key = $item['config_value'];
}
?>
<div class="page-container">
	<div class="main-content">
		<div class="page-title">
			<div class="title-env">
				<p class="description"><?= __('互联登录设置') ?></p>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6">
				<div class="panel panel-default">
					<div class="panel-heading">
                        <div class="panel-title">Weixin账号设置</div>
                        <small class="pull-right"><a target="_blank" href="https://jingyan.baidu.com/article/cb5d6105fa1c90005c2fe0c1.html">如何申请</a></small>
					</div>
					<div class="panel-body">
						<form method="post" id="weixin-connect-form" name="weixin-connect-form" class="form-horizontal setting-form">
							<input type="hidden" name="config_type[]" value="connect"/>
							
							<div class="form-group">
                                <label class="col-sm-2 control-label" for="weixin_app_id">Weixin App Id</label>
								
								<div class="col-sm-10">
									<input type="text" value="<?=$data['weixin_app_id']['config_value']?>" name="connect[weixin_app_id]" id="weixin_app_id" class="form-control">
									<p class="help-block"></p>
								</div>
							</div>
							<div class="form-group-separator"></div>

							<div class="form-group">
								<label class="col-sm-2 control-label" for="weixin_app_key">Weixin App Key</label>
								<div class="col-sm-10">
									<input type="text" value="<?=$data['weixin_app_key']['config_value']?>" name="connect[weixin_app_key]" id="weixin_app_key" class="form-control">
									<p class="help-block"></p>
								</div>
							</div>
							<div class="form-group-separator"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="weixin_status">是否开启</label>
                                <div class="col-sm-10">
                                    <label title="开启" for="weixin_status1">
                                    <input class="cbr cbr-success"  id="weixin_status1" name="connect[weixin_status]" value="1" type="radio" <?= ($data['weixin_status']['config_value'] == 1 ? 'checked' : '') ?>>
                                        开启</label>
                                    &nbsp;&nbsp;
                                    <label title="关闭" for="weixin_status0">
                                    <input class="cbr " id="weixin_status0" name="connect[weixin_status]" value="0"  type="radio" <?= ($data['weixin_status']['config_value'] == 0 ? 'checked' : '') ?>>关闭</label>
                                    
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group-separator"></div>

							<div class="form-group">
								<a type="submit"
								   class="btn btn-primary btn-single btn-block btn-icon btn-icon-standalone"
								   id="submit-btn">
									<i class="fa-pencil"></i>
									<span>修改</span>
								</a>
							</div>
						</form>
					</div>
				</div>
			</div>


			<div class="col-sm-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="panel-title">Weibo账号设置</div>
                        <small class="pull-right"><a target="_blank" href="https://jingyan.baidu.com/article/455a99508c91c8a166277893.html">如何申请</a></small>
					</div>
					<div class="panel-body">
						<form method="post" id="weibo-connect-form" name="weibo-connect-form" class="form-horizontal setting-form">
							<input type="hidden" name="config_type[]" value="connect"/>
							
							<div class="form-group">
								<label class="col-sm-2 control-label" for="weibo_app_id">Weibo App Id</label>
								
								<div class="col-sm-10">
									<input type="text" value="<?=$data['weibo_app_id']['config_value']?>" name="connect[weibo_app_id]" id="weibo_app_id" class="form-control">
									<p class="help-block"></p>
								</div>
							</div>
							<div class="form-group-separator"></div>

							<div class="form-group">
								<label class="col-sm-2 control-label" for="weibo_app_key">Weibo App Key</label>
								<div class="col-sm-10">
									<input type="text" value="<?=$data['weibo_app_key']['config_value']?>" name="connect[weibo_app_key]" id="weibo_app_key" class="form-control">
									<p class="help-block"></p>
								</div>
							</div>
							<div class="form-group-separator"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="weibo_status">是否开启</label>
                                <div class="col-sm-10">
                                    <label title="开启" for="weibo_status1">
                                    <input class="cbr cbr-success"  id="weibo_status1" name="connect[weibo_status]" value="1" type="radio" <?= ($data['weibo_status']['config_value'] == 1 ? 'checked' : '') ?>>
                                        开启</label>
                                    &nbsp;&nbsp;
                                    <label title="关闭" for="weibo_status0">
                                    <input class="cbr " id="weibo_status0" name="connect[weibo_status]" value="0"  type="radio" <?= ($data['weibo_status']['config_value'] == 0 ? 'checked' : '') ?>>关闭</label>
                                    
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group-separator"></div>

							<div class="form-group">
								<a type="submit"
								   class="btn btn-primary btn-single btn-block btn-icon btn-icon-standalone"
								   id="submit-btn">
									<i class="fa-pencil"></i>
									<span>修改</span>
								</a>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="col-sm-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="panel-title">Qq账号设置</div>
                        <small class="pull-right"><a target="_blank" href="https://jingyan.baidu.com/article/d8072ac498fd2dec95cefd1d.html">如何申请</a></small>
					</div>
					<div class="panel-body">
						<form method="post" id="qq-connect-form" name="qq-connect-form" class="form-horizontal setting-form">
							<input type="hidden" name="config_type[]" value="connect"/>
							
							<div class="form-group">
								<label class="col-sm-2 control-label" for="qq_callback_url">回调地址</label>
								
								<div class="col-sm-10">
									<input type="text" value="<?=$data['qq_callback_url']['config_value']?>" name="connect[qq_callback_url]" id="qq_callback_url" class="form-control" readonly >
									<p class="help-block">在QQ互联平台中会要求填写回调地址。</p>
								</div>
							</div>
							<div class="form-group-separator"></div>

							<div class="form-group">
								<label class="col-sm-2 control-label" for="qq_app_id">Qq App Id</label>
								
								<div class="col-sm-10">
									<input type="text" value="<?=$data['qq_app_id']['config_value']?>" name="connect[qq_app_id]" id="qq_app_id" class="form-control">
									<p class="help-block"></p>
								</div>
							</div>
							<div class="form-group-separator"></div>

							<div class="form-group">
								<label class="col-sm-2 control-label" for="qq_app_key">Qq App Key</label>
								<div class="col-sm-10">
									<input type="text" value="<?=$data['qq_app_key']['config_value']?>" name="connect[qq_app_key]" id="qq_app_key" class="form-control">
									<p class="help-block"></p>
								</div>
							</div>
							<div class="form-group-separator"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="qq_status">是否开启</label>
                                <div class="col-sm-10">
                                    <label title="开启" for="qq_status1">
                                    <input class="cbr cbr-success"  id="qq_status1" name="connect[qq_status]" value="1" type="radio" <?= ($data['qq_status']['config_value'] == 1 ? 'checked' : '') ?>>
                                        开启</label>
                                    &nbsp;&nbsp;
                                    <label title="关闭" for="qq_status0">
                                    <input class="cbr " id="qq_status0" name="connect[qq_status]" value="0"  type="radio" <?= ($data['qq_status']['config_value'] == 0 ? 'checked' : '') ?>>关闭</label>
                                    
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group-separator"></div>

							<div class="form-group">
								<a type="submit"
								   class="btn btn-primary btn-single btn-block btn-icon btn-icon-standalone"
								   id="submit-btn">
									<i class="fa-pencil"></i>
									<span>修改</span>
								</a>
							</div>
						</form>
					</div>
				</div>
			</div>


			<div class="col-sm-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="panel-title">手机动态码登录设置</div>
                        <small class="pull-right" id="set-mobile-connect"><a target="_blank" href="javascript:void(0)">设置</a></small>
					</div>
					<div class="panel-body">
						<form method="post" id="mobile-connect-form" name="mobile-connect-form" class="form-horizontal setting-form">
							<input type="hidden" name="config_type[]" value="connect"/>
							
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="mobile_status">是否开启</label>
                                <div class="col-sm-10">
                                    <label title="开启" for="mobile_status1">
                                    <input class="cbr cbr-success"  id="mobile_status1" name="connect[mobile_status]" value="1" type="radio" <?= ($data['mobile_status']['config_value'] == 1 ? 'checked' : '') ?>>
                                        开启</label>
                                    &nbsp;&nbsp;
                                    <label title="关闭" for="mobile_status0">
                                    <input class="cbr " id="mobile_status0" name="connect[mobile_status]" value="0"  type="radio" <?= ($data['mobile_status']['config_value'] == 0 ? 'checked' : '') ?>>关闭</label>
                                    
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group-separator"></div>

							<div class="form-group">
								<a type="submit"
								   class="btn btn-primary btn-single btn-block btn-icon btn-icon-standalone"
								   id="submit-btn">
									<i class="fa-pencil"></i>
									<span>修改</span>
								</a>
							</div>
						</form>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<script type="text/javascript" src="<?=$this->js('plugins/tagsinput/bootstrap-tagsinput.min', true)?>" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->js('plugins/multiselect/js/jquery.multi-select', true)?>" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->js('plugins/select2/js/select2.full', true)?>" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->js('modules/account/config')?>" charset="utf-8"></script>
<script type="text/javascript">
    $(document).on("click", "#set-mobile-connect", function () {
        var text = __("短信登录");
        var url =  SYS.CONFIG.index_url + '?mdu=plantform&ctl=Config&met=sms&config_type%5B%5D=service&config_type%5B%5D=sms';
        parent.tab.addTabItem({
            text: text,
            url: url
        });
    });
</script>