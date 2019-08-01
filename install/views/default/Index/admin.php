<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="viewport" content="width=device-width"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="robots" content="noindex,nofollow"/>
	<title><?= __('欢迎您选用ShopSuite网上商店管理系统！') ?></title>
	<link rel='stylesheet' id='buttons-css' href='./static/common/css/buttons.css?ver=4.5.2' type='text/css' media='all'/>
	<link rel='stylesheet' id='install-css' href='./static/common/css/install.css?ver=4.5.2' type='text/css' media='all'/>
</head>
<body class="wp-core-ui">
<p id="logo"><a href="http://www.shopsuite.cn/" tabindex="-1">ShopSuite</a></p>

<h1>创建管理员账号</h1>

<form id="setup" method="post" action="index.php?met=createAdminAccount&language=zh_CN" novalidate="novalidate">
	<table class="form-table">
		<tr>
			<th scope="row"><label for="user_login">用户名</label></th>
			<td>
				<input name="user_account" type="text" id="user_login" size="25" value=""  style="width: 100%" />
				<p></p>
			</td>
		</tr>
		<tr class="form-field form-required user-pass1-wrap">
			<th scope="row">
				<label for="pass1"> 密码	</label>
			</th>
			<td>
				<div class="">
					<input type="text" name="user_password" id="pass1" class="regular-text"  value=""  style="width: 100%" />
					<div id="pass-strength-result" aria-live="polite"></div>
				</div>
				<p><span class="description important hide-if-no-js">
				<strong>重要：</strong>您将需要此密码来登录，请将其保存在安全的位置。</span></p>
			</td>
		</tr>

        <!--
		<tr class="form-field form-required user-pass1-wrap">
			<th scope="row">
				<label for="passport_app_url"> 用户中心网址	</label>
			</th>
			<td>
				<div class="">
					<input type="text" name="passport_app_url" id="passport_app_url" class="regular-text"  value="<?=Base_ConfigModel::getConfig('passport_app_url', Zero_Registry::get('base_url') . '/account.php')?>"  style="width: 100%" />
					<div id="pass-strength-result" aria-live="polite"></div>
				</div>
				<p><span class="description important hide-if-no-js">
				<strong></strong>用户中心网址。</span></p>
			</td>
		</tr>

		<tr class="form-field form-required user-pass1-wrap">
			<th scope="row">
				<label for="passport_app_key"> 用户中心Key	</label>
			</th>
			<td>
				<div class="">
					<input type="text" name="passport_app_key" id="passport_app_key" class="regular-text"  value="<?=Base_ConfigModel::getConfig('passport_app_key')?>" style="width: 100%" />
					<div id="pass-strength-result" aria-live="polite"></div>
				</div>
				<p><span class="description important hide-if-no-js">
				<strong></strong>用户中心Key。</span></p>
			</td>
		</tr>
        -->
	</table>
	<p class="step"><input type="submit" name="Submit" id="submit" class="button button-large" value="创建管理员账号"  /></p>
	<input type="hidden" name="language" value="zh_CN" />
</form>
</body>
</html>
