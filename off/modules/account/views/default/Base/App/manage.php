<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<style type="text/css">
	body {
		background-color: #fff;
		min-width: 200px;
	}
</style>
<div id="manage-wrap">
	<div class="manage-edit-box">
		<div class="box-main">
			<form method="post" enctype="multipart/form-data" id="manage-form" name="manage-form">
				<input type="hidden" class="input-text form-control" name="app_id" id="app_id"  placeholder="服务ID" autocomplete="off" />
				<div class="form-section">
					<label class="input-label" for="app_name">名称，程序调用key sprintf</label>
					<input type="text" class="input-text form-control" name="app_name" id="app_name"  placeholder="名称，程序调用key sprintf('%s_url', app_name)" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="app_label">服务名称</label>
					<input type="text" class="input-text form-control" name="app_label" id="app_label"  placeholder="服务名称" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="app_type">服务类型</label>
					<input type="text" class="input-text form-control" name="app_type" id="app_type"  placeholder="服务类型" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="app_seq">顺序号</label>
					<input type="text" class="input-text form-control" name="app_seq" id="app_seq"  placeholder="顺序号" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="app_key">服务密钥</label>
					<input type="text" class="input-text form-control" name="app_key" id="app_key"  placeholder="服务密钥" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="app_ip">服务 IP 列表</label>
					<input type="text" class="input-text form-control" name="app_ip" id="app_ip"  placeholder="服务 IP 列表" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="app_url_site">服务网址</label>
					<input type="text" class="input-text form-control" name="app_url_site" id="app_url_site"  placeholder="服务网址" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="app_url_admin">后台网址， API设置直接从用户中心同步</label>
					<input type="text" class="input-text form-control" name="app_url_admin" id="app_url_admin"  placeholder="后台网址， API设置直接从用户中心同步" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="app_url_login">登录URL</label>
					<input type="text" class="input-text form-control" name="app_url_login" id="app_url_login"  placeholder="登录URL" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="app_url_logout"></label>
					<input type="text" class="input-text form-control" name="app_url_logout" id="app_url_logout"  placeholder="" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="app_url_reg"></label>
					<input type="text" class="input-text form-control" name="app_url_reg" id="app_url_reg"  placeholder="" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="app_url_recharge"></label>
					<input type="text" class="input-text form-control" name="app_url_recharge" id="app_url_recharge"  placeholder="" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="app_url_order">检查订单是否存在的url地址</label>
					<input type="text" class="input-text form-control" name="app_url_order" id="app_url_order"  placeholder="检查订单是否存在的url地址" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="app_logo">LOGO 图片地址</label>
					<input type="text" class="input-text form-control" name="app_logo" id="app_logo"  placeholder="LOGO 图片地址" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="app_hosts">域名列表</label>
					<input type="text" class="input-text form-control" name="app_hosts" id="app_hosts"  placeholder="域名列表" autocomplete="off" />
				</div>
				<div class="form-section">
					<label class="input-label" for="app_return_fields">返回字段</label>
					<input type="text" class="input-text form-control" name="app_return_fields" id="app_return_fields"  placeholder="返回字段" autocomplete="off" />
				</div>

			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	var curRow, curCol, curArrears, $grid = $("#grid"), $_form = $("#manage-form"), api = frameElement.api, oper = api.data.oper, rowData = api.data.rowData || {}, callback = api.data.callback;

	initPopBtns();
	initField();

	function initField()
	{
		if (rowData.id)
		{
			$('#app_id').val(rowData.app_id);
			$('#app_name').val(rowData.app_name);
			$('#app_label').val(rowData.app_label);
			$('#app_type').val(rowData.app_type);
			$('#app_seq').val(rowData.app_seq);
			$('#app_key').val(rowData.app_key);
			$('#app_ip').val(rowData.app_ip);
			$('#app_url_site').val(rowData.app_url_site);
			$('#app_url_admin').val(rowData.app_url_admin);
			$('#app_url_login').val(rowData.app_url_login);
			$('#app_url_logout').val(rowData.app_url_logout);
			$('#app_url_reg').val(rowData.app_url_reg);
			$('#app_url_recharge').val(rowData.app_url_recharge);
			$('#app_url_order').val(rowData.app_url_order);
			$('#app_logo').val(rowData.app_logo);
			$('#app_hosts').val(rowData.app_hosts);
			$('#app_return_fields').val(rowData.app_return_fields);


			//$('#keyword_find').attr("readonly", "readonly");
			//$('#keyword_find').addClass('ui-input-dis');
		}
	}

	function initPopBtns()
	{
		var btn = "add" == oper ? ["保存", "关闭"] : ["确定", "取消"];
		api.button({
			id: "confirm", name: btn[0], focus: !0, callback: function ()
			{
				postData(oper, rowData.id);
				return cancleGridEdit(), $_form.trigger("validate"), !1;
			}
		}, {id: "cancel", name: btn[1]})
	}

	function postData(oper, id)
	{
		$_form.validator({
			ignore: ':hidden',
			theme: 'yellow_bottom',
			timely: 1,
			stopOnError: true,
			fields: {
				//'keyword_find': 'required;'
			},
			valid: function (form)
			{
				var me = this;
				// 提交表单之前，hold住表单，防止重复提交
				me.holdSubmit();

				$.dialog.confirm('修改立马生效,是否继续？', function ()
				{
					/*
					var keyword_find = $.trim($("#keyword_find").val());

					var params = {keyword_find: keyword_find, keyword_replace: keyword_replace};
					*/
					var n = "add" == oper ? __("新增") : __("修改");

					Public.ajaxPost(SYS.CONFIG.index_url + "?mdu=account&ctl=Base_App&typ=json&met=" + ("add" == oper ? "add" : "edit"), $_form.serialize(), function (resp)
					{
						if (200 == resp.status)
						{
							resp.data['id'] = resp.data['app_id'];
							parent.parent.Public.tips({content: n + "成功！"});
							callback && "function" == typeof callback && callback(resp.data, oper, window)
						}
						else
						{
							parent.parent.Public.tips({type: 1, content: n + "失败！" + resp.msg})
						}

						// 提交表单成功后，释放hold，如果不释放hold，就变成了只能提交一次的表单
						me.holdSubmit(false);
					})
				},
				function ()
				{
					me.holdSubmit(false);
				});
			},
		}).on("click", "a.submit-btn", function (e)
		{
			$(e.delegateTarget).trigger("validate");
		});
	}

	function cancleGridEdit()
	{
		null !== curRow && null !== curCol && ($grid.jqGrid("saveCell", curRow, curCol), curRow = null, curCol = null)
	}

	//设置表单元素回车事件
	function bindEventForEnterKey()
	{
		Public.bindEnterSkip($_form, function()
		{
			$('#grid tr.jqgrow:eq(0) td:eq(0)').trigger('click');
		});
	}

	function resetForm(t)
	{
		$('#app_id').val('');
		$('#app_name').val('');
		$('#app_label').val('');
		$('#app_type').val('');
		$('#app_seq').val('');
		$('#app_key').val('');
		$('#app_ip').val('');
		$('#app_url_site').val('');
		$('#app_url_admin').val('');
		$('#app_url_login').val('');
		$('#app_url_logout').val('');
		$('#app_url_reg').val('');
		$('#app_url_recharge').val('');
		$('#app_url_order').val('');
		$('#app_logo').val('');
		$('#app_hosts').val('');
		$('#app_return_fields').val('');

	}

	$(".box-main .form-section:has(label)").each(function(i, el)
	{
		var $this = $(el),
			$label = $this.find('label'),
			$input = $this.find('.form-control');

		$input.on('focus', function()
		{
			$this.addClass('form-section-active');
			$this.addClass('form-section-focus');
		});

		$input.on('keydown', function()
		{
			$this.addClass('form-section-active');
			$this.addClass('form-section-focus');
		});

		$input.on('blur', function()
		{
			$this.removeClass('form-section-focus');

			if(!$.trim($input.val()))
			{
				$this.removeClass('form-section-active');
			}
		});

		$label.on('click', function()
		{
			$input.focus();
		});

		if($.trim($input.val()))
		{
			$this.addClass('form-section-active');
		}
	});
</script>