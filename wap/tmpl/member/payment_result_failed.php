<?php
include __DIR__ . '/../../includes/header.php';
?>
<!DOCTYPE html>
<html lang="zh-CN" >
<head>
<meta http-equiv="Content-type" content="text/html;charset=utf-8" />
<title><?=__('支付结果')?></title>
</head>
<body>
<?=__('正在加载…')?>
<script type="text/javascript">
window.onload = function() {
	alert('Sorry，支付未完成或失败！');
	if (/attach\=v$/.test(location.href)) {
		location.href = 'vr_order_list.html';
	} else {
		location.href = 'order_list.html';
	}
}
</script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
