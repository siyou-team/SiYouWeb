<?php
include __DIR__ . '/../../includes/header.php';
?>
<!doctype html>
<html lang="zh-CN" >
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-touch-fullscreen" content="yes" />
<meta name="format-detection" content="telephone=no"/>
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="format-detection" content="telephone=no" />
<meta name="msapplication-tap-highlight" content="no" />
<meta name="viewport" content="initial-scale=1,maximum-scale=1,minimum-scale=1" />
<title><?=__('追加评价')?></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
</head>
<body>
<header id="header">
  <div class="header-wrap">
    <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-title">
      <h1><?=__('追加评价')?></h1>
    </div>
  </div>
</header>
<div class="sstouch-main-layout" id="member-evaluation-div"> </div>
<footer id="footer" class="posr"></footer>
<script type="text/html" id="member-evaluation-script">
<div class="special-tips">
	<p><?=__('特别提示：评价晒图选择直接拍照或从手机相册上传图片时，请注意图片尺寸控制在1M以内，超出请压缩裁剪后再选择上传！')?></p>
	</div>
<%if(evaluate_goods.length > 0){%>
	<form>
	<ul class="sstouch-evaluation-goods">
		<%for(var i=0; i<evaluate_goods.length; i++){%>
		<li>
			<div class="evaluation-info">
				<div class="goods-pic">
					<img src="<%=evaluate_goods[i].geval_goodsimage%>"/>
				</div>
				<dl class="goods-info">
					<dt class="goods-name"><%=evaluate_goods[i].geval_goodsname%></dt>
					<dd class="goods-rate"><%=evaluate_goods[i].geval_content%></dd>
				</dl>
			</div>
			<div class="evaluation-inp-block">
			<input type="text" class="textarea" autofocus="false" name="goods[<%=evaluate_goods[i].geval_id%>][comment]" placeholder="亲，写点什么吧，您的意见对其他买家有很大帮助！" style="width: 95%;"/>
			</div>
			<div class="evaluation-upload-block">
				<div class="tit"><i></i><p><?=__('晒图')?></p></div>
				<div class="sstouch-upload">
					<a href="javascript:void(0);">
						<span><input type="file" hidefocus="true" size="1" class="input-file" name="upfile" id=""></span>
						<p><i class="icon-upload"></i></p>
              		</a>
					<input type="hidden" name="goods[<%=evaluate_goods[i].geval_id%>][evaluate_image][0]" value="" />
				</div>
				<div class="sstouch-upload">
					<a href="javascript:void(0);">
						<span><input type="file" hidefocus="true" size="1" class="input-file" name="upfile" id=""></span>
						<p><i class="icon-upload"></i></p>
              		</a>
					<input type="hidden" name="goods[<%=evaluate_goods[i].geval_id%>][evaluate_image][1]" value="" />
				</div>
				<div class="sstouch-upload">
					<a href="javascript:void(0);">
						<span><input type="file" hidefocus="true" size="1" class="input-file" name="upfile" id=""></span>
						<p><i class="icon-upload"></i></p>
              		</a>
					<input type="hidden" name="goods[<%=evaluate_goods[i].geval_id%>][evaluate_image][2]" value="" />
				</div>
				<div class="sstouch-upload">
					<a href="javascript:void(0);">
						<span><input type="file" hidefocus="true" size="1" class="input-file" name="upfile" id=""></span>
						<p><i class="icon-upload"></i></p>
              		</a>
					<input type="hidden" name="goods[<%=evaluate_goods[i].geval_id%>][evaluate_image][3]" value="" />
				</div>
				<div class="sstouch-upload">
					<a href="javascript:void(0);">
						<span><input type="file" hidefocus="true" size="1" class="input-file" name="upfile" id=""></span>
						<p><i class="icon-upload"></i></p>
              		</a>
					<input type="hidden" name="goods[<%=evaluate_goods[i].geval_id%>][evaluate_image][4]" value="" />
				</div>
			</div>
		</li>
		<%}%>
	</ul>
	<a class="btn-l mt5 mb5"><?=__('提交')?></a>
	<form>
<%}%>
</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script><script type="text/javascript" src="../../js/common.js"></script>
<script type="text/javascript" src="../../js/tmpl/member_evaluation_again.js"></script>
<script type="text/javascript" src="../../js/tmpl/footer.js"></script>
</body>
</html>
<?php
include __DIR__ . '/../../includes/footer.php';
?>
