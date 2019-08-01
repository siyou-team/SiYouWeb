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
	alert('支付操作完成！如果您的订单状态没有改变，请耐心等待支付网关的返回结果。');
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